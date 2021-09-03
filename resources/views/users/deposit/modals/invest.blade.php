@foreach($paymentMethods as $method)
<div
    class="modal fade"
    id="investModal{{ $method->id }}"
    tabindex="-1"
    role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-610" role="document">
        <div class="modal-content issue-padd">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="exampleModalLabel mt-0">Deposit Ammount</h5>
            </div>
            <div class="modal-body  pt-0">
                <form
                    action="{{route('user.paynow')}}"
                    method="post">
                    @csrf
                    <div class="form-group" id="ammountDiv-{{ $method->id }}">
                        <label for="text" class="input-label mb-0">Enter Amount:</label>
                        <input
                            type="number"
                            name="amount"
                            value="{{old('amount')}}"
                            required=""
                            min="{{ showAmount($method->min_limit) }}"
                            max= "{{ showAmount($method->max_limit) }}"
                            data-id ="{{ $method->id }}"
                            data-fixed-charge = "{{ showAmount($method->fixed_charge) }}"
                            data-page-charge = "{{ showAmount($method->percent_charge) }}"
                            class="form-control bg-light border-0 round-10 ammount" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                            @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <input type="hidden" name="payment_method" value="{{ $method->id }}">
                        <div class="form-group" id="table-div-{{ $method->id }}" style="display: none;">
                            <table class="table table-bordered" style="text-align: center" >
                                <tr>
                                    <td>Payment Method: <span>{{ $method->name }}</span></td>
                                </tr>
                                <tr>
                                    <td>Ammount: <span id="ammount-{{ $method->id }}"></span></td>
                                </tr>
                                <tr>
                                    <td> Charge: <span id="charge-{{ $method->id }}"></span></td>
                                </tr>
                                <tr>
                                    <td> Total Payable ammount: <span id="total-{{ $method->id }}"></span></td>
                                </tr>
                            </table>
                        </div>
                        <div class="row">
                                <div class="col-md-12">
                                        <div class="d-flex justify-content-center">
                                            <button
                                                type="button"
                                                class="btn btn-outline-blue px-4 mr-1 px-5"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary btn-blue px-4 px-5">Submit</button>
                                        </div>
                                    </form>
                                </div>
                        </div>
                    </div>
@endforeach
