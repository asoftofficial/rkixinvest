<div
    class="modal fade"
    id="addRewardModal"
    tabindex="-1"
    role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-610" role="document">
        <div class="modal-content issue-padd">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="exampleModalLabel mt-0">Create reward</h5>
            </div>
            <div class="modal-body  pt-0">
                <form
                    action="{{route('admin.reward.store')}}"
                    enctype="multipart/form-data"
                    method="post">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="gap">
                                        <h4 class="input-label mt-2">reward title</h4>
                                        <div class="">
                                            <input
                                                type="text"
                                                class="form-control bg-light round-10 border-0 mb-4"
                                                name="title" value="{{old('title')}}"></div>
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
                                            <select
                                                name="status"
                                                required=""
                                                class="form-control bg-light round-10 border-0 mb-4">
                                                <option value="enabled" class="sel-v">enabled</option>
                                                <option value="disabled" class="sel-v">disabled</option>
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
                                                <input
                                                    type="text"
                                                    class="form-control bg-light round-10 border-0 mb-4"
                                                    name="amount" value="{{old('status')}}"></div>
                                                @error('amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="gap">

                                                <h4 class="input-label mt-2">referral </h4>
                                                <div class="">
                                                    <input
                                                        type="text"
                                                        class="form-control bg-light round-10 border-0 mb-4"
                                                        name="referral" value="{{old('referral')}}"></div>
                                                    @error('referral ')
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
                                        <textarea
                                            rows="6"
                                            class="form-control bg-light border-0 round-10"
                                            name="description"
                                            required=""
                                            id="description">
                                            {{old('desc')}}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button
                                            type="button"
                                            class="btn btn-outline-blue px-4 mr-1 px-5"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary btn-blue px-4 px-5">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
