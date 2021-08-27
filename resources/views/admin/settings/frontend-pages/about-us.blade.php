@extends('admin.layouts.default')
@section('page-title')
Settings
@endsection
@section('page-subtitle')
About us
@endsection
@section('content')
<div class="container-fluid">
    {{-- About Us Page --}}
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h4 class="border-bottom pb-2 mb-0">about us</h4>
        <form action="{{route('admin.aboutus.update.settings')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mb-1 pt-3">
                <div class="col-md-6">
                    <label class="input-label mb-0">section title</label>
                <input type="text" name="title" value="{{old('title',$aboutus->section_title)}}"
                    class="form-control bg-white border-0 round-10 ">
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
                <div class="col-md-6">
                    <label class="input-label mb-0">section headding</label>
                <input type="text" name="heading" value="{{old('heading',$aboutus->section_heading)}}"
                    class="form-control bg-white border-0 round-10 ">
                @error('heading')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
            </div>

             <div class="row mb-1 pt-3">
                <div class="col-md-6">
                    <label class="input-label mb-0">Button text</label>
                <input type="text" name="button_text" value="{{old('title',$aboutus->button_text)}}"
                    class="form-control bg-white border-0 round-10 ">
                @error('button_text')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
                <div class="col-md-6">
                    <label class="input-label mb-0">link</label>
                <input type="url" name="link" value="{{old('heading',$aboutus->link)}}"
                    class="form-control bg-white border-0 round-10 ">
                @error('link')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
            </div>

             <div class="row mb-1 pt-3">
                <div class="col-md-12">
                    <label class="input-label mb-0">section image</label>
                <input type="file" name="image"
                    class="form-control bg-white border-0 round-10">
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
            </div>

            <div class="row mb-1 pt-3">
                <div class="col-md-12">
                    <label class="input-label">section content</label>
                    <textarea rows="6" name="description" class="form-control bg-white border-0 round-10">{{old('description',$aboutus->section_description)}}</textarea>
                    @error('description')
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
