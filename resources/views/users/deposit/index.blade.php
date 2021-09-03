@extends('users.layouts.default')
@section('page-title')
Deposit
@endsection
@push('style')
@endpush
@push('script')
<script src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js" > </script>
<script>
    $('.ammount').on('change', function(e) {
        
           var ammount = parseInt($(this).val());
           var id = $(this).attr('data-id');
           var charge_ammount = parseFloat($(this).attr('data-charge-ammount'));
           var charge_type = $(this).attr('data-charge-type');
           var total_ammount = 0;
           if(charge_type == 2){
                charge_ammount = (ammount/100) *charge_ammount;
                
           }
           total_ammount = charge_ammount + ammount;
           $("#ammount-"+id).text(ammount);
           $("#charge-"+id).text(charge_ammount);
           $("#total-"+id).text(total_ammount);
    })
    </script>
    
@endpush
@section('content')
<div class = "container-fluid">

{{-- Page Section Title Area    --}}
<section class = "page-section-title-area" > <div>
    <h2>Deposit List</h2>
    <p>All Investment Packages</p>
</div>
</section>
{{-- End Page Section Title Area    --}}
<div class="packages">
    @if(!empty($paymentGateways))
        @foreach($paymentGateways as $pg)
       <div class="table basic">
           <div class="price-section">
               <div class="price-area">
                   <div class="inner-area" style="background-image: url('{{ asset($pg->image) }}'); background-size:cover;">
                       
                   </div>
               </div>
           </div>
           <div class="package-name">
                <span>{{ $pg->title }}</span>
           </div>
           <div class="features">
               <li>
                   <span class="list-name">Min Deposit</span>
                   <span class="icon check">{{ $pg->min_ammount }}</span>
               </li>
               <li>
                   <span class="list-name">Max Deposit </span>
                   <span class="icon check">{{ $pg->max_ammount }}</span>
               </li>
               <li>
                <span class="list-name">Charge </span>
                <span class="icon check">{{ $pg->charge }} {{ $pg->charge_type==2?"%":'' }}</span>
            </li>
               <button class="btn btn-info blue-bg round-10 invest"  data-toggle="modal" data-target="#investModal{{ $pg->id }}" >Invest Now</button>
           </div>
       </div>

    @endforeach
    @endif
   </div>
</div>
<!-- /.container-fluid -->

{{-- Add package Model  --}}
@include('users.deposit.modals.invest')
{{-- End Add package Model  --}}
@endsection
