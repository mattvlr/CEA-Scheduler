<?php
/**
 * Lightweight in-memory data access layer that emulates the original MySQL
 * queries the prototype relied on. Data is stored in data/sample_data.php and
 * can be queried using a handful of high-level helper methods. This keeps the
 * legacy PHP pages functional without needing an actual MySQL instance.
 */
class DataRepository
{
    /** @var array<string, array<int, array<string, mixed>>> */
    private $data;

    /** @var string */
    private $dataFile;

    public function __construct($dataFile = __DIR__ . '/../data/sample_data.php')
    {
        if (!file_exists($dataFile)) {
            throw new RuntimeException('Sample data file missing: ' . $dataFile);
        }

        $this->dataFile = $dataFile;
        $this->data = require $dataFile;
    }

    /**
     * Return a single user by their internal numeric id.
     *
     * @param int|string $id
     * @return array<string, mixed>|null
     */
    public function findUserById($id)
    {
        foreach ($this->data['Users'] as $user) {
            if ((string)$user['ID'] === (string)$id) {
                return $user;
            }
        }

        return null;
    }

    /**
     * Return a single user by their username.
     *
     * @param string $username
     * @return array<string, mixed>|null
     */
    public function findUserByUsername($username)
    {
        foreach ($this->data['Users'] as $user) {
            if (strcasecmp($user['USERNAME'], $username) === 0) {
                return $user;
            }
        }

        return null;
    }

    /**
     * Return the user that owns the provided activation code.
     *
     * @param string $code
     * @return array<string, mixed>|null
     */
    public function findUserByActivationCode($code)
    {
        foreach ($this->data['Users'] as $user) {
            if ($user['ACTIVATION'] === $code) {
                return $user;
            }
        }

        return null;
    }

    /**
     * Update the permission level for a user using their activation code.
     * The updated data is written back to the sample data file so a page
     * refresh reflects the change.
     *
     * @param string $code
     * @param string|int $permission
     * @return bool
     */
    public function activateUserByCode($code, $permission)
    {
        foreach ($this->data['Users'] as $index => $user) {
            if ($user['ACTIVATION'] === $code) {
                $this->data['Users'][$index]['PERMISSION'] = (string)$permission;
                $this->data['Users'][$index]['Active'] = 1;
                return $this->persist();
            }
        }

        return false;
    }

    /**
     * Provide a sorted list of all users so the admin directory works.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listUsers()
    {
        $users = $this->data['Users'];
        usort($users, function ($a, $b) {
            $last = strcasecmp($a['LAST_NAME'], $b['LAST_NAME']);
            if ($last !== 0) {
                return $last;
            }

            return strcasecmp($a['FIRST_NAME'], $b['FIRST_NAME']);
        });

        return $users;
    }

    /**
     * Fuzzy search by first or last name – used by search.php.
     *
     * @param string $query
     * @return array<int, array<string, mixed>>
     */
    public function searchUsers($query)
    {
        $needle = strtolower($query);

        return array_values(array_filter($this->data['Users'], function ($user) use ($needle) {
            return strpos(strtolower($user['FIRST_NAME']), $needle) !== false
                || strpos(strtolower($user['LAST_NAME']), $needle) !== false
                || strpos(strtolower($user['USERNAME']), $needle) !== false;
        }));
    }

    /**
     * Return the schedule entries for the provided day (YYYY-MM-DD).
     *
     * @param string $day
     * @return array<int, array<string, mixed>>
     */
    public function getScheduleForDay($day)
    {
        $matches = array_values(array_filter($this->data['Schedules'], function ($schedule) use ($day) {
            return $schedule['Day'] === $day;
        }));

        usort($matches, function ($a, $b) {
            return strcmp($a['PickupTime'], $b['PickupTime']);
        });

        return $matches;
    }

    /**
     * Return all driver shift blocks for a university id.
     *
     * @param string $universityId
     * @return array<int, array<string, mixed>>
     */
    public function getDriverTimes($universityId)
    {
        $matches = array_values(array_filter($this->data['DriverTimes'], function ($row) use ($universityId) {
            return $row['UniversityID'] === $universityId;
        }));

        usort($matches, function ($a, $b) {
            return strcmp($a['StartTime'], $b['StartTime']);
        });

        return $matches;
    }

    /**
     * Return all recurring student rides for a university id.
     *
     * @param string $universityId
     * @return array<int, array<string, mixed>>
     */
    public function getStudentTimes($universityId)
    {
        $matches = array_values(array_filter($this->data['StudentTimes'], function ($row) use ($universityId) {
            return $row['UniversityID'] === $universityId;
        }));

        usort($matches, function ($a, $b) {
            return strcmp($a['RideTime'], $b['RideTime']);
        });

        return $matches;
    }

    /**
     * Return stop metadata for a collection of place codes.
     *
     * @param array<int, string> $places
     * @return array<int, array<string, mixed>>
     */
    public function getStopsByPlaces(array $places)
    {
        $needle = array_map('strval', $places);

        return array_values(array_filter($this->data['Stops'], function ($stop) use ($needle) {
            return in_array($stop['Place'], $needle, true);
        }));
    }

    /**
     * Return every stop.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getStops()
    {
        return $this->data['Stops'];
    }

    /**
     * Persist the mutated data array back to disk.
     *
     * @return bool
     */
    private function persist()
    {
        $export = var_export($this->data, true);
        $php = "<?php\nreturn " . $export . ";\n";

        return (bool)file_put_contents($this->dataFile, $php);
    }
}
