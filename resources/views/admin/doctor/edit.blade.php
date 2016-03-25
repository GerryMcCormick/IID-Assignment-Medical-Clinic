@extends('admin.admin')

@section('content')

    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Doctor</h3>
        </div><!-- /.box-header -->

        <!-- form start -->
        {!! Form::model($doctor, ['method' => 'PATCH', 'url' => route('admin.doctor.update', ['doctor' => $doctor->id]), 'class' => 'form-horizontal', 'files' => true]) !!}

            <div class="box-body">
                @include('admin.doctor.doctorform_partial')
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

        {!! Form::close() !!}

    </div><!-- /.box -->

@endsection