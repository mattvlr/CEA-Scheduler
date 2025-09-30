<?php
require_once __DIR__ . '/lib/DataRepository.php';

$repository = new DataRepository();
$users = $repository->listUsers();

echo '<div class="panel panel-primary" style="width:90%;margin-right:4%">';
echo '<div class="panel-heading"><h3 class="panel-title">User List</h3></div>';
echo '<table class="table"><thead><tr><th>ID</th><th>Last Name</th><th>First Name</th><th>University ID</th><th>Username</th><th>Permission</th></tr></thead><tbody>';

if (!$users) {
    echo '<tr><td colspan="6" class="text-center text-muted">No users available.</td></tr>';
} else {
    foreach ($users as $user) {
        $permissionClass = '';
        $permissionLabel = 'Guest';

        switch ((string)$user['PERMISSION']) {
            case '3':
                $permissionClass = ' class="danger"';
                $permissionLabel = 'Admin';
                break;
            case '2':
                $permissionClass = ' class="info"';
                $permissionLabel = 'Driver';
                break;
            case '1':
                $permissionClass = ' class="success"';
                $permissionLabel = 'Student';
                break;
            case '0':
                $permissionClass = '';
                $permissionLabel = 'Guest';
                break;
            default:
                $permissionClass = ' class="warning"';
                $permissionLabel = 'Inactive';
                break;
        }

        $username = htmlspecialchars($user['USERNAME'], ENT_QUOTES, 'UTF-8');
        $link = '?act=profile&u=' . $username;

        echo '<tr' . $permissionClass . ' data-href="' . $link . '">';
        echo '<td>' . htmlspecialchars($user['ID'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($user['LAST_NAME'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($user['FIRST_NAME'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($user['UniversityID'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . $username . '</td>';
        echo '<td>' . $permissionLabel . '</td>';
        echo '</tr>';
    }
}

echo '</tbody></table></div>';
?>
<script>
$('tr[data-href]').on("click", function() {
    document.location = $(this).data('href');
});
</script>
