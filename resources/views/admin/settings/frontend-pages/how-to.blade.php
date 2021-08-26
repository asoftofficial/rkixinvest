@extends('admin.layouts.default')
@section('page-title')
Settings
@endsection
@section('page-subtitle')
How To
@endsection
@section('content')
<div class="container-fluid">
    {{-- About Us Page --}}
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h4 class="border-bottom pb-2 mb-0">how to invest</h4>
        <form action="{{route('admin.how.to.settings')}}" method="post">
            @csrf
            <div class="row mb-1 pt-3">
                <div class="col-md-6">
                    <label class="input-label mb-0">Section title</label>
                <input type="text" name="title" value="{{$data->step_title}}"
                    class="form-control bg-white border-0 round-10 ">
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
                <div class="col-md-6">
                    <label class="input-label mb-0">Step 1</label>
                <input type="text" name="step1" value="{{$data->step1}}"
                    class="form-control bg-white border-0 round-10 ">
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
                    class="form-control bg-white border-0 round-10 ">
                @error('step2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
                <div class="col-md-6">
                    <label class="input-label mb-0">Step 3</label>
                <input type="url" name="step3" value="{{$data->step3}}"
                    class="form-control bg-white border-0 round-10 ">
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
                    <textarea rows="6" name="description" class="form-control bg-white border-0 round-10">value="{{$data->step_content}}</textarea>
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
