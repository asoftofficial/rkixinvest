@extends('admin.layouts.default')
@section('page-title')
    Promotions
@endsection
@push('style')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .input-label1{
            font-size:12px;
            color:#ABA9A9;
            font-weight:bold;
        }
        .issue-padd{
            padding:20px;
        }
    </style>
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
                        var url = "{{route('admin.promotions.destroy', 'id')}}";
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
                <button class="btn btn-light px-3 yellow-bg round-10" data-toggle="modal" data-target="#addPromotionsModal">Add a Promotion</button>
            </div>
            <div class="admin-search-right">
                <div class="admin-section-search-area input-group mb-3">
                    <input type="text" class="" />
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
                <h2>PROMOTIONS LIST</h2>
                <p>Latest promotions and information</p>
            </div>
            <div class="section-title-right">
                <button class="btn btn-light title-right-btn"><img src="{{asset('/backend/img/icons/export-icon.png')}}" alt="" /> Export CVS</button>
            </div>
        </section>
        {{--    End Page Section Title Area    --}}

        <section class="promotions">
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Promotion ID <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1" /></th>
                        <th scope="col">Name <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1" /></th>
                        <th scope="col">Start Date <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1" /></th>
                        <th scope="col">End Date <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1" /></th>
                        <th scope="col">Code <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1" /></th>
                        <th scope="col">Usage Limit <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1" /></th>
                        <th scope="col">Total Redeemed <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1" /></th>
                        <th scope="col"> </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($promotions as $promotion)
                        <tr>
                            <td>{{$promotion->id}}</td>
                            <td>{{$promotion->name}}</td>
                            <td>{{$promotion->start_date}}</td>
                            <td>{{$promotion->end_date}}</td>
                            <td>{{$promotion->code}}</td>
                            <td>00</td>
                            <td>0000</td>
                            <td style="min-width: 256px; text-align: right">
                                <a href="#" class="btn btn-light yellow-bg round-10 px-4 mr-2" data-toggle="modal" data-target="#editPromotionModal-{{$promotion->id}}">Edit</a>
                                <a href="#" class="delete" data-id="{{$promotion->id}}"><i class='fas fa-trash-alt' style='font-size:20px;color:var(--yellow)'></i></a>
                            </td>
                        </tr>
                        @include('admin.promotions.modals.edit')
                    @endforeach
                    </tbody>
                </table>
                {{ $promotions->links('admin.custom-paginator') }}
            </div>
        </section>

    </div>
    <!-- /.container-fluid -->
        @include('admin.promotions.modals.create')
    <form action="" method="post" id="delete-form">
        @csrf
        @method('delete')
    </form>
@endsection
