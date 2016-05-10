@extends('layouts.app')

@section('content')
@if(count($errors) > 0)
    <div class="alert alert-danger alert-dismissable text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first() }}</div>
@endif
<div class="row">
    <form id="frm_edit_patient" action="{{ url('patients/edit') }}" method="post" class="form-horizontal">
        {{ csrf_field() }}
        <input name="hdn_patient_id" type="hidden" value="{{ $patient->id }}">
        <div class="form-group">
            <button type="submit" class="btn btn-primary col-sm-offset-11 col-sm-1">Save</button>
        </div>
        <fieldset>
            <legend>Patient Information</legend>
            <div class="form-group">
                <label class="control-label col-sm-3">First Name</label>
                <div class="col-sm-5">
                    <input name="txt_first_name" class="form-control" type="text" value="{{ $patient->first_name }}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Middle Name</label>
                <div class="col-sm-5">
                    <input name="txt_middle_name" class="form-control" type="text" value="{{ $patient->middle_name }}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Last Name</label>
                <div class="col-sm-5">
                    <input name="txt_last_name" class="form-control" type="text" value="{{ $patient->last_name }}">
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Additional Information</legend>
            <div class="form-group">
                <label class="control-label col-sm-3">Address</label>
                <div class="col-sm-5">
                    <input name="txt_address" class="form-control" type="text" value="{{ $patient->address }}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Postal Code</label>
                <div class="col-sm-5">
                    <input name="txt_postal_code" class="form-control" type="text" value="{{ $patient->postal_code }}">
                </div>
            </div>
        </fieldset>
    </form>
</div>
@endsection