@extends('layouts.main')
@section('content')

<div class="content-wrapper">
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Companies</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin/dashbord')}}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
             @if(session()->has('message'))
              <div class="alert alert-danger">
             {{ session()->get('message') }}
            </div>
            @endif
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit</h3>

              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{url('/company/update/'.$company->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label><span>  (Required)</span>
                    <input type="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name" value="{{$company->name}}">
                    <span style="color:red">
                      @error('name')
                      {{$message}}
                      @enderror
                    </span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Email" name="email" value="{{$company->email}}">
                     <span style="color:red">
                      @error('email')
                      {{$message}}
                      @enderror
                    </span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Website</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Website" name="website" value="{{$company->website}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Logo</label><span> (Must be 100 by 100px)</span>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                    @if($company->logo == "")
                    <span>image not found</span>
                    @else
                    <img src="{{$company->logo}}" width="70px">
                    @endif
                  </div>
                  <span style="color:red">
                      @error('image')
                      {{$message}}
                      @enderror
                    </span>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  @endsection



