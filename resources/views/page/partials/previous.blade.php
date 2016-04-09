<div class="box-body table-responsive no-padding">
    <table class="table table-hover table-bordered appointments-table">
        <thead>
        <tr>
            <th>Time/Date</th><th>Doctor</th>
        </tr>
        </thead>
        @foreach($previous as $pre)
            <tr>
                <td><p>{{ $pre['time'] }}</p></td>
                <td><p>{{ $pre['doctor']['name'] }}</p></td>
            </tr>
        @endforeach

    </table>
</div><!-- /.box-body -->