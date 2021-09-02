@extends('admin.layouts.default')
@section('page-title')
Settings
@endsection
@section('page-subtitle')
Funds settings
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-toggle.min.css')}}">
@endpush
@push('script')
    <script src="{{asset('js/bootstrap-toggle.min.js')}}"></script>
    <script>
        $('#addfund').bootstrapToggle()
        $('#removefund').bootstrapToggle()
    </script>
@endpush

@section('content')
<div class="container-fluid">
{{-- fund system settings --}}
<div class="card">
    <div class="card-header bg-dark">Fund System Settings</div>
    <div class="card-body">
        <form action="{{route('admin.post.fund.settings')}}" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="addfund">Add Fund</label>
                    <input type="checkbox" id="addfund" name="addfund"  @if($settings->add_fund == 'on') checked @endif data-toggle="toggle">
                    @error('addfund')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="removefund">Remove Fund</label>
                    <input type="checkbox" id="removefund" name="removefund" @if($settings->remove_fund == 'on') checked @endif data-toggle="toggle">
                    @error('addfund')
                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn text-white btn-blue px-4 px-5 text-center">Update</button>
        </form>
    </div>
</div>
    <!-- /.container-fluid -->
@endsection
