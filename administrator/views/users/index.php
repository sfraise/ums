<?php
/**
 * Created by PhpStorm.
 * User: Spencer
 * Date: 1/15/14
 * Time: 8:51 PM
 */

// GET USERS DATA
$members = array();
$usersdata = DB::getInstance();
$usersdata->query('SELECT * FROM users');
if (!$usersdata->count()) {
    echo 'No Users Exist';
} else {
    $i = 1;
    foreach ($usersdata->results() as $user) {
        $thisuserid = $user->id;
        $thisuseremail = $user->username;
        $thisuserfirstname = $user->firstname;
        $thisuserlastname = $user->lastname;
        $thisusergroup = $user->user_group;

        if ($thisusergroup == 2) {
            $thisusertype = 'Super Administrator';
            $thisuserpromote = "
                            <div id=\"amu_promote_select_wrapper_".$thisuserid."\">
                            <select id=\"amu_promote_select_".$thisuserid."\" rel=\"".$thisuserid."\" class=\"amu_promote_select\">
                                <option selected = \"selected\" value=\"\">Promote or Demote</option>
                                <option value=\"3\">Demote to Administrator</option>
                                <option value=\"4\">Demote to Moderator</option>
                                <option value=\"1\">Demote to Registered</option>
                            </select>
                            </div>";
        } elseif ($thisusergroup == 3) {
            $thisusertype = 'Administrator';
            $thisuserpromote = "
                            <div id=\"amu_promote_select_wrapper_".$thisuserid."\">
                            <select id=\"amu_promote_select_".$thisuserid."\" rel=\"".$thisuserid."\" class=\"amu_promote_select\">
                                <option selected = \"selected\" value=\"\">Promote or Demote</option>
                                <option value=\"2\">Promote to Super Administrator</option>
                                <option value=\"4\">Demote to Moderator</option>
                                <option value=\"1\">Demote to Registered</option>
                            </select>
                            </div>";
        } elseif ($thisusergroup == 4) {
            $thisusertype = 'Moderator';
            $thisuserpromote = "
                            <div id=\"amu_promote_select_wrapper_".$thisuserid."\">
                            <select id=\"amu_promote_select_".$thisuserid."\" rel=\"".$thisuserid."\" class=\"amu_promote_select\">
                                <option selected = \"selected\" value=\"\">Promote or Demote</option>
                                <option value=\"2\">Promote to Super Administrator</option>
                                <option value=\"3\">Promote to Administrator</option>
                                <option value=\"1\">Demote to Registered</option>
                            </select>
                            </div>";
        } else {
            $thisusertype = 'Registered';
            $thisuserpromote = "
                            <div id=\"amu_promote_select_wrapper_".$thisuserid."\">
                            <select id=\"amu_promote_select_".$thisuserid."\" rel=\"".$thisuserid."\" class=\"amu_promote_select\">
                                <option selected = \"selected\" value=\"\">Promote or Demote</option>
                                <option value=\"2\">Promote to Super Administrator</option>
                                <option value=\"3\">Promote to Administrator</option>
                                <option value=\"4\">Promote to Moderator</option>
                            </select>
                            </div>";
        }

        $members[] = "
                    <div id=\"admin_manage_user_".$thisuserid."\" class=\"admin_manage_user\">
                        " . $thisuserid . " " . $thisuserfirstname . " " . $thisuserlastname . " " . $thisuseremail . " <span id=\"amu_type_".$thisuserid."\">" . $thisusertype . "</span><br />
                        <div id=\"admin_manage_user_promote_".$thisuserid."\">
                            ".$thisuserpromote."
                        </div>
                    </div>";
        $i++;
    }
}

$memberlist = implode('', $members);

echo 'Manage Users<br /><br />';

echo $memberlist;
?>

