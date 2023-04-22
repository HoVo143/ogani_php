@extends('admin.layout.admin')

@section('title')
  Product list
@endsection

@section('admin')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper m-5">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{ route('admin.article.create')}}">
                <h3 class="card-title ">Create</h3>
              </a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                {{-- <h3 class="card-title">DataTable with minimal features & hover style</h3> --}}
                  <div class="card-title">
                    <form class="d-flex" role="search" method="GET" action="{{route('admin.article.list')}}">
                      @csrf
                      <div class="form-group col-md-5 d-flex align-items-center">
                        <input class="form-control me-2" type="text" value="{{request()->keyword ?? ''}}" name="keyword" id="keyword" placeholder="keyword" aria-label="Search">
                      </div>
                      <div class="form-group col-md-4 d-flex align-items-center">
                        <label for="is_show">is_show</label>
                        <select name="is_show" id="is_show" class="form-control m-1" > 
                          <option value=""> --Choose-- </option>
                          <option value="1">show</option>
                          <option value="0">hide</option>
                        </select>
                      </div>
                      {{-- <div class="form-group col-md-4 d-flex align-items-center">
                        <label for="status">asc/desc</label>
                        <select name="status" id="status" class="form-control m-1" > 
                          <option value=""> --Choose-- </option>
                          <option value="1">asc</option>
                          <option value="0">desc</option>
                        </select>
                      </div> --}}
                      <div class="form-group col-md-4 d-flex align-items-center">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                      </div>
                    </form>
                </div>
    
       
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>
                      <a href="{{ request()->fullUrlWithQuery([
                          'keyword' => request()->keyword ?? '',
                          'sort-by' => 'id',
                          'sort-type' => $sortType])}}">id</a>
                    </th>
                    <th>
                      <a href="{{ request()->fullUrlWithQuery([
                          'keyword' => request()->keyword ?? '',
                          'sort-by' => 'title',
                          'sort-type' => $sortType])}}">title</a>
                    </th>
  
                    {{-- <th>title</th> --}}
                    <th>author</th>
                    <th>Description</th>
                    <th>is_show</th>
                    <th>tags</th>
                    <th>Category Name</th>
                    <th>Option</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ( $articles as $article)
                      <tr>
                        <td>{{$article->id}}</td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->author}}</td>
                        <td>{!!$article->description!!}</td>
                        <td>{{ $article->is_show ? 'Show' : 'Hide' }}</td>
                        <td>{{$article->tags}}</td>

                        
                        <td>{{ $article->category->name }}</td>
                        <td>
                          <a href="{{ route('admin.article.detail', ['id' => $article->id]) }}">Detail</a>
                          <a onclick="return confirm('xoa ko ?');" href="{{ route('admin.article.delete', ['id' => $article->id])}}" class="btn btn-danger">Delete</a>

                       </td>
                        {{-- <td>
                          <a href="{{ route('admin.article.detail', [$article->id])}}" class="btn btn-primary">Detail</a>
                          <a onclick="return confirm('xoa ko ?');" href="{{ route('admin.article.delete', [$article->id])}}" class="btn btn-danger">Delete</a>

                         </td> --}}
                      </tr>
                      @empty
                      <tr>
                        <td colspan="5">No article</td>
                      </tr>
                  @endforelse
                  </tbody>
  
                </table>
              </div>
              {{-- phan trang --}}
              {{ $articles->links()}}
              {{-- {{ $products->links('pagination::default')}}  --}}

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('js-custom')
<!-- DataTables -->
<script src="{{ asset('assets/admins/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/admins/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/admins/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/admins/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script>
  // $(function () {
  //   $("#example1").DataTable({
  //     "responsive": true,
  //     "autoWidth": false,
  //   });
  //   $('#example2').DataTable({
  //     "paging": true,
  //     "lengthChange": false,
  //     "searching": false,
  //     "ordering": true,
  //     "info": true,
  //     "autoWidth": false,
  //     "responsive": true,
  //   });
  // });
</script>
@endsection