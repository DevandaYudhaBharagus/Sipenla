<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Sipenla | Sistem Informasi Pendidikan</title>
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/feathericon.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugins/morris/morris.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}"> </head>

<body>
    @error('password')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
	<div class="main-wrapper login-body login_class">
		<div class="login-wrapper">
			<div class="container">
				<div class="loginbox login_pswd">
					<div class="login-right">
						<div class="login-right-wrap mb-5 mt-5">
							<h1>Change Password</h1>
							<form action="{{ route('resetpass') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="token" value="{{ $token }}">
								<div class="form-group">
									<label>New Password</label>
									<input class="form-control" type="password" placeholder="New Password" name="password"> </div>
								<div class="form-group">
									<label>Confirm Password</label>
									<input class="form-control" type="password" placeholder="Confirm New Password" name="password_confirmation"> </div>
								<div class="form-group mt-5">
									<button class="btn btn-primary btn-block" type="submit">Update Password</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
	<script src="{{asset('assets/js/popper.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('assets/js/script.js')}}"></script>
</body>

</html>
