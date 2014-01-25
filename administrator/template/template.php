<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo $sitename; ?> Admin</title>
    <meta name="description" content="<?php echo $sitedescription; ?>" />

    <!-- STYLESHEETS -->
    <link type="text/css" rel="stylesheet" href="template/css/style.css"/>

    <!-- SCRIPTS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="/js/colorbox/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="/js/modals.js"></script>
    <script type="text/javascript" src="/administrator/js/admin.js"></script>
</head>
<body>
<div class="pagewrapper">
    <div class="header">
        <div class="logo">
            <a href="../index.php"><?php echo $sitelogo; ?></a>
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
                    Hello <a href="../index.php?option=profile&user=<?php echo escape($user->data()->id); ?>"><?php echo escape($user->data()->firstname); ?></a>! - <?php echo $usertype; ?>
                </div>
                <div class="loginlinks">
                    <?php echo $logout; ?> <a href="../index.php?option=profile&user=<?php echo $myid; ?>">My Profile</a> <a href="../index.php">Main Site</a>
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
    <div class="adminmain">
        <?php if ($user->isLoggedIn()) { ?>
            <?php if($user->hasPermission('mod')) { ?>
                <div class="admintopmenu">
                    <a href="index.php">Admin Home</a> - <a href="index.php?option=config">Site Config</a> - <a href="index.php?option=sitedata">Edit Site Info</a> - <a href="index.php?option=users">Manage Users</a>
                </div>
                <div class="adminmainbody">
                    <div class="adminmainbody">
                        <?php require_once 'helpers/router.php'; ?>
                    </div>
                </div>
                <div style="clear:both;"></div>
            <?php } else { ?>
                <div class="adminnotloggedin">
                    You are not authorized to view this page!
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="adminnotloggedin">
                You must log in!
            </div>
        <?php } ?>
    </div>
    <div class="footer">
        Footer
        <div style="clear:both;"></div>
    </div>
</div>
</body>
</html>