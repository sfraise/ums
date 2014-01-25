/**
 * Created by Spencer on 1/15/14.
 */
$(document).ready(function () {
    // REGISTER
    $('#editsite_submit').click(function () {
        var editsitetoken = $('#token').val();
        var editsitename = $('#editsitename').val();
        var editsitedesc = $('#editsitedesc').val();

        $('#editsite_message').html('<img id="ajaxloading" src="/images/loading/loading35.gif" alt="Loading" title="Loading" />');
        $.ajax({
            url: 'helpers/submits/updatesitedata.php',
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

    /*** CONFIG SECTION ***/
    // SET VERIFICATION OPTION
    $('#admin_config_verify_button').click(function() {
        var token = $('#token').val();

        $('#admin_config_veirfy_button').html('<img id="ajaxloading" src="/images/loading/loading35.gif" alt="Loading" title="Loading" />');
        $.ajax({
            url: 'helpers/submits/verify.php',
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
            url: 'helpers/submits/promoteuser.php',
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