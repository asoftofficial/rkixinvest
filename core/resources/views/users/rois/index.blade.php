@extends('users.layouts.default')
@section('page-title')
    Dashboard
@endsection
@section('page-subtitle')
    Welcome back,
@endsection
@section('header-right')
    <a href="{{ route('user.investment') }}" class="btn btn-primary btn-blue header-right-btn">@lang('back')</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            {{--    Page Section Title Area    --}}
            <section class="page-section-title-area">
                    <h2>RECENT ROIS</h2>
                    <p>Latest rois details</p>
                <div class="section-title-right"></div>
            </section>
            {{--    End Page Section Title Area    --}}
            <section class="customers">
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">ROIs</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            {{-- <th scope="col">Date</th> --}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($investment->rois as $key => $roi)
                            <tr>
                                <td>
                                    {{++$key}}
                                </td>
                                <td>{{showAmount($roi->amount,2)}}</td>
                                <td>
                                    @if($roi->status==1)
                                        <button class="btn btn-info">Pending !</button>
                                    @else
                                        <button class="btn btn-success">Received</button>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
    <!-- /.row -->
@endsection
