<?php
/**
 * Created by PhpStorm.
 * User: Spencer
 * Date: 1/26/14
 * Time: 3:25 PM
 */
session_start();

// INCLUDE INIT FILE
include_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';

$userid = escape($_POST['userid']);
$token = escape($_POST['token']);
$newpass = escape($_POST['newpass']);

if (Token::check($token)) {
// UPDATE THE DATABASE
    try {
        $salt = Hash::salt(32);
        $hashpass = Hash::make($newpass, $salt);

        $userdata = DB::getInstance();
        $userdata->query("UPDATE users SET password = '$hashpass', salt = '$salt' WHERE id = $userid");

        echo 'The password has been updated';
    } catch (Exception $e) {
        die($e->getMessage());
    }
} else {
    echo 'The token is invalid';
}
?>