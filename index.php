<?php
// INCLUDE INIT FILE
include_once 'core/init.php';

// GET USER DATA
$user = new User();

if(Session::exists('home')) {
    echo '<p>', Session::flash('home'), '</p>';
}

if(!$user->exists()) {
    $usertype = 'Guest';
} else {
    if($user->hasPermission('superadmin')) {
        $usertype = 'Super Administrator';
    } elseif($user->hasPermission('admin')) {
        $usertype = 'Administrator';
    } elseif($user->hasPermission('mod')) {
        $usertype = 'Moderator';
    } else {
        $usertype = 'Registered';
    }
    $myuserdata = $user->data();
    $myid = $myuserdata->id;
}

// GET SITE DATA
$sitedata = DB::getInstance()->query('SELECT * FROM site_data');
if(!$sitedata->count()) {
    echo 'error';
} else {
    foreach($sitedata->results() as $siteinfo) {
        $sitename = $siteinfo->name;
        $sitedescription = $siteinfo->description;
    }
}

// GET TEMPLATE
require 'template/template.php';

// SET THE PAGE TOKEN
echo "<input type=\"hidden\" id=\"token\" value=\"" . Token::generate() . "\">";

// SET MY ID
echo "<input type=\"hidden\" id=\"myid\" value=\"" . $myid . "\">";
?>