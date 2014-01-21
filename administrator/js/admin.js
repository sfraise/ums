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
});