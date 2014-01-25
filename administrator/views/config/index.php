<?php
/**
 * Created by PhpStorm.
 * User: Spencer
 * Date: 1/24/14
 * Time: 9:39 PM
 */

// GET CURRENT VERIFICATION OPTION (O or 1)
$verify = $siteinfo->verify;
if($verify == 0) {
    $ischecked = '';
} elseif ($verify == 1) {
    $ischecked = "<img src=\"/images/checkmark.png\" alt=\"Selected\" />";
} else {
    $ischecked = 'Error';
}

echo 'Configuration';
?>

<div class="admin_config">
    <div class="admin_config_verify">
        <div class="admin_config_verify_label">
            Require Registration Verification
        </div>
        <div id="admin_config_verify_button">
            <?php echo $ischecked; ?>
        </div>
        <div style="clear:both;"></div>
    </div>
</div>