@extends('layouts.app')

@section('content')
<form id="frm_add_mc" action="{{ url('departments/add') }}" method="post" class="form-horizontal">
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
    </fieldset>
    <fieldset>
        <div class="form-group">
            <label class="col-sm-offset-2 col-sm-2">Diagnosis</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="txt_diagnosis_search" name="txt_diagnosis_search">
            </div>
            <button id="btn_add_diagnosis" type="button" class="btn btn-primary col-sm-1">Add</button>
        </div>
    </fieldset>
    <fieldset>
        <legend>Diagnoses</legend>
        <div class="panel panel-default">
            <div class="panel-body">
                <ul id="lst_diagnoses" class="list-group"></ul>
            </div>
        </div>
    </fieldset>
    <div class="form-group">
        <button type="submit" class="btn btn-primary col-sm-offset-5 col-sm-2">Save</button>
    </div>
</form>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $("#txt_diagnosis_search").autocomplete({
            serviceUrl: "{{ url('diagnoses/search') }}",
        });

        $("#btn_add_diagnosis").click(function () {
            $e = $("#txt_diagnosis_search");
            $d = $e.val();
            $e.val('');
            $("#lst_diagnoses").append('<li class="list-group-item">' + $d + '</li>');
            $("#frm_add_mc").append('<input type=hidden name="hdn_diagnoses[]" value="' + $d + '">');
        });
    });
</script>
@endsection