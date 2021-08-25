@extends('admin.layouts.default')
@section('page-title')
Create referral
@endsection
@push('style')
    <style>
        div#refdiv {
            border-bottom: 0 0 0 0.1 gray;
            height: auto;
            padding-bottom: 10px;
            border-bottom: 2px solid gray;
        }
        input#refbonus {
            max-width: 240px;
        }
    </style>
@endpush
@section('content')
<div class = "container-fluid" >
    {{-- create refeeral bonus --}}
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <form action="">
                        <div class="gap">
                            <h4 class="input-label mt-2">Referral level</h4>
                                <div class="d-flex justify-content-between" id="refdiv">
                                <input type="text" class="form-control bg-white round-10 border-0 pb-3" name="refbonus" value="{{old('refbonus')}}" id="refbonus">
                                <input type="submit" value="Create bonus" class="btn btn-blue round-10 border-0 text-white">
                            </div>
                                @error('refbonus')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end referral bonus --}}

    {{-- referal level bonus --}}
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-bold mt-3 mb-3">Referral level bonus</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="gap mt-3">
                        {{-- <h4 class="input-label mt-2">Referral level</h4> --}}
                            <div class="d-flex justify-content-between">
                                <h4 class="input-label">Level 1 bonus</h4>
                                <input type="text" class="form-control bg-white round-10 border-0 pb-3" name="levels" id="refbonus">
                        </div>
                            @error('levels')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
            </div>
                <div class="row">
                <div class="col-md-12">
                    <div class="gap mt-3">
                        {{-- <h4 class="input-label mt-2">Referral level</h4> --}}
                            <div class="d-flex justify-content-between">
                                <h4 class="input-label">Level 2 bonus</h4>
                                <input type="text" class="form-control bg-white round-10 border-0 pb-3" name="levels" id="refbonus">
                        </div>
                            @error('levels')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
            </div>
                <div class="row">
                <div class="col-md-12">
                    <div class="gap mt-3">
                        {{-- <h4 class="input-label mt-2">Referral level</h4> --}}
                            <div class="d-flex justify-content-between">
                                <h4 class="input-label">Level 3 bonus</h4>
                                <input type="text" class="form-control bg-white round-10 border-0 pb-3" name="levels" id="refbonus">
                        </div>
                            @error('levels')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

