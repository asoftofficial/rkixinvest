@extends('admin.layouts.default')
@section('page-title')
Settings
@endsection
@section('page-subtitle')
General info
@endsection
@section('content')
<div class="container-fluid">
    {{-- Contact Info --}}
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h4 class="border-bottom pb-2 mb-0">Contact info</h4>
        <form action="{{route('admin.general.info.update')}}" method="post">
            @csrf
            <div class="row mb-3 pt-3">
                <div class="col-md-6">
                    <label class="input-label mb-0">Contact email</label>
                <input type="email" name="email" value="{{old('email',$settings->email)}}"
                    class="form-control bg-white border-0 round-10 ">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
                <div class="col-md-6">
                    <label class="input-label mb-0">contact no.</label>
                <input type="text" name="phone" value="{{old('phone',$settings->phone)}}"
                    class="form-control bg-white border-0 round-10 ">
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
            </div>
            <div class="row">
                 <div class="col-12">
                    <label class="input-label mb-0">Address</label>
                <input type="text" name="address" value="{{old('address',$settings->address)}}"
                    class="form-control bg-white border-0 round-10 ">
                @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
            </div>
            <div class="d-flex justify-content-center">

                <button type="submit" class="btn btn-primary btn-blue px-4 px-5 mt-3">Update</button>
            </div>
        </form>
    </div>


    {{-- Social links --}}
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h4 class="border-bottom pb-2 mb-0">Social links</h4>
        <form action="{{route('admin.social.links.update')}}" method="post">
            @csrf
            <div class="row mb-1 pt-3">
                <div class="col-md-6">
                    <label class="input-label mb-0">Facebook</label>
                <input type="url" name="facebook" value="{{old('facebook',$sociallinks->facebook)}}"
                    class="form-control bg-white border-0 round-10 ">
                @error('facebook')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
                <div class="col-md-6">
                    <label class="input-label mb-0">Linkedin</label>
                <input type="url" name="linkedin" value="{{old('linkedin',$sociallinks->linkedin)}}"
                    class="form-control bg-white border-0 round-10 ">
                @error('linkedin')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
            </div>

             <div class="row mb-1 pt-3">
                <div class="col-md-6">
                    <label class="input-label mb-0">Pintrest</label>
                <input type="url" name="pintrest" value="{{old('pintrest',$sociallinks->pintrest)}}"
                    class="form-control bg-white border-0 round-10 ">
                @error('pintrest')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
                <div class="col-md-6">
                    <label class="input-label mb-0">Twitter</label>
                <input type="url" name="twitter" value="{{old('twitter',$sociallinks->twitter)}}"
                    class="form-control bg-white border-0 round-10 ">
                @error('twitter')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary btn-blue px-4 px-5 mt-3">Update</button>
            </div>
        </form>
    </div>
</div>  <!-- /.container-fluid -->
@endsection
