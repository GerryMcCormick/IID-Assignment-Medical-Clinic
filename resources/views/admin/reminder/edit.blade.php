@extends('admin.admin')

@section('content')

    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Reminder</h3>
        </div><!-- /.box-header -->

        <!-- form start -->
        {!! Form::model($reminder, ['method' => 'PATCH', 'url' => route('admin.reminder.update', ['reminder' => $reminder->id]), 'class' => 'form-horizontal', 'files' => true]) !!}

            <div class="box-body">
                @include('admin.reminder.reminderform_partial')
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

        {!! Form::close() !!}

    </div><!-- /.box -->

@endsection