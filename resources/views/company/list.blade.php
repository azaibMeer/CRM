@extends('layouts.main')
@section('content')
<div class="content-wrapper">
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Companies List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin/dashbord')}}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
	<section class="content">
      <div class="container-fluid">
        <div class="row">
         <div class="col-md-12">
          @if(session()->has('message'))
              <div class="alert alert-success">
             {{ session()->get('message') }}
            </div>
        @endif
            <div class="card">
              <div class="card-header">
                <a href="{{url('/add/company')}}" class="btn btn-primary">Add Company</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Logo</th>
                      <th>Website</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@foreach($company as $list)
                    <tr id="record{{$list->id}}">
                      <td>{{$list->id}}</td>
                      <td>{{$list->name}}</td>
                      <td>{{$list->email}}</td>
                      <td>
                        @if($list->logo == "")
                        <span>no image found</span>
                        @else
                        <img src="{{$list->logo}}" width="50px">
                        @endif
                        
                      </td>
                      <td>{{$list->website}}</td>
                      <td>
                        <a href="{{url('/edit/company/'.$list->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm delete_row" data-id="{{ $list->id }}">Delete</a>
                      </td>
                      
                    </tr>
                    @endforeach
                  </tbody>

                </table>
              </div>
            </div>
            
          </div>
        </div>
        </div>
        
      </div><!-- /.container-fluid -->
    </section>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script >
    $(document).ready(function() {
        $(".delete_row").click(function() {
            var id = $(this).data("id");
            var text = "Are you sure you want to delete";
            if (confirm(text) == true) {
                $.ajax({

                    url: "{{url('/delete/company')}}",
                    type: "post",
                    data: {
                        id: id,
                        _token: "{{csrf_token()}}"
                    },
                    dataType: "json",
                    success: function(result) {
                        
                        $("#record" + id).remove();
                    }
                });
            }
        })
    }); 
</script>