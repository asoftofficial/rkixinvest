@extends('admin.layouts.default')
@section('page-title')
Slider
@endsection
@section('page-subtitle')
Create Slider
@endsection
@section('content')
    <div class="container-fluid">
    {{-- Frontend slider --}}
        <div class="card">
            <h5 class="card-header bg-dark">Slider</h5>
            <div class="card-body">
                <form action="{{route('admin.slider.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-1 pt-3">
                        <div class="col-md-6">
                            <label class="input-label mb-0">Button text</label>
                            <input type="text" name="button_text" value="{{old('button_text')}}"
                                   class="form-control bg-light border-0 round-10 ">
                            @error('button_text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="input-label mb-0">link</label>
                            <input type="url" name="link" value="{{old('link')}}"
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
                            <textarea rows="6" name="description" class="form-control bg-light border-0 round-10 nicEdit">{{old('description')}}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-blue px-4 px-5 mt-3">create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  <!-- /.container-fluid -->
@endsection
