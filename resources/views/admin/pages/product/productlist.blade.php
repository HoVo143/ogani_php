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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
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
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
                <a href="{{ route('admin.product')}}">
                    <h3 class="card-title {{ Request::route()->getName() === 'admin.product' ? 'active': '' }}">Create</h3>
                  </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Product name</th>
                    <th>discount price</th>
                    <th>Product price</th>
                    <th>Description</th>
                    <th>status</th>
                    <th>Image</th>
                    <th>Created at</th>
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
                    @forelse ( $product as $products)
                      <tr>
                        <td>{{$products->name}}</td>
                        <td>{{ $products->discount_price}}</td>
                        <td>{{number_format( $products->price, 2)}}</td>
                        <td>{!!$products->description!!}</td>
                        <td>
                          @if($products->status)
                          <button class="btn btn-danger">show</button>
                        @else
                          <button class="btn btn-dark">hide</button>
                        @endif
                      </td>
                        <td>
                          @if ($products->image_url !== null)
                            <img style="width: 150px; height:150px;" src="{{asset('images'). '/'.$products->image_url}}" alt="">
                          @else
                            <img style="width: 150px; height:150px; background:#ffff;">
                          @endif
                          {{-- <img style="width: 150px; height:150px;" src="{{asset('images'). '/'.$products->image_url}}" alt=""> --}}
                        </td>
                        <td>{{ Carbon\Carbon::parse($products->created_at)->format('d/m/Y H:i:s')}}</td>

                        <td>
                          <a href="{{ route('admin.product.detail', [$products->id])}}" class="btn btn-primary">Detail</a>
                          <a onclick="return confirm('xoa ko ?');" href="{{ route('admin.product.delete', [$products->id])}}" class="btn btn-danger">Delete</a>

                         </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="5">No product</td>
                      </tr>
                  @endforelse
                  </tbody>
  
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