@extends('layouts.app')

@section('content')
<form action="{{ url('departments/add') }}" method="post" class="form-horizontal">
    {{ csrf_field() }}
    <fieldset>
        <legend>Add Medical Case</legend>
        <div class="form-group">
            <label class="col-sm-offset-2 col-sm-2">Case Serial Number</label>
            <div class="col-sm-6">
                <input type="text" value="{{ sprintf("MCN-%s%s", strtotime('now'), mt_rand(10000, 99999)) }}" name="txt_dept_code" class="form-control" readonly>
            </div>
        </div>
        @if(isset($patient))
        <div class="form-group">
            <label class="col-sm-offset-2 col-sm-2">Patient</label>
            <div class="col-sm-6">
                <a href="{{ url("patients/edit/{$patient->id}") }}">{{ $patient->full_name }}</a>
            </div>
        </div>
        @else
        <div class="form-group">
            <label class="col-sm-offset-2 col-sm-2">Patient</label>
            <div class="col-sm-6">
                <select class="form-control">
                    <option>Choose one</option>
                </select>
            </div>
        </div>
        @endif
        <div class="form-group">
            <label class="col-sm-offset-2 col-sm-2">Department Code</label>
            <div class="col-sm-6">
                <select class="form-control">
                    <option>Choose one</option>
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->code }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary col-sm-offset-5 col-sm-2">Save</button>
        </div>
    </fieldset>
</form>
@endsection