@extends('users.layouts.default')
@section('page-title')
Transactions
@endsection
@push('script')
<script src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js" > </script>
@endpush
@section('content')
<div class = "container-fluid" >
{{-- Page Section Title Area    --}}
    <section class = "page-section-title-area">
        <div>
            <h2>Transaction History</h2>
            <p>Latest tranactions information</p>
        </div>
    </section>{{-- End Page Section Title Area    --}}
<section class = "collections" >
    <div class="table-responsive">
        <table class="table custom-table table-responsive-md">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#id
                    </th>
                    <th scope="col">type
                    </th>
                    <th scope="col">Amount
                    </th>
                    <th scope="col">description
                    </th>

                    {{-- <th scope="col"></th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $item)
                <tr class="bg-light">
                    <td>{{$item->id}}</td>
                    <td class="{{$item->type==1 ? 'text-success' : 'text-danger'}}">{{$item->type==1 ? 'Credit' : 'Debit'}}</td>
                    <td>{{$item->amount}}</td>
                    <td>{{$item->description}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $transactions->render('admin.custom-paginator') !!}
    </div>
</section>
</div>
<!-- /.container-fluid -->
@endsection
