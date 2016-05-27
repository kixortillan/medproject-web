@extends('layouts.app')

@section('content')
@if(count($errors) > 0)
<div class="alert alert-danger alert-dismissable text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first() }}</div>
@endif
<form id="frm_add_mc" action="{{ url('cases/add') }}" method="post" class="form-horizontal">
    {{ csrf_field() }}
    <input id="hdn_sel_patient_id" type="hidden" value="">
    <input id="hdn_sel_dept_id" type="hidden" value="">
    <div class="form-group">
        <button type="submit" class="btn btn-primary col-sm-offset-11 col-sm-1">Save</button>
    </div>
    <fieldset>
        <legend>Add Medical Case</legend>
        <div class="form-group">
            <label class="col-sm-offset-2 col-sm-2">Case Serial Number</label>
            <div class="col-sm-6">
                <input name="txt_med_case_num" type="text" value="{{ old('txt_med_case_num')!= null ? old('txt_med_case_num') : $med_case_num }}" class="form-control" readonly>
            </div>
        </div>
        @if(isset($patient))
        <div class="form-group">
            <label class="col-sm-offset-2 col-sm-2">Patient</label>
            <div class="col-sm-6">
                <a href="{{ url("patients/edit/{$patient->id}") }}">{{ $patient->full_name }}</a>
                <input name="hdn_patient_id[]" type="hidden" value="{{ $patient->id }}">
            </div>
        </div>
        @else
        <div class="form-group">
            <label class="col-sm-offset-2 col-sm-2">Patient</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="txt_patient_search" name="txt_patient_search">
            </div>
            <button id="btn_add_patient" type="button" class="btn btn-primary col-sm-1">Add</button>
        </div>
        @endif
        <div class="form-group">
            <label class="col-sm-offset-2 col-sm-2">Department Code</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="txt_department_search" name="txt_department_search">
            </div>
            <button id="btn_add_department" type="button" class="btn btn-primary col-sm-1">Add</button>
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
        <legend>Patient</legend>
        <div class="panel panel-default">
            <div class="panel-body">
                <ul id="lst_diagnoses" class="list-group"></ul>
            </div>
        </div>
    </fieldset>
    <div class="col-sm-6">
        <fieldset>
            <legend>Diagnoses</legend>
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul id="lst_diagnoses" class="list-group"></ul>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="col-sm-6">
        <fieldset>
            <legend>Departments</legend>
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul id="lst_departments" class="list-group"></ul>
                </div>
            </div>
        </fieldset>
    </div>
</form>
@endsection
@section('scripts')
<script type="text/javascript">
    var diagnoses = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '{{ url('diagnoses/search') }}?query=%QUERY',
            wildcard: '%QUERY',
            filter: function(diagnosis) {
                return $.map(diagnosis, function(item) {
                    return {
                        name: item.name,
                        desc: item.desc,
                    };
                });
            }
        }
    });
    
    diagnoses.initialize();
    
    $('#txt_diagnosis_search').typeahead({
        highlight: true
    }, {
        name: 'diagnosis',
        limit: 100,
        display: function(data) {
            return data.name;
        },
        source: diagnoses,
        templates: {
            notFound: '<div class="noitems">No Items Found</div>',
            header: '<div class="tt-header">Diagnoses</div>',
            suggestion: function(data) {
                return '<div>' + data.name + '</div>';
            },
        }
    });
    
    var dept = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '{{ url('departments/search') }}?query=%QUERY',
            wildcard: '%QUERY',
            filter: function(dept) {
                return $.map(dept, function(item) {
                    return {
                        id: item.id,
                        code: item.code,
                        name: item.name,
                        desc: item.desc,
                    };
                });
            }
        }
    });
    
    dept.initialize();
    
    $('#txt_department_search').typeahead({
        highlight: true
    }, {
        name: 'department',
        limit: 100,
        display: function(data) {
            return data.name;
        },
        source: dept,
        templates: {
            notFound: '<div class="noitems">No Items Found</div>',
            header: '<div class="tt-header">Departments</div>',
            suggestion: function(data) {
                return '<div>' + data.name + '</div>';
            },
        }
    }).on("typeahead:select", function(obj, datum){
        $("#hdn_sel_dept_id").val(datum.id);
    });
    
    var patient = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '{{ url('patients/search') }}?query=%QUERY',
            wildcard: '%QUERY',
            filter: function(patients) {
                return $.map(patients, function(item) {
                    return {
                        id: item.id,
                        full_name: item.full_name,
                    };
                });
            }
        }
    });
    
    patient.initialize();
    
    $('#txt_patient_search').typeahead({
        highlight: true
    }, {
        name: 'patient',
        limit: 100,
        display: function(data) {
            return data.full_name;
        },
        source: patient,
        templates: {
            notFound: '<div class="noitems">No Items Found</div>',
            header: '<div class="tt-header">Patients</div>',
            suggestion: function(data) {
                return '<div>' + data.full_name + '</div>';
            },
        }
    }).on("typeahead:select", function(obj, datum){
        $("#hdn_sel_patient_id").val(datum.id);
    });
    
    $("#btn_add_diagnosis").click(function() {
        e = $("#txt_diagnosis_search");
        d = e.val();
        e.val('');
        if (d == '') return;
        if ($("#frm_add_mc").find("input[value='" + d + "']").length > 0) return;
        $("#lst_diagnoses").append('<li class="list-group-item">' + d + '<button type="button" class="close btn-rmv-diagnosis" data-item="' + d + '"><span aria-hidden="true">&times;</span></li>');
        $("#frm_add_mc").append('<input type=hidden name="hdn_diagnoses[]" value="' + d + '">');
    });
    
    $("#btn_add_department").click(function () {
        e = $("#txt_department_search");
        d = e.val();
        e.val('');
        if(d == '')return;
        if($("#frm_add_mc").find("input[value='" + d + "']").length > 0) return;
        $("#lst_departments").append('<li class="list-group-item">' + d + '<button type="button" class="close btn-rmv-department" data-item="' + d + '"><span aria-hidden="true">&times;</span></li>');
        $("#frm_add_mc").append('<input type=hidden name="hdn_departments[]" value="' + $("#hdn_sel_dept_id").val() + '">');
        $("#hdn_sel_dept_id").val('');
    });
    
    $("#btn_add_patient").click(function() {
        e = $("#txt_patient_search");
        d = e.val();
        if (d == '') return;
        if ($("#frm_add_mc").find("input[value='" + d + "']").length > 0) return;
        $("#frm_add_mc").append('<input type=hidden name="hdn_patients[]" value="' + $("#hdn_sel_patient_id").val() + '">');
        $("#hdn_sel_dept_id").val('');
        e.attr('readonly', true).css('background-color', '');
    });
    
    $("#frm_add_mc").on("click", ".btn-rmv-diagnosis", function(e) {
        e.preventDefault();
        el = $(e.target);
        $("#lst_diagnoses").find("li:contains('" + el.attr('data-item') + "')").remove();
        $("#frm_add_mc").find("input[value='" + d + "']").remove();
    });
    
    $("#frm_add_mc").on("click", ".btn-rmv-department", function(e) {
        e.preventDefault();
        el = $(e.target);
        $("#lst_departments").find("li:contains('" + el.attr('data-item') + "')").remove();
        $("#frm_add_mc").find("input[value='" + d + "']").remove();
    });
</script>
@endsection