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
                  <a href="{{ route('article.index')}}">
                    <h3 class="card-title ">Create</h3>
                  </a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST"action="{{route('article.store')}}" enctype="multipart/form-data">
                  @csrf
                  {{-- <input type="hidden" name="_token" value="{{ csrf_token()}}" > --}}
                  <div class="card-body">
                    <div class="form-group">
                      <label for="title">title</label>
                      <input type="text" class="form-control" id="title" name="title" >
                      <button type="button" id="generate">Nhúng chat GPT</button>

                     @error('title')
                        <span class="text-danger">
                          {{$message}}
                      </span>
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
                      <label for="author">author</label>
                      <input type="text" class="form-control" id="author" name="author">
                     @error('author')
                        <span class="text-danger">
                          {{$message}}
                      </span>
                      @enderror
                    </div>


                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea style="color: black;" name="description" id="description" class="form-control " cols="30" rows="3"></textarea>

                     @error('description')
                        <span class="text-danger">
                          {{$message}}
                      </span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="tags">tags</label>
                      <input type="text" class="form-control" id="tags" name="tags">

                     @error('tags')
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
                    <div class="form-group">
                      <label for="is_approved">is_approved</label>
                      <select name="is_approved" id="is_approved" class="form-control">
                        <option value=""> -----pelease---- </option>
                        <option value="1">show</option>
                        <option value="0">hide</option>
                      </select>
                      @error('is_approved')
                        <span class="text-danger">
                          {{$message}}
                      </span>
                      @enderror
                    </div>
                    {{--  --}}
                    <div class="form-group" style="color: black;" >
                      <label for="article_category_id">Article Category</label>
                      <select style="color: black;" name="article_category_id" class="form-select form-control"
                          id="article_category_id">
                          <option value="">---Please Select---</option>
                          @foreach ($articleCategory as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach

                      </select>
                      @error('article_category_id')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
          

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
    let myEditor;
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            myEditor = editor;
        })
        .catch(error => {
            console.error(error);
        });
  </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#title').on('keyup', function() { // lấy id của ô input có tên là "title"
                let title = $(this).val(); // lấy value của ô input trên
                $.ajax({ // ajax 
                    method: 'POST', //method of form
                    url: "{{ route('article.get.slug') }}", // action of form
                    data: {
                        "title": title,
                        "_token": "{{ csrf_token() }}" // gửi kèm csrf_token() thì mới chạy được
                    },
                    success: function(res) {
                        $('#slug').val(res.title);// thành công thì show ra ô input có id = "slug"
                    },
                    error: function(res) {

                    }
                });
            });
            $('#generate').on('click', function() {
                let name = $('#title').val();

                $.ajax({
                    method: 'POST', //method of form
                    url: "{{ route('write-generate') }}", // action of form
                    data: {
                        "title": name,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        // $('#description').val(res.content);
                        // var editor = CKEDITOR.instances['description'];
                        // editor.setData(res.content);
                        myEditor.setData(res.content);
                    },
                    error: function(res) {

                    }
                });
            });
        });
        
    </script>
@endsection

