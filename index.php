<?php
	session_start();

	// Insert the connection page
	require_once('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
	<!--HTML tags-->
	<?php require_once('header.php');?>

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
			<h2>Welcome to The Wall, the hottest social networking site since Facebook's horrifying, yet very sensual, demise in 2019. Boy that had to have been one of the freakiest years in human history.</h2>

			<div class="row">
				<!--Registration-->
				<div class="col-md-6 col-md-offset-3">
					<h2>Sign Up</h2>
					<form action="process.php" method="post">
						<input type="hidden" name="action" value="register">
						<div class="form-group">
							<label for="first_name">First Name</label>
							<input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name">
						</div>

						<div class="form-group">
							<label for="last_name">Last Name</label>
							<input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name">
						</div>

						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" placeholder="Email" name="email">
						</div>

						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" placeholder="Password" name="password">
						</div>

						<div class="form-group">
							<label for="confirmation_password">Confirmation Password</label>
							<input type="password" class="form-control" id="confirmation_password" placeholder="Confirmation Password" name="confirmation_password">
						</div>

						<button type="submit" class="btn btn-primary">Sign Up</button>
					</form>
				</div>
				<div class="col-md-3">
					<?php
						if (isset($_SESSION['errors']) && COUNT($_SESSION['errors']) > 0) {
							foreach ($_SESSION['errors'] as $message) {
								echo "<div class='alert alert-danger'><p>".$message."</p></div>";
							}
							session_destroy();
						}

						if (isset($_SESSION['message'])) {
							if ($_SESSION['message'][1]) {
								echo "<div class='alert alert-success'><p>".$_SESSION['message'][1]."</p></div>";
							}
							elseif ($_SESSION['message'][0]) {
								echo "<div class='alert alert-danger'><p>".$_SESSION['message'][0]."</p></div>";
							}

							unset($_SESSION['message']);
						}
					?>
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
						<form action="process.php" method="post">
							<input type="hidden" name="action" value="login">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" id="email" placeholder="Email" name="email">
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password" placeholder="Password" name="password">
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