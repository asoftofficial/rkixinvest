<div class="modal fade" id="addTestimonialrdModal" tabindex="-1" role="dialog"aria-hidden="true">
    <div class="modal-dialog modal-610" role="document">
        <div class="modal-content issue-padd">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="exampleModalLabel mt-0">Add testimonial</h5>
            </div>
            <div class="modal-body  pt-0">
                  <form action="{{route('admin.testimonial.store')}}" method="post">
            @csrf
            {{-- <div class="row mb-1 pt-3">
                <div class="col-md-6">
                    <label class="input-label mb-0">Section title</label>
                <input type="text" name="title" value=""
                    class="form-control bg-light border-0 round-10 ">
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
                <div class="col-md-6">
                    <label class="input-label mb-0">Section heading</label>
                <input type="text" name="heading" value=""
                    class="form-control bg-light border-0 round-10 ">
                @error('step1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
            </div> --}}

             <div class="row mb-1 pt-3">
                <div class="col-md-6">
                    <label class="input-label mb-0">username</label>
                <input type="text" name="username" value=""
                    class="form-control bg-light border-0 round-10 ">
                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
                <div class="col-md-6">
                    <label class="input-label mb-0">Designation</label>
                <input type="text" name="designation" value=""
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
                    <label class="input-label">Testimonial content</label>
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
                    <textarea rows="6" name="description" class="form-control bg-light border-0 round-10"></textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary btn-blue px-4 px-5 mt-3">Create</button>
            </div>
        </form>
            </div>
        </div>
    </div>
</div>
