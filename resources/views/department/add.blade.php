@extends('layouts.app')

@section('content')
<form action="{{ url('departments') }}" method="post" class="form-horizontal">
    {{ csrf_field() }}
    <fieldset>
        <legend>Add Department</legend>
        <div class="form-group">
            <label class="col-sm-offset-2 col-sm-2">Department Code</label>
            <div class="col-sm-6">
                <input type="text" name="txt_dept_code" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-offset-2 col-sm-2">Department Name</label>
            <div class="col-sm-6">
                <input type="text" name="txt_dept_name" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-offset-2 col-sm-2">Department Description</label>
            <div class="col-sm-6">
                <input type="text" name="txt_dept_desc" class="form-control">
            </div>
        </div>
        <div class="form-group">
                <button type="submit" class="btn btn-primary col-sm-offset-5 col-sm-2">Add</button>
        </div>
    </fieldset>
</form>
@endsection