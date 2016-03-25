@extends('admin.admin')

@section('content')

    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Patient</h3>
        </div><!-- /.box-header -->

        <!-- form start -->
        {!! Form::model($patient, ['method' => 'PATCH', 'url' => route('admin.patient.update', ['patient' => $patient->id]), 'class' => 'form-horizontal', 'files' => true]) !!}

            <div class="box-body">
                @include('admin.patient.patientform_partial')
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

        {!! Form::close() !!}

    </div><!-- /.box -->

@endsection