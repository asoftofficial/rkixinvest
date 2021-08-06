<div class="modal fade" id="editPlanModal-{{$plan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog   modal-610" role="document">
        <div class="modal-content ">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="exampleModalLabel">Update Plan</h5>
            </div>
            <div class="modal-body pt-0">
                <form action="{{route('admin.plans.update', $plan)}}" enctype="multipart/form-data"   method="post">
                    @csrf
                    @method('put')
                    <div class="form-group plan-name">
                        <label for="text" class="input-label">Plan Name:</label>
                        <input type="text" class="form-control bg-light border-0 round-10" name="name" required="" value="{{old('name', $plan->name)}}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group plan-name1">
                        <label for="text" class="input-label">Description:</label>
                        <textarea rows="4" class="form-control bg-light border-0 round-10" name="description"  required="" id="description">{{old('description', $plan->description)}}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-form">
                            <!-- Monthly price -->
                            <div class="row">
                                <div class="col-md-6">
                                   <h4 class="input-label mt-1">Monthly Price</h4>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text  border-0 round-10 pound-1" id="basic-addon1">£
                                            </span>
                                        </div>
                                        <input type="text" class="form-control bg-light border-0 round-10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="price" required="" value="{{old('price', $plan->price)}}"  aria-label="Username" aria-describedby="basic-addon1">
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 available-radio">
                                    <h4 class="input-label mt-1">Available on Frontend? </h4>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="1" name="front" id="inlineRadio1" {{$plan->front==1?"checked":""}}>
                                        <label class="form-check-label pound" for="inlineRadio1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="0" name="front" id="inlineRadio2" {{$plan->front==0?"checked":""}}>
                                        <label class="form-check-label pound" for="inlineRadio2">No</label>
                                    </div>
                                    @error('front')
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
                            <h4 class="input-label mt-1">Include following magazine brands</h4>
                            <div class="d-flex justify-content-between flex-wrap" style="max-width:400px">
                                <div class="form-check form-check-inline">
                                    <label class="input-container">One
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="input-container">Two
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="input-container">Three
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="input-label mt-3">Status</h4>
                                    <div class="drop-icon">
                                        <select name="status" class="form-control bg-light round-10 border-0">
                                            <option value="" class="sel-v"></option>
                                            <option value="1"  class="sel-v" {{$plan->status==1?"selected":""}} >Live</option>
                                            <option value="0" class="sel-v" {{$plan->status==0?"selected":""}}>Offline</option>
                                        </select>
                                    </div>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <h4 class="input-label mt-3">Stripe ID</h4>
                                    <input type="text" class="form-control bg-light border-0 round-10" name="stripe_id" required="" value="{{old('stripe_id', $plan->stripe_id)}}">

                                    @error('stripe_id')
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
                                <div class="col-md-12">
                                    <h4 class="model-section-heading mt-3">BRAND AREA-PARTNERS</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="text" class="input-label">Partner Name:</label>
                                        <input type="text" name="partner_name" value="{{old('partner_name', $plan->partner_name)}}" class="form-control bg-light border-0 round-10">
                                        @error('partner_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="input-label">Upload file</h4>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="textarea" class="input-label">Text</label>
                                <textarea rows="4" name="text" class="form-control bg-light border-0 round-10" id="description">{{old('text', $plan->text)}}</textarea>
                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-1 mb-4">
                        <button type="button" class="btn btn-outline-orange px-4 mr-1 round-10 px-5" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-orange px-4 round-10 px-5">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
