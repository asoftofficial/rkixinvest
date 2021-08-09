<div class="modal fade" id="editRewardModal-{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-610" role="document">
        <div class="modal-content issue-padd">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="exampleModalLabel mt-0">Update your Package</h5>
            </div>
            <div class="modal-body  pt-0">

                <form action="{{route('admin.reward.update',$item->id)}}" enctype="multipart/form-data" method="post">
                    @csrf


                    {{-- <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="gap">
                                        <h4 class="input-label mt-2">reward title</h4>
                                        <div class="">
                                            <input type="text" class="form-control bg-light round-10 border-0" name="title" value="{{old('title', $item->title)}}">


                                        </div>
                                        @error('roi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="gap1">
                                        <h4 class="input-label mt-2">status</h4>
                                        <div class="drop-icon">
                                            <select name="status" required="" class="form-control bg-light round-10 border-0" value="{{old('status', $item->status)}}">
                                                <option value="inactive" class="sel-v">inactive</option>
                                                <option value="active" class="sel-v">active</option>


                                            </select>
                                        </div>
                                        @error('roi_type')
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
                                        <h4 class="input-label mt-2">amount</h4>
                                        <div class="">
                                            <input type="text" class="form-control bg-light round-10 border-0" name="amount" value="{{old('amount', $item->amount)}}">
                                        </div>
                                        @error('min-invest')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="gap">
                                        <h4 class="input-label mt-2">Referals</h4>
                                        <div class="">
                                            <input type="text" class="form-control bg-light round-10 border-0" name="refrel" value="{{old('refrel', $item->refrel)}}">
                                        </div>
                                        @error('refrel')
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

                                <div class="col-md-12">
                                    <div class="gap1">
                                        <h4 class="input-label">Choose reward Image</h4>
                                        <div class="input-group mb-3 ">
                                            <div class="custom-file">
                                                <input type="file" name="image" required="" class="custom-file-input" value="{{old('image',$item->image)}}">
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
                        <label for="text" class="input-label">Description</label>
                        <textarea rows="6" class="form-control bg-light border-0 round-10" name="description" required="" id="description"> {{old('description',$item->description)}}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div> --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="gap">
                                        <h4 class="input-label mt-2">reward title</h4>
                                        <div class="">
                                            <input type="text" class="form-control bg-light round-10 border-0 mb-4" name="title" value="{{old('title', $item->title)}}">
                                        </div>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="gap">
                                        <h4 class="input-label mt-2">Status</h4>
                                        <select name="status" required="" class="form-control bg-light round-10 border-0 mb-4">
                                            <option value="activate" class="sel-v">activate</option>
                                            <option value="deactivate" class="sel-v">deactivate</option>

                                        </select>
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



                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="gap">
                                        <h4 class="input-label mt-2">Amount</h4>
                                        <div class="">
                                            <input type="text" class="form-control bg-light round-10 border-0 mb-4" name="amount" value="{{old('amount', $item->amount)}}">
                                        </div>
                                        @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="gap">

                                        <h4 class="input-label mt-2">Referal</h4>
                                        <div class="">
                                            <input type="text" class="form-control bg-light round-10 border-0 mb-4" name="refrel" value="{{old('refrel', $item->refrel)}}">
                                        </div>
                                        @error('refrel')
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

                                <div class="col-md-12">
                                    <div class="gap">
                                        <h4 class="input-label">Choose reward Image</h4>
                                        <div class="input-group mb-3 ">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input">
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
                        <label for="text" class="input-label">Description</label>
                        <textarea rows="6" class="form-control bg-light border-0 round-10" name="description" required="" id="description"> {{old('description',$item->description)}}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-outline-blue px-4 mr-1 px-5" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-blue px-4 px-5">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
