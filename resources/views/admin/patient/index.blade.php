@extends('admin.admin')

@section('content')

<h1>Patients <a href="{{ route('admin.patient.create') }}" class="btn btn-primary pull-right btn-sm">Add New Patient</a></h1>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"></h3>
                <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-header -->

            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Title</th><th>User Id</th><th>Address Id</th><th>Actions</th>
                    </tr>
                    @foreach($patients as $item)
                        <tr id='{{$item->id}}'>
                            <td>{{ $item->title }}</td><td>{{ $item->user_id }}</td><td>{{ $item->address_id }}</td><td>
                                <a href='{{ route('admin.patient.edit', ['patient' => $item->id]) }}'><button type='submit' class='btn btn-primary btn-xs'>Update</button></a> /
                                <button data-delete-id='{{ $item->id }}' data-delete-url='{{ route('admin.patient.destroy', ['artist' => $item->id]) }}' data-item-message='' class='btn btn-danger btn-xs del_cms_item'>Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
<div class="row">
    <div class="col-sm-5">
        <div class="dataTables_info">Showing {{ (($patients->currentPage() - 1) * $patients->count()) + 1 }} to {{(($patients->currentPage()) * $patients->count())}} of {{$patients->total()}} patients</div>
    </div>
    <div class="col-sm-7">
        {!! $patients->render() !!}
    </div>
</div>

@endsection