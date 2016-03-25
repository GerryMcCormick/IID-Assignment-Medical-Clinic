
<div class="form-group">
    <label for="date">Date</label>
    {!! Form::text('date', null, ['class' => 'form-control', 'id' => 'datetime', 'placeholder' => 'Date']) !!}
</div>

<div class="form-group">
    <label for="time">Time</label>
    {!! Form::text('date', null, ['class' => 'form-control', 'id' => 'datetime', 'placeholder' => 'Time']) !!}
</div>

<div class="form-group">
    <label for="doctor_id">Doctor</label>
    {!! Form::text('doctor_id', null, ['class' => 'form-control', 'id' => 'doctor_id', 'placeholder' => 'Doctor']) !!}
</div>

<div class="form-group">
    <label for="patient_id">Patient</label>
    {!! Form::select('patient_id', $patients, null, ['class' => 'form-control', 'style' => 'width: 100%;']) !!}
</div><!-- /.form-group -->