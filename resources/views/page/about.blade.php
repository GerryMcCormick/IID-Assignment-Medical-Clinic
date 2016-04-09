@extends('app')

@section('content')

        <div class="container appointments-container">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10 page-content">
                    @if(isset($doctors) && count($doctors) > 0)
                        @include('page.partials.about_carousel', ['doctors' => $doctors])
                    @endif
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
@endsection