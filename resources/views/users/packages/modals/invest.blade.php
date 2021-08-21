<div
    class="modal fade"
    id="investModal"
    tabindex="-1"
    role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-610" role="document">
        <div class="modal-content issue-padd">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="exampleModalLabel mt-0">Make Investment</h5>
            </div>
            <div class="modal-body  pt-0">
                <form
                    action="{{route('user.invest.post')}}"
                    method="post">
                    @csrf
                    <div class="form-group">
                        <label for="text" class="input-label mb-0">Amount:</label>
                        <input
                            type="text"
                            name="amount"
                            value="{{old('amount')}}"
                            required=""
                            class="form-control bg-light border-0 round-10 amount">
                            @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <input type="hidden" name="packageId" id="packageId" value="">
                        <div class="row">
                                <div class="col-md-12">
                                        <div class="d-flex justify-content-center">
                                            <button
                                                type="button"
                                                class="btn btn-outline-blue px-4 mr-1 px-5"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary btn-blue px-4 px-5">Invest</button>
                                        </div>
                                    </form>
                                </div>
                        </div>
                    </div>
