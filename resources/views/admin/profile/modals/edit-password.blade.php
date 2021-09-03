<div
    class="modal fade"
    id="editPasswordModal"
    tabindex="-1"
    role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-610" role="document">
        <div class="modal-content issue-padd">
            <div class="modal-header pb-0">
                <h5 class="modal-title text-center" id="exampleModalLabel mt-0">Change Password</h5>
            </div>
            <div class="modal-body  pt-0">

                <form
                    action="{{route('admin.change.password',Auth::user()->id)}}"
                    enctype="multipart/form-data"
                    method="POST">
                    @csrf

                    <div class="row justify-content-center">
                       <div class="col-8">
                           <h4 class="input-label mt-2">old password</h4>
                           <input
                           type="password"
                           class="form-control bg-light round-10 border-0"
                            name="oldpas">
                              @error('oldpas')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                       </div>
                    </div>

                    <div class="row justify-content-center">
                       <div class="col-8">
                           <h4 class="input-label mt-2">New password</h4>
                           <input
                           type="password"
                           class="form-control bg-light round-10 border-0"
                            name="newpas">
                              @error('newpas')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                       </div>
                    </div>

                    <div class="row justify-content-center mb-3">
                       <div class="col-8">
                           <h4 class="input-label mt-2">Confirm password</h4>
                           <input
                           type="password"
                           class="form-control bg-light round-10 border-0"
                            name="password_confirmation">
                              @error('password_confirmation')
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
            </div>
