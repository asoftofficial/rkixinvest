@extends('admin.layouts.default')
@section('page-title')
Active Investments
@endsection
@push('style') <link rel = "stylesheet" href = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" > @endpush
@push('script') <script src = "https://code.jquery.com/ui/1.12.1/jquery-ui.js" > </script>
<script src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js" > </script>
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
$(function () {
    $('.datepicker').datepicker({dateFormat: 'yy-m-d'})
});

$(".delete").click(function (e) {
    console.log("asdhsakdash")
    swal(
        {title: "Are you sure ?", text: "Once Deleted it can not be reverted", icon: "warning", buttons: true, dangerMode: true}
    ).then((willDelete) => {
        if (willDelete) {
            var package_id = $(this).attr('data-id');
            var url = "{{route('admin.investment.destroy', 'id')}}";
            url = url.replace('id', package_id);
            $("#delete-form").attr('action', url);
            $("#delete-form").submit();
        }
    });
});
</script>
@endpush
@section('content')
@section('header-right')
    <a href="{{route('admin.pending.investments')}}" class="btn btn-primary btn-blue header-right-btn">Pending Investments</a>
@endsection
{{-- Page Section Title Area    --}}
<section class = "page-section-title-area" > <div>
    <h2>Active Investments List</h2>
    <p>Latest active investments information</p>
</div>
</section>{{-- End Page Section Title Area    --}}
<section class = "collections" > <div class="table-responsive">
        <table class="table custom-table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#id
                    </th>
                    <th scope="col">Amount
                    </th>
                    <th scope="col">Status
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($active_investments as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->amount}}</td>
                    <td>Active</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

</div>
<!-- /.container-fluid -->

{{-- Add package Model  --}}
@include('admin.packages.modals.create')
{{-- End Add package Model  --}}
<form action = "" method = "post" id = "delete-form" > @csrf
@method('delete') </form>
@endsection
