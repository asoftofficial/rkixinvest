@extends('layouts.auth-layout')
@push('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
.select2-container--default .select2-selection--single {
    border: none;
    height: 42px;
    border-radius: 8px;
    padding: 8px;
    color: var(--gray);
    background-color: var(--input-bg)
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    top: 10px;
}
.label-required{
    font-size: 20px;
}
</style>
@endpush
@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('#countries').select2();
});
$("#username").on({
  keydown: function(e) {
    if (e.which === 32)
      return false;
  },
  change: function() {
    this.value = this.value.replace(/\s/g, "");
  }
});

</script>
@endpush
@section('page-title')
    Sign Up
@endsection
@section('content')
<section class="register-form py-5">
    <div class="card">
        <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row justify-content-center">
            <div class="form-title text-center ">
                <h2 class="text-dark">Let's get started</h2>
                <p class="text-dark">Follow the steps to quickly create an account</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <label for="fname" class="text-dark">First Name<span class="label-required  text-danger">*</span></label>
                <input id="fname" name="first_name"  value="{{ old('first_name') }}" type="text" class="form-control autocar-input @error('first_name') is-invalid @enderror" placeholder="First name">
                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="lname" class="text-dark">Last Name<span class="label-required  text-danger">*</span></label>
                <input id="lname" name="last_name" value="{{ old('last_name') }}" type="text" class="form-control autocar-input @error('last_name') is-invalid @enderror" placeholder="Last name">
                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="username" class="text-dark">Username<span class="label-required  text-danger">*</span></label>
                <input id="username" name="username" value="{{ old('username') }}" type="text" class="form-control autocar-input @error('username') is-invalid @enderror" placeholder="Username">
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="email" class="text-dark">Email<span class="label-required  text-danger">*</span></label>
                <input id="email" name="email" type="text" class="form-control autocar-input  @error('email') is-invalid @enderror" placeholder="Email"  value="{{ old('email') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="Country" class="text-dark">Country</label>
                <select
                name="country"
                required
                id="countries"
                class="form-control bg-light round-10 border-0 mb-2 "
                style="height:10vh !important;">

                @foreach ($countries as $item)
                <option value="{{$item->name}}">{{$item->name}}</option>
                @endforeach
            </select>
                @error('country')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="email" class="text-dark">Referral<span class="label-required  text-danger">*</span></label>
                <input id="text" name="referral" type="text" class="form-control autocar-input  @error('referral') is-invalid @enderror" placeholder="Referral"  value="{{ old('referral',$sponser->username) }}">
                @error('referral')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <label for="Address" class="text-dark">Address</label>
                <input id="Address" name="address" type="text" class="form-control autocar-input mb-1 @error('address') is-invalid @enderror" placeholder="address">
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="pcode" class="text-dark">Post code<span class="label-required  text-danger">*</span></label>
                <input id="pcode" name="pcode" type="text" class="form-control autocar-input mb-1 @error('pcode') is-invalid @enderror" placeholder="Post code">
                @error('pcode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-1">
                <label for="password" class="text-dark">Password<span class="label-required  text-danger">*</span></label>
                <input id="password" name="password" type="password" class="form-control autocar-input mb-1 @error('email') is-invalid @enderror" placeholder="Password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input required @error('terms') is-invalid @enderror" type="checkbox" id="inlineCheckbox1" name="terms" value="option1">
                    <label class="form-check-label" for="inlineCheckbox1">I have read and agree to the Terms and Conditions and Privacy Policy</label>

                </div>
                <span class="forgot"><a href="{{ route('password.request') }}">Forgot password?</a></span>
                @error('terms')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-block btn-blue text-uppercase">Sign Up</button>
            </div>
        </div>
    </form>
        <div class="form-footer">
            <p class="bg-blue">Already have an account? <a href="{{ route('login') }}" class="bg-blue">Login</a></p>
        </div>
        </div>
    </div>
</section>
@endsection
