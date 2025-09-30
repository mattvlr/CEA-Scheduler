<?php
require_once __DIR__ . '/mysql/_mysql.php';

$mysql = new mysql_driver();
$mysql->connect();

$code = isset($_GET['code']) ? $_GET['code'] : '';
$message = 'Invalid activation, please double check your link.';

if ($code !== '') {
    $perm = $mysql->select('Users', 'PERMISSION', 'ACTIVATION="' . $code . '"');

    if ($perm === false) {
        $message = 'We could not find an account for that activation code.';
    } elseif ((string)$perm === '0') {
        if ($mysql->update('Users', "PERMISSION='1'", 'ACTIVATION="' . $code . '"')) {
            $message = 'Your account is now activated.<br>Login <a href="loginform.php">here</a>!';
        } else {
            $message = 'Activation failed. Please try again.';
        }
    } else {
        $message = 'Your account is already activated.<br>Login <a href="loginform.php">here</a>!';
    }
}

echo '<div class="alert alert-info" style="margin:1em">' . $message . '</div>';
