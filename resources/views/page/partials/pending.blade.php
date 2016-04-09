<div class="box-body table-responsive no-padding">
    <table class="table table-hover table-bordered appointments-table">
        <thead>
        <tr>
            <th>Time/Date</th><th>Doctor</th><th></th>
        </tr>
        </thead>
        @foreach($pending as $pen)
            <tr id="row_id_{{$pen['app_id']}}">
                <td><p>{{ $pen['time'] }}</p></td>
                <td><p>{{ $pen['doctor']['name'] }}</p></td>

                <td style="width: 100px">
                    {{--<!-- Button trigger modal -->--}}
                    <a class="btn btn-danger" data-toggle="modal" data-target="#modal_pending{{$pen['app_id']}}">Cancel</a>
                </td>
            </tr>
        @endforeach
    </table>
</div><!-- /.box-body -->