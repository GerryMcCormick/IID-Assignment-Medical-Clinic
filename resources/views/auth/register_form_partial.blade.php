<div class="row">
    <div class="col-md-3"></div>

        <div class="col-md-6">
            <form id="registerForm" class="page-content" role="form" method="POST" action="{{ url('/auth/register') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <fieldset>
                    @include('auth.reg_partials.personal_partial')
                </fieldset>

                <fieldset>
                    @include('auth.reg_partials.contact_partial')
                </fieldset>

                <fieldset>
                    @include('auth.reg_partials.account_partial', ['doctors' => $doctors])
                </fieldset>

                <br>
                <input type="submit" id="register_btn" class="btn btn-primary pull-right page-content" value="Register"/>
            </form>
        </div>

        <div class="col-md-3"></div>
    </div>

    @if (count($errors) > 0)
        <div class="alert-danger">
            <p><strong>Whoops!</strong> There were some problems with your input.</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif