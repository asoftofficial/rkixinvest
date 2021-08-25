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
            display: flex;
            justify-content: space-between;
        }
        input#refLevels {
            max-width: 240px;
        }
        input.form-control.bg-white.round-10.border-0.bonusinput {
    max-width: 240px;
}
     .refbonus-div{
            display: flex;
            justify-content: space-between;
        }
        .reflabel{
            align-self: center;
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
                                <div id="refdiv">
                                    <input type="text" class="form-control bg-white round-10 border-0" name="refLevels" id="refLevels">
                                    <button type="button" class="btn btn-blue round-10 border-0 text-white px-5 createLevels" disabled="TRUE"> Create </button>
                                </div>
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
            <form action="{{route('admin.referrals.post')}}" method="POST">
                @csrf
                <div class="ref-bonuses">
                    @if(!empty($referrals))
                        @foreach($referrals as $ref)
                            <div class='row justify-content-center'><div class='col-md-12'><div class='gap mt-3'><div class='refbonus-div'><h4 class='input-label reflabel'>Level {{$ref->id}} bonus</h4> <input type='text' class='form-control bg-white round-10 border-0 bonusinput' value="{{$ref->bonus}}" name='bonuses[]'></div></div></div></div>
                        @endforeach
                            <button class="btn btn-primary btn-blue saveReferrals px-5 mt-3">Save</button>
                    @endif
                </div>
                <button class="btn btn-primary btn-blue saveReferrals px-5 mt-3" style="display: none">Save</button>
            </form>
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
            }else{
                $(".createLevels").removeAttr("disabled");
            }
            if($(this).val()==""){
                $(".createLevels").attr("disabled","TRUE");
            }

        });
        $('.createLevels').click(function(){
            let refLevels = $('#refLevels').val();
            if(refLevels<=100){
                $('.ref-bonuses').html("");
                for(var i=1; i<=refLevels; i++){
                    $('.ref-bonuses').append("<div class='row justify-content-center'><div class='col-md-12'><div class='gap mt-3'><div class='refbonus-div'><h4 class='input-label reflabel'>Level "+i+" bonus</h4> <input type='text' class='form-control bg-white round-10 border-0 bonusinput' name='bonuses[]'></div></div></div></div>")
                }
                $('.saveReferrals').slideDown();
            }else{
                alert('too large value')
            }

        });
    </script>
@endpush
