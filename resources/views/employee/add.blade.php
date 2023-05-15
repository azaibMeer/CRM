@extends('layouts.main')
@section('content')

<div class="content-wrapper">
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Employee</h1>
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
                <h3 class="card-title">Add</h3>

              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{url('/employee/store')}}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label><span>  (Required)</span>
                    <input type="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name" >
                    <span style="color:red">
                      @error('name')
                      {{$message}}
                      @enderror
                    </span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Last Name</label><span>  (Required)</span>
                    <input type="name" class="form-control" id="exampleInputEmail1" placeholder="Enter last name" name="last_name" >
                    <span style="color:red">
                      @error('last_name')
                      {{$message}}
                      @enderror
                    </span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Email" name="email">
                     <span style="color:red">
                      @error('email')
                      {{$message}}
                      @enderror
                    </span>
                  </div>
                  <div class="form-group">
                        <label>Select company</label>
                        <select class="form-control" name="company_id">
                          <option disabled >Select Company</option>
                          @foreach($company as $company_name)
                          <option value="{{$company_name->id}}">{{$company_name->name}}</option>
                          @endforeach
                        </select>
                      </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Phone</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone" name="phone" >
                    <span style="color:red">
                      @error('phone')
                      {{$message}}
                      @enderror
                    </span>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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



