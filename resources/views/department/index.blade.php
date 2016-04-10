@extends('layouts.app')

@section('content')
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
    <tbody>
        @foreach($departments as $department)
        <tr>
            <td>{{ $department->code }}</td>
            <td>{{ $department->name }}</td>
            <td>{{ $department->desc }}</td>
            <td class="text-center">
                <a href="{{ url("departments/edit/{$department->id}") }}">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
            </td>
            <td class="text-center">
                <a href="{{ url("departments/delete/{$department->id}") }}">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection