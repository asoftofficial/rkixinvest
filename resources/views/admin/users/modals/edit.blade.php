<div class="modal fade" id="edituserModal-{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-610" role="document">
        <div class="modal-content issue-padd">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="exampleModalLabel mt-0">Update user</h5>
            </div>
            <div class="modal-body  pt-0">

                <form action="{{route('admin.userprofile.update',$item->id)}}" enctype="multipart/form-data"   method="post">
                    @csrf
                    @method('put')
                    <div class="form-group plan-name">
                        <label for="text" class="input-label">First Name:</label>
                        <input type="text" class="form-control bg-light border-0 round-10" name="fname" required="" value="{{old('fname',$item->first_name)}}" id="fname">
                        @error('fname')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group plan-name1">
                        <label for="text" class="input-label">Last Name:</label>
                        <textarea rows="4" class="form-control bg-light border-0 round-10" name="lname" value="{{old('lname',$item->last_name)}}" required="" id="lname"></textarea>
                        @error('lname')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="input-label mt-3">Email address</label>
                                    <input type="text" class="form-control bg-light border-0 round-10" name="email" required="" value="{{old('email',$item->email)}}" id="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="gap">
                                        <label class="input-label1 mt-2">User Role</label>
                                        <div class="drop-icon">
                                            <select name="status" required="" class="form-control bg-light round-10 border-0">
                                                <option value="" class="sel-v"></option>
                                                <option value="Admin" class="sel-v">Admin</option>
                                                <option value="User" class="sel-v" selected>User</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-2 mb-4">
                        <div class="col-md-12">
                            <h4 class="input-label mt-1">Magazines</h4>
                            <div class="d-flex justify-content-start flex-wrap" style="max-width:400px">
                                <div class="form-check mr-3">
                                    <input class="form-check-input" type="checkbox" value="" id="autocar" name="magazin">
                                    <label class="form-check-label text-gray" for="autocar">
                                        Autocar
                                    </label>
                                </div>
                                <div class="form-check mr-3">
                                    <input class="form-check-input" type="checkbox" value="" id="what-car">
                                    <label class="form-check-label text-gray" for="what-car">
                                        What Car
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-1 mb-4">
                        <button type="button" class="btn btn-outline-dark px-4 mr-1 round-10 px-5" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-dark px-4 round-10 px-5">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
