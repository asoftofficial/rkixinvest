@extends('admin.layouts.default')
@section('page-title')
Settings
@endsection
@section('page-subtitle')
General Settings
@endsection
@push('style')
<link href="{{asset('backend/assets/dist/css/bootstrap.min.css')}}" rel="stylesheet">
<style>
    * {
        box-shadow: none;
    }

    .main {
        font-family: 'Poppins', sans-serif;
    }



    .referral-button {
        display: flex;
        margin-top: 30px;
        padding: 8px 16px;
        width: 16rem;
        border-radius: 10px;
        margin-bottom: 30px;
        /* box-shadow: -8px -8px 15px rgba(255,255,255,.7),
                10px 10px 10px rgba(0,0,0, .3),
                inset 8px 8px 15px rgba(255,255,255,.7),
                inset 10px 10px 10px rgba(0,0,0, .3); */
        justify-content: space-between;
        align-items: center;
    }

    .referral-label {
        width: 150px;
    }

    .referral-label i {
        margin-right: 5px;
    }

    .referral-toggle {
        height: 40px;
    }

    .referral-toggle input[type="checkbox"] {
        position: absolute;
        opacity: 0;
        z-index: -2;
    }

    .referral-toggle input[type="checkbox"]+label {
        position: relative;
        /* top: 0px; */
        right: 7.2rem;
        display: inline-block;
        width: 92px;
        height: 35px;
        border-radius: 20px;
        margin: 0;
        cursor: pointer;
        box-shadow: inset -8px -8px 15px rgb(255 255 255 / 60%), inset 10px 10px 10px rgb(0 0 0 / 25%);
    }

    .referral-toggle input[type="checkbox"]+label::before {
        position: absolute;
        content: 'OFF';
        font-size: 10px;
        text-align: center;
        line-height: 25px;
        top: 2px;
        left: 2px;
        width: 37px;
        height: 30px;
        border-radius: 20px;
        background-color: #d1dad3;
        box-shadow: -3px -3px 5px rgb(255 255 255 / 50%), 3px 3px 5px rgb(0 0 0 / 25%);
        transition: .3s ease-in-out;
        padding: 3px 7px;
    }

    .referral-toggle input[type="checkbox"]:checked+label::before {
        left: 59%;
        content: 'ON';
        color: #fff;
        background-color: #00b33c;
        box-shadow: -3px -3px 5px rgba(255, 255, 255, .5),
            3px 3px 5px #00b33c;
            padding: 3px;
    }

    label#refreltext {
        position: absolute;
        top: 5px;
        font-size: 17px;
    }

    h4#refrel_level {
        margin-top: -74px !important;
    }

    div#refrel_div {
        margin: reght;
        margin-right: 18rem;
    }

    * {
        box-shadow: none;
    }


    .main {
        font-family: 'Poppins', sans-serif;
    }



    .reward-button {
        display: flex;
        margin-top: 30px;
        padding: 8px 16px;
        width: 16rem;
        border-radius: 10px;
        margin-bottom: 30px;
        /* box-shadow: -8px -8px 15px rgb(255 255 255 / 70%), 10px 10px 10px rgb(0 0 0 / 30%), inset 8px 8px 15px rgb(255 255 255 / 70%), inset 10px 10px 10px rgb(0 0 0 / 30%); */
        justify-content: space-between;
        align-items: center;
    }

    .reward-label {
        width: 150px;
    }

    .reward-label i {
        margin-right: 5px;
    }

    .reward-toggle {
        height: 40px;
    }

    .reward-toggle input[type="checkbox"] {
        position: absolute;
        opacity: 0;
        z-index: -2;
    }

    .reward-toggle input[type="checkbox"]+label {
        position: relative;
        right: 7rem;
        display: inline-block;
        width: 92px;
        height: 35px;
        border-radius: 20px;
        margin: 0;
        cursor: pointer;
        box-shadow: inset -8px -8px 15px rgb(255 255 255 / 60%), inset 10px 10px 10px rgb(0 0 0 / 25%);
    }

    .reward-toggle input[type="checkbox"]+label::before {
        position: absolute;
        content: 'OFF';
        font-size: 10px;
        text-align: center;
        line-height: 25px;
        top: 2px;
        left: 2px;
        width: 37px;
        height: 30px;
        border-radius: 20px;
        background-color: #d1dad3;
        box-shadow: -3px -3px 5px rgb(255 255 255 / 50%), 3px 3px 5px rgb(0 0 0 / 25%);
        transition: .3s ease-in-out;
        padding: 3px 7px;
    }

    .reward-toggle input[type="checkbox"]:checked+label::before {
        left: 59%;
        content: 'ON';
        color: #fff;
        background-color: #00b33c;
        box-shadow: -3px -3px 5px rgba(255, 255, 255, .5),
            3px 3px 5px #00b33c;
            padding: 3px;
    }

    .main {
        font-family: 'Poppins', sans-serif;
    }



    .confirmation-button {
        display: flex;
        margin-top: 30px;
        padding: 8px 16px;
        width: 16rem;
        border-radius: 10px;
        margin-bottom: 30px;
        /* box-shadow: -8px -8px 15px rgb(255 255 255 / 70%), 10px 10px 10px rgb(0 0 0 / 30%), inset 8px 8px 15px rgb(255 255 255 / 70%), inset 10px 10px 10px rgb(0 0 0 / 30%); */
        justify-content: space-between;
        align-items: center;
    }

    .confirmation_email-label {
        width: 150px;
    }

    .confirmation_email-label i {
        margin-right: 5px;
    }

    .confirmation_email-toggle {
        height: 40px;
    }

    .confirmation_email-toggle input[type="checkbox"] {
        position: absolute;
        opacity: 0;
        z-index: -2;
    }

    .confirmation_email-toggle input[type="checkbox"]+label {
        position: relative;
        right: 8rem;
        display: inline-block;
        width: 92px;
        height: 35px;
        border-radius: 20px;
        margin: 0;
        cursor: pointer;
        box-shadow: inset -8px -8px 15px rgb(255 255 255 / 60%), inset 10px 10px 10px rgb(0 0 0 / 25%);
    }

    .confirmation_email-toggle input[type="checkbox"]+label::before {
        position: absolute;
        content: 'OFF';
        font-size: 10px;
        text-align: center;
        line-height: 25px;
        top: 2px;
        left: 8px;
        width: 37px;
        height: 30px;
        border-radius: 20px;
        background-color: #d1dad3;
        box-shadow: -3px -3px 5px rgb(255 255 255 / 50%), 3px 3px 5px rgb(0 0 0 / 25%);
        transition: .3s ease-in-out;
    }

    .confirmation_email-toggle input[type="checkbox"]:checked+label::before {
        left: 50%;
        content: 'ON';
        color: #fff;
        background-color: #00b33c;
        box-shadow: -3px -3px 5px rgba(255, 255, 255, .5),
            3px 3px 5px #00b33c;
    }

    h4#reward-heading {
        margin-top: -72px !important;
    }

    #reward_div {
        position: relative;
        left: 17rem;
    }
</style>

@endpush

@section('content')
<div class="container-fluid">
    {{-- website settings --}}
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h4 class="border-bottom pb-2 mb-0">Web Settings</h4>
        <form action="{{route('admin.web.settings')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="text" class="input-label mb-0">website Name:</label>
                <input type="text" name="web_title" value="{{old('name',$settings->web_title)}}"
                    class="form-control bg-light border-0 round-10 ">
                @error('web_title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
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
                    <label for="icon" class="input-label mb-0">Website logo</label>
                <input type="file" name="logo" value=""
                    class="form-control bg-light border-0 round-10 ">
                @error('logo')
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
            <div class="d-flex justify-content-center">

                <button type="submit" class="btn btn-primary btn-blue px-4 px-5">Update</button>
            </div>
        </form>
    </div>

{{-- referral system settings --}}
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h4 class="border-bottom pb-2 mb-0">Referral System Settings</h4>
    <div class="d-flex text-muted pt-3">
        <form action="{{route('admin.referral.settings')}}" method="get">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="row" id="refrel_div">
                        <div class="col-md-6">
                            <div class="gap">
                                <div class="main mt-3 justify-content-start">
                                    <div class="referral-button">
                                        <div class="referral-label">
                                        </div>
                                        <label for="bluetooth" id="refreltext" class="input-label">Referral
                                            Level</label>
                                        <h4 class="input-label mt-2" id="refrel_level"></h4>
                                        <div class="referral-toggle">
                                            @if($settings->refrel_system == 'on')
                                            <input type="checkbox" id="bluetooth" name="refrel_system" checked>
                                            <label for="bluetooth"></label>
                                            @else
                                            <input type="checkbox" id="bluetooth" name="refrel_system">
                                            <label for="bluetooth"></label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div>

                                </div>
                                @error('refrel_system')
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
                                        name="refrellevel_type"
                                        value="{{old('refrellevel_type',$settings->refrellevel_type)}}">
                                </div>
                                @error('refrellevel_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary btn-blue px-4 px-5 text-center">Update</button>
            </div>
        </form>
    </div>
</div>




    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h4 class="border-bottom pb-2 mb-0">Reward Settings</h4>
        <div class="d-flex text-muted pt-3">
            <form action="{{route('admin.reward.settings')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 justify-content-start">
                                <div class="gap">
                                    @if($settings->reward_system == 'on')
                                    <div class="main mt-3">
                                        <div class="reward-button">

                                            <h4 class="input-label mt-2" id="reward-heading">Reward system</h4>
                                            <div class="reward-toggle">

                                                <input type="checkbox" id="reward" name="reward_system" checked>
                                                <label for="reward"></label>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="main mt-3">
                                        <div class="reward-button">

                                            <h4 class="input-label mt-2" id="reward-heading">reward system</h4>
                                            <div class="reward-toggle">
                                                @if ($settings->reward_system == 'on')
                                                <input type="checkbox" id="reward" name="reward_system" checked>
                                                <label for="reward"></label>
                                                @else
                                                <input type="checkbox" id="reward" name="reward_system">
                                                <label for="reward"></label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center text-center" id="reward_div">
                    <button type="submit" class="btn btn-primary btn-blue px-4 px-5 text-center">Update</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
