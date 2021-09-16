@extends('admin.layouts.default')
@section('page-title')
    Admin Dashboard
@endsection
@section('page-subtitle')
    Welcome back,
@endsection
@section('header-right')
    <a href="{{route('admin.deposit-gateways.create')}}" class="btn btn-primary btn-blue header-right-btn">Add Method</a>
@endsection
@push('style')

@endpush
@push('script')
 <script>
$(".delete").click(function (e) {
    swal(
        {title: "Are you sure ?", text: "Once Deleted it can not be reverted", icon: "warning", buttons: true, dangerMode: true}
    ).then((willDelete) => {
        if (willDelete) {
            var method_id = $(this).attr('data-id');
            var url = "{{route('admin.deposit-gateways.destroy', 'id')}}";
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
                                    <th>@lang('Deposit Limit')</th>
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
                                                <div class="thumb"><img src="{{ getImage(imagePath()['withdraw']['method']['path'].'/'. $method->image,imagePath()['withdraw']['method']['size'])}}" alt="@lang('image')" width="200"></div>
                                            </div>
                                        </td>

                                        <td data-label="@lang('Currency')"
                                            class="font-weight-bold">{{ __($method->currency) }}</td>
                                        <td data-label="@lang('Charge')"
                                            class="font-weight-bold">{{ showAmount($method->fixed_charge)}} {{__($settings->cur_text) }} {{ (0 < $method->percent_charge) ? ' + '. showAmount($method->percent_charge) .' %' : '' }} </td>
                                        <td data-label="@lang('Withdraw Limit')"
                                            class="font-weight-bold">{{ $method->min_limit + 0 }}
                                            - {{ $method->max_limit + 0 }} {{__($settings->cur_text) }}</td>
                                        <td data-label="@lang('Status')">
                                           <a href="{{route('admin.change.status',$method->id)}}" class="btn @if($method->status == 1)btn-success @else btn-info @endif">@if($method->status == 1)Enabled @else Disabled @endif</a>
                                        </td>
                                        <td data-label="@lang('Action')">
                                            {{-- Edit Button --}}
                                            <a href="{{ route('admin.deposit-gateways.edit', $method->id)}}"
                                               class="btn btn-primary ml-1" data-toggle="tooltip" data-original-title="@lang('Edit')"><i class="fas fa-pen"></i></a>
                                             {{-- Delete Button   --}}
                                             <a href="#" class="delete btn btn-primary mt-1 ml-1"  data-id="{{$method->id}}"><i class='fas fa-trash-alt' style='font-size:20px;color:white;'></i></a>
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

    </div>
    <!-- /.container-fluid -->
    <form action = "" method = "post" id = "delete-form" >
    @csrf
@method('delete') </form>
@endsection
