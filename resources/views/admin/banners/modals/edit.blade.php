<div class="modal fade" id="editBannerModal-{{$banner->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-610" role="document">
        <div class="modal-content banner-modal">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="exampleModalLabel">Update banner</h5>
            </div>
            <div class="modal-body  pt-0">
                <form action="{{route('admin.banners.update', $banner)}}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group plan-name">
                        <label for="text" class="input-label">Name:</label>
                        <input type="text" name="name" class="form-control bg-light border-0 round-10" required="" value="{{old('name', $banner->name)}}">
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
                                        <h4 class="input-label">Type</h4>
                                        <div class="drop-icon">
                                            <select name="type" class="form-control bg-light round-10 border-0" required="">
                                                <option  value="" class="sel-v"></option>
                                                <option value="Skyscraper"  class="sel-v" {{$banner->type=="Skyscraper"?"selected":""}}>Skyscraper</option>
                                                <option value="Standard" class="sel-v" {{$banner->type=="Standard"?"selected":""}}>Standard</option>
                                                <option value="Mobile" class="sel-v" {{$banner->type=="Mobile"?"selected":""}}>Mobile</option>

                                            </select>
                                            @error('type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="gap1">
                                        <h4 class="input-label">Display on plan</h4>
                                        <div class="drop-icon">
                                            <select name="plan_id" class="form-control bg-light round-10 border-0" required="" >
                                                <option value=""></option>
                                                @foreach($plans as $plan)
                                                    <option value="{{$plan->id}}" {{$banner->plan_id==$plan->id?"selected":""}}>{{$plan->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('plan_id')
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
                                        <h4 class="input-label mt-2">Start Date</h4>
                                        <div class="drop-icon">
                                            <input type="text" class="form-control bg-light border-0 round-10 datepicker" autocomplete="off" value="{{old('start_date', $banner->start_date)}}" required="" name="start_date">
                                            @error('start_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="gap1">
                                        <h4 class="input-label mt-2">End Date</h4>
                                        <div class="drop-icon">
                                            <input type="text" class="form-control bg-light border-0 round-10 datepicker" autocomplete="off" value="{{old('end_date', $banner->end_date)}}" required="" name="end_date">
                                            @error('end_date')
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
                                <div class="col-md-6 mt-2 mb-2 banner-upload">
                                    <div class="gap">
                                        <h4 class="input-label">Upload file</h4>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input customFileInput bg-light border-0 round-10" id="" aria-describedby="customFileInput" accept="image/png,  image/jpeg" name="image">
                                                <label class="bg-light border-0 round-10 custom-file-label" for="customFileInput">Select file</label>
                                                @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="gap">
                                        <h4 class="input-label">Display Area</h4>
                                        <div class="form-group">
                                            <div class="drop-icon">
                                            <select name="display_area" class="form-control bg-light round-10 border-0" required="">
                                                <option value=""></option>
                                                <option value="2" {{$banner->display_area==2?"selected":""}}>Main Header</option>
                                                 <option value="1" {{$banner->display_area==1?"selected":""}}>Side Bar</option>
                                            </select>
                                            @error('display_area')
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
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-outline-green px-3 mr-1 round-10 px-5" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-green px-3 round-10 px-5">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
