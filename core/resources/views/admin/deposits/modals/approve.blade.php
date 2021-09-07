<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-610" role="document">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="exampleModalLabel mt-0">Approve Deposit</h5>
            </div>
            <div class="modal-body  pt-0">
                <form action="{{route('admin.deposit.approve')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="" class="withdraw-id">
                    <div class="form-group">
                        <label for="text" class="input-label">Description</label>
                        <textarea rows="6" class="form-control bg-light border-0 round-10" name="description" required="" id="description">{{old('description')}}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-outline-blue px-4 mr-1 px-5" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-blue px-4 px-5">Approve</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        $( "#approveModal" ).on('shown.bs.modal', function(e){
            let withdrawId = $(e.relatedTarget).attr('data-id');
            $('.withdraw-id').val(withdrawId)
        });
    </script>
@endpush

