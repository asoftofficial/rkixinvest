@extends('admin.layouts.default')
@section('page-title')
    Plan
@endsection
@push('style')

@endpush
@push('script')
   <script type="text/javascript">
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
                <button class="btn btn-info px-5 orange-bg round-10" data-toggle="modal" data-target="#addPlanModal">Add a Plan</button>
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
            <h2>PLAN DETAILS</h2>
            <p></p>
        </section>
        {{--    End Page Section Title Area    --}}

        <section class="plans">
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Plan ID <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Name <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Partners <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Created on <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Frontend <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Subscribers <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Status <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col"> </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($plans as $plan)
                        <tr>
                            <td>{{ $plan->planId }}</td>
                            <td>{{ $plan->name }}</td>
                            @if($plan->partner_name ||  $plan->file_path)
                            <td><img src="{{asset($plan->file_path)}}"  /> {{$plan->partner_name}}</td>
                            @else
                            <td></td>
                            @endif
                            <td>{{date('d/m/Y', strtotime($plan->created_at))}}</td>
                            <td>{{$plan->front==1?"Yes":"No"}}</td>
                            <td>{{count($plan->licenses)}}</td>
                            <td>{{$plan->status==1?"Live":"Offline"}}</td>
                            <td style="min-width: 256px">
                               
                                <a href="#" data-toggle="modal" data-target="#editPlanModal-{{$plan->id}}" class="btn btn-info orange-bg round-10 px-4 mr-2">Edit</a>
                               
                            </td>
                        </tr>
                         @include("admin.plans.modals.edit")
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        <br><br>
        {{--    Page Section Title Area    --}}
        <section class="page-section-title-area">
            <div>
                <h2>CUSTOMERS LIST</h2>
                <p>Latest customers and information</p>
            </div>
            <div class="section-title-right">
                <button class="btn btn-light title-right-btn" data-href="{{route('admin.export-plan-customers', $plans[0]->id)}}" id="export"  onclick="exportTasks(event.target);" ><img src="{{asset('/backend/img/icons/export-icon.png')}}" alt=""> Export CVS</button>
            </div>
        </section>
        {{--    End Page Section Title Area    --}}

        <section class="plan-details">
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Customer ID <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">First name <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Last name <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Email <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Date <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Plan <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col"> </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($plans[0]->licenses as $license)
                    
                        <tr>
                            <td>{{$license->customer->customer_id}}</td>
                            <td>{{$license->customer->first_name}}</td>
                            <td>{{$license->customer->last_name}}</td>
                            <td>{{$license->customer->email}}</td>
                            <td>{{date('d/m/Y', strtotime($license->customer->created_at))}}</td>
                            <td class="text-uppercase">{{$license->plan?$license->plan->name:''}}</td>
                            <td style="min-width: 256px; text-align: right">
                                <a href="{{route('admin.customers.show', $license->customer->id)}}" class="btn btn-secondary btn-orange round-10 px-4 mr-2">See more</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

    </div>
    <!-- /.container-fluid -->

    {{--  Add Plan Model  --}}
    @include('admin.plans.modals.create')
    {{--  End Add Plan Model  --}}
@endsection
