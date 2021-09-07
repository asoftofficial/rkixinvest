@extends('users.layouts.default')
@section('page-title')
Transaction Code
@endsection
@section('page-subtitle')
Update Trasnfer Code
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-toggle/css/bootstrap-toggle.min.css')}}">
@endpush

@section('content')
<div class="container-fluid">

<div class="card">
    <div class="card-header bg-dark">Update Transaction Code</div>
        <div class="card-body">
            <form action="{{route('user.transfer.code.update')}}" method="POST">
                    @csrf
                    <div class="row justify-content-center">
                       <div class="col-8">
                           <h4 class="input-label mt-2">old Code</h4>
                           <input type="password" class="form-control bg-light round-10 border-0" name="oldtrx">
                              @error('oldtrx')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                       </div>
                    </div>

                    <div class="row justify-content-center">
                       <div class="col-8">
                           <h4 class="input-label mt-2">New Code</h4>
                           <input
                           type="password"
                           class="form-control bg-light round-10 border-0"
                            name="newtrx">
                              @error('newtrx')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                       </div>
                    </div>

                    <div class="row justify-content-center mb-3">
                       <div class="col-8">
                           <h4 class="input-label mt-2">Confirm Code</h4>
                           <input
                           type="password"
                           class="form-control bg-light round-10 border-0"
                            name="confirm">
                              @error('confirm')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                       </div>
                    </div>
                                <div class="d-flex justify-content-center mt-1 mb-4">
                                    <button
                                        type="button"
                                        class="btn btn-outline-dark px-4 mr-1 round-10 px-5"
                                        data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-dark px-4 round-10 px-5">Update</button>
                                </div>
                            </form>
        </div>
    </div>
</div>
    <!-- /.container-fluid -->
@endsection
