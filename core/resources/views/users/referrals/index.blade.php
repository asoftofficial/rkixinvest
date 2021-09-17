@extends('users.layouts.default')
@section('page-title')
    {{$pageTitle}}
@endsection
@section('page-subtitle')
    Welcome back,
@endsection
@section('header-right')
    <select name="level" class="form-control" id="levels">
        <option value="" selected disabled>Select Level</option>
        @foreach($levels as $level)
            <option value="{{$level->id}}">Level {{$level->id}}</option>
        @endforeach
    </select>
@endsection
@push('style')

@endpush
@push('script')
    <script>
        $('#levels').change(function () {
            let url = "{{route('user.referrals')}}" + '?level=' + $(this).val()
            window.location.href = url
        })
    </script>
@endpush
@section('content')
    <div class="container-fluid">
        <section class="page-section-title-area">
            <div>
                <h2>{{$pageTitle}}</h2>
                <p>Referrals information</p>
            </div>
        </section>{{-- End Page Section Title Area    --}}
        <section class="referrals">
            <div class="table-responsive">
                <table class="table custom-table table-responsive-md">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#N
                        </th>
                        <th scope="col">username
                        </th>
                        <th scope="col">Level
                        </th>

                        {{-- <th scope="col"></th> --}}
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($referrals as $key => $referral)
                        <tr class="bg-light">
                            <td>{{$key+1}}</td>
                            <td>{{$referral->referral->username}}</td>
                            <td>{{$referral->level}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">{{ __($emptyMessage) }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {!! $referrals->render('admin.custom-paginator') !!}
            </div>
        </section>
    </div>
    <!-- /.container-fluid -->
@endsection
