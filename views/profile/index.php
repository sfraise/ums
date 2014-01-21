<?php

if(!$username = Input::get('user')) {
	Redirect::to('index.php');
} else {
	$user = new User($username);

	if(!$user->exists()) {
		Redirect::to(404);
	} else {
		$data = $user->data();
	}

    // DEFINE PROFILE OWNER'S USERID
    $userid = $data->id;

    // FORMAT THE MEMBER SINCE DATE
    $membersince = date('F jS, Y', strtotime($data->joined));
	?>

	<h3><?php echo escape($data->username); ?></h3>
    <p>Member since: <?php echo $membersince; ?></p>
    <p>User Type: <?php echo $usertype; ?></p><br /><br />

    <div class="userprofile">
	    <div class="profile_fields">
            <div class="profile_field_wrapper_title">
                First Name:
            </div>
            <div id="profile_field_wrapper_firstname">
                <?php echo $user->userFields($myid, 'firstname', 'text'); ?>
            </div>
            <div style="clear:both;"></div>
        </div>
        <div class="profile_fields">
            <div class="profile_field_wrapper_title">
                Last Name:
            </div>
            <div id="profile_field_wrapper_lastname">
                <?php echo $user->userFields($myid, 'lastname', 'text'); ?>
            </div>
            <div style="clear:both;"></div>
        </div>
        <div class="profile_fields">
            <div class="profile_field_wrapper_title">
                City:
            </div>
            <div id="profile_field_wrapper_city">
                <?php echo $user->userFields($myid, 'city', 'text'); ?>
            </div>
            <div style="clear:both;"></div>
        </div>
        <div class="profile_fields">
            <div class="profile_field_wrapper_title">
                State:
            </div>
            <div id="profile_field_wrapper_state">
                <?php echo $user->userFields($myid, 'state', 'text'); ?>
            </div>
            <div style="clear:both;"></div>
        </div>
        <div class="profile_fields">
            <div class="profile_field_wrapper_title">
                Country:
            </div>
            <div id="profile_field_wrapper_country">
                <?php echo $user->userFields($myid, 'country', 'text'); ?>
            </div>
            <div style="clear:both;"></div>
        </div>
        <div class="profile_fields">
            <div class="profile_field_wrapper_title">
                Gender:
            </div>
            <div id="profile_field_wrapper_gender">
                <?php echo $user->userFields($myid, 'gender', 'text'); ?>
            </div>
            <div style="clear:both;"></div>
        </div>
        <div class="profile_fields">
            <div class="profile_field_wrapper_title">
                Date of Birth:
            </div>
            <div id="profile_field_wrapper_dob">
                <?php echo $user->userFields($myid, 'dob', 'text'); ?>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
	<?php
}
?>