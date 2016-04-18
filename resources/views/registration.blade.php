<?php $currenturl = Request::url(); $url = Request::root(); ?>
<!doctype html>

<html lang="en">

<head>
    <title>@if(isset($page))Ballydale Medical Clinic | {{ $page }}@else Ballydale Medical Clinic @endif</title>

    <?php
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
    ?>
    <input id="token" type="hidden" value="{{$encrypted_token}}">

    <link rel="prerender" href="{{$currenturl}}">
    <style>
        body { font-family:Lucida Sans, Arial, Helvetica, Sans-Serif; font-size:13px; margin:20px;}
        #header { text-align:center; border-bottom:solid 1px #b2b3b5; margin: 0 0 20px 0; }
        fieldset { border:none; width:320px;}
        legend { font-size:18px; margin:0px; padding:10px 0px; color:#b0232a; font-weight:bold;}
        label { display:block; margin:15px 0 5px;}
        input[type=text], input[type=password], input[type=email] { width:300px; padding:5px; border:solid 1px #000;}
        select { width:300px; padding:5px; border:solid 1px #000;}

        button, .prev, .next { background-color:#b0232a; padding:5px 10px; color:#fff; text-decoration:none;}
        button:hover, .prev:hover, .next:hover { background-color:#000; text-decoration:none;}

        button { border: none; }

        /*#controls { background: #eee; box-shadow: 0 0 16px #999; height: 30px; position: fixed; padding: 10px; top: 0; left: 0; width: 100%; z-index: 1 }*/
        /*#controls h1 { color: #666; display: inline-block; margin: 0 0 8px 0 }*/
        /*#controls input[type=text] { border-color: #999; margin: 0 25px; width: 120px }*/

        #steps { margin: 80px 0 0 0 }
    </style>

    <link rel="stylesheet" href="{{$url}}/formToWizard/css/formToWizard.css" />
    <link rel="stylesheet" href="{{$url}}/formToWizard/css/validationEngine.jquery.css" />

    <link rel="stylesheet" href="{{$url}}/css/app.css" type="text/css">
    <link rel="stylesheet" href="{{$url}}/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{$url}}/css/bootstrap.min.css" type="text/css">

    <script src="{{$url}}/formToWizard/js/jquery-1.7.1.min.js"></script>
    {{--bootstrap js requires jquery 1.9 or higher, but then formwizard doesn't work!--}}
    {{--<script src="{{$url}}/js/bootstrap.min.js" type="text/javascript"></script>--}}
    <script src="{{$url}}/js/jquery-ui.min.js" type="text/javascript"></script>

    <script src="{{$url}}/formToWizard/js/jquery.formToWizard.js"></script>
    <script src="{{$url}}/formToWizard/js/jquery.validationEngine.js"></script>
    <script src="{{$url}}/formToWizard/js/jquery.validationEngine-en.js"></script>

    <script>
        $( function() {
            var $signupForm = $( '#registerForm' );

            $signupForm.validationEngine();

            $signupForm.formToWizard({
                submitButton: 'register_btn',
                showProgress: true, //default value for showProgress is also true
                nextBtnName: 'Next >>',
                prevBtnName: '<< Previous',
                showStepNo: false,
                validateBeforeNext: function() {
                    return $signupForm.validationEngine( 'validate' );
                }
            });

            $( '#txt_stepNo' ).change( function() {
                $signupForm.formToWizard( 'GotoStep', $( this ).val() );
            });

            $( '#btn_next' ).click( function() {
                $signupForm.formToWizard( 'NextStep' );
            });

            $( '#btn_prev' ).click( function() {
                $signupForm.formToWizard( 'PreviousStep' );
            });
        });
    </script>

    <script>
        $(function() {
            $( "#datepicker" ).datepicker({
                changeMonth: true,
                changeYear: true,
                maxDate: 0,
                yearRange: "1940:2016",
                dateFormat: "DD, d MM, yy"
            });
        });

    </script>
</head>

<body>
    <div class="wrapper">
        @if(isset($bodyid) && $bodyid == "home")
        <header class="row site-header">
        @else
        <header class="row site-header fixed">
        @endif
            <div class="container nav-container">
                <div class="column _2 r">
                    <ul class="site-nav">
                        @include('navlist')
                    </ul>
                </div>
            </div>
            <div class="nav-open icon-menu radial-btn"></div>

            <div class="nav-close radial-btn long"><span class="icon-back"></span><div class="label">Back</div></div>
        </header>

        <div class="content-div">
            <div class="bg-overlay">
                <div class="heading">
                    {{--@include('flash::message')--}}
                    <h1>Ballydale Medical Clinic</h1>
                    @if(isset($page))
                        <h3>{{ $page }}</h3>
                    @endif
                    <hr class="home-divider">
                </div>

                <div id="yield-content">
                    @yield('content')
                </div>

            </div>
        </div>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <p>21 Ballydale Street</p>
                        <p>Ballydale</p>
                        <p>BT48 123</p>
                    </div>
                    <div class="col-lg-6">
                        <p>+44 (0) 28 7131 9526</p>
                        <p>+44 (0) 28 7131 9532</p>
                        <p><a href="mailto:admin@ballydale.com">Send us an email</a></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <span>Copyright &copy; <?php echo date("Y"); ?> Ballydale Medical Clinic. All rights reserved.</span>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    @if(isset($page) && $page == "Register")
    <script>
        $(document).ready(function() {
            var $elem = $(document);
            $('html, body').delay(1500).animate({scrollTop: $elem.height()}, 1500);
        });
    </script>
    @endif

</body>
</html>
