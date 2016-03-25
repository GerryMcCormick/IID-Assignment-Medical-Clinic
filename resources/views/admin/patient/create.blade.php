@extends('admin.admin')

@section('content')

    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Create New Patient</h3>
        </div><!-- /.box-header -->

        <!-- form start -->
        {!! Form::open(['url' => route('admin.patient.store'), 'class' => 'form-horizontal', 'files' => true, 'role' => 'form']) !!}

            <div class="box-body">
                @include('admin.patient.patientform_partial')
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>

        {!! Form::close() !!}

    </div><!-- /.box -->

@endsection

