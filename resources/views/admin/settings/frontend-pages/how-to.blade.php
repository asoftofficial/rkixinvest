@extends('admin.layouts.default')
@section('page-title')
How Its Work
@endsection
@section('page-subtitle')
How To
@endsection
@section('content')
<div class="container-fluid">
    {{-- About Us Page --}}
    <div class="card">
        <div class="card-header bg-dark">How Its Work</div>
        <div class="card-body">
            <form action="{{route('admin.how.to.update.settings')}}" method="post">
                @csrf
                <div class="row mb-1 pt-3">
                    <div class="col-md-6">
                        <label class="input-label mb-0">Section Title</label>
                        <input type="text" name="title" value="{{$data->step_title}}"
                               class="form-control bg-light border-0 round-10 ">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="input-label mb-0">Step 1</label>
                        <input type="text" name="step1" value="{{$data->step1}}"
                               class="form-control bg-light border-0 round-10 ">
                        @error('step1')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-1 pt-3">
                    <div class="col-md-6">
                        <label class="input-label mb-0">Step 2</label>
                        <input type="text" name="step2" value="{{$data->step2}}"
                               class="form-control bg-light border-0 round-10 ">
                        @error('step2')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="input-label mb-0">Step 3</label>
                        <input type="text" name="step3" value="{{$data->step3}}"
                               class="form-control bg-light border-0 round-10 ">
                        @error('step3')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-1 pt-3">
                    <div class="col-md-12">
                        <label class="input-label">Section content</label>
                        <textarea rows="6" name="description" class="form-control bg-light border-0 round-10">{{$data->step_content}}</textarea>
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
