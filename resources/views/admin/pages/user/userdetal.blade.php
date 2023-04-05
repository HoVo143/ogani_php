@extends('admin.layout.admin')
@section('title')
  User
@endsection
@section('admin')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper m-5">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">User </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v3</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary ">
                <div class="card-header d-flex justify-content-between">
                  <h3 class="card-title">Quick Example</h3>
                  <a href="{{ route('admin.user.userlist')}}">
                    <h3 class="card-title">Create</h3>
                  </a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{route('admin.user.update')}}">
                  @csrf
                  {{-- <input type="hidden" name="_token" value="{{ csrf_token()}}" > --}}
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">name</label>
                      {{-- dùng is-invalid --}}
                      <input type="text" class="form-control {{ $errors->first('name') ? 'is-invalid' : ''}}" id="name" name="name" 
                      value="{{$user->name}}">  {{-- {{ old('name')}} giữ lại giá trị cũ khi các input khác chưa nhập --}}
                      @error('name')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="phone">phone</label>
                      <input type="text" class="form-control {{ $errors->first('phone') ? 'is-invalid' : ''}}" id="phone" name="phone" value="{{$user->phone}}">
                      @error('phone')
                        <span class="text-danger">
                          {{$message}}
                      </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="price">email</label>
                      <input type="email" class="form-control {{ $errors->first('email') ? 'is-invalid' : ''}}" id="email" name="email" value="{{$user->email}}">
                      @error('email')
                        <span class="text-danger">
                          {{$message}}
                      </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="status">status</label>
                      <select name="status" id="status" class="form-control" value="{{$user->status}}">
                        <option value=""> -----pelease---- </option>
                        <option {{ $user->status ? 'selected' : ''}} value="1">Active</option>
                        <option {{ !$user->status ? 'selected' : ''}} value="0">In Active</option>
                      </select>
                      @error('status')
                        <span class="text-danger">
                          {{$message}}
                      </span>
                      @enderror
                    </div>
                    {{--  --}}
                    
                    {{-- lay id --}}
                    <input type="hidden" value="{{$user->id}}" name="id">
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    
                  </div>
                </form>
              </div>
              <!-- /.card -->

  
            <!--/.col (right) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
      <!-- Main content -->

  </div>


@endsection
