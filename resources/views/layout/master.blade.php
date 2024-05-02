@extends('layout.base')
@section('screen')
    <div id="wrapper">
        @include('layout.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layout.header')
                <div class="container-fluid">
                    @yield('title-manage')
                    @yield('content')
                </div>
            </div>
            @include('layout.footer')
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sẵn sàng đăng xuất?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đăng xuất" bên dưới nếu bạn sẵn sàng kết thúc phiên làm việc hiện tại của mình.</div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="{{ route('logout') }}">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade bd-example-modal-lg" id="paymentOrderModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Quy trình</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="msform">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active" id="account"><strong>Account</strong></li>
                        <li id="personal"><strong>Personal</strong></li>
                        <li id="payment"><strong>Image</strong></li>
                        <li id="confirm"><strong>Finish</strong></li>
                    </ul>
                    <div class="progress">
                    	<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                	</div>
                    <br>
                    <!-- fieldsets -->
                    <fieldset>
                        <div class="form-card">
                        	<div class="row">
                        		<div class="col-7">
                            		<h2 class="fs-title">Account Information:</h2>
                            	</div>
                            	<div class="col-5">
                            		<h2 class="steps">Step 1 - 4</h2>
                            	</div>
                            </div>
                            <label class="fieldlabels">Email: *</label>
                            <input type="email" name="email" placeholder="Email Id"/>
                            <label class="fieldlabels">Username: *</label>
                            <input type="text" name="uname" placeholder="UserName"/>
                            <label class="fieldlabels">Password: *</label>
                            <input type="password" name="pwd" placeholder="Password"/>
                            <label class="fieldlabels">Confirm Password: *</label>
                            <input type="password" name="cpwd" placeholder="Confirm Password"/>
                        </div>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                        		<div class="col-7">
                            		<h2 class="fs-title">Personal Information:</h2>
                            	</div>
                            	<div class="col-5">
                            		<h2 class="steps">Step 2 - 4</h2>
                            	</div>
                            </div>
                            <label class="fieldlabels">First Name: *</label>
                            <input type="text" name="fname" placeholder="First Name"/>
                            <label class="fieldlabels">Last Name: *</label>
                            <input type="text" name="lname" placeholder="Last Name"/>
                            <label class="fieldlabels">Contact No.: *</label>
                            <input type="text" name="phno" placeholder="Contact No."/>
                            <label class="fieldlabels">Alternate Contact No.: *</label>
                            <input type="text" name="phno_2" placeholder="Alternate Contact No."/>
                        </div>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                        		<div class="col-7">
                            		<h2 class="fs-title">Image Upload:</h2>
                            	</div>
                            	<div class="col-5">
                            		<h2 class="steps">Step 3 - 4</h2>
                            	</div>
                            </div>
                            <label class="fieldlabels">Upload Your Photo:</label>
                            <input type="file" name="pic" accept="image/*">
                            <label class="fieldlabels">Upload Signature Photo:</label>
                            <input type="file" name="pic" accept="image/*">
                        </div>
                        <input type="button" name="next" class="next action-button" value="Submit"/>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                        	<div class="row">
                        		<div class="col-7">
                            		<h2 class="fs-title">Finish:</h2>
                            	</div>
                            	<div class="col-5">
                            		<h2 class="steps">Step 4 - 4</h2>
                            	</div>
                            </div>
                            <br><br>
                            <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-3">
                                    <img src="https://i.imgur.com/GwStPmg.png" class="fit-image">
                                </div>
                            </div>
                            <br><br>
                            <div class="row justify-content-center">
                                <div class="col-7 text-center">
                                    <h5 class="purple-text text-center">You Have Successfully Signed Up</h5>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="#">Xác nhận</a>
            </div>
          </div>
        </div>
    </div>
@endsection
