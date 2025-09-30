<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$username = isset($_SESSION['USERNAME']) ? $_SESSION['USERNAME'] : 'Guest';
$permission = isset($_SESSION['PERMISSION']) ? (string)$_SESSION['PERMISSION'] : '0';

$permissionLabel = 'Guest';
if ($permission === '3') {
    $permissionLabel = 'Administrator';
} elseif ($permission === '2') {
    $permissionLabel = 'Driver';
} elseif ($permission === '1') {
    $permissionLabel = 'Student';
}

$menuItems = [
    ['label' => 'Schedule', 'href' => '?act=sch', 'visible' => in_array($permission, ['1', '2', '3'], true)],
    ['label' => 'Profile', 'href' => '?act=profile', 'visible' => $permission !== '0'],
    ['label' => 'Settings Panel', 'href' => '?act=admin', 'visible' => $permission === '3'],
    ['label' => 'User Directory', 'href' => '?act=ul', 'visible' => $permission === '3'],
    ['label' => 'Logout', 'href' => '?act=logout', 'visible' => $permission !== '0'],
];

?>
<div class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-header">
        <a href="http://www.uark.edu">
            <img src="/resources/img/logo-on-red.png" style="position:absolute; padding-left:35px; left:-5px;" alt="University of Arkansas" />
        </a>
    </div>
    <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1" style="margin-right:1%">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li style="padding: 3px 20px" class="text-muted"><?php echo htmlspecialchars($permissionLabel, ENT_QUOTES, 'UTF-8'); ?></li>
                    <li class="divider"></li>
                    <?php foreach ($menuItems as $item) : ?>
                        <?php if ($item['visible']) : ?>
                            <li><a href="<?php echo htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </li>
        </ul>
    </div>
</div>
