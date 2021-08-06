<div class="modal fade" id="addIssuesModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-610" role="document">
        <div class="modal-content issue-padd">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="exampleModalLabel mt-0">Create a Package</h5>
            </div>
            <div class="modal-body  pt-0">
                <form action="{{route('admin.packages.store')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="text" class="input-label mb-0">Package Name:</label>
                        <input type="text" name="name" value="{{old('name')}}" required="" class="form-control bg-light border-0 round-10 ">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- <div class="row">
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
                    </div> --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="gap">
                                        <h4 class="input-label mt-2">ROI</h4>
                                        <div class="">
                                            <input type="text" class="form-control bg-light round-10 border-0" name="roi">


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
                                        <h4 class="input-label mt-2">ROI Type</h4>
                                        <div class="drop-icon">
                                            <select name="roi_type" required="" class="form-control bg-light round-10 border-0">
                                                <option value="daily" class="sel-v">daily</option>
                                                <option value="weekly" class="sel-v">weekly</option>
                                                <option value="monthly" class="sel-v">monthly</option>
                                                <option value="yearly" class="sel-v">yearly</option>
                                                {{-- @foreach($collections as $collection)
                                                    <option value="{{$collection->id}}" class="sel-v">{{$collection->name}}</option>
                                                @endforeach --}}
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="gap">
                                        <h4 class="input-label mt-2">Minimum Investment</h4>
                                        <div class="">
                                            <input type="text" class="form-control bg-light round-10 border-0" name="min_invest">
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
                                        <h4 class="input-label mt-2">Maximum Investment</h4>
                                        <div class="">
                                            <input type="text" class="form-control bg-light round-10 border-0" name="max_invest">
                                        </div>
                                        @error('min-invest')
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
                                        <h4 class="input-label">Choose packaeg Image</h4>
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
                        <label for="text" class="input-label">Description</label>
                        <textarea rows="6" class="form-control bg-light border-0 round-10" name="description" required="" id="description"> {{old('desc')}}</textarea>
                        @error('desc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-outline-blue px-4 mr-1 px-5" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-blue px-4 px-5">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
