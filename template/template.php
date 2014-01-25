<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo $sitename; ?></title>
    <meta name="description" content="<?php echo $sitedescription; ?>" />

    <!-- STYLESHEETS -->
    <link type="text/css" rel="stylesheet" href="template/css/style.css"/>

    <!-- SCRIPTS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="/js/colorbox/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="/js/modals.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
</head>
<body>
<div class="pagewrapper">
    <div class="header">
        <div class="logo">
            <a href="index.php"><?php echo $sitelogo; ?></a>
        </div>
        <div class="logreg">
            <?php
                $newRegister = new logReg();
                $newRegister->set_logreg();
                $register = $newRegister->get_logreg('register');
                $login = $newRegister->get_logreg('login');
                $logout = $newRegister->get_logreg('logout');
                $changepassword = $newRegister->get_logreg('changepassword');
                $forgotpassword = $newRegister->get_logreg('forgotpassword');
            ?>
            <?php if ($user->isLoggedIn()) { ?>
                <div class="loginmessage">
                    Hello <a href="index.php?option=profile&user=<?php echo escape($user->data()->id); ?>"><?php echo escape($user->data()->firstname); ?></a>! - <?php echo $usertype; ?>
                </div>
                <div class="loginlinks">
                    <?php echo $logout; ?> <a href="index.php?option=profile&user=<?php echo $myid; ?>">My Profile</a> <?php if($user->hasPermission('admin')) { ?><a href="/administrator/index.php">Admin Panel</a><?php } ?>
                </div>
            <?php } else { ?>
                <div class="loginlinks">
                    You need to <?php echo $login; ?> or <?php echo $register; ?>!<br />(<?php echo $forgotpassword; ?>)
                </div>
            <?php } ?>
            <div style="clear:both;"></div>
        </div>
        <div style="clear:both;"></div>
    </div>
    <div class="main">
        <?php require_once 'helpers/router.php'; ?>
        <div style="clear:both;"></div>
    </div>
    <div class="footer">
        Footer
        <div style="clear:both;"></div>
    </div>
</div>
</body>
</html>