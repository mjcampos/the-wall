<?php
	session_start();

	// Insert the connection page
	require_once('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
	<!--header-->
	<?php require_once('header.php');?>

	<body>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<h2>The Wall</h2>
				</div>

				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<p class="navbar-text">Signed in as <?=$_SESSION['first_name']?></p>
						<li>
							<form action="process.php" method="post">
								<button type="submit" class="btn btn-primary">Log Off</button>
							</form>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<!--The main body-->
		<div class="container main">
			<?php
				var_dump($_SESSION);
			?>

			<!--Row for error messages-->
			<div class="row">
				<div class="col-md-12">
					<?php
						if (isset($_SESSION['errors']) && COUNT($_SESSION['errors']) > 0) {
							foreach ($_SESSION['errors'] as $message) {
								echo "<div class='alert alert-danger'><p>".$message."</p></div>";
							}
							unset($_SESSION['errors']);
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
			<h3>Post a message</h3>
			<form action="process.php" method="post">
				<input type="hidden" name="action" value="post">
				<textarea id="message" rows="5" name="message"></textarea>
				<button type="submit" class="btn btn-primary btn-lg">Submit</button>
			</form>

			<?php
				$query = "SELECT messages.id, CONCAT(users.first_name,' ', users.last_name) AS name, messages.message, messages.created_at
						  FROM messages
						  LEFT JOIN users ON users.id = messages.user_id
						  ORDER BY created_at DESC";
				$result = fetch($query);

				foreach ($result as $key) {
					echo "<div class='message_box'>";
					echo "<h3>".$key['name']." ".date('F j Y', strtotime($key['created_at']))."</h3>";
					echo "<p>".$key['message']."</p>";
					echo "</div>";
				}
			?>
		</div>
	</body>
</html>