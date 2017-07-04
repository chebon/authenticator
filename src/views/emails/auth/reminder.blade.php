<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<style>
			@import url(//fonts.googleapis.com/css?family=Open+Sans);

			body {
				font-family: 'Open Sans', arial, sans-serif;
			}

			a, a:visited {
				text-decoration:none;
				color: #0000ff;
			}

			h2 {
				font-size: 32px;
				margin: 16px 0 0 0;
			}

			.mybutton{
				margin-left: 15%;
			}
		</style>
	</head>
	<body>
		<div>
			<p>Dear {{{ $first_name.' '.$last_name }}},<br><br>
			A password reset request has been initiated from your email address. To reset your password, Click the link below: <br>
			</p>
			
			<p class="mybutton"><a class="btn btn-danger" href="{{ $password_reset_url }}">Reset my Password</a></p>

			<p>Regards,<br>
			Support Team<br></p>
		</div>
	</body>
</html>