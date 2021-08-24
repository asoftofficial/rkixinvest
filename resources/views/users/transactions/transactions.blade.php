@extends('admin.layouts.default')
@section('page-title')
Transactions
@endsection
@push('style')
    <link rel="stylsheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}
@endpush
@push('script')
<script src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js" > </script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
    $('#transactionTable').DataTable();
} );
</script>
@endpush
@section('content')
<div class = "container-fluid" >
    {{-- Section Search Area   --}}
     {{-- <section class = "admin-search-area" >
         <div class="admin-search-left">
    <button
        class="btn btn-info px-3 blue-bg round-10"
        data-toggle="modal"
        data-target="#addRewardModal">Create reward</button>
</div>
 <div class="admin-search-right">
    <div class="admin-section-search-area input-group mb-3">
        <input type="text" class="">
            <div class="admin-section-search-btn-area">
                <button class="btn bg-transparent mr-2" type="button">
                    <i class="fas fa-search mr-2"></i>
                    Search here</button>
            </div>
        </div>
    </div>
</section> --}}
{{-- End Section Search Area  --}}

{{-- Page Section Title Area    --}}
<section class = "page-section-title-area" > <div>
    <h2>Transaction History</h2>
    <p>Latest tranactions information</p>
</div>
</section>{{-- End Page Section Title Area    --}}
<section class = "collections" >
    <div class="table-responsive">
        <table class="table custom-table" id="transactionTable">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#id
                    </th>
                    <th scope="col">type
                    </th>
                    <th scope="col">Amount
                    </th>
                    <th scope="col">description
                    </th>

                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->type}}</td>
                    <td>{{$item->amount}}</td>
                    <td>{{$item->description}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
</div>
<!-- /.container-fluid -->
@endsection
