@extends('admin.layout.admin')
@section('title')
  Product
@endsection
@section('admin')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper m-5">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Product</h1>
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
                    <h3 class="card-title ">Create</h3>
                  </a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{route('admin.product.save')}}" enctype="multipart/form-data">
                  @csrf
                  {{-- <input type="hidden" name="_token" value="{{ csrf_token()}}" > --}}
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">Product name</label>
                      <input type="text" class="form-control" id="name" name="name" >
                      @error('name')
                      <span class="text-danger">
                        {{$message}}
                    </span>
                    @enderror
                    </div>

                    <div class="form-group">
                      <label for="discount_price">discount price</label>
                      <input type="text" class="form-control" id="discount_price" name="discount_price">
                     @error('discount_price')
                        <span class="text-danger">
                          {{$message}}
                      </span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="price">Product price</label>
                      <input type="text" class="form-control" id="price" name="price" >
                     @error('price')
                        <span class="text-danger">
                          {{$message}}
                      </span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea name="description" id="description" class="form-control " cols="30" rows="3"></textarea>

                     @error('description')
                        <span class="text-danger">
                          {{$message}}
                      </span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="status">status</label>
                      <select name="status" id="status" class="form-control">
                        <option value=""> -----pelease---- </option>
                        <option value="1">show</option>
                        <option value="0">hide</option>
                      </select>
                      @error('status')
                        <span class="text-danger">
                          {{$message}}
                      </span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="image_url">Product image</label>
                      <input type="file" class="form-control" id="image_url" name="image_url" placeholder="Product image">
                      
                    </div>
                    
                    @error('image_url')
                    <span class="text-danger">
                      {{$message}}
                  </span>
                  @enderror
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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

@section('js-custom')
<script>
  ClassicEditor
      .create( document.querySelector( '#description' ) )
      .catch( error => {
          console.error( error );
      } );
</script>
@endsection

