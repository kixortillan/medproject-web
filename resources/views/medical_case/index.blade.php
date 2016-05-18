@extends('layouts.app')

@section('content')
@if(session('message') != null)
<div class="alert alert-success alert-dismissable text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session('message') }}</div>
@endif
<div class="row">
    <div class="col-sm-offset-11 col-sm-1">
        <div class="panel">
            <a href="{{ url('patients/add') }}" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
        </div>
    </div>
    <div class="col-sm-12">
        <table class="table table-bordered table-responsive table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th></th>
                    <th>Medical Case Number</th>
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
                @foreach($paginator as $item)
                <tr>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="glyphicon glyphicon-menu-hamburger"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url("cases/add") }}">New Case</a></li>
                                <li><a href="{{ url("cases/edit/{$item->id}") }}">Edit</a></li>
                                <li><a href="{{ url("cases/delete/{$item->id}") }}">Delete</a></li>
                            </ul>
                        </div>
                    </td>
                    <td>{{ $item->serial_num }}</td>
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