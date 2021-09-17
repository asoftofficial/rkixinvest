<div class="modal fade" id="editGateWayModal-{{$pg->id}}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog   modal-610" role="document">
        <div class="modal-content ">
            <div class="modal-header pb-0">
                <h5 class="modal-title">Update Deposit Gateway</h5>
            </div>
            <div class="modal-body pt-0">
                <form action="{{route('admin.deposit.geteways.update', $pg)}}" enctype="multipart/form-data"
                      method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="gap">
                                        <h4 class="input-label mt-2">Name</h4>
                                        <div class="">
                                            <input type="text" class="form-control bg-light round-10 border-0"
                                                   name="name" value="{{old('name', $pg->name)}}"></div>
                                        @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="gap">
                                        <h4 class="input-label mt-2">Image</h4>
                                        <div class="">
                                            <input type="file" class="form-control bg-light round-10 border-0"
                                                   name="image" value="{{old('lname')}}"></div>
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
                                        <h4 class="input-label mt-2">Minimum Deposit Amount</h4>
                                        <div class="">
                                            <input type="text" class="form-control bg-light round-10 border-0 mb-2"
                                                   name="min_ammount" value="{{old('min_ammount',$pg->min_ammount)}}">
                                        </div>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="gap">
                                        <h4 class="input-label mt-2">Maximum Deposit Amount</h4>

                                        <input type="text" class="form-control bg-light round-10 border-0 mb-2"
                                               name="max_ammount" value="{{old('max_ammount',$pg->max_ammount)}}">
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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="gap">
                                        <h4 class="input-label mt-2">Charge</h4>
                                        <div class="">
                                            <input type="text" class="form-control bg-light round-10 border-0 mb-4"
                                                   name="charge" value="{{ old('charge', $pg->charge) }}"></div>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="gap">
                                        <h4 class="input-label mt-2">Charge Tpe</h4>
                                        <div class="">
                                            <select name="charge_type" required=""
                                                    class="form-control bg-light round-10 border-0 mb-2">
                                                <option value=""></option>
                                                <option value="1" {{ $pg->charge_type==1?"selected":'' }} >Fix Amount
                                                </option>
                                                <option value="2" {{ $pg->charge_type==2?"selected":'' }} >Percentage
                                                </option>

                                            </select>
                                        </div>
                                        @error('password_confirmation')
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
                        @foreach(json_decode($pg->parameters) as $key => $value)
                            <div class="col-md-6">
                                <div class="gap">
                                    <h4 class="input-label mt-2"> {{strtoupper(str_replace('_',' ',$key))}}</h4>
                                    <input type="text" class="form-control bg-light round-10 border-0 mb-2" name="{{$key}}" required value="{{$value}}">
                                </div>
                            </div>
                        @endforeach
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
