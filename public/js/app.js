$(document).ready(function() {

    $('.btn-confirm_appointment').click(function(){
        var datetime     = $(this).data('datetime');
        var dr_id        = $(this).data('dr-id');
        var patient_id   = $('#patient_id').val();
        var container_id = $(this).data('container-id');
        
        var url = "/appointments/book_appointment";

        $.ajax({
            type: 'POST',
            headers: { 'X-XSRF-TOKEN' : $('#token').val() },
            url: url,
            data: { datetime: datetime, dr_id: dr_id, patient_id: patient_id},
            dataType: 'json',
            success: function(success) {

                if(success){
                    var modal_dismiss_btn = document.getElementById("btn-dismiss-modal" + container_id);
                    //alert("Appointment Booked.");
                    modal_dismiss_btn.click();
                    $('p#'+container_id).hide();

                    // now return to home, with flash message
                    // submit form hidden on availableAppointments.blade - was only way i could think of quickly to
                    // hit the route "/" as a POST
                    $('#home-post').submit();
                }else{
                    alert("error");
                }
            }
        });
    });

    $('.loader').click(function(){
        displayLoader();
    });

});

function displayLoader(){

    $('#yield-content').hide();

    // display loading gif, hacky positioning
    $('#loading-spinner').html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
        '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
        '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
        '<img src="/img/ajax-loader.gif"/>');
        // '<img src="http://rpg.drivethrustuff.com/shared_images/ajax-loader.gif"/>');
}

$(document).on("change keyup", "#doctor-get-appointments", function() {
    displayLoader();

    var dr_id  = $('#doctor-get-appointments').val();
    var week   = $('#week').val();

    window.location.assign('/appointments/available_appointments/' + week + '/' + dr_id);
});