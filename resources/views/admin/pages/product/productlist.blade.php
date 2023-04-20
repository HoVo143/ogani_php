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
              <a href="{{ route('admin.product.create')}}">
                <h3 class="card-title {{ Request::route()->getName() === 'admin.product' ? 'active': '' }}">Create</h3>
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
                    <form class="d-flex" role="search" method="GET" action="{{route('admin.product.productlist')}}">
                      @csrf
                      <div class="form-group col-md-5 d-flex align-items-center">
                        <input class="form-control me-2" type="text" value="{{request()->keyword ?? ''}}" name="keyword" id="keyword" placeholder="keyword" aria-label="Search">
                      </div>
                      <div class="form-group col-md-4 d-flex align-items-center">
                        <label for="status">status</label>
                        <select name="status" id="status" class="form-control m-1" > 
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
                          'sort-by' => 'name',
                          'sort-type' => $sortType])}}">name</a>
                    </th>
                    {{-- <th><a href="?sort-by=id&sort-type={{ $sortType }}">id</a></th> --}}
                    {{-- <th><a href="?sort-by=name&sort-type={{ $sortType }}">name</a></th> --}}

                    {{-- <th>discount price</th>
                    <th>Product price</th>
                    <th>Description</th>
                    <th>status</th>
                    <th>Image</th>
                    <th>Created at</th>
                    <th>Action</th> --}}
                    <th>Description</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Category Name</th>
                    <th>Option</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ( $products as $product)
                      <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{!!$product->description!!}</td>
                        {{-- <td>{{ $product->discount_price}}</td> --}}
                        <td>{{number_format( $product->price, 2)}}</td>
                        <td>{{ $product->status ? 'Show' : 'Hide' }}</td>

                        {{-- <td>
                          @if($product->status)
                          <button class="btn btn-danger">show</button>
                        @else
                          <button class="btn btn-dark">hide</button>
                        @endif
                      </td> --}}
                        <td>
                          @if ($product->image_url !== null)
                            <img style="width: 150px; height:150px;" src="{{asset('images'). '/'.$product->image_url}}" alt="">
                          @else
                            <img style="width: 150px; height:150px; background:#ffff;">
                          @endif
                          {{-- <img style="width: 150px; height:150px;" src="{{asset('images'). '/'.$product->image_url}}" alt=""> --}}
                        </td>
                        {{-- <td>{{ Carbon\Carbon::parse($product->created_at)->format('d/m/Y H:i:s')}}</td> --}}
                        
                        <td>{{ $product->category->name }}</td>
                        <td>
                          <a href="{{ route('admin.product.detail', ['id' => $product->id]) }}">Detail</a>
                          <a onclick="return confirm('xoa ko ?');" href="{{ route('admin.product.delete', ['id' => $product->id])}}" class="btn btn-danger">Delete</a>

                       </td>
                        {{-- <td>
                          <a href="{{ route('admin.product.detail', [$product->id])}}" class="btn btn-primary">Detail</a>
                          <a onclick="return confirm('xoa ko ?');" href="{{ route('admin.product.delete', [$product->id])}}" class="btn btn-danger">Delete</a>

                         </td> --}}
                      </tr>
                      @empty
                      <tr>
                        <td colspan="5">No product</td>
                      </tr>
                  @endforelse
                  </tbody>
  
                </table>
              </div>
              {{-- phan trang --}}
              {{ $products->links()}}
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