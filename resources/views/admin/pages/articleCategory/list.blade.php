@extends('admin.layout.admin')
@section('title')
  Article category list
@endsection
@section('admin')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper m-5">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Article category list</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Article category list</li>
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
              <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title">Article category list</h3>
                    </div>
                    <div class="col-md-4">
                        {{-- <a href="{{ route('product-category.create') }}"
                            class="btn btn-primary float-right">Create</a> --}}
                    </div>
                </div>
            </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    {{-- <th>id</th> --}}
                    <th>name</th>
                    <th>is_show</th>
                    <th>delete</th>

                    <th>Option</th>

                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($articleCategories as $articleCategory)
                    <tr>
                        <td>{{ $articleCategory->name }}</td>
                        <td>{{ $articleCategory->is_show ? 'Show' : 'Hide' }}</td>
                        <td>{{ $articleCategory->deleted_at ? 'da xoa mem' : '1' }}</td>
                        
                        <td>
                            <form method="post"
                                action="{{ route('article-category.destroy', ['article_category' => $articleCategory->id]) }}">
                                @csrf
                                <a class="btn btn-primary"
                                    href="{{ route('article-category.edit', ['article_category' => $articleCategory->id]) }}">Detail</a>
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure ?')" type="submit"
                                    class="btn btn-danger">Delete</button>
                            </form>
                            @if ($articleCategory->trashed())
                              <form method="POST" action="{{route('article-category.restore', ['article_category' => $articleCategory->id])}}">
                                @csrf
                                <button onclick="return confim('Are you sure ?')"
                                 type="submit" class="btn btn-success">Restore</button>
                              </form>
                            @endif

                        </td>
                    </tr>

                  @empty
                      <tr>
                          <td colspan="1">No article Category</td>
                      </tr>
                  @endforelse
                  </tbody>
                  {{-- <tbody>
                    @forelse ( $productCategory as $key=>$productCategorys)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$productCategorys->name}}</td>
                        <td>{{date('d/m/Y H:i:s', strtotime($productCategorys->update_at))}}</td>
                        <td>{{ Carbon\Carbon::parse($productCategorys->created_at)->format('d/m/Y H:i:s')}}</td>

                        <td>
                          <a href="{{ route('product-category.edit', ['product_category'=>$productCategorys->id])}}" class="btn btn-primary">Detail</a>
                          
                          <a  onclick="event.preventDefault(); document.getElementById('form-product-category-delete-{{$productCategorys->id}}').submit();"  
                          href="" 
                          class="btn btn-danger">Delete </a>
                            <form method="post" id="form-product-category-delete-{{$productCategorys->id}}"
                             action="{{route('product-category.destroy' , ['product_category'=>$productCategorys->id])}}" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                         </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="1">No product category</td>
                      </tr>
                  @endforelse
                  </tbody>
   --}}
                </table>
              </div>
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
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection