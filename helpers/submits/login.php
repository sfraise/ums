<?php
/**
 * Created by PhpStorm.
 * User: Spencer
 * Date: 1/13/14
 * Time: 8:13 PM
 */

// INCLUDE INIT FILE
include_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';

// GET VALUES
$token = escape($_POST['login_token']);
$email = escape($_POST['login_email']);
$password = escape($_POST['login_password']);
$rememberme = escape($_POST['login_remember']);

// LOGIN
if(Token::check($token)) {
    $user = new User();

    $remember = ($rememberme === 'on') ? true : false;
    $login = $user->login($email, $password, $remember);

    if ($login) {
        ?>
        <script type="text/javascript">
            parent.location.reload();
        </script>
    <?php
    } else {
        echo '<p>Sorry, that username and password wasn\'t recognised.</p>';
    }
}
?>