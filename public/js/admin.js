$(document).ready(function() {

    var $_token = $('#token').val();

    $(".del_cms_item").click(function () {

        var deleteId = $(this).data('delete-id');
        var deleteUrl = $(this).data('delete-url');
        var extraMessage = $(this).data('item-message');

        var confirmMessage = "Are you sure you want to delete item?";

        if(extraMessage !== undefined){
            confirmMessage += extraMessage;
        }

        //alert(deleteUrl);
        //alert(extraMessage);

        if (confirm(confirmMessage)) {
            alert(deleteUrl);
            $.ajax({
                type: 'DELETE',
                headers: {'X-XSRF-TOKEN': $_token},
                url: deleteUrl,
                dataType: 'json',
                success: function (success) {
                    if (success == true) {
                        alert("Item removed.");
                        $('tr#' + deleteId).hide();
                    } else {
                        alert("Error");
                    }
                }
            });

        }
        else {
            return false;
        }
    });

    //initialize select2 instances
    $(".select2").select2();

    //file upload buttons
    $('.updateFile').click(function(){
        var formDiv = $(this).closest('.form-group');
        var fileContainer = formDiv.find('#fileContainer');
        fileContainer.show();
        $(this).hide();
        return false;
    });
});
