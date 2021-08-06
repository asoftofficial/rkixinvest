@extends('admin.layouts.default')
@section('page-title')
    Banners
@endsection
@push('style')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .banner-modal{
            padding:20px;
        }
        @media (min-width: 768px){
            .banner-upload{
                -webkit-flex: 0 0 66.666667%;
                -ms-flex: 0 0 66.666667%;
                flex: 0 0 66.666667%;
                max-width: 62.666667%;
            }
        }
    </style>
@endpush
@push('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $('.custom-file-input').change(function(e) {
            var filename = $(this).val().split('\\').pop();
            var lastIndex = filename.lastIndexOf("\\");
            var nextSibling = e.target.nextElementSibling
            nextSibling.innerText = filename
        });
        $( function() {
            $('.datepicker').datepicker({
                dateFormat: 'yy-m-d'
            })
            $('select.ui-select').selectmenu();
        } );

    </script>
@endpush
@section('content')
    <div class="container-fluid">
        {{--    Section Search Area    --}}
        <section class="admin-search-area">
            <div class="admin-search-left">
                <button class="btn btn-info px-3 green-bg round-10" data-toggle="modal" data-target="#addBannersModal">Create a Banner</button>
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
                <h2>BANNERS LIST</h2>
                <p>Latest banners and information</p>
            </div>
        </section>
        {{--    End Page Section Title Area    --}}

        <section class="collections">
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Banner ID <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Name <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Type <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Start Date <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">End Date <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Status <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col"> </th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $today = date('m/d/Y');
                        @endphp
                        @foreach($banners as $banner)
                        <tr>
                            <td>{{ $banner->bannerId}}</td>
                            <td>{{ $banner->name }}</td>
                            <td class="text-center">{{ $banner->type }}</td>
                            <td>{{ date('d/m/y', strtotime($banner->start_date)) }}</td>
                            <td>{{ date('d/m/y', strtotime($banner->end_date)) }}</td>
                            <td>{{ $today <= $banner->end_date?"Live":"Completed" }}


                        </td>
                            <td style="min-width: 256px; text-align: right">
                                <a href="#" class="mr-2"><i class='fas fa-eye' style='font-size:20px;color:var(--gray)'></i></a>
                                <a href="#" class="btn btn-info green-bg round-10 px-5 mr-2" data-toggle="modal" data-target="#editBannerModal-{{$banner->id}}">Edit</a>
                                <a href="#" class="delete" data-id="{{$banner->id}}" ><i class='fas fa-trash-alt' style='font-size:20px;color:var(--green)'></i></a>
                            </td>
                        </tr>
                        @include('admin.banners.modals.edit')
                        @endforeach
                    </tbody>
                </table>
                {{ $banners->links('admin.custom-paginator') }}
            </div>
        </section>

    </div>
    <!-- /.container-fluid -->


    @include('admin.banners.modals.create')

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
                        var url = "{{route('admin.banners.destroy', 'id')}}";
                        url = url.replace('id', issue_id);
                        $("#delete-form").attr('action', url);
                        $("#delete-form").submit();
                    }
                });
        });
    </script>
@endpush
