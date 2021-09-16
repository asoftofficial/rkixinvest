@extends('admin.layouts.default')
@section('page-title')
Deposit Gateways
@endsection

@push('style')
@endpush

@section('content')
<div class = "container-fluid" > {{-- Section Search Area    --}}
{{-- Page Section Title Area    --}}
<section class = "page-section-title-area" > <div>
    <h2>Deposit Gateways</h2>
    <p>Latest Deposit Gateways information</p>
</div>
</section>{{-- End Page Section Title Area    --}}
<section class = "collections" > <div class="table-responsive">
        <table class="table custom-table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Name
                    </th>
                    <th scope="col">Image
                    </th>
                    <th scope="col">Minimum Deposit Amount
                    </th>
                    <th scope="col">Maximum Deposit Amount
                    </th>
                    <th scope="col">Charge Amount
                    </th>
                    <th scope="col">Status </th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paymentGateways as $pg)
                <tr>
                    <td>{{$pg->name}}</td>
                    <td><img src="{{asset($pg->image)}}"></td>
                    <td>{{$pg->min_ammount}}</td>
                    <td>{{$pg->max_ammount}}</td>
                    <td>{{$pg->charge}}</td>

                    <td>
                        <div class="fund-button">
                            <div class="fund-label">
                            </div>
                            <h4 class="input-label mt-2" id="refrel_level"></h4>
                            <div class="fund-toggle">
                                <input type="checkbox" id="removefund-{{ $pg->id }}" name="removefund" @if($pg->status == 1) checked @endif>
                                <label for="removefund-{{ $pg->id }}"></label>
                            </div>
                        </div>
                    </td>
                    <td style="min-width: 256px; text-align: right">

                        <a href="#"
                            class="btn btn-info blue-bg round-10 px-5 mr-2"
                            data-target="#editGateWayModal-{{$pg->id}}"
                            data-toggle="modal">Edit</a>

                    </td>
                </tr>
                @include('admin.settings.depositGateways.modals.edit')
                @endforeach
            </tbody>
        </table>
    </div>
</section>

</div>
<!-- /.container-fluid -->
@endsection
