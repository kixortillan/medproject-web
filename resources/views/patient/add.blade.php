@extends('layouts.app')

@section('content')
<form action="{{ url('departments/add') }}" method="post" class="form-horizontal">
    {{ csrf_field() }}
    <fieldset>
        <legend>Add Patient</legend>
        <div class="form-group">
            <label class="col-sm-offset-2 col-sm-2">First Name</label>
            <div class="col-sm-6">
                <input type="text" name="txt_dept_code" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-offset-2 col-sm-2">Middle Name</label>
            <div class="col-sm-6">
                <input type="text" name="txt_dept_code" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-offset-2 col-sm-2">Last Name</label>
            <div class="col-sm-6">
                <input type="text" name="txt_dept_code" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-offset-2 col-sm-2">Address Name</label>
            <div class="col-sm-6">
                <textarea type="text" name="txt_dept_code" class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary col-sm-offset-5 col-sm-2">Save</button>
        </div>
    </fieldset>
</form>
@endsection