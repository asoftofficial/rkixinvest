@extends('admin.layouts.default')
@section('page-title')
Slider
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
            var slider_id = $(this).attr('data-id');
            var url = "{{route('admin.slider.remove','id')}}";
            url = url.replace('id', slider_id);
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
        <a href="{{route('admin.slider.create')}}" class="btn btn-info px-3 blue-bg round-10">Add Slider</a>
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
<section class = "page-section-title-area" >
    <div>
        <h2>Slider List</h2>
        <p>Latest slider information</p>
    </div>
</section>{{-- End Page Section Title Area    --}}
<section class = "collections" > <div class="table-responsive">
        <table class="table custom-table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#id
                    </th>
                    <th scope="col">Content
                    </th>
                    <th scope="col">Image
                    </th>
                    <th scope="col">Button Text
                    </th>
                    <th scope="col">Link
                    </th>
                    <th scope="col">Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($sliders as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{Str::limit($item->slider_content,20)}}</td>
                    <td><img src="{{$item->image}}" height="100px"></td>
                    <td>{{$item->button_text}}</td>
                    <td>{{$item->link}}</td>
                    <td style="min-width: 256px; text-align:center">
                        {{-- <a href="#" class="mr-2">
                            <i class='fas fa-eye' style='font-size:20px;color:var(--gray)'></i>
                        </a> --}}
                        <a href="{{route('admin.slider.edit',$item->id)}}" class="btn btn-info blue-bg round-10 px-3 mr-2">Edit</a>
                        <a href="#" class="delete" data-id="{{$item->id}}">
                            <i class='fas fa-trash-alt' style='font-size:20px;color:var(--blue)'></i>
                        </a>
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</section>

</div>
<!-- /.container-fluid -->
{{-- End Add package Model  --}}
<form action ="" method ="post" id ="delete-form">
    @csrf
    @method('delete')
</form>
@endsection
