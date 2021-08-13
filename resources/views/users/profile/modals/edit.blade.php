<div
    class="modal fade"
    id="edituserModal-{{$item->id}}"
    tabindex="-1"
    role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-610" role="document">
        <div class="modal-content issue-padd">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="exampleModalLabel mt-0">Update user</h5>
            </div>
            <div class="modal-body  pt-0">

                <form
                    action="{{route('admin.userprofile.update',$item->id)}}"
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
                                                value="{{$item->first_name}}"></div>
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
                                                    value="{{$item->last_name}}"></div>
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
                                                <h4 class="input-label mt-2">Email</h4>
                                                <div class="">
                                                    <input
                                                        type="email"
                                                        class="form-control bg-light round-10 border-0 mb-4"
                                                        name="email"
                                                        value="{{$item->email}}"></div>
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="gap">
                                                    <h4 class="input-label mt-2">role</h4>
                                                    <select
                                                        name="role"
                                                        required=""
                                                        class="form-control bg-light round-10 border-0 mb-4">
                                                        <option value="admin" class="sel-v">admin</option>
                                                        <option value="user" class="sel-v">user</option>

                                                    </select>
                                                    @error('role')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
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
