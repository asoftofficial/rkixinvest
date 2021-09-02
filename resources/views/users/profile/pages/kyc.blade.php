@extends('admin.layouts.default')
@section('page-title')
    User KYC
@endsection
@section('page-subtitle')
    Kyc
@endsection
@section('header-right')
    <a href="{{ route('user.show.profile') }}" class="btn btn-primary btn-blue header-right-btn">Back</a>
@endsection
@push('style')

@endpush
@push('script')
    <script>
        (function ($) {
            "use strict";
            $('input[name=currency]').on('input', function () {
                $('.currency_symbol').text($(this).val());
            });
            $('.addUserData').on('click', function () {
                var html = `
                    <div class="col-md-12 user-data">
                        <div class="form-group">
                            <div class="input-group mb-md-0 mb-4">
                                <div class="col-md-4">
                                    <input name="field_name[]" class="form-control" type="text" required placeholder="@lang('Field Name')">
                                </div>
                                <div class="col-md-3 mt-md-0 mt-2">
                                    <select name="type[]" class="form-control">
                                        <option value="text" > @lang('Input Text') </option>
                                        <option value="textarea" > @lang('Textarea') </option>
                                        <option value="file"> @lang('File') </option>
                                    </select>
                                </div>
                                <div class="col-md-3 mt-md-0 mt-2">
                                    <select name="validation[]"
                                            class="form-control">
                                        <option value="required"> @lang('Required') </option>
                                        <option value="nullable">  @lang('Optional') </option>
                                    </select>
                                </div>
                                <div class="col-md-2 mt-md-0 mt-2 text-right">
                                    <span class="input-group-btn">
                                        <button class="btn btn--danger btn-lg removeBtn w-100" type="button">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>`;

                $('.addedField').append(html);
            });

            $(document).on('click', '.removeBtn', function () {
                $(this).closest('.user-data').remove();
            });
            @if(old('currency'))
            $('input[name=currency]').trigger('input');
            @endif
        })(jQuery);

    </script>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card main-card">
                        <div class="card-body">
                            <div class="payment-method-item">
                                <div class="kyc-header">
                                    <div class="thumb">
                                        <div class="avatar-preview ">
                                            <div class="profilePicPreview" style="background-image: url({{getImage('/',imagePath()['withdraw']['method']['size'])}})"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div><!-- card end -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
