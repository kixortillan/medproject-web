@extends('layouts.app')

@section('content')
<table class="table table-bordered table-responsive table-striped table-hover">
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
            <td>Edit</td>
            <td>Delete</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection