
<div class="form-group">
    <label for="title">Title</label>
    {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Title']) !!}
</div>
<div class="form-group">
    <label for="forename">Forename</label>
    {!! Form::text('forename', null, ['class' => 'form-control', 'id' => 'forename', 'placeholder' => 'Forename']) !!}
</div>
<div class="form-group">
    <label for="surname">Surname</label>
    {!! Form::text('surname', null, ['class' => 'form-control', 'id' => 'surname', 'placeholder' => 'Surname']) !!}
</div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Qualifications</h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
            <button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        </div><!-- /. tools -->
    </div><!-- /.box-header -->
    <div class="box-body pad">
        {!! Form::textarea('qualifications', null, ['class' => 'textarea', 'placeholder' => 'Place some text here', 'style' => 'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;']) !!}
    </div>
</div>
<div class="form-group">
    <label for="image">Image</label>
    @if(isset($doctor->image))
        <a href="{{ $doctor->image }}" download/>
        <button class="btn btn-primary updateFile">Update Image</button>
        <div id="fileContainer" style="display: none;">
            {!! Form::file('image', ['class' => 'form-control']) !!}
            {!! $errors->first('image', '<p class="help-block alert-error">:message</p>') !!}
        </div>
    @else
        {!! Form::file('image', ['class' => 'form-control']) !!}
        {!! $errors->first('image', '<p class="help-block alert-error">:message</p>') !!}
    @endif

</div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">About</h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
            <button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        </div><!-- /. tools -->
    </div><!-- /.box-header -->
    <div class="box-body pad">
        {!! Form::textarea('about', null, ['class' => 'textarea', 'placeholder' => 'Place some text here', 'style' => 'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;']) !!}
    </div>
</div>