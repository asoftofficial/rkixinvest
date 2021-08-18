@extends('admin.layouts.default')
@section('page-title')
Settings
@endsection
@section('page-subtitle')
Funds settings
@endsection
@push('style')
<link href="{{asset('backend/assets/dist/css/bootstrap.min.css')}}" rel="stylesheet">
<style>* {
    box-shadow: none;
}

.main {
    font-family: 'Poppins', sans-serif;
}



.fund-button {
    display: flex;
    margin-top: 30px;
    padding: 8px 16px;
    width: 16rem;
    border-radius: 10px;
    margin-bottom: 30px;
    justify-content: space-between;
    align-items: center;
}

.fund-label {
    width: 150px;
}

.fund-label i {
    margin-right: 5px;
}

.fund-toggle {
    height: 40px;
}

.fund-toggle input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    z-index: -2;
}

.fund-toggle input[type="checkbox"]+label {
    position: relative;
    /* top: 0px; */
    right: 9rem;
    display: inline-block;
    width: 92px;
    height: 35px;
    border-radius: 20px;
    margin: 0;
    cursor: pointer;
    box-shadow: inset -8px -8px 15px rgb(255 255 255 / 60%), inset 10px 10px 10px rgb(0 0 0 / 25%);
}

.fund-toggle input[type="checkbox"]+label::before {
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

.fund-toggle input[type="checkbox"]:checked+label::before {
    left: 50%;
    content: 'ON';
    color: #fff;
    background-color: #00b33c;
    box-shadow: -3px -3px 5px rgba(255, 255, 255, .5),
        3px 3px 5px #00b33c;
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

</style>
@endpush

@section('content')
<div class="container-fluid">
{{-- fund system settings --}}
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h4 class="border-bottom pb-2 mb-0">fund System Settings</h4>
    <div class="d-flex text-muted pt-3">
        <form action="{{route('admin.post.fund.settings')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="row" id="refrel_div">
                        <div class="col-md-6">
                            <div class="gap">
                                <div class="main mt-3 justify-content-start">
                                    <div class="fund-button">
                                        <div class="fund-label">
                                        </div>
                                        <label for="bluetooth" id="refreltext" class="input-label">Add fund</label>
                                        <h4 class="input-label mt-2" id="refrel_level"></h4>
                                        <div class="fund-toggle">
                                            @if($settings->add_fund == 'on')
                                            <input type="checkbox" id="addfund" name="addfund" checked>
                                            <label for="addfund"></label>
                                            @else
                                            <input type="checkbox" id="addfund" name="addfund">
                                            <label for="addfund"></label>
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
                                <div class="main mt-3 justify-content-start">
                                    <div class="fund-button">
                                        <div class="fund-label">
                                        </div>
                                        <label for="bluetooth" id="refreltext" class="input-label">fund subtraction</label>
                                        <h4 class="input-label mt-2" id="refrel_level"></h4>
                                        <div class="fund-toggle">
                                            @if($settings->remove_fund == 'on')
                                            <input type="checkbox" id="removefund" name="removefund" checked>
                                            <label for="removefund"></label>
                                            @else
                                            <input type="checkbox" id="removefund" name="removefund">
                                            <label for="removefund"></label>
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
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary btn-blue px-4 px-5 text-center">Update</button>
            </div>
        </form>
    </div>
</div>
    <!-- /.container-fluid -->
@endsection
