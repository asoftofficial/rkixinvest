<div class="modal fade" id="addPromotionsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-610" role="document">
        <div class="modal-content issue-padd">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="exampleModalLabel mt-0">Add a Promotion</h5>
            </div>
            <form action="{{route('admin.promotions.store')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="modal-body  pt-0">
                    <div class="form-group">
                        <label for="text" class="input-label1 mb-0">Promotion Name:</label>
                        <input name="name" type="text" class="form-control bg-light border-0 round-10 " />
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="text" class="input-label1 mb-0">Description:</label>
                        <textarea name="desc" rows="6" class="form-control bg-light border-0 round-10 " id="Promotion text"></textarea>
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
                                    <div class="gap">
                                        <label class="input-label1 mt-1">Update logo or icon</label>
                                        <div class="input-group mb-3 ">
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
                                    <div class="gap1">
                                        <label class="input-label1 mt-2">Include on following plans</label>
                                        <div class="drop-icon">
                                            <select name="plan" class="form-control bg-light round-10 border-0" required>
                                                <option value="" class="sel-v" selected disabled>Select Plan</option>
                                                @foreach($plans as $plan)
                                                    <option value="{{$plan->id}}" class="sel-v">{{$plan->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('plan')
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
                                        <label class="input-label1 mb-0 mt-2">Discount Type</label>
                                        <div class="drop-icon">
                                            <select name="type" class="form-control bg-light round-10 border-0">
                                                <option value="" class="sel-v"></option>
                                                <option value="per" class="sel-v">Percentage</option>
                                                <option value="flat" class="sel-v">Flat</option>
                                            </select>
                                        </div>
                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="gap1">
                                        <div class="form-group">
                                            <label for="text" class="input-label1 mb-0">Discount Value</label>
                                            <input type="text" name="discount" class="form-control bg-light border-0 round-10" />
                                            @error('discount')
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
                                        <div class="form-group">
                                            <label for="text" class="input-label1">Voucher code(leave blank if auto generated)</label>
                                            <input type="text" class="form-control bg-light border-0 round-10" name="code" />
                                            @error('code')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="gap1">
                                        <label class="input-label1 mt-2">Number of codes to generate</label>
                                        <div class="drop-icon">
                                            <select name="number_of_codes" class="form-control bg-light round-10 border-0" required>
                                                <option value="1" class="sel-v" selected>1</option>
                                                @for ($i = 2; $i <= 100; $i++)
                                                    <option value="{{$i}}" class="sel-v">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        @error('number_of_codes')
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
                                        <div class="form-group">
                                            <label for="text" class="input-label1">Start date</label>
                                            <div class="drop-icon">
                                                <input type="text" class="form-control bg-light border-0 round-10 datepicker" autocomplete="off" required="" name="start_date">
                                            </div>
                                            @error('start_date')
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
                                            <label for="text" class="input-label1">Expiry date</label>
                                            <div class="drop-icon">
                                                <input type="text" class="form-control bg-light border-0 round-10 datepicker" autocomplete="off" required="" name="end_date">
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
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="gap">
                                        <div class="form-group">
                                            <label for="text" class="input-label1">Usage limit per user (-1 for unlimited)</label>
                                            <input type="text" name="limt_per_user" class="form-control bg-light border-0 round-10" />
                                            @error('limt_per_user')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="gap1">
                                        <div class="form-group">
                                            <label for="text" class="input-label1">Usage limit per coupon (-1 for unlimited)</label>
                                            <input type="text" name="limit_per_coupon" class="form-control bg-light border-0 round-10" />
                                            @error('limit_per_coupon')
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

                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-outline-yellow px-4 mr-1 px-5" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-yellow px-4 px-5">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
