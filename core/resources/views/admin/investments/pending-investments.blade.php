@extends('admin.layouts.default')
@section('page-title')
Pending Investments
@endsection
@section('content')
@section('header-right')
    <a href="{{route('admin.active.investments')}}" class="btn btn-primary btn-blue header-right-btn">Active Investments</a>
@endsection
{{-- Page Section Title Area    --}}
<section class = "page-section-title-area" >
    <div>
        <h2>Pending Investments List</h2>
        <p>Latest pending investments information</p>
    </div>
</section>{{-- End Page Section Title Area    --}}
<section class = "collections" >
    <div class="table-responsive">
        <table class="table custom-table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#id</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pending_investments as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->amount}}</td>
                        <td>Pending</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
