<script type="text/javascript" src="js/main.js"></script>
<?php
/**
 * Created by PhpStorm.
 * User: Spencer
 * Date: 1/20/14
 * Time: 8:02 PM
 */

// INCLUDE INIT FILE
include_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';

// GET VALUES
$token = escape($_POST['token']);
$myid = escape($_POST['myid']);
$field = escape($_POST['field']);
$newvalue = escape($_POST['newvalue']);

$user = new User($myid);

try {
    $user->update(array(
        $field => "$newvalue"
    ), $myid);
} catch(Exception $e) {
    die($e->getMessage());
}

$user = new User($myid);

echo $user->userFields($myid, $field, 'text');
?>