@extends('admin.layouts.default')
@section('page-title')
    Collections
@endsection
@push('style')

@endpush

@section('content')
    <div class="container-fluid">
        {{--    Section Search Area    --}}
        <section class="admin-search-area">
            <div class="admin-search-left">
                <button class="btn btn-info px-3 pink-bg round-10" data-toggle="modal" data-target="#addCollectionModal">Add a Collection</button>
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
                <h2>COLLECTION LIST</h2>
                <p>Latest collections and information</p>
            </div>
            <div class="section-title-right">
                <button class="btn btn-light title-right-btn" data-href="{{route('admin.export-collections')}}" id="export"  onclick="exportTasks(event.target);"  ><img src="{{asset('/backend/img/icons/export-icon.png')}}" alt=""> Export CVS</button>
            </div>
        </section>
        {{--    End Page Section Title Area    --}}

        <section class="collections">
            <div class="table-responsive">

                <table class="table custom-table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Collection ID <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Name <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Description <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Created on <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Issues Attached <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Status <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col"> </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($collections as $collection)
                        <tr>
                        <td>{{$collection->collectionId}}</td>
                        <td>{{$collection->name}}</td>
                        <td class="text-center">{{substr($collection->description,0, 30)}}</td>
                        <td>{{ date('d/m/Y', strtotime($collection->created_at))}}</td>
                        <td>{{$collection->issues_count}}</td>
                        <td>{{$collection->status==1?'Live':'Inactive'}}</td>
                        <td style="min-width: 256px">
                            <a href="#" class="mr-2"><i class='fas fa-eye' style='font-size:20px;color:var(--gray)'></i></a>
                            <a href="#" class="btn btn-info pink-bg round-10 px-5 mr-2" data-target="#editCollectionModal-{{$collection->id}}" data-toggle="modal">Edit</a>
                            <a href="#" class="delete" data-id="{{$collection->id}}"><i class='fas fa-trash-alt' style='font-size:20px;color:var(--pink)'></i></a>
                        </td>
                    </tr>
                    @include('admin.collections.modals.edit')

                        @endforeach
                    </tbody>
                </table>
                {{$collections->links('admin.custom-paginator')}}
            </div>
        </section>

    </div>
    <!-- /.container-fluid -->

    @include('admin.collections.modals.create')

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
                        var url = "{{route('admin.collections.destroy', 'id')}}";
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
