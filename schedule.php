<?php
require_once __DIR__ . '/lib/DataRepository.php';

$repository = new DataRepository();
$day = isset($_GET['day']) ? $_GET['day'] : date('Y-m-d');
$schedule = $repository->getScheduleForDay($day);

echo '<div class="panel panel-primary" style="width:90%;margin-right:4%">';
echo '<div class="panel-heading"><h3 class="panel-title">Schedule ' . htmlspecialchars($day, ENT_QUOTES, 'UTF-8') . '</h3></div>';
echo '<table class="table table-striped"><thead><tr><th>Golf Cart</th><th>Student Name</th><th>Driver</th><th>Pickup Time</th><th>Pickup Point</th><th>Dropoff Time</th><th>Dropoff Point</th><th>Backup Driver</th></tr></thead><tbody>';

if (!$schedule) {
    echo '<tr><td colspan="8" class="text-center text-muted">No rides scheduled for this day.</td></tr>';
} else {
    foreach ($schedule as $row) {
        $driverClass = (strcasecmp($row['Driver'], 'No Driver') === 0) ? ' class="danger"' : '';
        $backupClass = (strcasecmp($row['BackupDriver'], 'No Backup') === 0) ? ' class="danger"' : '';

        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['Cart'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($row['Student_First'] . ' ' . $row['StudentLast'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td' . $driverClass . '>' . htmlspecialchars($row['Driver'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($row['PickupTime'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($row['PickupPoint'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($row['DropTime'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($row['DropPoint'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td' . $backupClass . '>' . htmlspecialchars($row['BackupDriver'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '</tr>';
    }
}

echo '</tbody></table></div>';
