@extends('admin.layout.admin')
@section('title')
  product
@endsection
@section('admin')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper m-5">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">product </h1>
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
                  <a href="{{ route('admin.product.productlist')}}">
                    <h3 class="card-title">Create</h3>
                  </a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->


                <form role="form" method="POST" action="{{route('product-category.update',[$productCategory->id])}}" enctype="multipart/form-data">
                    @csrf
                    {{-- <input type="hidden" name="_token" value="{{ csrf_token()}}" > --}}
                    <div class="card-body">
                      <div class="form-group">
                        <label for="name">Product name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$productCategory->name}}">
                        @error('name')
                        <span class="text-danger">
                          {{$message}}
                      </span>
                      @enderror
                      </div>

                    {{-- <input type="hidden" value="{{$product->id}}" name="id"> --}}
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
