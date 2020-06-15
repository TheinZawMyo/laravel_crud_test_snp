@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 ml-auto text-right">
            <a href="{{ route('employee.create') }}" class="btn btn-success">New Employee</a>
        </div>
    </div>
    <br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Employee List</div>
                <div class="card-body">
                    <div class="emplist">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Company Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($empList as $emplist)
                                <tr>
                                    <td>{{ $emplist->first_name }}</td>
                                    <td>{{ $emplist->last_name }}</td>
                                    <td>{{ $emplist->name ? $emplist->name : 'No Company' }}</td>
                                    <td>{{ $emplist->email }}</td>
                                    <td>{{ $emplist->phone }}</td>
                                    <td>
                                    <a href="{{ route('employee.edit',$emplist->id)}}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                    <form action="{{ route('employee.destroy', $emplist->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" onclick="return confirm('Are you sure to delete?')" type="submit">Delete</button>
                                    </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        {{ $empList->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
