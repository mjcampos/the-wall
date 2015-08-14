<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>The Wall</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="styles.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="script.js" type="text/javascript"></script>
	</head>

	<body>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<h2>The Wall</h2>
				</div>

				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Log In</button></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container main">
			<h1>The Wall</h1>
			<h2>Welcome to The Wall, the hottest social networking site since Facebook's horrifying, yet very sensual, demise in 2019. Boy that had to have been one of the freakest years in human history.</h2>

			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<h2>Sign Up</h2>
					<form>
						<div class="form-group">
							<label for="first_name">First Name</label>
							<input type="text" class="form-control" id="first_name" placeholder="First Name">
						</div>

						<div class="form-group">
							<label for="last_name">Last Name</label>
							<input type="text" class="form-control" id="last_name" placeholder="Last Name">
						</div>

						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" placeholder="Email">
						</div>

						<div class="form-group">
							<label for="password">Password</label>
							<input type="text" class="form-control" id="password" placeholder="Password">
						</div>

						<div class="form-group">
							<label for="confirmation_password">Confirmation Password</label>
							<input type="text" class="form-control" id="confirmation_password" placeholder="Confirmation Password">
						</div>

						<button type="submit" class="btn btn-primary">Sign Up</button>
					</form>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Log In</h4>
					</div>

					<div class="modal-body">
						<form>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" id="email" placeholder="Email">
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password" placeholder="Password">
							</div>

							<div class="modal-footer">
								<button type="submit" class="btn btn-primary">Log In</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>