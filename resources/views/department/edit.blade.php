@extends('layouts.app')

@section('content')
@if(count($errors) > 0)
    <div class="alert alert-danger alert-dismissable text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first() }}</div>
@endif
<div class="row">
    <form id="frm_edit_dept" action="{{ url('departments/edit') }}" method="post" class="form-horizontal">
        {{ csrf_field() }}
        <input name="hdn_dept_id" type="hidden" value="{{ $department->id }}">
        <div class="form-group">
            <button type="submit" class="btn btn-primary col-sm-offset-11 col-sm-1">Save</button>
        </div>
        <fieldset>
            <legend>Department Information</legend>
            <div class="form-group">
                <label class="control-label col-sm-offset-1 col-sm-3">Code</label>
                <div class="col-sm-5">
                    <input name="txt_dept_code" class="form-control" type="text" value="{{ $department->code }}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-offset-1 col-sm-3">Name</label>
                <div class="col-sm-5">
                    <input name="txt_dept_name" class="form-control" type="text" value="{{ $department->name }}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-offset-1 col-sm-3">Description</label>
                <div class="col-sm-5">
                    <input name="txt_dept_desc" class="form-control" type="text" value="{{ $department->desc }}">
                </div>
            </div>
        </fieldset>
    </form>
</div>
@endsection