<form class="contact-form" role="form" method="POST" action="{{ url('/auth/register') }}">

    <div class="row">
        <div class="col-md-6">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="input-group">
                <label for="gender">Gender:</label>
                <br>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default active">
                        <input type="radio" id="male" name="gender[]" value="Male" checked="checked"/> Male
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" id="female" name="gender[]" value="Female" /> Female
                    </label>
                </div>
            </div>

            <div class="input-group">
                <label for="title">Title:</label>
                <input class="form-control" type="text" id="title" name="title" value="{{ old('title') }}">
            </div>

            <div class="input-group">
                <label for="firstName">First Name:</label>
                <input class="form-control" type="text" id="firstName" name="first_name" value="{{ old('first_name') }}">
            </div>

            <div class="input-group">
                <label for="lastName">Last Name:</label>
                <input class="form-control" type="text" id="lastName" name="last_name" value="{{ old('last_name') }}">
            </div>

            <div class="input-group">
                <label for="email">Email Address:</label>
                <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}">
            </div>

            <div class="input-group">
                <label for="password">Password:</label>
                <input class="form-control" type="password" id="password" name="password">
            </div>

            <div class="input-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation">
            </div>

            <br>
            <div class="input-group">
                <label for="reminder">Appointment Reminder Method:</label>
                <div id="reminder">
                    <p><input type="radio" name="reminder_id[]" value="1"/>&nbsp;Email day before appointment</p>
                    <p><input type="radio" name="reminder_id[]" value="2"/>&nbsp;Text day before appointment</p>
                    <p><input type="radio" name="reminder_id[]" value="3" checked/>&nbsp;No Reminder</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group">
                <label for="doctor">Preferred Doctor:</label>
                <select class="form-control" id="doctor" name="dr_id">
                    <option value="0">Select doctor</option>
                    @if(isset($doctors) && count($doctors) > 0)
                        @foreach($doctors as $d)
                            @if(null !== old('dr_id') && old('dr_id') == $d->id)
                                <option value="{{ $d->id }}" selected>{{ $d->title . " " . $d->surname }}</option>
                            @else
                                <option value="{{ $d->id }}">{{ $d->title . " " . $d->surname }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="input-group">
                <label for="phone">Phone Number:</label>
                <input class="form-control" type="text" id="phone" name="phone" value="{{ old('phone') }}"
                       onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
            </div>

            <div class="input-group">
                <label for="dob">Date of Birth:</label>
                <input class="form-control" type="text" id="datepicker" name="dob" value="{{ old('dob') }}">
            </div>

            <div class="input-group">
                <label for="add_line_1">Address Line 1:</label>
                <input class="form-control" type="text" id="add_line_1" name="add_line_1" value="{{old('add_line_1')}}">
            </div>

            <div class="input-group">
                <label for="add_line_2">Address Line 2:</label>
                <input class="form-control" type="text" id="add_line_2" name="add_line_2" value="{{old('add_line_1')}}">
            </div>

            <div class="input-group">
                <label for="town">Town:</label>
                <input class="form-control" type="text" id="town" name="town" value="{{old('town')}}">
            </div>

            <div class="input-group">
                <label for="postcode">Postcode:</label>
                <input class="form-control" type="text" id="postcode" name="postcode" value="{{old('postcode')}}">
            </div>

            <br>
            <input type="submit" class="btn btn-default" value="Register"/>
        </div>
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

</form>