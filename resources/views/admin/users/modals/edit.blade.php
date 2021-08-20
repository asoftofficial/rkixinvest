<div
    class="modal fade"
    id="UserProfileModal"
    tabindex="-1"
    role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-610" role="document">
        <div class="modal-content issue-padd">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="exampleModalLabel mt-0">Update profile</h5>
            </div>
            <div class="modal-body  pt-0">

                <form
                    action="{{route('admin.userprofile.update',$user->id)}}"
                    enctype="multipart/form-data"
                    method="post">
                    @csrf @method('put')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="gap">
                                        <h4 class="input-label mt-2">First name</h4>
                                        <div class="">
                                            <input
                                                type="text"
                                                class="form-control bg-light round-10 border-0"
                                                name="fname"
                                                value="{{old('fname',$user->first_name)}}"></div>
                                            @error('fname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="gap">
                                            <h4 class="input-label mt-2">Last name</h4>
                                            <div class="">
                                                <input
                                                    type="text"
                                                    class="form-control bg-light round-10 border-0"
                                                    name="lname"
                                                    value="{{old('fname',$user->last_name)}}"></div>
                                                @error('lname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="gap">
                                        <h4 class="input-label mt-2">email</h4>
                                        <div class="">
                                            <input
                                                type="email"
                                                class="form-control bg-light round-10 border-0"
                                                name="email"
                                                value="{{old('fname',$user->email)}}"></div>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="gap">
                                            <h4 class="input-label mt-2">Username</h4>
                                            <div class="">
                                                <input
                                                    disabled
                                                    type="text"
                                                    class="form-control bg-light round-10 border-0"
                                                    name="username"
                                                    value="{{$user->username}}"></div>
                                                @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h4 class="input-label mt-2">change image</h4>
                                    <input type="file" name="image" class="form-control bg-light round-10 border-0">
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
            </div>
