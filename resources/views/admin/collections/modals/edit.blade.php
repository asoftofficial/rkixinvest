<div class="modal fade" id="editCollectionModal-{{$collection->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog    modal-610" role="document">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="exampleModalLabel">Edit collection</h5>
            </div>
            <div class="modal-body pt-0">
                <form action="{{route('admin.collections.update', $collection)}}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="text" class="input-label">Collection Name:</label>
                        <input type="text" name="name" value="{{$collection->name}}" class="form-control bg-light border-0 round-10" >
                    </div>
                    <div class="form-group">
                        <label for="text" class="input-label">Description:</label>
                        <textarea rows="6" name="description"  class="form-control bg-light border-0 round-10" >{{$collection->description}}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="input-label">Upload Image</h4>
                                    <div class="input-group mb-3 ">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" placeholder="{{$collection->image}}" name="image">
                                            <label class="custom-file-label upload-sec bg-light" for="inputGroupFile02">Browse</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="input-label ">Status</h4>
                                        <div class="drop-icon">
                                            <select name="status" class="form-control bg-light round-10 border-0">
                                                <option value="" class="sel-v"></option>
                                                <option value="1" {{$collection->status==1?'selected':''}} class="sel-v">Live</option>
                                                <option value="0" class="sel-v" {{$collection->status==0?'selected':''}}>Inactive</option>
                                            </select>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3 mb-2">
                        <button type="button" class="btn btn-outline-pink px-4 mr-1 px-5" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-pink px-4 px-5">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
    