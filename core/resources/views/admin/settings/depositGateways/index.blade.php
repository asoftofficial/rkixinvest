@extends('admin.layouts.default')
@section('page-title')
Deposit Gateways
@endsection

@push('style')

<style>* {
    box-shadow: none;
}

.main {
    font-family: 'Poppins', sans-serif;
}



.fund-button {
    display: flex;
    padding: 8px 16px;
    border-radius: 10px;
    align-items: center;
}



.fund-label i {
    margin-right: 5px;
}

.fund-toggle {
    height: 40px;
}

.fund-toggle input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    z-index: -2;
}

.fund-toggle input[type="checkbox"]+label {
    position: relative;
    /* top: 0px; */
    display: inline-block;
    width: 92px;
    height: 35px;
    border-radius: 20px;
    margin: 0;
    cursor: pointer;
    box-shadow: inset -8px -8px 15px rgb(255 255 255 / 60%), inset 10px 10px 10px rgb(0 0 0 / 25%);
}

.fund-toggle input[type="checkbox"]+label::before {
    position: absolute;
    content: 'OFF';
    font-size: 10px;
    text-align: center;
    line-height: 25px;
    top: 2px;
    left: 2px;
    width: 37px;
    /* height: 30px; */
    border-radius: 20px;
    background-color: #d1dad3;
    box-shadow: -3px -3px 5px rgb(255 255 255 / 50%), 3px 3px 5px rgb(0 0 0 / 25%);
    transition: .3s ease-in-out;
    padding: 3px 7px;
}

.fund-toggle input[type="checkbox"]:checked+label::before {
    left: 59%;
    content: 'ON';
    color: #fff;
    background-color: #00b33c;
    box-shadow: -3px -3px 5px rgba(255, 255, 255, .5),
        3px 3px 5px #00b33c;
        padding: 3px;
}

label#refreltext {
    position: absolute;
    top: 5px;
    font-size: 17px;
}

h4#refrel_level {
    margin-top: -74px !important;
}

div#refrel_div {
    margin: reght;
    margin-right: 18rem;
}

</style>
@endpush


@section('content')
<div class = "container-fluid" > {{-- Section Search Area    --}}
    <section class = "admin-search-area" > <div class="admin-search-left">
    
</div>
<div class="admin-search-right">
    <div class="admin-section-search-area input-group mb-3">
        <input type="text" class="">
            <div class="admin-section-search-btn-area">
                <button class="btn bg-transparent mr-2" type="button">
                    <i class="fas fa-search mr-2"></i>
                    Search here</button>
            </div>
        </div>
    </div>
</section>{{-- End Section Search Area    --}}

{{-- Page Section Title Area    --}}
<section class = "page-section-title-area" > <div>
    <h2>Deposit Gateways</h2>
    <p>Latest Deposit Gteways information</p>
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

{{-- Add package Model  --}}

{{-- End Add package Model  --}}

@endsection
