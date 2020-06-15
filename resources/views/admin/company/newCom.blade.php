@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                <div class="card-header">Company Registration</div>
                <div class="card-body">
            {{ Form::open(['route'=>'company.store','method'=>'post','accept-charset'=>'utf-8','enctype'=>'multipart/form-data',
            'class'=>'uploader','id'=>'file-upload-form'])}}
            <div class="form-group">
                <label for="name">Company Name</label>
                {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                {{ Form::email('email', null, ['class' => 'form-control']) }}
            </div>
            
            <div class="image">
                <label for="logo">Logo</label>
                <input id="file-upload" type="file" name="logo" accept="image/*" onchange="readURL(this);">
                <label for="file-upload" id="file-drag">
                <div id="start">
                    <img id="blah" width="300px" height="150px" />
                    <div>Select a file here</div>
                    <div id="notimage" class="hidden">Please select an image</div>
                    <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                    <br>
                </div>
                </label>
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                {{ Form::url('website', null, ['class' => 'form-control']) }}
            </div>
          <hr>
          <br>
          <div class="text-center">
            {{ Form::submit('Add..',['class'=>'btn btn-success']) }}
          </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
<script>
  function readURL(input, id) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
 }
</script>