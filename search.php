<?php
require_once __DIR__ . '/lib/DataRepository.php';

$repository = new DataRepository();
$query = isset($_POST['query']) ? trim($_POST['query']) : '';

if ($query === '') {
    exit;
}

$results = $repository->searchUsers($query);

if (!$results) {
    echo '<li class="list-group-item"><h4><b>No results found.</b></h4><p class="text-muted">Try a different name or username.</p></li>';
    exit;
}

$pattern = '/' . preg_quote($query, '/') . '/i';

foreach ($results as $result) {
    $first = htmlspecialchars($result['FIRST_NAME'], ENT_QUOTES, 'UTF-8');
    $last = htmlspecialchars($result['LAST_NAME'], ENT_QUOTES, 'UTF-8');
    $username = htmlspecialchars($result['USERNAME'], ENT_QUOTES, 'UTF-8');

    $firstHighlighted = preg_replace($pattern, '<b class="highlight">$0</b>', $first);
    $lastHighlighted = preg_replace($pattern, '<b class="highlight">$0</b>', $last);

    $permissionLabel = 'Guest';
    $itemClass = 'list-group-item';

    switch ((string)$result['PERMISSION']) {
        case '3':
            $permissionLabel = 'Admin';
            $itemClass .= ' list-group-item-danger';
            break;
        case '2':
            $permissionLabel = 'Driver';
            $itemClass .= ' list-group-item-info';
            break;
        case '1':
            $permissionLabel = 'Student';
            $itemClass .= ' list-group-item-success';
            break;
        default:
            if ((string)$result['PERMISSION'] !== '0') {
                $permissionLabel = 'Inactive';
                $itemClass .= ' list-group-item-warning';
            }
            break;
    }

    echo '<a href="?act=profile&amp;u=' . $username . '"><li class="' . $itemClass . '"><h4>' .
        $firstHighlighted . ' ' . $lastHighlighted . '<span class="badge" style="float:right">' .
        htmlspecialchars($permissionLabel, ENT_QUOTES, 'UTF-8') . '</span></h4></li></a>';
}
