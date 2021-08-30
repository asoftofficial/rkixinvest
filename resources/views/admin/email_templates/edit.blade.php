@extends('admin.layouts.default')
@section('page-title')
    Admin Dashboard
@endsection
@section('page-subtitle')
    Welcome back,
@endsection
@section('header-right')
    <a href="{{ route('admin.email.template.index') }}" class="btn btn-primary btn-blue header-right-btn">Button</a>
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-toggle.min.css')}}">
@endpush
@push('script')
    <script src="{{asset('js/bootstrap-toggle.min.js')}}"></script>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive table-responsive--sm">
                            <table class="table align-items-center table--light">
                                <thead>
                                <tr>
                                    <th>@lang('Short Code')</th>
                                    <th>@lang('Description')</th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                @forelse($email_template->shortcodes as $shortcode => $key)
                                    <tr>
                                        <th data-label="@lang('Short Code')">@php echo "{{"$shortcode"}}"  @endphp</th>
                                        <td data-label="@lang('Description')">{{ __($key) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-muted text-center">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- card end -->
            </div>

            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header bg-dark">
                        <h5 class="card-title text-white">{{ __($pageTitle) }}</h5>
                    </div>
                    <form action="{{ route('admin.email.template.update', $email_template->id) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label class="font-weight-bold">@lang('Subject') <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" placeholder="@lang('Email subject')" name="subject" value="{{ $email_template->subject }}"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-weight-bold">@lang('Status') <span class="text-danger">*</span></label>
                                    <input type="checkbox" data-height="46px" data-width="100%" data-onstyle="success"
                                           data-offstyle="danger" data-toggle="toggle" data-on="@lang('Send Email')"
                                           data-off="@lang("Don't Send")" name="email_status"
                                           @if($email_template->email_status) checked @endif>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">@lang('Message') <span class="text-danger">*</span></label>
                                    <textarea name="email_body" rows="10" class="form-control nicEdit" placeholder="@lang('Your message using shortcodes')">{{ $email_template->email_body }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-block text-white btn-blue  mr-2">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
