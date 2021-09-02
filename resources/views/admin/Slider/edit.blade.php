@extends('admin.layouts.default')
@section('page-title')
Slider
@endsection
@section('page-subtitle')
Edit Slider
@endsection
@section('content')
    <div class="container-fluid">
    {{-- Frontend slider --}}
        <div class="card">
            <h5 class="card-header bg-dark">Slider</h5>
            <div class="card-body">
                <form action="{{route('admin.slider.update',$slider->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row mb-1 pt-3">
                        <div class="col-md-6">
                            <label class="input-label mb-0">Button text</label>
                            <input type="text" name="button_text" value="{{old('button_text',$slider->button_text)}}"
                                   class="form-control bg-light border-0 round-10 ">
                            @error('button_text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="input-label mb-0">link</label>
                            <input type="url" name="link" value="{{old('link',$slider->link)}}"
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
                            <label class="input-label mb-0">section image</label>
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
                            <label class="input-label">Slider content</label>
                            <textarea rows="6" name="description" class="form-control bg-light border-0 round-10 nicEdit">{{old('description',$slider->slider_content)}}</textarea>
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
        </div>
    </div>
</div>  <!-- /.container-fluid -->
@endsection
