@extends('admin.layout.admin')
@section('title')
  Article
@endsection
@section('admin')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper m-5">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Article </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item" >Home</a></li>
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
                  <a href="{{route('article-category.index')}}">
                    <h3 class="card-title" >Create</h3>
                  </a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{route('article-category.store')}}" enctype="multipart/form-data">
                  @csrf
                  {{-- <input type="hidden" name="_token" value="{{ csrf_token()}}" > --}}
                  <div class="card-body">
                    <div class="form-group">
                      <label for="title">title</label>
                      {{-- dùng is-invalid --}}
                      <input type="text" class="form-control {{ $errors->first('title') ? 'is-invalid' : ''}}" id="title" name="title" 
                      value="{{ old('title')}}">  {{-- {{ old('name')}} giữ lại giá trị cũ khi các input khác chưa nhập --}}
                      @error('title')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label for="is_show">is_show</label>
                        <select name="is_show" id="is_show" class="form-control">
                          <option value=""> -----pelease---- </option>
                          <option value="1">1</option>
                          <option value="0">0</option>
                        </select>
                        @error('is_show')
                          <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                      </div>
                  </div>
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
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection