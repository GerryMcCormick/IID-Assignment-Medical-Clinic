<legend>Account Information</legend>

<div class="input-group">
    <label for="email">Email Address:</label>
    <input class="form-control validate[custom[email],required]" type="email" id="email" name="email"
           value="{{ old('email') }}">
</div>

<div class="input-group">
    <label for="password">Password:</label>
    <input class="form-control validate[required]" type="password" id="password" name="password">
</div>

<div class="input-group">
    <label for="password_confirmation validate[required]">Confirm Password:</label>
    <input class="form-control" type="password" id="password_confirmation" name="password_confirmation">
</div>

<div class="input-group">
    <label for="reminder">Appointment Reminder Method:</label>
    <div id="reminder">
        <p><input type="radio" name="reminder_id[]" value="1"/>&nbsp;Email day before appointment</p>
        <p><input type="radio" name="reminder_id[]" value="2"/>&nbsp;Text day before appointment</p>
        <p><input type="radio" name="reminder_id[]" value="3" checked/>&nbsp;No Reminder</p>
    </div>
</div>

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
