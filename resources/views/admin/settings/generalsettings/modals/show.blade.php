<style>
*{
    box-shadow: none;
}

.main {
    font-family: 'Poppins', sans-serif;
}



.referal-button {
    display: flex;
    margin-top: 30px;
    padding: 8px 16px;
    width: 16rem;
    border-radius: 10px;
    margin-bottom: 30px;
    /* box-shadow: -8px -8px 15px rgba(255,255,255,.7),
                10px 10px 10px rgba(0,0,0, .3),
                inset 8px 8px 15px rgba(255,255,255,.7),
                inset 10px 10px 10px rgba(0,0,0, .3); */
    justify-content: space-between;
    align-items: center;
}

.referal-label {
    width: 150px;
}

.referal-label i {
    margin-right: 5px;
}

.referal-toggle {
    height: 40px;
}

.referal-toggle input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    z-index: -2;
}

.referal-toggle input[type="checkbox"] + label {
    position: relative;
    /* top: 0px; */
    right: 8.2rem;
    display: inline-block;
    width: 92px;
    height: 35px;
    border-radius: 20px;
    margin: 0;
    cursor: pointer;
    box-shadow: inset -8px -8px 15px rgb(255 255 255 / 60%), inset 10px 10px 10px rgb(0 0 0 / 25%);
}

.referal-toggle input[type="checkbox"] + label::before {
    position: absolute;
    content: 'OFF';
    font-size: 10px;
    text-align: center;
    line-height: 25px;
    top: 2px;
    left: 8px;
    width: 37px;
    height: 30px;
    border-radius: 20px;
    background-color: #d1dad3;
    box-shadow: -3px -3px 5px rgb(255 255 255 / 50%), 3px 3px 5px rgb(0 0 0 / 25%);
    transition: .3s ease-in-out;
}
.referal-toggle input[type="checkbox"]:checked + label::before {
    left: 50%;
    content: 'ON';
    color: #fff;
    background-color: #00b33c;
    box-shadow: -3px -3px 5px rgba(255,255,255,.5),
                3px 3px 5px #00b33c;
}

label#refreltext {
    position: absolute;
    top: 5px;
    font-size: 17px;
}

.main {
    font-family: 'Poppins', sans-serif;
}



.reward-button {
    display: flex;
    margin-top: 30px;
    padding: 8px 16px;
    width: 16rem;
    border-radius: 10px;
    margin-bottom: 30px;
    /* box-shadow: -8px -8px 15px rgba(255,255,255,.7),
                10px 10px 10px rgba(0,0,0, .3),
                inset 8px 8px 15px rgba(255,255,255,.7),
                inset 10px 10px 10px rgba(0,0,0, .3); */
    justify-content: space-between;
    align-items: center;
}

.reward-label {
    width: 150px;
}

.reward-label i {
    margin-right: 5px;
}

.reward-toggle {
    height: 40px;
}

.reward-toggle input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    z-index: -2;
}

.reward-toggle input[type="checkbox"] + label {
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

.reward-toggle input[type="checkbox"] + label::before {
    position: absolute;
    content: 'OFF';
    font-size: 10px;
    text-align: center;
    line-height: 25px;
    top: 2px;
    left: 8px;
    width: 37px;
    height: 30px;
    border-radius: 20px;
    background-color: #d1dad3;
    box-shadow: -3px -3px 5px rgb(255 255 255 / 50%), 3px 3px 5px rgb(0 0 0 / 25%);
    transition: .3s ease-in-out;
}
.reward-toggle input[type="checkbox"]:checked + label::before {
    left: 50%;
    content: 'ON';
    color: #fff;
    background-color: #00b33c;
    box-shadow: -3px -3px 5px rgba(255,255,255,.5),
                3px 3px 5px #00b33c;
}
</style>

<div class="modal fade" id="generalsettings" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-610" role="document">
        <div class="modal-content issue-padd">
            <div class="modal-header pb-0">
                <h5 class="modal-title text-left" id="exampleModalLabel mt-0">General Settings</h5>
            </div>
            <div class="modal-body  pt-0">
                <form action="{{route('general.settings.store')}}"  method="post">
                    @csrf
                    <div class="form-group">
                        <label for="text" class="input-label mb-0">website Name:</label>
                        <input type="text" name="web_title" value="{{old('name')}}" required="" class="form-control bg-light border-0 round-10 ">
                        @error('web_title')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="text" class="input-label">Website Description</label>
                        <textarea rows="6" class="form-control bg-light border-0 round-10" name="description" required="" id="description"> {{old('desc')}}</textarea>
                        @error('desc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    {{-- referral settings --}}
                    <hr>
                    <h5 class="modal-title" id="exampleModalLabel mt-0">Referal settings</h5>
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="gap">
                                        <div class="main mt-3 justify-content-start">
                                            <div class="referal-button">
                                                <div class="referal-label">
                                                    {{-- <i class="fa fa-users"></i><span>Referal System</span> --}}
                                                </div>
                                                <label for="bluetooth" id="refreltext" class="input-label">Referal System</label>
                                                <div class="referal-toggle">
                                                    <input type="checkbox" id="bluetooth" name="refrel_system">
                                                    <label for="bluetooth"></label>
                                                </div>
                                            </div>
                                                        </div>
                                                    <div>

                                                    </div>
                                        @error('refrel_system')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="gap1">
                                        <h4 class="input-label mt-2">Referal_system level</h4>
                                        <input type="text" name="refrelsystem_level" value="{{old('refrelsystem_level')}}" required="" class="form-control bg-light border-0 round-10 ">
                                        @error('refrelsystem_level')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Reward setting --}}
                    <hr>
                    <h5 class="modal-title" id="exampleModalLabel mt-0">Reward settings</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 justify-content-start">
                                    <div class="gap">
                                        <div class="main mt-3">
                                            <div class="reward-button">

                                                <label for="reward" id="refreltext" class="input-label">reward System</label>
                                                <div class="reward-toggle">
                                                    <input type="checkbox" id="reward" name="reward_system">
                                                    <label for="reward"></label>
                                                </div>
                                            </div>
                                                        </div>
                                                    <div>

                                                    </div>
                                        @error('refrel_system')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>




                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-outline-blue px-4 mr-1 px-5" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-blue px-4 px-5">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
