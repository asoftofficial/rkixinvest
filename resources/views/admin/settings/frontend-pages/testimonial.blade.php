@extends('admin.layouts.default')
@section('page-title')
Testimonial
@endsection
@section('header-right')
    <button
        class="btn btn-info px-3 blue-bg round-10"
        data-toggle="modal"
        data-target="#addTestimonialrdModal">Add Testimonial</button>
@endsection
@push('style')
<link rel = "stylesheet" href = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" > @endpush
@push('script')
<script src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js" > </script>
<script >
$('.custom-file-input').change(function (e) {
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
            var reward_id = $(this).attr('data-id');
            var url = "{{route('admin.testimonial.delete', 'id')}}";
            url = url.replace('id', reward_id);
            $("#delete-form").attr('action', url);
            $("#delete-form").submit();
        }
    });
});
</script>
@endpush
@section('content')
<div class = "container-fluid" >

{{-- Page Section Title Area    --}}
<section class = "page-section-title-area" > <div>
    <h2>Testimonial List</h2>
    <p>Latest testimonials here</p>
</div>
</section>
{{-- End Page Section Title Area    --}}
<section class = "collections" >
    <div class="table-responsive">
        <table class="table custom-table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#id
                    </th>
                    <th scope="col">Client
                    </th>
                    <th scope="col">designation
                    </th>
                    <th scope="col">content
                    </th>
                    <th scope="col">posted at
                    </th>
                    <th scope="col">actions
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach($testimonials as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->username}}</td>
                    <td>{{$item->designation}}</td>
                    <td>{{Str::limit($item->content,20)}}</td>
                    <td>{{$item->created_at}}</td>
                    <td style="min-width: 256px; text-align: right">
                        <a href="{{route('admin.testimonial.show',$item->id)}}" class="mr-2">
                            <i class='fas fa-eye' style='font-size:20px;color:var(--gray)'></i>
                        </a>
                        <a
                            href="#"
                            class="btn btn-info blue-bg round-10 px-5 mr-2"
                            data-target="#editTestimonialModal-{{$item->id}}"
                            data-toggle="modal">Edit</a>
                        <a href="#" class="delete btn btn-dark" data-id="{{$item->id}}">
                            <i class='fas fa-trash-alt' style='font-size:20px;color:white;'></i>
                        </a>
                    </td>
                </tr>
                @include('admin.settings.frontend-pages.modals.testimonial.edit')
                @endforeach
            </tbody>
        </table>
    </div>
</section>

</div>
<!-- /.container-fluid -->

{{-- Add testimonialModel  --}}
@include('admin.settings.frontend-pages.modals.testimonial.create')
<form action = "" method = "post" id = "delete-form" >
    @csrf
@method('delete') </form>
@endsection


@section('content')

@endsection
