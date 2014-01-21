<script type="text/javascript" src="js/main.js"></script>
<?php
/**
 * Created by PhpStorm.
 * User: Spencer
 * Date: 1/13/14
 * Time: 5:49 PM
 */
session_start();

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
            ?>
            <script type="text/javascript">
                // RESET THE PARENT PAGE TOKEN IN ORDER TO VALIDATE ON NEXT TRY
                $('#token').val('<?php echo Token::generate(); ?>');
            </script>
        <?php
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }
}
?>