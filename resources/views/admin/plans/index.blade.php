@extends('admin.layouts.default')
@section('page-title')
    Plans
@endsection
@push('style')

@endpush
@push('script')
<style>
  .pound{
      color:#ABA9A9;
  }
  .pound-1{
     color:#ABA9A9;
     background-color:#F8F9FA;
     border-right:1px solid gray;
 }
 .upload-sec{
     border-radius:10px;
     color:#ABA9A9;
     border:0px;
 }
  .custom-file {
      margin-top: 6px;
  }


</style>
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
            <div>
                <h2>PLAN LIST</h2>
                <p>Latest plans and information</p>
            </div>
            <div class="section-title-right">
                <button class="btn btn-light title-right-btn"  data-href="{{route('admin.export-plans')}}" id="export"  onclick="exportTasks(event.target);"  ><img src="{{asset('/backend/img/icons/export-icon.png')}}" alt=""> Export CVS</button>
            </div>
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
                            <td>{{$plan->licenses_count}}</td>
                            <td>{{$plan->status==1?"Live":"Offline"}}</td>
                            <td style="min-width: 256px">
                                <a href="{{route('admin.plans.show', $plan)}}" class="btn btn-outline-orange round-10 px-4 mr-2">See more</a>
                                <a href="#" data-toggle="modal" data-target="#editPlanModal-{{$plan->id}}" class="btn btn-info orange-bg round-10 px-4 mr-2">Edit</a>
                               @if(!$plan->licenses_count>0)
                                <a href="#" class="delete" data-id="{{$plan->id}}" ><i class='fas fa-trash-alt' style='font-size:20px;color:var(--orange)'></i></a>
                                @endif
                            </td>
                        </tr>
                         @include("admin.plans.modals.edit")
                    @endforeach
                    </tbody>
                </table>
                {{$plans->links('admin.custom-paginator')}}
            </div>
        </section>

    </div>
    <!-- /.container-fluid -->

    {{--  Add Plan Modal  --}}
    @include("admin.plans.modals.create")

    {{--  End Add Plan Modal  --}}
    <form action="" method="post" id="delete-form">
        @csrf
        @method('delete')
    </form>
@endsection
@push('script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        $(".delete").click(function(e){
             swal({
                  title: "Are you sure ?",
                  text: "Once Deleted it can not be reverted, All related issues will also be deleted",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var issue_id = $(this).attr('data-id');
                        var url = "{{route('admin.plans.destroy', 'id')}}";
                        url = url.replace('id', issue_id);
                        $("#delete-form").attr('action', url);
                        $("#delete-form").submit();
                    }
                });
        });
        function exportTasks(_this) {
          let _url = $(_this).data('href');
          window.location.href = _url;
       }
    </script>

@endpush
