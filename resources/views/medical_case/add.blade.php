@extends('layouts.app')

@section('content')
<form id="frm_add_mc" action="{{ url('cases/add') }}" method="post" class="form-horizontal">
    {{ csrf_field() }}
    <fieldset>
        <legend>Add Medical Case</legend>
        <div class="form-group">
            <label class="col-sm-offset-2 col-sm-2">Case Serial Number</label>
            <div class="col-sm-6">
                <input name="txt_med_case_num" type="text" value="{{ sprintf("MCN-%s%s", strtotime('now'), mt_rand(10000, 99999)) }}" class="form-control" readonly>
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
            <div class="col-sm-6">
                <select class="form-control">
                    <option>Choose one</option>
                </select>
            </div>
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
        <legend>Diagnoses</legend>
        <div class="panel panel-default">
            <div class="panel-body">
                <ul id="lst_diagnoses" class="list-group"></ul>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Departments</legend>
        <div class="panel panel-default">
            <div class="panel-body">
                <ul id="lst_departments" class="list-group"></ul>
            </div>
        </div>
    </fieldset>
    <div class="form-group">
        <button type="submit" class="btn btn-primary col-sm-offset-5 col-sm-2">Save</button>
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
            filter: function (diagnosis) {
                return $.map(diagnosis, function (item) {
                    return {
                        name: item.name,
                        desc: item.desc,
                    };
                });
            }
        }
    });

    diagnoses.initialize();

    $('#txt_diagnosis_search').typeahead({highlight: true}, {
        name: 'diagnosis',
        display: function(data){
            return data.name;
        },
        source: diagnoses,
        templates: {
            empty: '<div class="noitems">No Items Found</div>',
            header: '<div class="tt-header">Diagnosis</div>',
            suggestion: function(data){
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
            filter: function (dept) {
                return $.map(dept, function (item) {
                    return {
                        name: item.name,
                        desc: item.code,
                    };
                });
            }
        }
    });

    dept.initialize();

    $('#txt_department_search').typeahead({highlight: true}, {
        name: 'diagnosis',
        display: function(data){
            return data.name;
        },
        source: dept,
        templates: {
            empty: '<div class="noitems">No Items Found</div>',
            header: '<div class="tt-header">Departments</div>',
            suggestion: function(data){
                return '<div>' + data.name + '</div>';
            },
        }
    });
    
    $("#btn_add_diagnosis").click(function () {
        e = $("#txt_diagnosis_search");
        d = e.val();
        e.val('');
        if(d == '')return;
        if($("#frm_add_mc").find("input[value='" + d + "']").length > 0) return;
        $("#lst_diagnoses").append('<li class="list-group-item">' + d + '<span class="btn-rmv-diagnosis pull-right glyphicon glyphicon-remove" data-item="' + d + '"></span></li>');
        $("#frm_add_mc").append('<input type=hidden name="hdn_diagnoses[]" value="' + d + '">');
    });
    
    $("#btn_add_department").click(function () {
        e = $("#txt_department_search");
        d = e.val();
        e.val('');
        if(d == '')return;
        if($("#frm_add_mc").find("input[value='" + d + "']").length > 0) return;
        $("#lst_departments").append('<li class="list-group-item">' + d + '<span class="btn-rmv-department pull-right glyphicon glyphicon-remove" data-item="' + d + '"></span></li>');
        $("#frm_add_mc").append('<input type=hidden name="hdn_departments[]" value="' + d + '">');
    });
    
    $("#frm_add_mc").on("click", ".btn-rmv-diagnosis", function(e){
        e.preventDefault();
        el = $(e.target);
        $("#lst_diagnoses").find("li:contains('" + el.attr('data-item') + "')").remove();
        $("#frm_add_mc").find("input[value='" + d + "']").remove();
    });
    
    $("#frm_add_mc").on("click", ".btn-rmv-department", function(e){
        e.preventDefault();
        el = $(e.target);
        $("#lst_departments").find("li:contains('" + el.attr('data-item') + "')").remove();
        $("#frm_add_mc").find("input[value='" + d + "']").remove();
    });
</script>
@endsection