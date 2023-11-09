<?php
// Create a connection (replace with your database connection code)
$conn = mysqli_connect("localhost", "root", "", "wptemp1");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    

    // Retrieve registration data from the JSON object
    $username = $_POST['username']; 
    $email = $_POST['email'];       
    $password = $_POST['password'];    
    
    

    // Check if email already exists in database
    $email_exists = false;
    $sql = "SELECT email FROM customer WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $email_exists = true;
    }
    $stmt->close();

    if ($email_exists) {
        // Email already exists in database
        echo "Email already exists";
        
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        // Insert the registration data into the database (assuming you have a 'customer' table)
        $sql = "INSERT INTO customer (username, email, password) VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            // Registration was successful
            echo "Registration successful";
            session_start();
            $_SESSION["email"] = $email;
            header("Location: http://localhost/Won-Peace-/Code/About%20Page/register%20page/index-registerhtml.php");
        } else {
            // Registration failed
            echo "Registration failed";
        }

        $stmt->close();
    }
    $conn->close();
}
?>
