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
              <li class="breadcrumb-item">Home</a></li>
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
                <form role="form" method="post"
                action="{{ route('admin.product.edit', ['id' => $product->id]) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Name" value="{{ $product->name }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="slug">Slug</label>
                      <input type="text" class="form-control" name="slug" id="slug"
                          placeholder="Slug">
                      @error('slug')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" id="price"
                            placeholder="99" value="{{ $product->price }}">
                    </div>
                    <div class="form-group">
                        <label for="discount_price">Discount Price</label>
                        <input type="number" class="form-control" name="discount_price" id="discount_price"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description">
                            {{ $product->description }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-select form-control" id="status">
                            <option value="">---Please Select---</option>
                            <option value="1">Show</option>
                            <option value="0">Hide</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>~
                        @enderror
                    </div>
                  
                    <div class="form-group">
                      <label for="image_url">Product image</label>
                      <input type="file" class="form-control" 
                      id="image_url" name="image_url" placeholder="Product image" value="{{$product->image_url}}">
                    </div>
                    {{--  --}}
                    @if ($product->image_url !== null)
                          <img style="width: 150px; height:150px;" src="{{asset('images'). '/'.$product->image_url}}" alt="">
                        @else
                          <img style="width: 150px; height:150px; background:#ffff;">
                    @endif
                    {{--  --}}
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

                {{-- <form role="form" method="POST" action="{{route('admin.product.edit',['id' => $product->id])}}" enctype="multipart/form-data">
                    @csrf
                
                    <div class="card-body">
                      <div class="form-group">
                        <label for="name">Product name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}">
                        @error('name')
                        <span class="text-danger">
                          {{$message}}
                      </span>
                      @enderror
                      </div>
  
                      <div class="form-group">
                        <label for="discount_price">discount price</label>
                        <input type="text" class="form-control" id="discount_price" name="discount_price" value="{{$product->discount_price}}">
                       @error('discount_price')
                          <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                      </div>
  
                      <div class="form-group">
                        <label for="price">Product price</label>
                        <input type="text" class="form-control" id="price" name="price" value="{{$product->price}}" >
                       @error('price')
                          <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                      </div>
  
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control "
                         cols="30" rows="3" >{{$product->description}}</textarea>
                       @error('description')
                          <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                      </div>
  
                      <div class="form-group">
                        <label for="status">status</label>
                        <select name="status" id="status" class="form-control" value="{{$product->status}}">
                          <option value=""> -----pelease---- </option>
                          <option {{ $product->status ? 'selected' : ''}}  value="1">show</option>
                          <option {{ !$product->status ? 'selected' : ''}}  value="0">hide</option>
                        </select>
                        @error('status')
                          <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                      </div>
  
                      <div class="form-group">
                        <label for="image_url">Product image</label>
                        <input type="file" class="form-control" 
                        id="image_url" name="image_url" placeholder="Product image" value="{{$product->image_url}}">
                      </div>
                      @if ($product->image_url !== null)
                            <img style="width: 150px; height:150px;" src="{{asset('images'). '/'.$product->image_url}}" alt="">
                          @else
                            <img style="width: 150px; height:150px; background:#ffff;">
                
           
                    </div>
            
    
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </form>
              </div> --}}
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
  <script type="text/javascript">
    $(document).ready(function() {
        $('#name').on('keyup', function() { // lấy id của ô input có tên là "name"
            let name = $(this).val(); // lấy value của ô input trên
            $.ajax({ // ajax 
                method: 'POST', //method of form
                url: "{{ route('product.get.slug') }}", // action of form
                data: {
                    name: name,
                    _token: "{{ csrf_token() }}" // gửi kèm csrf_token() thì mới chạy được
                },
                success: function(res) {
                    $('#slug').val(res.slug);// thành công thì show ra ô input có id = "slug"
                },
                error: function(res) {

                }
            });
        });
    });
  </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection