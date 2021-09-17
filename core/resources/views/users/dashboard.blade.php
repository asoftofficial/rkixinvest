@extends('users.layouts.default')
@section('page-title')
    Dashboard
@endsection
@section('page-subtitle')
    Welcome back,
@endsection
@push('style')
@endpush
@push('script')
    <script src="{{asset('/assets/dashboard/js/clipboard.min.js')}}"></script>
    <script>
        let clipboard = new ClipboardJS('.copyreflink');
        clipboard.on('success', function (e) {
            toastr.options =
                {
                    "closeButton": true,
                    "progressBar": true
                }
            toastr.success('Your referral link is ' + e.action);
            e.clearSelection();
        });
    </script>
@endpush
@section('header-right')
    <div class="row mt-3">
        <div class="col-12">
            <div class="input-group">
                <input type="text" name="referral_link" class="form-control referral_link"
                       value="{{route('register')}}?sponser={{auth()->user()->username}}" placeholder="Referral link"
                       value="{{old('referral_link')}}"/>
                @error('referral_link')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
                <input type="submit" value="Copy Referral Link" class="btn ml-3 bg-blue copyreflink"
                       data-clipboard-target=".referral_link">
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="dashboard-first-line d-flex justify-content-between flex-wrap">
            <div
                class="dashboard-card upload-issues d-flex align-items-center justify-content-center">
                <a
                    href="{{route('user.deposit')}}"
                    class="dashboard-card-link">
                    Add Funds
                </a>
            </div>
            <div class="dashboard-card page-views">
                <div class="dashboard-card-header">
                    <h2>BALANCE</h2>
                    <p>Total Balance</p>
                </div>
                <div class="dashboard-card-stat">
                    USD {{showAmount(Auth::user()->balance,2)}}
                </div>
            </div>
            <div class="dashboard-card new-orders">
                <a href="#" class=" dashboard-card-dropdown">
                    <i class="fas fa-ellipsis-h"></i>
                </a>
                <div class="dashboard-card-header">
                    <h2>Investment</h2>
                    <p>Total Investments</p>
                </div>
                <div class="dashboard-card-stat">
                    USD {{auth()->user()->investments()->sum('amount')}}
                </div>
            </div>
            <div class="dashboard-card total-earnings bg-dark">
                <a href="#" class="text-white dashboard-card-dropdown">
                    <i class="fas fa-ellipsis-h"></i>
                </a>
                <div class="dashboard-card-header">
                    <h2 class="text-white">TOTAL ROIs</h2>
                    <p class="text-white">All ROIs</p>
                </div>
                <div class="dashboard-card-stat">
                    {{showAmount(auth()->user()->rois()->count(),2)}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{--    Page Section Title Area    --}}
                <section class="page-section-title-area">
                    <div>
                        <h2>RECENT INVESTMENTS</h2>
                        <p>Latest investments details</p>
                    </div>
                    <div class="section-title-right"></div>
                </section>
                {{--    End Page Section Title Area    --}}
                <section class="customers">
                    <div class="table-responsive">
                        <table class="table custom-table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Investment ID</th>
                                <th scope="col">Package</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                                <th scope="col">Total ROIs</th>
                                <th scope="col">Recieved ROIs</th>
                                <th scope="col">Progress</th>
                                <th scope="col">action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($investments as $inv)
                                <tr>
                                    <td>{{$inv->id}}</td>
                                    <td>{{$inv->package->title}}</td>
                                    <td>{{$inv->amount}}</td>
                                    <td>{{$status = $inv->status==1 ? 'Active' : 'Expired'}}</td>
                                    <td>{{$inv->created_at}}</td>
                                    <td>{{$inv->rois->count()}}</td>
                                    <td>{{$inv->rois->where('status',0)->count()}}</td>
                                    <td>
                                        @php
                                            $progress = get_percentage($inv->rois->count(), $inv->rois->where('status',0)->count());
                                        @endphp
                                        <div class="progress progress-sm active">
                                            <div class="progress-bar progress-bar-success progress-bar-striped"
                                                 role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: {{$progress}}%">
                                                <span class="sr-only">{{$progress}}% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="{{route('user.rois',$inv->id)}}" class="btn btn-primary">Details</a>
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
    </div>
    <!-- /.container-fluid -->
    @endsection
    </div>
    </div>
    </div>
    </div>
    </div>
