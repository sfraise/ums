/**
 * Created by Spencer on 1/15/14.
 */
$(document).ready(function () {
    // REGISTER
    $('#register_submit').click(function() {
        var register_token = $('#token').val();
        var register_email = $('#register_email').val();
        var register_firstname = $('#register_firstname').val();
        var register_lastname = $('#register_lastname').val();
        var register_password = $('#register_password').val();
        var register_password_again = $('#register_password_again').val();

        $('#register_message').html('<img id="ajaxloading" src="/images/loading/loading35.gif" alt="Loading" title="Loading" />');
        $.ajax({
            url: '/administrator/helpers/submits/register.php',
            type: 'POST',
            data: {register_token: register_token, register_email: register_email, register_firstname: register_firstname, register_lastname: register_lastname, register_password: register_password, register_password_again: register_password_again},
            success: function (data) {
                $('#register_message').html(data);
            },
            error: function (errorThrown) {
                $('#register_message').html(errorThrown);
            }
        });
        return false;
    });

    // LOGIN
    $('#login_submit').click(function() {
        var login_token = $('#token').val();
        var login_email = $('#login_email').val();
        var login_password = $('#login_password').val();
        var login_remember = $('#login_remember').val();

        $('#login_message').html('<img id="ajaxloading" src="/images/loading/loading35.gif" alt="Loading" title="Loading" />');
        $.ajax({
            url: '/administrator/helpers/submits/login.php',
            type: 'POST',
            data: {login_token: login_token, login_email: login_email, login_password: login_password, login_remember: login_remember},
            success: function (data) {
                $('#login_message').html(data);
            },
            error: function (errorThrown) {
                $('#login_message').html(errorThrown);
            }
        });
        return false;
    });

    // FORGOT PASSWORD
    $('#forgotpass_submit').click(function() {
        var forgotpass_token = $('#token').val();
        var forgotpass_email = $('#forgotpass_email').val();

        $('#forgotpass_message').html('<img id="ajaxloading" src="/images/loading/loading35.gif" alt="Loading" title="Loading" />');
        $.ajax({
            url: '/administrator/helpers/submits/forgotpass.php',
            type: 'POST',
            data: {forgotpass_token: forgotpass_token, forgotpass_email: forgotpass_email},
            success: function (data) {
                $('#forgotpass_message').html(data);
            },
            error: function (errorThrown) {
                $('#forgotpass_message').html(errorThrown);
            }
        });
        return false;
    });

    /*** CONFIG SECTION ***/
    // SET VERIFICATION OPTION
    $('#admin_config_verify_button').click(function() {
        var token = $('#token').val();

        $('#admin_config_veirfy_button').html('<img id="ajaxloading" src="/images/loading/loading35.gif" alt="Loading" title="Loading" />');
        $.ajax({
            url: '/administrator/views/config/helpers/verify.php',
            type: 'POST',
            data: {token: token},
            success: function (data) {
                $('#admin_config_verify_button').html(data);
            },
            error: function (errorThrown) {
                $('#admin_config_verify_button').html(errorThrown);
            }
        });
        return false;
    });

    /*** SITE INFO SECTION ***/
    // LOGO UPLOAD TOGGLE
    $('#update_logo_upload_area').click(function () {
        $('#updatelogouploadform').show();
        $('#update_logo_upload_area').hide();
    });
    $('#update_logo_upload_cancel').click(function () {
        $('#updatelogouploadform').hide();
        $('#update_logo_upload_area').show();
    });

    // EDIT SITE INFO
    $('#editsite_submit').click(function () {
        var editsitetoken = $('#token').val();
        var editsitename = $('#editsitename').val();
        var editsitedesc = $('#editsitedesc').val();

        $('#editsite_message').html('<img id="ajaxloading" src="/images/loading/loading35.gif" alt="Loading" title="Loading" />');
        $.ajax({
            url: '/administrator/views/sitedata/helpers/updatesitedata.php',
            type: 'POST',
            data: {editsitetoken: editsitetoken, editsitename: editsitename, editsitedesc: editsitedesc},
            success: function (data) {
                $('#editsite_message').html(data);
            },
            error: function (errorThrown) {
                $('#editsite_message').html(errorThrown);
            }
        });
        return false;
    });

    /*** MANAGE MEMBERS ***/
    // MANAGE MEMBERS SHOW/HIDE PROMOTE/DEMOTE SELECT BOX
    $('a[id^=amu_prodem_]').click(function() {
        var userid = $(this).attr('rel');

        $('#amu_promote_select_wrapper_' + userid).show();
    });

    // MANAGE MEMBERS PROMOTE/DEMOTE
    $('select[id^=amu_promote_select_]').on('change', function () {
        var token = $('#token').val();
        var userid = $(this).attr('rel');
        var type = $(this).val();
        if (type == 2) {
            var usertype = 'Super Administrator';
        } else if(type == 3) {
            var usertype = 'Administrator';
        } else if(type == 4) {
            var usertype = 'Moderator';
        } else {
            var usertype = 'Registered';
        }

        $('#amu_promote_select_wrapper_' + userid).html('<img id="amu_promote_loading" src="/images/loading/loading35.gif" alt="Loading" title="Loading" />');
        $.ajax({
            url: '/administrator/views/users/helpers/promoteuser.php',
            type: 'POST',
            data: {token: token, userid: userid, type: type},
            success: function (data) {
                $('#amu_promote_select_wrapper_' + userid).html(data);
                $('#amu_type_' + userid).html(usertype);
            },
            error: function (errorThrown) {
                $('#amu_promote_select_wrapper_' + userid).html(errorThrown);
            }
        });
        return false;
    });

    // MANAGE MEMBERS SHOW/HIDE PROMOTE/DEMOTE SELECT BOX
    $('a[id^=amu_promote_select_close_]').click(function() {
        var userid = $(this).attr('rel');

        $('#amu_promote_select_wrapper_' + userid).hide();
    });
});