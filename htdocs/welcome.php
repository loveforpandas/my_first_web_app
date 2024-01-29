<?php
// Include the database connection file
include("db_connection.php");

// Define variables and initialize with empty values
$name = $email = $message = "";
$name_err = $email_err = $message_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate message
    if (empty(trim($_POST["message"]))) {
        $message_err = "Please enter your message.";
    } else {
        $message = trim($_POST["message"]);
    }

    // Check for any validation errors before saving to the database
    if (empty($name_err) && empty($email_err) && empty($message_err)) {
        // Prepare a SQL statement
        $sql = "INSERT INTO connection_requests (name, email, message) VALUES (?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss", $param_name, $param_email, $param_message);

            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_message = $message;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect user to the home page after successful submission
                header("location: home.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect with Somebody</title>
    <style>
        /* Your styles here */
    </style>
</head>
<body>
    <form id="connectionForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Connect with Somebody</h2>

        <!-- Display validation errors, if any -->
        <?php
        if (!empty($name_err)) {
            echo '<p style="color:red;">' . $name_err . '</p>';
        }
        if (!empty($email_err)) {
            echo '<p style="color:red;">' . $email_err . '</p>';
        }
        if (!empty($message_err)) {
            echo '<p style="color:red;">' . $message_err . '</p>';
        }
        ?>

        <label for="name">Your Name</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Your Email</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Your Message</label>
        <textarea id="message" name="message" rows="4" required></textarea>

        <input type="submit" value="Submit Request" name="btnsubmit">
    </form>

    <!-- Your JavaScript code here -->

</body>
</html>