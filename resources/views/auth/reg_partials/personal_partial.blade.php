<legend>Personal Information</legend>

<div class="input-group">
    <label for="gender">Gender:</label>
    <div>
        <p>
            <input type="radio" id="male" name="gender[]" value="Male" checked/>&nbsp;Male&nbsp;
            <input type="radio" id="female" name="gender[]" value="Female"/>&nbsp;Female
        </p>

        {{--<label class="btn btn-default active">--}}
            {{--<input type="radio" id="male" name="gender[]" value="Male" checked="checked"/> Male--}}
        {{--</label>--}}
        {{--<label class="btn btn-default">--}}
            {{--<input type="radio" id="female" name="gender[]" value="Female" /> Female--}}
        {{--</label>--}}
    </div>
</div>

<div class="input-group">
    <p>Title:</p>
    <input class="form-control validate[required]" type="text" id="title" name="title" value="{{ old('title') }}">
</div>

<div class="input-group">
    <label for="firstName">First Name:</label>
    <input class="form-control validate[required]" type="text" id="firstName" name="first_name"
           value="{{ old('first_name') }}">
</div>

<div class="input-group">
    <label for="lastName">Last Name:</label>
    <input class="form-control validate[required]" type="text" id="lastName" name="last_name"
           value="{{ old('last_name') }}">
</div>
<br>

<div class="input-group">
    <p>Date of Birth:</p>
    <input class="form-control validate[required]" type="text" id="datepicker" name="dob" value="{{ old('dob') }}">
</div>