@extends('admin.layouts.default')
@section('page-title')
Packages
@endsection
@push('style') <link rel = "stylesheet" href = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" > @endpush
@push('script') <script src = "https://code.jquery.com/ui/1.12.1/jquery-ui.js" > </script>
<script src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js" > </script>
<script > $(
    '.custom-file-input'
).change(function (e) {
    var filename = $(this)
        .val()
        .split('\\')
        .pop();
    var lastIndex = filename.lastIndexOf("\\");
    var nextSibling = e.target.nextElementSibling
    nextSibling.innerText = filename
});
$(function () {
    $('.datepicker').datepicker({dateFormat: 'yy-m-d'})
});

$(".delete").click(function (e) {
    console.log("asdhsakdash")
    swal(
        {title: "Are you sure ?", text: "Once Deleted it can not be reverted", icon: "warning", buttons: true, dangerMode: true}
    ).then((willDelete) => {
        if (willDelete) {
            var package_id = $(this).attr('data-id');
            var url = "{{route('admin.packages.destroy', 'id')}}";
            url = url.replace('id', package_id);
            $("#delete-form").attr('action', url);
            $("#delete-form").submit();
        }
    });
});
</script>
@endpush
@section('content')
<div class = "container-fluid" > {{-- Section Search Area    --}}
    <section class = "admin-search-area" > <div class="admin-search-left">
    <button
        class="btn btn-info px-3 blue-bg round-10"
        data-toggle="modal"
        data-target="#addIssuesModal">Create Package</button>
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
</section>{{-- End Section Search Area    --}}

{{-- Page Section Title Area    --}}
<section class = "page-section-title-area" > <div>
    <h2>Packages List</h2>
    <p>Latest Packages information</p>
</div>
</section>{{-- End Page Section Title Area    --}}
<section class = "collections" > <div class="table-responsive">
        <table class="table custom-table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Package ID
                    </th>
                    <th scope="col">Name
                    </th>
                    <th scope="col">min-invest
                    </th>
                    <th scope="col">max-invest
                    </th>
                    <th scope="col">Roi
                    </th>
                    <th scope="col">Roi_type</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($pack as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->min_invest}}</td>
                    <td>{{$item->max_invest}}</td>
                    <td>{{$item->roi}}</td>
                    <td>{{$item->roi_type}}</td>
                    <td style="min-width: 256px; text-align: right">
                        <a href="#" class="mr-2">
                            <i class='fas fa-eye' style='font-size:20px;color:var(--gray)'></i>
                        </a>
                        <a
                            href="#"
                            class="btn btn-info blue-bg round-10 px-5 mr-2"
                            data-target="#editpackagesModal-{{$item->id}}"
                            data-toggle="modal">Edit</a>
                        <a href="#" class="delete" data-id="{{$item->id}}">
                            <i class='fas fa-trash-alt' style='font-size:20px;color:var(--blue)'></i>
                        </a>
                    </td>
                </tr>
                @include('admin.packages.modals.edit') @endforeach
            </tbody>
        </table>
    </div>
</section>

</div>
<!-- /.container-fluid -->

{{-- Add package Model  --}}
@include('admin.packages.modals.create')
{{-- End Add package Model  --}}
<form action = "" method = "post" id = "delete-form" > @csrf
@method('delete') </form>
@endsection
