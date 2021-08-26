@extends('admin.layouts.default')
@section('page-title')
Settings
@endsection
@section('page-subtitle')
Testimonial
@endsection
@section('content')
<div class="container-fluid">
    {{-- About Us Page --}}
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h4 class="border-bottom pb-2 mb-0">Testimonial</h4>
        <form action="{{route('admin.testimonial.update')}}" method="post">
            @csrf
            <div class="row mb-1 pt-3">
                <div class="col-md-6">
                    <label class="input-label mb-0">Section title</label>
                <input type="text" name="title" value=""
                    class="form-control bg-white border-0 round-10 ">
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
                <div class="col-md-6">
                    <label class="input-label mb-0">Section heading</label>
                <input type="text" name="heading" value=""
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
                    <label class="input-label mb-0">username</label>
                <input type="text" name="username" value=""
                    class="form-control bg-white border-0 round-10 ">
                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
                <div class="col-md-6">
                    <label class="input-label mb-0">Designation</label>
                <input type="text" name="Designation" value=""
                    class="form-control bg-white border-0 round-10 ">
                @error('Designation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
            </div>
            <div class="row mb-1 pt-3">
                <div class="col-md-12">
                    <label class="input-label">Testimonial content</label>
                    <input type="file" name="image" class="form-control bg-white border-0 round-10">
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-1 pt-3">
                <div class="col-md-12">
                    <label class="input-label">Testimonial content</label>
                    <textarea rows="6" name="description" class="form-control bg-white border-0 round-10"></textarea>
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
