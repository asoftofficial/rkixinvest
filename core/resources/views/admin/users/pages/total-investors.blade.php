@extends('admin.layouts.default')
@section('page-title')
Total Investors
@endsection
@push('style') <link rel = "stylesheet" href = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" > @endpush
@section('content')
@section('header-right')
    <a href="{{route('admin.show.active.investors')}}" class="btn btn-primary btn-blue header-right-btn">Active Investors</a>
@endsection
{{-- Page Section Title Area    --}}
<section class = "page-section-title-area" >
    <div>
        <h2>Total Investors List</h2>
        <p>Latest Investors Information</p>
    </div>
</section>{{-- End Page Section Title Area    --}}
<section class = "collections" >
    <div class="table-responsive">
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
                @foreach($total_investors as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->amount}}</td>
                        @if ($item->status == 1)
                            <td>Active</td>
                        @else
                        <td>Suspended</td>
                        @endif

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
