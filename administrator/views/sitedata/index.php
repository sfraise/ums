<?php
/**
 * Created by PhpStorm.
 * User: Spencer
 * Date: 1/14/14
 * Time: 10:13 PM
 */

echo 'Edit Site Data<br />';
?>

<input type="text" id="editsitename" value="<?php echo $sitename; ?>" placeholder="Site Name" /><br />
<textarea id="editsitedesc" cols="30" placeholder="Site Description"><?php echo $sitedescription; ?></textarea><br /><br />
<?php echo $updatesiteinfo; ?>
<div id="editsite_submit" class="submit_button">Submit</div><br /><br />
<div id="editsite_message"></div>