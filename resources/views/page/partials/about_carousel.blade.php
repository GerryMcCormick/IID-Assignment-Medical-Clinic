{{--<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">--}}
<div id="carousel-example-generic" class="carousel slide">

    <!-- Indicators -->
    <ol class="carousel-indicators">
        @foreach($doctors as $key => $d)
            @if($key == 0)
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            @else
                <li data-target="#carousel-example-generic" data-slide-to="{{$key}}"></li>
            @endif
        @endforeach
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

        @foreach($doctors as $key => $d)
            @if($key == 0)
                <div class="item active">
            @else
                <div class="item">
            @endif
                    <div class="carousel-inner">
                        <img src="/img/doc_profile_pics/{{$d->image}}" width="400" height="600" data-animation="animated flipInX">
                    </div>

                    <div class="carousel-caption text-outline">
                        <h2 data-animation="animated bounceInLeft">
                            {{$d->title . ' ' . $d->forename . ' ' . $d->surname}}
                        </h2>
                        <h4 data-animation="animated bounceInRight">
                            {{$d->qualifications}}
                        </h4>
                        <h5 data-animation="animated zoomInUp">{{$d->about}}</h5>
                    </div>
                </div><!-- /.item -->
        @endforeach

    </div><!-- /.carousel-inner -->

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic"
       role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic"
       role="button" data-slide="next">
        <i class="glyphicon glyphicon-chevron-right" aria-hidden="true"></i>
        <span class="sr-only">Next</span>
    </a>

</div><!-- /.carousel -->