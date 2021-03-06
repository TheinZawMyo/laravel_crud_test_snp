@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="card-header">Employee Registration</div>
                <div class="card-body">
                    <div class="empForm">
                        {{ Form::open(['route' => 'employee.store', 'method' => 'POST']) }}
                        <div class="form-group">
                            <label for="first_name">First Name</label> <br>
                            {{ Form::text('first_name', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label> <br>
                            {{ Form::text('last_name', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            <label for="company">Company Name</label> <br>
                            
                            <select class="form-control" name="company_name">
                                <option disabled selected>Choose Company</option>
                                @foreach($compList as $comList)
                                <option value="{{ $comList->id }}">{{ $comList->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label> <br>
                            {{ Form::email('email', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label> <br>
                            {{ Form::tel('phone', null, ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group text-center">
                            {{ Form::submit('Add...', ['class' => 'btn btn-success'])}}
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
