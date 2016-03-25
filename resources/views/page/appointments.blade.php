@extends('app')

@section('content')

    <div class="container appointments-container">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4 page-content">

                <br>
                <ul class="list-inline">
                    <li>
                        <p>
                            <a href="/appointments/available_appointments/1/0"
                               class="loader btn btn-default btn-lg">Available Appointments</a>

                            <br><br>

                            <a href="#" class="btn btn-default btn-lg">Pending/Previous Appointments</a>
                        </p>
                    </li>
                </ul>

            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
@endsection