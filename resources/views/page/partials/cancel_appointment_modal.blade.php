<!-- Modal -->
<div class="modal fade" id="modal_pending{{$pen['app_id']}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{$pen['app_id']}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-booking-cancel">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalLabel{{$pen['app_id']}}"><b>Cancel Appointment?</b></h4>
            </div>

            <div class="modal-body">
                <h5>{{ $pen['time'] }}</h5>
                <h5>{{ $pen['doctor']['name'] }}</h5>
            </div>

            <div class="modal-footer">
                <button id="btn-dismiss-modal{{$pen['app_id']}}"
                        type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                &nbsp;&nbsp;&nbsp;
                <button type="button"
                        class="btn btn-primary btn-cancel_appointment"
                        data-container-id="{{$pen['app_id']}}"
                        data-app_id="{{$pen['app_id']}}">Confirm</button>
            </div>
        </div>
    </div>
</div>
