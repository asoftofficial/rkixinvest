<div class="modal fade" id="editMagazineModal-{{$mag->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog   modal-610" role="document">
        <div class="modal-content ">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="exampleModalLabel">Edit Magazine</h5>
            </div>
            <div class="modal-body pt-0">
                <form action="{{route('admin.magazines.store')}}" enctype="multipart/form-data"   method="post">
                    @csrf
                    <div class="form-group plan-name">
                        <label for="text" class="input-label">Magazine Title:</label>
                        <input type="text" class="form-control bg-light border-0 round-10" name="title" required="" value="{{old('title', $mag->title)}}">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group plan-name1">
                        <label for="text" class="input-label">Description:</label>
                        <textarea rows="4" class="form-control bg-light border-0 round-10" name="description" value="" required="" id="description">{{old('description' ,$mag->description)}}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="input-label mt-3">First published</label>
                                    <input type="text" class="form-control bg-light border-0 round-10 datepicker" autocomplete="off" name="first_published" required="" value="{{old('first_published', $mag->first_published)}}">
                                    @error('first_published')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="input-label mt-3">Country</label>
                                    <select name="country_id" id="country" class="form-control bg-light border-0 round-10">
                                        <option value="" disabled >Country</option>
                                        @foreach($countries as $count)
                                            <option value="{{ $count->id }}" {{old('country_id',$mag->country_id)==$count->id?'selected':''}} >{{ $count->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country')
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

                                <div class="col-md-8">
                                    <label class="input-label">Logo</label>
                                    <div class="input-group mb-3 ">
                                        <div class="custom-file">
                                            <input type="file" name="logo" class="custom-file-input">
                                            <label class="custom-file-label upload-sec bg-light" for="inputGroupFile02">Upload file</label>
                                        </div>
                                        @error('logo')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-1 mb-4">
                        <button type="button" class="btn btn-outline-red px-4 mr-1 round-10 px-5" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-red px-4 round-10 px-5">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
