@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Company</div>
                <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                    </div>
                @endif
            {{ Form::open(['route'=>['company.update', $company->id],'method'=>'POST','accept-charset'=>'utf-8','enctype'=>'multipart/form-data',
            'class'=>'uploader','id'=>'file-upload-form'])}}
            @method('PATCH') 
            @csrf
            <div class="form-group">
                <label for="name">Company Name</label>
                {{ Form::text('name', $company->name , ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                {{ Form::email('email', $company->email, ['class' => 'form-control']) }}
            </div>
            
            <div class="image">
                <label for="logo">Logo</label>
                <input id="file-upload" type="file" name="logo" accept="image/*" onchange="readURL(this);">
                <label for="file-upload" id="file-drag">
                <div id="start">
                    <img id="blah" width="300px" height="150px" src="{{ asset($company->logo) }}" />
                    <div>Select a file here</div>
                    <div id="notimage" class="hidden">Please select an image</div>
                    <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                    <br>
                </div>
                </label>
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                {{ Form::url('website', $company->website, ['class' => 'form-control']) }}
            </div>
          <hr>
          <br>
          <div class="text-center">
            {{ Form::submit('Update..',['class'=>'btn btn-success']) }}
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