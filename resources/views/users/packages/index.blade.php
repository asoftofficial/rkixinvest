@extends('users.layouts.default')
@section('page-title')
Packages
@endsection
@push('style')
@endpush
@push('script')
<script src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js" > </script>
<script>
$('#investModal').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        $('#packageId').val(id)
})
</script>
@endpush
@section('content')
<div class = "container-fluid">

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
                       <span class="price">{{ $pack->min_invest }}</span>
                   </div>
               </div>
           </div>
           <div class="package-name">
                <span>{{ $pack->title }}</span>
           </div>
           <div class="features">
               <li>
                   <span class="list-name">Return on Invest {{ $pack->roi }}$</span>
                   <span class="icon check"><i class="fas fa-check-circle"></i></span>
               </li>
               <li>
                   <span class="list-name">{{ $pack->roi_type }} ROI</span>
                   <span class="icon check"><i class="fas fa-check-circle"></i></span>
               </li>
               <button class="btn btn-info blue-bg round-10 invest"  data-toggle="modal" data-target="#investModal" data-id="{{ $pack->id }}">purchase</button>
           </div>
       </div>
    @endforeach
    @endif
   </div>
</div>
<!-- /.container-fluid -->

{{-- Add package Model  --}}
@include('users.packages.modals.invest')
{{-- End Add package Model  --}}
@endsection
