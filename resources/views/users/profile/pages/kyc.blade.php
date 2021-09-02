@extends('admin.layouts.default')
@section('page-title')
    User KYC
@endsection
@section('page-subtitle')
    Kyc
@endsection
@section('header-right')
    <a href="{{ route('user.show.profile') }}" class="btn btn-primary btn-blue header-right-btn">Back</a>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card main-card">
                        <div class="card-body">
                            <div class="payment-method-item">
                                <div class="payment-method-header" id="kyc-image">
                                    <div class="thumb">
                                        <div class="avatar-preview ">
                                            <div class="profilePicPreview" style="background-image: url({{getImage('/',imagePath()['withdraw']['method']['size'])}})"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
        <div class="card-header bg-dark">Fund System Settings</div>
        <div class="card-body">
            <form action="{{route('user.store.kyc')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="icon" class="input-label mb-0">KYC</label>
                <input type="file" name="kyc" value=""
                    class="form-control bg-light border-0 round-10 ">
                @error('kyc')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>

            </div>
            <div class="d-flex justify-content-center">

                <button type="submit" class="btn btn-primary btn-blue px-4 px-5">Update</button>
            </div>
        </form>
        </div>
    </div>
                </div><!-- card end -->
            </div>
        </div>





    </div>
    <!-- /.container-fluid -->
@endsection
