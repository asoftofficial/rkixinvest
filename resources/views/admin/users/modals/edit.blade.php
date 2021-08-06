<div class="modal fade" id="edituserModal-{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-610" role="document">
        <div class="modal-content issue-padd">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="exampleModalLabel mt-0">Update user</h5>
            </div>
            <div class="modal-body  pt-0">
                {{-- <form action="{{route('admin.packages.store')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="text" class="input-label mb-0"> Name:</label>
                        <input type="text" name="name" value="{{old('name')}}" required="" class="form-control bg-light border-0 round-10 ">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="gap">
                                        <div class="form-group">
                                            <label for="text" class="input-label">Publication date</label>
                                            <div class="drop-icon">
                                                <input type="text" name="publish_date" value="{{old('publish_date')}}" class="form-control bg-light border-0 round-10 datepicker" autocomplete="off">
                                            </div>
                                            @error('publish_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="gap1">
                                            <label for="text" class="input-label">Release date</label>
                                            <div class="drop-icon">
                                                <input type="text" name="release_date" value="{{old('release_date')}}" class="form-control bg-light border-0 round-10 datepicker" autocomplete="off">
                                            </div>
                                            @error('release_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
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
                                        <h4 class="input-label mt-2">Magazine</h4>
                                        <div class="drop-icon">
                                            <select name="magazine_id" required="" class="form-control bg-light round-10 border-0">
                                                <option value="1" class="sel-v" selected></option>
                                                @foreach($magazines as $mag)
                                                    <option value="{{$mag->id}}" class="sel-v">{{$mag->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('magazine_id')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="gap1">
                                        <h4 class="input-label mt-2">Collection</h4>
                                        <div class="drop-icon">
                                            <select name="collection_id" required="" class="form-control bg-light round-10 border-0">
                                                <option value="" class="sel-v"></option>
                                                @foreach($collections as $collection)
                                                    <option value="{{$collection->id}}" class="sel-v">{{$collection->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('collection_id')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="gap">
                                        <h4 class="input-label">Upload Issue</h4>
                                        <div class="input-group mb-3 ">
                                            <div class="custom-file">
                                                <input type="file" name="file" required=""  class="custom-file-input" accept="application/pdf">
                                                <label class="custom-file-label upload-sec bg-light" for="inputGroupFile02">Browse</label>
                                            </div>
                                            @error('file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="gap1">
                                        <h4 class="input-label">Choose Feature Image</h4>
                                        <div class="input-group mb-3 ">
                                            <div class="custom-file">
                                                <input type="file" name="image" required=""  class="custom-file-input">
                                                <label class="custom-file-label upload-sec bg-light" for="inputGroupFile02">Browse</label>
                                            </div>
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 mt-1 pl-0">SEO OPTIMIZATION</div>
                        <label for="text" class="input-label mb-0">Page Title</label>
                        <input type="text" name="page_title" value="{{old('page_title')}}" required="" class="form-control bg-light border-0 round-10 ">
                        @error('page_title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="text" class="input-label">Description</label>
                        <textarea rows="6" class="form-control bg-light border-0 round-10" name="desc" required="" id="description"> {{old('desc')}}</textarea>
                        @error('desc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="text" class="input-label">Keywords</label>
                                        <textarea rows="4" required="" name="keywords" class="form-control bg-light border-0 round-10" id="description">{{old('keywords')}}</textarea>
                                        @error('keywords')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="gap1">
                                        <h4 class="input-label1 mt-2">Status</h4>
                                        <div class="drop-icon">
                                            <select name="status" required="" class="form-control bg-light round-10 border-0">
                                                <option value="" class="sel-v"></option>
                                                <option value="1" class="sel-v">Live</option>
                                                <option value="0" class="sel-v">Offline</option>
                                            </select>
                                        </div>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-outline-blue px-4 mr-1 px-5" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-blue px-4 px-5">Save</button>
                    </div>
                </form> --}}
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
