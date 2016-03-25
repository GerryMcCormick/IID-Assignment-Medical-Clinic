@extends('app')

@section('content')

    <div class="container page-content">
        <div class="row">
            <div class="col-lg-12">

                <div class="input-group">
                    <label for="doctor">Select Doctor:</label>
                    <select class="form-control" id="doctor-get-appointments" name="dr_id">
                        <option value="0">All Doctors</option>
                        @if(isset($doctors) && count($doctors) > 0)
                            @foreach($doctors as $d)
                                @if(isset($dr_id) && $dr_id == $d->id)
                                    <option value="{{ $d->id }}" selected>{{ $d->title . " " . $d->surname }}</option>
                                @else
                                    <option value="{{ $d->id }}">{{ $d->title . " " . $d->surname }}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>

                <br>
                <p>
                    @if(isset($week) && $week > 1)
                        <span class="pull-left">
                            <a class="loader btn btn-default"
                               href="/appointments/available_appointments/{{$week - 1}}/{{$dr_id}}"><< Previous Week</a>
                        </span>
                    @endif

                    @if(isset($week) && $week < 3)
                        <span class="pull-right">
                            <a class="loader btn btn-default"
                               href="/appointments/available_appointments/{{$week + 1}}/{{$dr_id}}">Next Week >></a>
                        </span>
                    @endif
                </p>
                <br><br>

                <p>
                    @if(isset($mon))
                        <span class="pull-left">{{ $mon }}</span>
                    @endif

                    @if(isset($fri))
                        <span class="pull-right">{{ $fri }}</span>
                    @endif
                </p>
                <br>

                @if(isset($appointments) && count($appointments) > 0)

                    @include('page.partials.all_available_appointments_partial',
                    [
                        'appointments' => $appointments,
                        'mon'          => $mon,
                        'fri'          => $fri,
                    ])

                @else
                    <h2>Sorry, No Appointments</h2>
                @endif


                <p>
                    @if(isset($mon))
                        <span class="pull-left">{{ $mon }}</span>
                    @endif

                    @if(isset($fri))
                        <span class="pull-right">{{ $fri }}</span>
                    @endif
                </p>
                <br>

                <p>
                    @if(isset($week) && $week > 1)
                        <span class="pull-left">
                            <a class="loader btn btn-default"
                               href="/appointments/available_appointments/{{$week - 1}}/{{$dr_id}}"><< Previous Week</a>
                        </span>
                    @endif

                    @if(isset($week) && $week < 3)
                        <span class="pull-right">
                            <a class="loader btn btn-default"
                               href="/appointments/available_appointments/{{$week + 1}}/{{$dr_id}}">Next Week >></a>
                        </span>
                    @endif
                </p>
                <br><br>

            </div>
        </div>
    </div>

    {{--modal must be outside container with fixed or relative position or is within an element with fixed or relative position--}}
    @foreach($appointments as $key => $a)
        @if($key != '13:00')
            @foreach($a as $time_day)
                @if(strtotime($time_day['datetime']) >= strtotime($mon . '09:00') && strtotime($time_day['datetime']) <= strtotime($fri . '17:30'))
                    @if(isset($time_day['available']) && count($time_day['available']) > 0)
                        @foreach($time_day['available'] as $appointment)
                            @include('page.partials.confirm_appointment_modal', ['appointment' => $appointment])
                        @endforeach
                    @endif
                @endif
            @endforeach
        @endif
    @endforeach

    <input type="hidden" id="patient_id" value="{{$patient_id}}">
    <input type="hidden" id="week"       value="{{$week}}">
    <form id="home-post" method="POST" action="{{ url('/') }}"></form>
@endsection