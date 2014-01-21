<?php
/**
 * Created by PhpStorm.
 * User: Spencer
 * Date: 1/13/14
 * Time: 5:49 PM
 */

// INCLUDE INIT FILE
include_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';

error_reporting(E_ALL);
ini_set('display_errors', '1');

// GET VALUES
$token = escape($_POST['register_token']);
$email = escape($_POST['register_email']);
$firstname = escape($_POST['register_firstname']);
$lastname = escape($_POST['register_lastname']);
$password = escape($_POST['register_password']);
$passwordagain = escape($_POST['register_password_again']);

/*
$username = "root";
$password = "mq174023";
$hostname = "localhost";
//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
or die("Unable to connect to MySQL");
//select a database to work with
$selected = mysql_select_db("restaurant",$dbhandle)
or die("Could not select examples");
$date = date('Y-m-d H:i:s');
$hashpass = Hash::make($password, $salt);
$query = "INSERT INTO users (username, password, salt, firstname, lastname, joined, group) VALUES ('$email', 'password', 'salt', '$firstname', '$lastname', '$date', '1')";
mysql_query($query) or die(mysql_error());
*/

// REGISTER
if (Token::check($token)) {
    $user = new User();

    $salt = Hash::salt(32);
    $hashpass = Hash::make($password, $salt);
    $date = date('Y-m-d H:i:s');

    try {
        $user->create(array(
            'username' => $email,
            'password' => $hashpass,
            'salt' => $salt,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'joined' => $date,
            'user_group' => 1
        ));

        // AUTO-LOGIN
        $rememberme = 'on';
        $remember = ($rememberme === 'on') ? true : false;
        $login = $user->login($email, $password, $remember);

        if ($login) {
            ?>
            <script type="text/javascript">
                parent.location.reload();
            </script>
        <?php
        } else {
            echo '<p>There was a problem logging in.</p>';
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }
}
?>