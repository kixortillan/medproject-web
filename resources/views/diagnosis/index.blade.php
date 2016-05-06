@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-offset-11 col-sm-1">
        <a href="{{ url('departments/add') }}" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
    </div>
    <div class="col-sm-12">
        <table class="table table-bordered table-responsive table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @if(count($diagnoses) < 1)
                <tr>
                    <td colspan="5">
                        No records found.
                    </td>
                </tr>
                @endif
                @foreach($diagnoses as $diagnosis)
                <tr>
                    <td>{{ $diagnosis->name }}</td>
                    <td>{{ $diagnosis->desc }}</td>
                    <td class="text-center">
                        <a href="{{ url("diagnoses/edit/{$diagnosis->id}") }}">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ url("diagnoses/delete/{$diagnosis->id}") }}">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection