@extends('admin.layouts.default')
@section('page-title')
    Issues
@endsection
@push('style')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@push('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $('.custom-file-input').change(function(e) {
            var filename = $(this).val().split('\\').pop();
            var lastIndex = filename.lastIndexOf("\\");
            var nextSibling = e.target.nextElementSibling
            nextSibling.innerText = filename
        });
        $( function() {
            $('.datepicker').datepicker({
                dateFormat: 'yy-m-d'
            })
        } );
    </script>
@endpush
@section('content')
    <div class="container-fluid">
        {{--    Section Search Area    --}}
        <section class="admin-search-area">
            <div class="admin-search-left">
                <button class="btn btn-info px-3 blue-bg round-10" data-toggle="modal" data-target="#addIssuesModal">Upload Issues</button>
            </div>
            <div class="admin-search-right">
                <div class="admin-section-search-area input-group mb-3">
                    <input type="text" class="">
                    <div class="admin-section-search-btn-area">
                        <button class="btn bg-transparent mr-2" type="button"><i class="fas fa-search mr-2"></i> Search here</button>
                    </div>
                </div>
            </div>
        </section>
        {{--    End Section Search Area    --}}

        {{--    Page Section Title Area    --}}
        <section class="page-section-title-area">
            <div>
                <h2>ISSUES LIST</h2>
                <p>Latest issues and information</p>
            </div>
        </section>
        {{--    End Page Section Title Area    --}}

        <section class="collections">
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Issue ID <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Name <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Upload Date <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Year <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col">Status <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                        <th scope="col"> </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($issues as $issue)
                        <tr>
                        <td>{{$issue->id}}</td>
                        <td>{{$issue->title}}</td>
                        <td>{{$issue->publish_date}}</td>
                        <td>{{\Illuminate\Support\Carbon::parse($issue->year)->format('Y')}}</td>
                        <td>{{$issue->status}}</td>
                        <td style="min-width: 256px; text-align: right">
                            <a href="{{route('admin.issues.show', $issue)}}" class="mr-2"><i class='fas fa-eye' style='font-size:20px;color:var(--gray)'></i></a>
                            <a href="#" class="btn btn-info blue-bg round-10 px-5 mr-2" data-target="#editIssuesModal-{{$issue->id}}" data-toggle="modal">Edit</a>
                            <a href="#"><i class='fas fa-trash-alt' style='font-size:20px;color:var(--blue)'></i></a>
                        </td>
                    </tr>
                            @include('admin.issues.modals.edit')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

    </div>
    <!-- /.container-fluid -->

    {{--  Add Issues Model  --}}
        @include('admin.issues.modals.create')
    {{--  End Add Issues Model  --}}
@endsection
