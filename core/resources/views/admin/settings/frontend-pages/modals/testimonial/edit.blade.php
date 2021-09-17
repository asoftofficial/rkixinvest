<div class="modal fade" id="editTestimonialModal-{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-610" role="document">
        <div class="modal-content issue-padd">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="exampleModalLabel mt-0">Edit testimonial</h5>
            </div>
            <div class="modal-body  pt-0">
                <form action="{{route('admin.testimonial.update', $item->id)}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-1 pt-3">
                        <div class="col-md-6">
                            <label class="input-label mb-0">username</label>
                            <input type="text" name="username" value="{{old('username',$item->username)}}"
                                   class="form-control bg-light border-0 round-10 ">
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="input-label mb-0">Designation</label>
                            <input type="text" name="designation" value="{{old('designation',$item->designation)}}"
                                   class="form-control bg-light border-0 round-10 ">
                            @error('designation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-1 pt-3">
                        <div class="col-md-12">
                            <label class="input-label">Testimonial image</label>
                            <input type="file" name="image" class="form-control bg-light border-0 round-10">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-1 pt-3">
                        <div class="col-md-12">
                            <label class="input-label">Testimonial content</label>
                            <textarea rows="6" name="description"
                                      class="form-control bg-light border-0 round-10">{{old('description',$item->content)}}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-blue px-4 px-5 mt-3">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
