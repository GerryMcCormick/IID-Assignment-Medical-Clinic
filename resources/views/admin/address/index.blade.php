@extends('admin.admin')

@section('content')

<h1>Addresses <a href="{{ route('admin.address.create') }}" class="btn btn-primary pull-right btn-sm">Add New Address</a></h1>

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
                        <th>Add Line 1</th><th>Add Line 2</th><th>Town</th><th>Actions</th>
                    </tr>
                    @foreach($addresses as $item)
                        <tr id='{{$item->id}}'>
                            <td>{{ $item->add_line_1 }}</td><td>{{ $item->add_line_2 }}</td><td>{{ $item->town }}</td><td>
                                <a href='{{ route('admin.address.edit', ['address' => $item->id]) }}'><button type='submit' class='btn btn-primary btn-xs'>Update</button></a> /
                                <button data-delete-id='{{ $item->id }}' data-delete-url='{{ route('admin.address.destroy', ['artist' => $item->id]) }}' data-item-message='' class='btn btn-danger btn-xs del_cms_item'>Delete</button>
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
        <div class="dataTables_info">Showing {{ (($addresses->currentPage() - 1) * $addresses->count()) + 1 }} to {{(($addresses->currentPage()) * $addresses->count())}} of {{$addresses->total()}} addresses</div>
    </div>
    <div class="col-sm-7">
        {!! $addresses->render() !!}
    </div>
</div>

@endsection