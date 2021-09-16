@extends('admin.layouts.default')
@section('page-title')
Settings
@endsection
@section('page-subtitle')
General Settings
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-toggle/css/bootstrap-toggle.min.css')}}">
@endpush
@push('script')
    <script src="{{asset('assets/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js')}}"></script>
    <script>
        $('.switch-button').bootstrapToggle()
    </script>
@endpush
@section('content')
<div class="container-fluid">
    {{-- website settings --}}
        <div class="card">
        <div class="card-header bg-dark">Website Settings</div>
        <div class="card-body">
            <form action="{{route('admin.web.settings')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="icon" class="input-label mb-0">Website Name:</label>
                <input type="text" name="web_title" value="{{old('name',$settings->web_title)}}"
                    class="form-control bg-light border-0 round-10 ">
                @error('web_title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="icon" class="input-label mb-0">Website Dark Logo:</label>
                <input type="file" name="dlogo" value="{{old('dlogo',$settings->dlogo)}}"
                    class="form-control bg-light border-0 round-10 ">
                @error('dlogo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>

                <div class="col-md-6">
                    <label for="icon" class="input-label mb-0">Website Light Logo</label>
                <input type="file" name="llogo" value="{{old('llogo',$settings->llogo)}}"
                    class="form-control bg-light border-0 round-10 ">
                @error('llogo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="icon" class="input-label mb-0">Favicon icon</label>
                <input type="file" name="favicon" value=""
                    class="form-control bg-light border-0 round-10 ">
                @error('favicon')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>

                <div class="col-md-6">
                    <label for="icon" class="input-label mb-0">Login & Register page Background</label>
                     <input type="file" name="form_image" value="" class="form-control bg-light border-0 round-10 ">
                    @error('form_image')
                        <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="text" class="input-label">Website Description</label>
                <textarea rows="6" class="form-control bg-light border-0 round-10" name="description"
                    id="description"> {{old('description',$settings->description)}}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="text" class="input-label">Footer Description</label>
                <textarea rows="6" class="form-control bg-light border-0 round-10" name="footer"
                    id="description"> {{old('description',$settings->footer)}}</textarea>
                @error('footer')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="d-flex justify-content-center">

                <button type="submit" class="btn btn-primary btn-blue px-4 px-5">Update</button>
            </div>
        </form>
        </div>
    </div>

    {{-- referral system settings --}}
    <div class="card">
        <div class="card-header bg-dark">Referral System Settings</div>
        <div class="card-body">
            <form action="{{route('admin.referral.settings')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="gap">
                            <h4 class="input-label mt-2">Referral System</h4>
                            <div class="">
                                <input type="checkbox" class="form-control bg-light round-10 border-0 switch-button"
                                     name="ref_system"
                                    @if($settings->referral_system == 'on') checked @endif>
                            </div>
                            @error('ref_system')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="gap">
                            <h4 class="input-label mt-2">Referral level</h4>
                            <div class="">
                                <input type="text" class="form-control bg-light round-10 border-0"
                                    name="ref_level"
                                    value="{{old('ref_level',$settings->referral_levels)}}">
                            </div>
                            @error('ref_level')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <button type="submit" class="btn btn-primary btn-blue px-4 px-5 text-center">Update</button>
                </div>
            </form>
        </div>
    </div>

{{-- Reward settings --}}
    <div class="card">
        <div class="card-header bg-dark">Email Verification Setting</div>
        <div class="card-body">
            <form action="{{route('admin.update.email.settings')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="gap">
                                <h4 class="input-label mt-2">Email Settings</h4>
                                <div class="">
                                    <input type="checkbox" class="form-control bg-light round-10 border-0 switch-button"
                                        name="email"
                                        @if($settings->email_verification == 'on') checked @endif>
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center text-center" id="reward_div">
                        <button type="submit" class="btn btn-primary btn-blue px-4 px-5 text-center">Update</button>
                    </div>
                </form>
            </div>
        </div>
</div>    <!-- /.container-fluid -->
@endsection
