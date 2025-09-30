<?php
require_once __DIR__ . '/../lib/DataRepository.php';
require_once __DIR__ . '/_db.php';

class mysql_driver extends db_info
{
    /** @var DataRepository */
    private $repository;

    public function __construct()
    {
        $this->repository = new DataRepository();
    }

    public function connect()
    {
        // Legacy code expects a boolean response when the database is ready.
        return true;
    }

    public function getSessionInfo($id)
    {
        $user = $this->repository->findUserById($id);
        if (!$user) {
            return false;
        }

        return [
            'USERNAME' => $user['USERNAME'],
            'FIRST_NAME' => $user['FIRST_NAME'],
            'LAST_NAME' => $user['LAST_NAME'],
            'PERMISSION' => $user['PERMISSION'],
        ];
    }

    public function login($username, $password)
    {
        $user = $this->repository->findUserByUsername($username);
        if (!$user) {
            return false;
        }

        $hash = $user['PASSHASH'];
        if ($hash && password_verify($password, $hash)) {
            return $user['ID'];
        }

        // Support the legacy crypt() hashes that appear in the old SQL dump.
        if ($hash && crypt($password, $hash) === $hash) {
            return $user['ID'];
        }

        return false;
    }

    public function getStops()
    {
        return $this->repository->getStops();
    }

    public function getPlaces($universityId)
    {
        return $this->repository->getStudentTimes($universityId);
    }

    public function select($table, $get, $where = '')
    {
        $record = $this->selectSingleRecord($table, $where);
        if (!$record) {
            return false;
        }

        if (is_array($get)) {
            $result = [];
            foreach ($get as $column) {
                $result[$column] = isset($record[$column]) ? $record[$column] : null;
            }
            return $result;
        }

        return isset($record[$get]) ? $record[$get] : null;
    }

    public function selectMany($table, $get, $where = '')
    {
        $records = $this->selectRecords($table, $where);
        if (!$records) {
            return false;
        }

        if (is_array($get)) {
            $result = [];
            foreach ($records as $index => $record) {
                $result[$index] = [];
                foreach ($get as $column) {
                    $result[$index][$column] = isset($record[$column]) ? $record[$column] : null;
                }
            }
            return $result;
        }

        return array_map(function ($record) use ($get) {
            return isset($record[$get]) ? $record[$get] : null;
        }, $records);
    }

    public function update($table, $set, $where = '')
    {
        if ($table !== 'Users') {
            return false;
        }

        $code = $this->extractConditionValue($where, 'ACTIVATION');
        if ($code === null) {
            return false;
        }

        $permission = $this->extractConditionValue($set, 'PERMISSION');
        if ($permission === null) {
            return false;
        }

        return $this->repository->activateUserByCode($code, $permission);
    }

    public function disconnect()
    {
        return true;
    }

    private function selectSingleRecord($table, $where)
    {
        $records = $this->selectRecords($table, $where);
        if (!$records) {
            return null;
        }

        return $records[0];
    }

    private function selectRecords($table, $where)
    {
        switch ($table) {
            case 'Users':
                $activationCode = $this->extractConditionValue($where, 'ACTIVATION');
                if ($activationCode !== null) {
                    $user = $this->repository->findUserByActivationCode($activationCode);
                    return $user ? [$user] : [];
                }

                $username = $this->extractConditionValue($where, 'USERNAME');
                if ($username !== null) {
                    $user = $this->repository->findUserByUsername($username);
                    return $user ? [$user] : [];
                }

                $id = $this->extractConditionValue($where, 'ID');
                if ($id !== null) {
                    $user = $this->repository->findUserById($id);
                    return $user ? [$user] : [];
                }

                return $this->repository->listUsers();
            case 'StudentTimes':
                $studentId = $this->extractConditionValue($where, 'UniversityID');
                if ($studentId !== null) {
                    return $this->repository->getStudentTimes($studentId);
                }
                break;
            case 'DriverTimes':
                $driverId = $this->extractConditionValue($where, 'UniversityID');
                if ($driverId !== null) {
                    return $this->repository->getDriverTimes($driverId);
                }
                break;
            case 'Stops':
                $place = $this->extractConditionValue($where, 'Place');
                if ($place !== null) {
                    return $this->repository->getStopsByPlaces([$place]);
                }

                return $this->repository->getStops();
        }

        return [];
    }


    private function extractConditionValue($where, $field)
    {
        if ($where === null || $where === '') {
            return null;
        }

        $position = stripos($where, $field);
        if ($position === false) {
            return null;
        }

        $fragment = substr($where, $position + strlen($field));
        $fragment = ltrim($fragment);
        if ($fragment === '') {
            return null;
        }

        if ($fragment[0] === '=') {
            $fragment = ltrim(substr($fragment, 1));
        }

        if ($fragment === '') {
            return null;
        }

        $delimiter = $fragment[0];
        if ($delimiter === chr(34) || $delimiter === chr(39)) {
            $end = strpos($fragment, $delimiter, 1);
            if ($end === false) {
                return null;
            }

            return substr($fragment, 1, $end - 1);
        }

        $parts = preg_split('/\s+/', $fragment);
        if (!$parts) {
            return null;
        }

        return $parts[0];
    }
}
