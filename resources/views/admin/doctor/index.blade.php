@extends('admin.admin')

@section('content')

<h1>Doctors <a href="{{ route('admin.doctor.create') }}" class="btn btn-primary pull-right btn-sm">Add New Doctor</a></h1>

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
                        <th>Title</th><th>Forename</th><th>Surname</th><th>Actions</th>
                    </tr>
                    @foreach($doctors as $item)
                        <tr id='{{$item->id}}'>
                            <td>{{ $item->title }}</td><td>{{ $item->forename }}</td><td>{{ $item->surname }}</td><td>
                                <a href='{{ route('admin.doctor.edit', ['doctor' => $item->id]) }}'><button type='submit' class='btn btn-primary btn-xs'>Update</button></a> /
                                <button data-delete-id='{{ $item->id }}' data-delete-url='{{ route('admin.doctor.destroy', ['artist' => $item->id]) }}' data-item-message='' class='btn btn-danger btn-xs del_cms_item'>Delete</button>
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
        <div class="dataTables_info">Showing {{ (($doctors->currentPage() - 1) * $doctors->count()) + 1 }} to {{(($doctors->currentPage()) * $doctors->count())}} of {{$doctors->total()}} doctors</div>
    </div>
    <div class="col-sm-7">
        {!! $doctors->render() !!}
    </div>
</div>

@endsection