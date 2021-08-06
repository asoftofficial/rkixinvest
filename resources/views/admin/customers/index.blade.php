@extends('admin.layouts.default')
@section('page-title')
    Customers
@endsection
@push('style')

@endpush
@push('script')
    <script>
       function exportTasks(_this) {
          let _url = $(_this).data('href');
          window.location.href = _url;
       }
    </script>
@endpush
@section('content')
    <div class="container-fluid">
        {{--    Section Search Area    --}}
        <section class="admin-search-area">
            <div class="admin-search-left">

            </div>
            <div class="admin-search-right">
                <div class="admin-section-search-area input-group mb-3">
                    <input type="text" class="">
                    <div class="admin-section-search-btn-area">
                        <button class="btn bg-transparent mr-2" type="button"><i class="fas fa-search mr-2"></i> Search here</button>
                    </div>
                </div>
            </div>
        </section>
        {{--    End Section Search Area    --}}

        {{--    Page Section Title Area    --}}
        <section class="page-section-title-area">
            <div>
                <h2>CUSTOMERS LIST</h2>
                <p>Latest customers and information</p>
            </div>
            <div class="section-title-right">
                <button class="btn btn-light title-right-btn" data-href="{{route('admin.export-customers')}}" id="export"  onclick="exportTasks(event.target);" ><img src="{{asset('/backend/img/icons/export-icon.png')}}" alt=""> Export CVS</button>
            </div>
        </section>
        {{--    End Page Section Title Area    --}}

        <section class="customers">
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Customer ID <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">First Name <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Last Name <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Email <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Date <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Plan <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col"> </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td>{{$customer->customer_id}}</td>
                            <td>{{$customer->first_name}}</td>
                            <td>{{$customer->last_name}}</td>
                            <td>{{$customer->email}}</td>
                            <td>{{date('d/m/Y', strtotime($customer->created_at))}}</td>
                            <td class="text-uppercase">{{$customer->lisense?$customer->lisense->plan->name:''}}</td>
                            <td style="min-width: 256px; text-align: right">
                                <a href="{{route('admin.customers.show', $customer)}}" class="btn btn-dark blue-bg round-10 px-4 mr-2">See more</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $customers->links('admin.custom-paginator') }}
            </div>
        </section>

    </div>
    <!-- /.container-fluid -->
@endsection
