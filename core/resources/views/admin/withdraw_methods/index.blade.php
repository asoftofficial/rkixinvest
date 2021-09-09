@extends('admin.layouts.default')
@section('page-title')
    Admin Dashboard
@endsection
@section('page-subtitle')
    Welcome back,
@endsection
@section('header-right')
    <a href="{{route('admin.withdraw.gateways.create')}}" class="btn btn-primary btn-blue header-right-btn">Add Method</a>
@endsection
@push('style')

@endpush
@push('script')
<script src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js" > </script>
<script>
    $(".delete").click(function (e) {
    console.log("asdhsakdash")
    swal(
        {title: "Are you sure ?", text: "Once Deleted it can not be reverted", icon: "warning", buttons: true, dangerMode: true}
    ).then((willDelete) => {
        if (willDelete) {
            var method_id = $(this).attr('data-id');
            var url = "{{route('user.destroy.method', 'id')}}";
            url = url.replace('id', method_id);
            $("#delete-form").attr('action', url);
            $("#delete-form").submit();
        }
    });
});
</script>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card b-radius--10 ">
                    <div class="card-body p-0">

                        <div class="table-responsive--sm table-responsive">
                            <table class="table table--light style--two">

                                <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Method')</th>
                                    <th>@lang('Currency')</th>
                                    <th>@lang('Charge')</th>
                                    <th>@lang('Withdraw Limit')</th>
                                    <th>@lang('Processing Time') </th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($methods as $method)
                                    <tr>
                                        <td>{{__($method->name)}}</td>
                                        <td data-label="@lang('Method')">
                                            <div class="user">
                                                <div class="thumb"><img src="{{route('placeholder.image','250x250')}}" alt="@lang('image')" width="100" height="100"></div>
                                            </div>
                                        </td>

                                        <td data-label="@lang('Currency')"
                                            class="font-weight-bold">{{ __($method->currency) }}</td>
                                        <td data-label="@lang('Charge')"
                                            class="font-weight-bold">{{ showAmount($method->fixed_charge)}} {{__($settings->cur_text) }} {{ (0 < $method->percent_charge) ? ' + '. showAmount($method->percent_charge) .' %' : '' }} </td>
                                        <td data-label="@lang('Withdraw Limit')"
                                            class="font-weight-bold">{{ $method->min_limit + 0 }}
                                            - {{ $method->max_limit + 0 }} {{__($settings->cur_text) }}</td>
                                        <td data-label="@lang('Processing Time')">{{ $method->delay }}</td>
                                        <td data-label="@lang('Status')">
                                            @if($method->status == 1)
                                                <span class="text--small badge font-weight-normal badge--success">@lang('Active')</span>
                                            @else
                                                <span class="text--small badge font-weight-normal badge--warning">@lang('Disabled')</span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <a href="{{ route('admin.withdraw.gateways.edit', $method->id)}}"
                                               class="btn btn-primary ml-1" data-toggle="tooltip" data-original-title="@lang('Edit')"><i class="fas fa-pen"></i></a>
                                            <a href="#" class="delete btn btn-danger" data-id="{{$method->id}}"><i class='fas fa-trash-alt' style='font-size:20px;color:white'></i></a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table><!-- table end -->
                        </div>
                    </div>
                </div><!-- card end -->
            </div>
        </div>


        {{-- ACTIVATE METHOD MODAL --}}
        <div id="activateModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Withdrawal Method Activation Confirmation')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.withdraw.method.activate') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id">
                        <div class="modal-body">
                            <p>@lang('Are you sure to activate') <span class="font-weight-bold method-name"></span> @lang('method')?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                            <button type="submit" class="btn btn--primary">@lang('Activate')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- DEACTIVATE METHOD MODAL --}}
        <div id="deactivateModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Withdrawal Method Disable Confirmation')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.withdraw.method.deactivate') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id">
                        <div class="modal-body">
                            <p>@lang('Are you sure to disable') <span class="font-weight-bold method-name"></span> @lang('method')?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                            <button type="submit" class="btn btn--danger">@lang('Disable')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    {{-- delete withdraw method form --}}
    <form action = "" method = "post" id = "delete-form" > @csrf
    @method('delete') </form>
@endsection
