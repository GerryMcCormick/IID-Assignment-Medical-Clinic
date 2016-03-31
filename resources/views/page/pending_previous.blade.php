@extends('app')

@section('content')

    <div class="container appointments-container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 page-content">

                <br>
                <h2>Pending Appointments</h2>
                @if(isset($pending) && count($pending) > 0)
                    @foreach($pending as $pen)
                        <p>{{ $pen['time'] . ' ' . $pen['doctor']['name']}}</p>
                    @endforeach
                @else
                    <p>No Pending Appointments</p>
                @endif

                <br>
                <h2>Previous Appointments</h2>
                @if(isset($previous) && count($previous) > 0)
                    @foreach($previous as $pre)
                        <p>{{ $pre['time'] . ' ' . $pre['doctor']['name']}}</p>
                    @endforeach
                @else
                    <p>No Previous Appointments</p>
                @endif

            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
@endsection