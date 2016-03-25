@extends('admin.admin')

@section('content')

    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Address</h3>
        </div><!-- /.box-header -->

        <!-- form start -->
        {!! Form::model($address, ['method' => 'PATCH', 'url' => route('admin.address.update', ['address' => $address->id]), 'class' => 'form-horizontal', 'files' => true]) !!}

            <div class="box-body">
                @include('admin.address.addressform_partial')
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

        {!! Form::close() !!}

    </div><!-- /.box -->

@endsection