@extends('users.layouts.default')
@section('page-title')
Packages
@endsection
@push('style') 
<link rel = "stylesheet" href = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" > 
@endpush
@push('script') 
<script src = "https://code.jquery.com/ui/1.12.1/jquery-ui.js" > </script> 
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
    {{-- <section class = "admin-search-area" > 
        <div class="admin-search-left">
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
</section>--}}
{{-- End Section Search Area    --}}

{{-- Page Section Title Area    --}} 
<section class = "page-section-title-area" > <div>
    <h2>Packages List</h2>
    <p>All Investment Packages</p>
</div>
</section>
{{-- End Page Section Title Area    --}} 
<div class="packages">
    @if(!empty($packages))
        @foreach($packages as $pack)
       <div class="table basic">
           <div class="price-section">
               <div class="price-area">
                   <div class="inner-area">
                       <span class="text">
                         $
                       </span>
                       <span class="price">00</span>
                   </div>
               </div>
           </div>
           <div class="package-name">
                <span>Gold</span>
           </div>
           <div class="features">
               <li>
                   <span class="list-name">One Selected Template</span>
                   <span class="icon check"><i class="fas fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">100% Responsive Design</span>
                   <span class="icon check"><i class="fas fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">Credit Remove Permission</span>
                   <span class="icon cross"><i class="far fa-times-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">Lifetime Template Updates</span>
                   <span class="icon cross"><i class="far fa-times-circle"></i></span>
               </li>
               <div class="btn"><button>Purchase</button></div>
           </div>
       </div>
    @endforeach
    @endif
       
   </div>

</div>
<!-- /.container-fluid -->

{{-- Add package Model  --}}
@include('admin.packages.modals.create')
{{-- End Add package Model  --}} 
<form action = "" method = "post" id = "delete-form" > 
    @csrf
@method('delete') </form>
@endsection
