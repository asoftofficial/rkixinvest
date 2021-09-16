@extends('admin.layouts.default')
@section('page-title')
Reward
@endsection
@push('style')

@endpush
@push('script')
<script src = "{{asset('assets/plugins/sweet-alert/js/swal.min.js')}}" > </script>
<script > $(
    '.custom-file-input'
).change(function (e) {
    var filename = $(this)
        .val()
        .split('\\')
        .pop();
    var lastIndex = filename.lastIndexOf("\\");
    var nextSibling = e.target.nextElementSibling
    nextSibling.innerText = filename
});

$(".delete").click(function (e) {
    swal(
        {title: "Are you sure ?", text: "Once Deleted it can not be reverted", icon: "warning", buttons: true, dangerMode: true}
    ).then((willDelete) => {
        if (willDelete) {
            var reward_id = $(this).attr('data-id');
            var url = "{{route('admin.reward.destroy', 'id')}}";
            url = url.replace('id', reward_id);
            $("#delete-form").attr('action', url);
            $("#delete-form").submit();
        }
    });
});
</script>
@endpush
@section('content')
<div class = "container-fluid" >
    {{-- Section Search Area    --}}
    <section class = "admin-search-area" >
        <div class="admin-search-left">
    <button
        class="btn btn-info px-3 blue-bg round-10"
        data-toggle="modal"
        data-target="#addRewardModal">Create reward</button>
</div>
<div class="admin-search-right">
    <div class="admin-section-search-area input-group mb-3">
        <input type="text" class="">
            <div class="admin-section-search-btn-area">
                <button class="btn bg-transparent mr-2" type="button">
                    <i class="fas fa-search mr-2"></i>
                    Search here</button>
            </div>
        </div>
    </div>
</section>{{-- End Section Search Area    --}}

{{-- Page Section Title Area    --}}
<section class = "page-section-title-area" > <div>
    <h2>Reward List</h2>
    <p>Latest reward information</p>
</div>
</section>{{-- End Page Section Title Area    --}}
<section class = "collections" >
    <div class="table-responsive">
        <table class="table custom-table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#id
                    </th>
                    <th scope="col">Title
                    </th>
                    <th scope="col">Amount
                    </th>
                    <th scope="col">referral
                    </th>
                    <th scope="col">Status
                    </th>
                    <th scope="col">description
                    </th>

                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($reward as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->amount}}</td>
                    <td>{{$item->refrel}}</td>
                    <td>{{$item->status}}</td>
                    <td>{{$item->description}}</td>

                    <td style="min-width: 256px; text-align: right">
                        <a href="#" class="mr-2">
                            <i class='fas fa-eye' style='font-size:20px;color:var(--gray)'></i>
                        </a>
                        <a
                            href="#"
                            class="btn btn-info blue-bg round-10 px-5 mr-2"
                            data-target="#editRewardModal-{{$item->id}}"
                            data-toggle="modal">Edit</a>
                        <a href="#" class="delete btn btn-dark" data-id="{{$item->id}}">
                            <i class='fas fa-trash-alt' style='font-size:20px;color:white;'></i>
                        </a>
                    </td>
                </tr>
                @include('admin.reward.modals.edit') @endforeach
            </tbody>
        </table>
    </div>
</section>

</div>
<!-- /.container-fluid -->

{{-- Add package Model  --}}
@include('admin.reward.modals.create')
{{-- End Add package Model  --}}
<form action = "" method = "post" id = "delete-form" >
    @csrf
    @method('delete')
</form>


@endsection
