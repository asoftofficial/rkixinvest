@extends('users.layouts.default')
@section('page-title')
   Investments
@endsection
@section('header-right')
    <a href="{{ route('user.packages') }}" class="btn btn-primary btn-blue header-right-btn">@lang('Withdraw')</a>
@endsection
@push('script')

@endpush
@section('content')
    <div class = "container-fluid" >
        {{-- Page Section Title Area    --}}
        <section class = "page-section-title-area">
            <div>
                <h2>Investments</h2>
                <p>All investments information</p>
            </div>
        </section>{{-- End Page Section Title Area    --}}
        <section class = "collections" >
            <div class="table-responsive">
                <table class="table custom-table table-responsive-md">
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
                    @forelse($investments as $inv)
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
                                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$progress}}%">
                                        <span class="sr-only">{{$progress}}% Complete</span>
                                    </div>
                                </div>
                            </td>
                            <td><a href="{{route('user.rois',$inv->id)}}" class="btn btn-primary">Details</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">{{ __($emptyMessage) }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {!! $investments->render('admin.custom-paginator') !!}
            </div>
        </section>
    </div>
    <!-- /.container-fluid -->
@endsection
