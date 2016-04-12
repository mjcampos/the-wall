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
			<h3>Post a message</h3>
			<form action="process.php" method="post">
				<input type="hidden" name="action" value="post">
				<textarea id="message" rows="5" name="message"></textarea>
				<button type="submit" class="btn btn-primary btn-lg">Post a message</button>
			</form>

			<!--Row for error messages-->
			<div class="row message_row">
				<div class="col-md-12">
					<?php
						if (isset($_SESSION['errors']) && COUNT($_SESSION['errors']) > 0) {
							foreach ($_SESSION['errors'] as $message) {
								echo "<div class='alert alert-danger'><p>".$message."</p></div>";
							}
							unset($_SESSION['errors']);
						}

						if (isset($_SESSION['message'])) {
							if (isset($_SESSION['message'][1])) {
								echo "<div class='alert alert-success'><p>".$_SESSION['message'][1]."</p></div>";
							}
							elseif (isset($_SESSION['message'][0])) {
								echo "<div class='alert alert-danger'><p>".$_SESSION['message'][0]."</p></div>";
							}

							unset($_SESSION['message']);
						}
					?>
				</div>
			</div>

			<?php
				$query = "SELECT messages.id, CONCAT(users.first_name,' ', users.last_name) AS name, messages.message, messages.created_at
						  FROM messages
						  LEFT JOIN users ON users.id = messages.user_id
						  ORDER BY created_at DESC";
				$result = fetch($query);

				foreach ($result as $key) {
					echo "<div class='message_box'>";
						echo "<h3>".$key['name']." ".date('F jS Y', strtotime($key['created_at']))."</h3>";
						echo "<p>".$key['message']."</p>";

						echo "<div class='comment'>";
							// Display comments here

							// Run queury for comments
							$query2 = "SELECT users.id AS 'user id', CONCAT(users.first_name,' ', users.last_name) AS name, messages.id AS 'message id', comments.id AS 'comment id', comments.comment, comments.created_at
									   FROM comments
									   LEFT JOIN messages ON messages.id = comments.message_id
									   Left JOIN users ON users.id = comments.user_id
									   WHERE messages.id ='{$key['id']}'
									   ORDER BY comments.created_at ASC";
							$result2 = fetch($query2);

							foreach ($result2 as $key2) {
								echo "<h4>".$key2['name']." - ".date('F jS Y', strtotime($key2['created_at']))."</h4>";
								echo "<p>".$key2['comment']."</p>";
							}
							echo "<h4>Post a comment</h4>";
							echo "<form action='process.php' method='post'>";
								echo "<input type='hidden' name='action' value='comment'>";
								// Hidden input for the message id
								echo "<input type='hidden' name='message_id' value='{$key['id']}'>";
								echo "<textarea id='message' rows='3' name='comment'></textarea>";
								echo "<button type='submit' class='btn btn-success btn-lg'>Post a comment</button>";
							echo "</form>";
						echo "</div>";
					echo "</div>";
				}
			?>
		</div>
	</body>
</html>