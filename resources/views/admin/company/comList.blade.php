@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 ml-auto text-right">
            <a href="{{ route('company.create') }}" class="btn btn-success">New Company</a>
        </div>
    </div>
    <br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="">
        <div class="title">
            <h5>Company List</h5>
        </div>
        <div class="row">
            @foreach($comList as $comlist)
                <div class="col-md-4">
                    <div class="card mt-2">
                        <div class="card-header">{{ $comlist->name }}</div>
                        <div class="card-body">
                            <img src="{{ asset($comlist->logo) }}" alt="logo" width="100%" height="200px">
                            <hr>
                            <p>Email : {{ $comlist->email }}</p>
                            <p>website : <a href="{{ asset($comlist->website) }}">{{ $comlist->website }}</a> </p>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('company.edit',$comlist->id) }}" class="btn btn-primary w-100">Edit</a>
                                </div>
                                <div class="col-md-6">
                                <form action="{{ route('company.destroy', $comlist->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger w-100" onclick="return confirm('Are you sure to delete?')" type="submit">Delete</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div><br>
        {{ $comList->links() }}
    </div>
</div>
@endsection
