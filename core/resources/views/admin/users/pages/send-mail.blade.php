<div
    class="modal fade"
    id="userEmailModal-{{$user->id}}"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog   modal-610" role="document">
        <div class="modal-content ">
            <div class="modal-header pb-0">
                <h5 class="modal-title">Send mail</h5>
            </div>
            <div class="modal-body pt-0">
                <form
                    action="{{route('admin.user.email',$user->id)}}"
                    enctype="multipart/form-data"
                    method="post">
                    @csrf
                    <div class="form-group plan-name">
                        <label for="subject" class="input-label">Subject:</label>
                        <input
                            type="text"
                            class="form-control bg-light border-0 round-10"
                            name="subject"
                            required="required"
                            id="subject">
                            @error('Subject')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="body" class="input-label">Body of email</label>
                            <textarea rows="6" class="form-control bg-light border-0 round-10" name="body" required="" id="emaildescription">{{old('body')}}</textarea>
                            @error('body')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <input type="hidden" value="{{$user->email}}" name="hidden_email">

                            <div class="d-flex justify-content-center mt-1 mb-4">
                                <button
                                    type="button"
                                    class="btn btn-outline-dark px-4 mr-1 round-10 px-5"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-dark px-4 round-10 px-5">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
