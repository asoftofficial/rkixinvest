@extends('admin.layouts.default')
@section('page-title')
    Magazines
@endsection
@push('style')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@push('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('.custom-file-input').change(function(e) {
            var filename = $(this).val().split('\\').pop();
            var lastIndex = filename.lastIndexOf("\\");
            var nextSibling = e.target.nextElementSibling
            nextSibling.innerText = filename
        });
        $(".delete").click(function(e){
            console.log("asdhsakdash")
            swal({
                title: "Are you sure ?",
                text: "Once Deleted it can not be reverted",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        var promotion_id = $(this).attr('data-id');
                        var url = "{{route('admin.magazines.destroy', 'id')}}";
                        url = url.replace('id', promotion_id);
                        $("#delete-form").attr('action', url);
                        $("#delete-form").submit();
                    }
                });
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
                <button class="btn btn-info px-5 btn-red round-10" data-toggle="modal" data-target="#addMagazineModal">Add a magazine</button>
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
                <h2>MAGAZINE LIST</h2>
                <p>Latest magazines and information</p>
            </div>
            <div class="section-title-right">

            </div>
        </section>
        {{--    End Page Section Title Area    --}}

        <section class="magazines">
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Magazine ID <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Title <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Description <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">First Published <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Issues <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Country <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Logo <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col"> </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($magazines as $mag)
                        <tr>
                            <td>{{$mag->id}}</td>
                            <td>{{$mag->title}}</td>
                            <td>{{$mag->desc}}</td>
                            <td>{{$mag->first_published}}</td>
                            <td>{{$mag->issues->count()}}</td>
                            <td>{{$mag->country->name}}</td>
                            <td><img src='{{asset("$mag->logo")}}' alt="" style="max-width: 100px"></td>
                            <td style="min-width: 256px">
                                <a href="#" class="mr-2" style="font-size: 20px;color: var(--light-gray)"><i class="fas fa-eye"></i></a>
                                <a href="#" data-toggle="modal" data-target="#editMagazineModal-{{$mag->id}}" class="btn btn-info btn-dark round-10 px-5 mr-2">Edit</a>
                                <a href="#" class="delete" data-id="{{$mag->id}}" ><i class='fas fa-trash-alt text-dark' style='font-size:20px;'></i></a>
                            </td>
                        </tr>
                        @include('admin.magazines.modals.edit')
                    @endforeach
                    </tbody>
                </table>

            </div>
        </section>

    </div>
    <!-- /.container-fluid -->

    {{--  Add Plan Modal  --}}
    @include("admin.magazines.modals.create")

    {{--  End Add Plan Modal  --}}
    <form action="" method="post" id="delete-form">
        @csrf
        @method('delete')
    </form>
@endsection
@push('script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
