

<div class="modal fade" id="generalsettings" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-610" role="document">
        <div class="modal-content issue-padd">
            <div class="modal-header pb-0">
                <h5 class="modal-title text-left" id="exampleModalLabel mt-0">General Settings</h5>
            </div>
            <div class="modal-body  pt-0">
                <form action="{{route('general.settings')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="text" class="input-label mb-0">website Name:</label>
                        <input type="text" name="web_title" value="{{old('name',$settings->web_title)}}"  class="form-control bg-light border-0 round-10 ">
                        @error('web_title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="text" class="input-label">Website Description</label>
                        <textarea rows="6" class="form-control bg-light border-0 round-10" name="description" id="description"> {{old('description',$settings->description)}}</textarea>
                        @error('description')
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
