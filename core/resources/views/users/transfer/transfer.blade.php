@extends('users.layouts.default')
@section('page-title')
    {{$pageTitle}}
@endsection
@section('page-subtitle')
    Welcome back,
@endsection
@section('header-right')
    <a href="{{route('user.dashboard')}}" class="btn btn-primary btn-blue header-right-btn">Dashboard</a>
@endsection
@push('style')

@endpush
@push('script')
    <script>
        $('#amount').keyup(function (){
            let amount = $(this).val()
            let charge = 2
            let charges = ((charge / 100) * amount).toFixed(2);
            let receivable = amount - charges;
            $('.charges').text(charges)
            $('.receivable').text(receivable)
        });
    </script>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="card main-card">
            <div class="card">
                <div class="card-header bg-dark">{{$pageTitle}}</div>
                <div class="card-body">
                    <form action="{{route('user.transfer.post')}}" method="POST">
                        @csrf
                        <p class="text-base text-danger">Transfer Charges: <span class="text-bold">2.00 %</span></p>
                        <p class="text-blue">Total Charges will be: <span class="text-bold charges">0.00</span> USD, receiver will get <span class="text-bold receivable">0.00</span> USD</p>
                        <div class="form-group">
                            <label>Enter Amount<sup class="text-danger">*</sup></label>
                            <div class="input-group">
                                <input id="amount" type="text" class="form-control" name="amount" placeholder="Amount" required="" value="" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                <span class="input-group-text bg--base">USD</span>
                            </div>
                            @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Transaction Code<sup class="text-danger">*</sup></label>
                            <input id="code" type="password" class="form-control" name="code" placeholder="Code" required="" value="" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                            @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Receiver's Username<sup class="text-danger">*</sup></label>
                            <input id="receiver" type="text" class="form-control" name="receiver" placeholder="Username" required>
                            @error('receiver')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn text-white btn-blue">Transfer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
