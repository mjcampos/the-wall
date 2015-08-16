<?php
	session_start();

	// Insert the connection page
	require_once('connection.php');

	// Set an error array in the Session that will keep track of all the errors that will be displayed for the user in index.php
	if (!isset($_SESSION['errors'])) {
		$_SESSION['errors'] = array();
	}

	// Registration
	if (isset($_POST['action']) && $_POST['action'] == 'register') {
		//--------Begin validation test--------//

		// Test for empty first name
		if (empty($_POST['first_name'])) {
			$_SESSION['errors'][] = 'First name field cannot be blank';
		}

		// Test for empty last name
		if (empty($_POST['last_name'])) {
			$_SESSION['errors'][] = 'Last name field cannot be blank';
		}

		// Test for empty email
		if (empty($_POST['email'])) {
			$_SESSION['errors'][] = 'Email field cannot be blank';
		}
		// Test for valid email input
		elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$_SESSION['errors'][] = 'Email address must be formatted correctly';
		}

		// Test for password
		if (empty($_POST['password'])) {
			$_SESSION['errors'][] = 'Password field cannot be blank';
		}

		// Test for confirmation_password
		if (empty($_POST['confirmation_password'])) {
			$_SESSION['errors'][] = 'You need to enter your password again for confirmation';
		}

		// Test for password and confirmation password match
		if ($_POST['password'] != $_POST['confirmation_password']) {
			$_SESSION['errors'][] = 'Passwords must match';
		}

		//--------End of validation testing--------//

		// If there are any errors user gets redirected back to index.php, else user's entries are inserted into the query
		if (COUNT($_SESSION['errors']) > 0) {
			header('location: index.php');
		}
		else {
			// Check if email address already exists
			$query = "SELECT email
					  FROM users
					  WHERE email = '{$_POST['email']}'";
			$user = mysqli_fetch_assoc(mysqli_query($connection, $query));

			if ($user) {
				$_SESSION['errors'][] = "An account under {$_POST['email']} already exists";
				header('location: index.php');
			}
			// If email does exist in the database proceed to Insert
			else {
				$password = md5($_POST['password']);

				// Insert user's input into the query in preparation for insertion
				$query = "INSERT INTO users(first_name, last_name, email, password, created_at, updated_at)
						  VALUES ('{$_POST['first_name']}', '{$_POST['last_name']}', '{$_POST['email']}', '{$password}', NOW(), NOW())";

				if(run_mysql_query($query)) {
				    $_SESSION['message'][1] = "Thank you for registering";
				    unset($_POST);
				}
				else {
				    $_SESSION['message'][0] = "We were unable to complete the registration";
				}

				header('location: index.php');
				die();
			}
		}
	}
	// Log In
	elseif (isset($_POST['action']) && $_POST['action'] == 'login') {
		//--------Begin validation test--------//

		// Test for empty email
		if (empty($_POST['email'])) {
			$_SESSION['errors'][] = 'Email field cannot be blank';
		}
		// Test for valid email input
		elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$_SESSION['errors'][] = 'Email address must be formatted correctly';
		}

		// Test for password
		if (empty($_POST['password'])) {
			$_SESSION['errors'][] = 'Password field cannot be blank';
		}

		//--------End of validation testing--------//

		// If there are any errors user gets redirected back to index.php, else user's entries are inserted into the query
		if (COUNT($_SESSION['errors']) > 0) {
			header('location: index.php');
		}
		else {
			$password = md5($_POST['password']);

			$query = "SELECT * 
					  FROM users
				 	  WHERE password='{$password}' AND email='{$_POST['email']}'";
			$user = fetch($query);

			if (COUNT($user) > 0) {
				$_SESSION['user_id'] = $user[0]['id'];
				$_SESSION['first_name'] = $user[0]['first_name'];
				$_SESSION['last_name'] = $user[0]['last_name'];
				$_SESSION['email'] = $user[0]['email'];
				header('location: main.php');
			} 
			else {
				$_SESSION['errors'][] = "Cannot find a user with those credentials";
				header('location: index.php');
				die();
			}
		}
	}
	// Post
	elseif (isset($_POST['action']) && $_POST['action'] == 'post') {
		//--------Begin validation test--------//

		// Test for empty message
		if (empty($_POST['message'])) {
			$_SESSION['errors'][] = 'Message field cannot be empty';
		}

		//--------End of validation testing--------//

		// If there are any errors user gets redirected back to index.php, else user's entries are inserted into the query
		if (COUNT($_SESSION['errors']) > 0) {
			header('location: main.php');
		}
		else {
			// Escape strings with special characters
			$esc_message = mysqli_real_escape_string($connection, $_POST['message']);
			// Insert message into the query
			$query = "INSERT INTO messages(message, created_at, updated_at, user_id)
					  Values ('$esc_message', NOW(), NOW(), '{$_SESSION['user_id']}')";

			if(run_mysql_query($query)) {
			    $_SESSION['message'][1] = "Message posted";
			    unset($_POST);
				}
			else {
			    $_SESSION['message'][0] = "Message unable to be posted";
			}

			header('location: main.php');
			die();
		}
	}
	// Comment
	elseif (isset($_POST['action']) && $_POST['action'] == 'comment') {
		//--------Begin validation test--------//

		// Test for empty comment
		if (empty($_POST['comment'])) {
			$_SESSION['errors'][] = 'Comment field cannot be empty';
		}

		//--------End of validation testing--------//

		// If there are any errors user gets redirected back to index.php, else user's entries are inserted into the query
		if (COUNT($_SESSION['errors']) > 0) {
			header('location: main.php');
		}
		else {
			// Escape strings with special characters
			$esc_comment = mysqli_real_escape_string($connection, $_POST['comment']);

			// Insert comment into query
			$query = "INSERT INTO comments(comment, created_at, updated_at, message_id, user_id)
					  VALUES ('{$esc_comment}', NOW(), NOW(), '{$_POST['message_id']}', '{$_SESSION['user_id']}')";

			if(run_mysql_query($query)) {
			    $_SESSION['message'][1] = "Comment posted";
			    unset($_POST);
				}
			else {
			    $_SESSION['message'][0] = "Comment unable to be posted";
			}

			header('location: main.php');
			die();
		}
	}
	// Log Off
	else {
		session_destroy();
		header('location: index.php');
	}
?>