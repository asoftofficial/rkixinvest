
@extends('admin.layouts.default')
@section('page-title')
settings
@endsection
@push('style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush

@push('script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endpush
@include('admin.settings.generalsettings.modals.webSettings')
<button type="button" class="btn btn-white text-dark" data-toggle="modal" data-target="#generalsettings" >
clik me
</button>


