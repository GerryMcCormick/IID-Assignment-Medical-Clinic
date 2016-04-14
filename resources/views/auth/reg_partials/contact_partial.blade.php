<legend>Contact Details</legend>

<div class="input-group">
    <label for="phone">Phone Number:</label>
    <input class="form-control validate[required]" type="text" id="phone" name="phone" value="{{ old('phone') }}"
           onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
</div>

<div class="input-group">
    <label for="add_line_1">Address Line 1:</label>
    <input class="form-control validate[required]" type="text" id="add_line_1" name="add_line_1" value="{{old('add_line_1')}}">
</div>

<div class="input-group">
    <label for="add_line_2">Address Line 2:</label>
    <input class="form-control" type="text" id="add_line_2" name="add_line_2" value="{{old('add_line_1')}}">
</div>

<div class="input-group">
    <label for="town">Town:</label>
    <input class="form-control validate[required]" type="text" id="town" name="town" value="{{old('town')}}">
</div>
<br>

<div class="input-group">
    <p>Postcode:</p>
    <input class="form-control validate[required]" type="text" id="postcode" name="postcode" value="{{old('postcode')}}">
</div>