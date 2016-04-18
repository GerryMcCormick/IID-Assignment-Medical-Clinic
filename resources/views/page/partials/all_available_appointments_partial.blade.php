<div class="box-body table-responsive no-padding">
    <table class="table table-condensed" >

    <table class="table table-hover table-bordered table-condensed appointments-table">
        <thead>
            <tr>
                <th class="time-col">Time</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th>
            </tr>
        </thead>
    </table>

    <div class="div-table-content">
        <table class="table table-condensed table-hover table-bordered appointments-table">
            @foreach($appointments as $key => $a)
                <tr>
                    @if($key == '13:00')
                        <td class="time-col">{{ $key }}</td><td class="lunch">Lunch</td><td class="lunch">Lunch</td><td class="lunch">Lunch</td><td class="lunch">Lunch</td><td class="lunch">Lunch</td>
                    @else
                        <td class="time-col">{{ $key }}</td>

                        @foreach($a as $time_day)

                            @if(strtotime($time_day['datetime']) >= strtotime($mon . '09:00') && strtotime($time_day['datetime']) <= strtotime($fri . '17:30'))
                                <td>
                                    @if(isset($time_day['available']) && count($time_day['available']) > 0)

                                        @foreach($time_day['available'] as $appointment)

                                            <p id="{{$appointment['link_id']}}">
                                                <!-- Button trigger modal -->
                                                <a data-toggle="modal" data-target="#modal{{$appointment['link_id']}}">
                                                    {{ $appointment['dr_name'] }}
                                                </a>
                                            </p>

                                        @endforeach

                                    @elseif(isset($time_day['not_available']) && $time_day['not_available'] == true)
                                        <p>N/A</p>
                                    @else
                                        <p>No Available Appointments</p>
                                    @endif
                                </td>
                            @endif
                        @endforeach

                    @endif
                </tr>
            @endforeach
        </table>
    </div>
</div><!-- /.box-body -->
