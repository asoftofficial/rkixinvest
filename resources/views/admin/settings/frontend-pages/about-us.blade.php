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
    <div class="card">
        <div class="card-header bg-dark">
            About Us
        </div>
        <div class="card-body">
            <form action="{{route('admin.aboutus.update.settings')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-1 pt-3">
                        <div class="col-md-6">
                            <label class="input-label mb-0">Section Title</label>
                            <input type="text" name="title" value="{{old('title',$aboutus->section_title)}}"
                                   class="form-control bg-light border-0 round-10 ">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="input-label mb-0">Section Heading</label>
                            <input type="text" name="heading" value="{{old('heading',$aboutus->section_heading)}}"
                                   class="form-control bg-light border-0 round-10 ">
                            @error('heading')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1 pt-3">
                        <div class="col-md-6">
                            <label class="input-label mb-0">Button Text</label>
                            <input type="text" name="button_text" value="{{old('title',$aboutus->button_text)}}"
                                   class="form-control bg-light border-0 round-10 ">
                            @error('button_text')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="input-label mb-0">Link</label>
                            <input type="url" name="link" value="{{old('heading',$aboutus->link)}}"
                                   class="form-control bg-light border-0 round-10 ">
                            @error('link')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1 pt-3">
                        <div class="col-md-12">
                            <label class="input-label mb-0">Section Image</label>
                            <input type="file" name="image"
                                   class="form-control bg-light border-0 round-10">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1 pt-3">
                        <div class="col-md-12">
                            <label class="input-label">Section Content</label>
                            <textarea rows="6" name="description" class="form-control bg-light border-0 round-10">{{old('description',$aboutus->section_description)}}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn text-white btn-blue px-4 px-5 mt-3">Update</button>
                    </div>
                </form>
        </div>
    </div>

</div>  <!-- /.container-fluid -->
@endsection
