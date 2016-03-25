<!-- Modal -->
<div class="modal fade" id="modal{{$appointment['link_id']}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{$appointment['link_id']}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-booking-confirmation">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalLabel{{$appointment['link_id']}}"><b>Confirm appointment for {{Auth::user()->fullName()}}</b></h4>
            </div>
            <div class="modal-body">
                <h5>{{ $appointment['display_app_time'] }}</h5>
                <h5>{{ $appointment['dr_name'] }}</h5>
            </div>
            <div class="modal-footer">
                <button id="btn-dismiss-modal{{$appointment['link_id']}}"
                        type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                &nbsp;&nbsp;&nbsp;
                <button type="button"
                        class="btn btn-primary btn-confirm_appointment"
                        data-datetime="{{$appointment['datetime']}}"
                        data-dr-id="{{$appointment['dr_id']}}"
                        data-container-id="{{$appointment['link_id']}}">Book Appointment</button>
            </div>
        </div>
    </div>
</div>
