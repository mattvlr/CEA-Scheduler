<?php
session_start();

require_once __DIR__ . '/lib/DataRepository.php';

$repository = new DataRepository();

if (!isset($_SESSION['USERNAME'])) {
    header('Location: loginform.php');
    exit;
}

$username = isset($_GET['u']) ? $_GET['u'] : $_SESSION['USERNAME'];
$user = $repository->findUserByUsername($username);

if (!$user) {
    echo '<div class="alert alert-warning">User profile not found.</div>';
    return;
}

$permission = (string)$user['PERMISSION'];
$studentTimes = $repository->getStudentTimes($user['UniversityID']);
$driverTimes = $repository->getDriverTimes($user['UniversityID']);

function renderDayMask($mask)
{
    $labels = ['M', 'Tu', 'W', 'Th', 'F'];
    $output = [];
    for ($i = 0; $i < strlen($mask) && $i < count($labels); $i++) {
        if ($mask[$i] === '1') {
            $output[] = $labels[$i];
        }
    }

    return $output ? implode(' ', $output) : 'None';
}

function buildRideTable($rides)
{
    if (!$rides) {
        return '<p class="text-muted">No recurring rides scheduled.</p>';
    }

    $rows = '';
    foreach ($rides as $ride) {
        $days = renderDayMask($ride['Day']);
        $rowClass = ($days === 'None') ? ' class="danger"' : '';
        $rows .= '<tr' . $rowClass . '><td>' . htmlspecialchars($ride['RideTime'], ENT_QUOTES, 'UTF-8') . '</td><td>' .
            htmlspecialchars($ride['PickupPlace'], ENT_QUOTES, 'UTF-8') . '</td><td>' .
            htmlspecialchars($ride['DropPlace'], ENT_QUOTES, 'UTF-8') . '</td><td>' .
            htmlspecialchars($days, ENT_QUOTES, 'UTF-8') . '</td></tr>';
    }

    return '<table class="table table-striped table-condensed"><caption>Current Scheduled Rides</caption><thead><tr class="info"><th>Ride Time</th><th>Pickup Location</th><th>Dropoff Location</th><th>Days</th></tr></thead><tbody>' . $rows . '</tbody></table>';
}

function buildDriverTable($shifts)
{
    if (!$shifts) {
        return '<p class="text-muted">No driver shifts scheduled.</p>';
    }

    $rows = '';
    foreach ($shifts as $shift) {
        $days = renderDayMask($shift['DaysOfWeek']);
        $rowClass = ($days === 'None') ? ' class="danger"' : '';
        $rows .= '<tr' . $rowClass . '><td>' . htmlspecialchars($shift['StartTime'], ENT_QUOTES, 'UTF-8') . '</td><td>' .
            htmlspecialchars($shift['EndTime'], ENT_QUOTES, 'UTF-8') . '</td><td>' .
            htmlspecialchars($days, ENT_QUOTES, 'UTF-8') . '</td></tr>';
    }

    return '<table class="table table-striped table-condensed"><caption>Current Scheduled Shifts</caption><thead><tr class="info"><th>Start Time</th><th>End Time</th><th>Days</th></tr></thead><tbody>' . $rows . '</tbody></table>';
}

$todayIndex = (int)date('N') - 1;
$todaysStops = [];
foreach ($studentTimes as $ride) {
    if ($todayIndex >= 0 && $todayIndex < strlen($ride['Day']) && $ride['Day'][$todayIndex] === '1') {
        $todaysStops[] = $ride['PickupPlace'];
    }
}

$stopDetails = $todaysStops ? $repository->getStopsByPlaces($todaysStops) : [];

$permissionLabel = 'Guest';
if ($permission === '3') {
    $permissionLabel = 'Administrator';
} elseif ($permission === '2') {
    $permissionLabel = 'Driver';
} elseif ($permission === '1') {
    $permissionLabel = 'Student';
}

?>
<div class="panel panel-default" style="margin: 1em;">
    <div class="panel-heading">
        <h3 class="panel-title">Profile for <?php echo htmlspecialchars($user['FIRST_NAME'] . ' ' . $user['LAST_NAME'], ENT_QUOTES, 'UTF-8'); ?></h3>
    </div>
    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Username</dt>
            <dd><?php echo htmlspecialchars($user['USERNAME'], ENT_QUOTES, 'UTF-8'); ?></dd>
            <dt>University ID</dt>
            <dd><?php echo htmlspecialchars($user['UniversityID'], ENT_QUOTES, 'UTF-8'); ?></dd>
            <dt>Email</dt>
            <dd><?php echo htmlspecialchars($user['EMAIL'], ENT_QUOTES, 'UTF-8'); ?></dd>
            <dt>Permission</dt>
            <dd><?php echo htmlspecialchars($permissionLabel, ENT_QUOTES, 'UTF-8'); ?></dd>
            <dt>Rides Taken</dt>
            <dd><?php echo htmlspecialchars($user['NumRides'], ENT_QUOTES, 'UTF-8'); ?></dd>
            <dt>No Shows</dt>
            <dd><?php echo htmlspecialchars($user['NoShows'], ENT_QUOTES, 'UTF-8'); ?></dd>
            <dt>Notes</dt>
            <dd><?php echo nl2br(htmlspecialchars($user['Notes'], ENT_QUOTES, 'UTF-8')); ?></dd>
        </dl>
    </div>
</div>

<?php if ($permission === '1' || $permission === '3') : ?>
<div class="panel panel-info" style="margin: 1em;">
    <div class="panel-heading"><h3 class="panel-title">Rides</h3></div>
    <div class="panel-body">
        <?php echo buildRideTable($studentTimes); ?>
    </div>
</div>
<?php endif; ?>

<?php if ($permission === '2' || $permission === '3') : ?>
<div class="panel panel-info" style="margin: 1em;">
    <div class="panel-heading"><h3 class="panel-title">Driver Shifts</h3></div>
    <div class="panel-body">
        <?php echo buildDriverTable($driverTimes); ?>
    </div>
</div>
<?php endif; ?>

<?php if ($permission === '1' || $permission === '3') : ?>
<div class="panel panel-default" style="margin: 1em;">
    <div class="panel-heading"><h3 class="panel-title">Today's Stops</h3></div>
    <div class="panel-body">
        <?php if (!$stopDetails) : ?>
            <p class="text-muted">No pickups scheduled for today.</p>
        <?php else : ?>
            <ul class="list-group">
                <?php foreach ($stopDetails as $stop) : ?>
                    <li class="list-group-item">
                        <strong><?php echo htmlspecialchars($stop['Place'], ENT_QUOTES, 'UTF-8'); ?></strong>
                        &mdash; <?php echo htmlspecialchars($stop['FullName'], ENT_QUOTES, 'UTF-8'); ?><br>
                        <small><?php echo htmlspecialchars($stop['Address'] . ', ' . $stop['City'] . ', ' . $stop['State'] . ' ' . $stop['ZipCode'], ENT_QUOTES, 'UTF-8'); ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>
