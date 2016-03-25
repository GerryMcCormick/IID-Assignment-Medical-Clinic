
<div class="form-group">
    <label for="title">Title</label>
    {!! Form::select('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Title']) !!}
</div>
<div class="form-group">
    <label for="user_id">Users</label>
    {!! Form::select('user_id', $users, null, ['class' => 'form-control select2', 'style' => 'width: 100%;']) !!}
</div>
<div class="form-group">
    <label for="address_id">Address</label>
    {!! Form::textarea('address_id', null, ['class' => 'form-control', 'id' => 'address_id', 'placeholder' => 'Address Id']) !!}
</div>
<div class="form-group">
    <label for="doctor_id">Doctor</label>
    {!! Form::text('doctor_id', null, ['class' => 'form-control', 'id' => 'doctor_id', 'placeholder' => 'Doctor Id']) !!}
</div>
<div class="form-group">
    <label for="phone">Phone</label>
    {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Phone']) !!}
</div>
<div class="form-group">
    <label for="reminder_id">Reminder</label>
    {!! Form::text('reminder_id', null, ['class' => 'form-control', 'id' => 'reminder_id', 'placeholder' => 'Reminder Id']) !!}
</div>