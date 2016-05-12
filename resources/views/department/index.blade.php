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
                    <th></th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @if(count($paginator) < 1)
                <tr>
                    <td colspan="5">
                        No records found.
                    </td>
                </tr>
                @endif
                @foreach($paginator as $department)
                <tr>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="glyphicon glyphicon-option-vertical"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url("departments/add") }}">New</a></li>
                                <li><a href="{{ url("departments/edit/{$department->id}") }}">Edit</a></li>
                                <li><a href="{{ url("departments/delete/{$department->id}") }}">Delete</a></li>
                            </ul>
                        </div>
                    </td>
                    <td>{{ $department->code }}</td>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->desc }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-sm-12">
        <div class="pull-right">
            {!! $paginator->render() !!}
        </div>
    </div>
</div>
@endsection