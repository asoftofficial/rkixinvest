@extends('admin.layouts.default')
@section('page-title')
    Admin Dashboard
@endsection
@section('page-subtitle')
    Welcome back,
@endsection
@section('header-right')
{{--    <button class="btn btn-primary btn-blue header-right-btn">Button</button>--}}
@endsection
@push('style')

@endpush
@push('script')

@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive table-responsive--sm">
                            <table class=" table align-items-center table--light">
                                <thead>
                                <tr>
                                    <th>@lang('Short Code') </th>
                                    <th>@lang('Description')</th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                <tr>
                                    <td data-label="@lang('Short Code')">@{{fullname}}</td>
                                    <td data-label="@lang('Description')">@lang('User Fullname')</td>
                                </tr>
                                <tr>
                                    <td data-label="@lang('Short Code')">@{{username}}</td>
                                    <td data-label="@lang('Description')">@lang('User Name')</td>
                                </tr>
                                <tr>
                                    <td data-label="@lang('Short Code')">@{{message}}</td>
                                    <td data-label="@lang('Description')">@lang('Message')</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-body">
                        <form action="{{ route('admin.email.template.global') }}" method="POST">
                            @csrf
                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">@lang('Email Sent From') <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" placeholder="@lang('Email address')" name="email_from" value="{{ $settings->email_from }}" required/>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">@lang('Email Body') <span class="text-danger">*</span></label>
                                    <textarea name="email_template" rows="10" class="form-control form-control-lg nicEdit" placeholder="@lang('Your email template')">{{ $settings->email_template }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-blue text-white mr-2">@lang('Update')</button>
                        </form>
                    </div>
                </div><!-- card end -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

