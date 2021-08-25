@extends('admin.layouts.default')
@section('page-title')
Create referral
@endsection
@push('style')
    <style>
        div#refdiv {
            border-bottom: 2px solid rgba(0,0,0,0.3);
            height: auto;
            padding-bottom: 20px;
        }
        input#refLevels {
            max-width: 240px;
        }
    </style>
@endpush
@section('content')
<div class = "container-fluid" >
    {{-- create refeeral bonus --}}
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                        <div class="gap">
                            <h4 class="input-label mt-2">Referral Levels</h4>
                                <div class="d-flex justify-content-between" id="refdiv">
                                    <input type="text" class="form-control bg-white round-10 border-0" name="refLevels" id="refLevels">
                                    <button type="button" class="btn btn-blue round-10 border-0 text-white px-5 createLevels"> CREATE </button>
                                </div>
                                @error('refbonus')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end referral bonus --}}

    {{-- referal level bonus --}}
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-bold mt-3 mb-3">Referral level bonus</h1>
            <div class="ref-bonuses">

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
@push('script')
    <script>
        $("#refLevels").on("keypress keyup blur",function (event) {
            $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        $('.createLevels').click(function(){
            if($('#refLevels').val()<=100){
                $('.ref-bonuses').html("");
                for(var i=1; i<=$('#refLevels').val(); i++){
                    $('.ref-bonuses').append(" <div class='row'><div class='col-md-12'><div class='gap mt-3'><div class='d-flex justify-content-between'><h4 class='input-label'>Level "+i+" bonus</h4> <input type='text' class='form-control bg-white round-10 border-0' name='bonuses[]'></div></div></div></div>")
                }
            }else{
                alert('too large value')
            }

        });
    </script>
@endpush
