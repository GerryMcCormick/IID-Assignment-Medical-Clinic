@extends('app')

@section('content')

    <div class="container appointments-container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 page-content">

                <h2>Pending Appointments</h2>
                @if(isset($pending) && count($pending) > 0)
                    @include('page.partials.pending', ['pending' => $pending ])
                @else
                    <p>No Pending Appointments</p>
                @endif

                <h2>Previous Appointments</h2>
                @if(isset($previous) && count($previous) > 0)
                    @include('page.partials.previous', ['previous' => $previous ])
                @else
                    <p>No Previous Appointments</p>
                @endif

            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>

    @if(isset($pending) && count($pending) > 0)
        @foreach($pending as $pen)
            @include('page.partials.cancel_appointment_modal', ['pen' => $pen])
        @endforeach
    @endif

    <form id="pending-previous-post" method="POST" action="{{ url('/appointments/pending_previous') }}">
        <input type="hidden" name="cancelled" value="true">
    </form>

@endsection