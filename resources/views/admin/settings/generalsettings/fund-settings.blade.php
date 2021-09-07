@extends('admin.layouts.default')
@section('page-title')
Settings
@endsection
@section('page-subtitle')
Funds settings
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-toggle/css/bootstrap-toggle.min.css')}}">
@endpush
@push('script')
    <script src="{{asset('assets/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js')}}"></script>
    <script>
        $('#addfund').bootstrapToggle()
        $('#removefund').bootstrapToggle()
        $('#switch').bootstrapToggle()

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
                        @error('removefund')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn text-white btn-blue px-4 px-5 text-center">Update</button>
                </div>
            </form>
        </div>
    </div>
        <div class="card">
        <div class="card-header bg-dark">Fund Transfer</div>
        <div class="card-body">
            <form action="{{route('admin.fund.transfer')}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="addfund">Fund Transfer</label><br>
                        <input type="checkbox" class="switch" name="fund_transfer"  @if($settings->fund_transfer == 'on') checked @endif data-toggle="toggle">
                        @error('fund_transfer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="charges">Transfer Charges</label>
                        <input type="text" name="charges" class="form-control bg-light border-0 round-10" value="{{old('charges',$settings->transfer_charges)}}">
                        @error('charges')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Minimun Transfer</label>
                        <input type="text" name="min_transfer" class="form-control bg-light border-0 round-10" value="{{old('min_transfer',$settings->min_transfer)}}">
                        @error('min_transfer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="charges">Maximum Transfer</label>
                        <input type="text" name="max_transfer" class="form-control bg-light border-0 round-10" value="{{old('max_transfer',$settings->max_transfer)}}">
                        @error('max_transfer')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn text-white btn-blue px-4 px-5 text-center">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <!-- /.container-fluid -->
@endsection
