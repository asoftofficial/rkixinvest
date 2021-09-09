@extends('admin.layouts.default')
@section('page-title')
Active Investors
@endsection
@push('style') <link rel = "stylesheet" href = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" > @endpush
@section('content')
@section('header-right')
    <a href="{{route('admin.show.total.investors')}}" class="btn btn-primary btn-blue header-right-btn">Total investors</a>
@endsection
{{-- Page Section Title Area    --}}
<section class = "page-section-title-area" >
    <div>
        <h2>Active Investments List</h2>
        <p>Latest active investments information</p>
    </div>
</section>{{-- End Page Section Title Area    --}}
<section class = "collections" >
    <div class="table-responsive">
        <table class="table custom-table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#id
                    </th>
                    <th scope="col">Active Investments
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($active_investors as $user)
                        @php
                        if($user->investments->where('status',1)->count()){
                            continue;
                        }
                        @endphp
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->investments()->where('status',1)->count()}} | {{$user->investments->where('status',1)->sum('amount').' '.'USD'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
