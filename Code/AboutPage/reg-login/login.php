<?php


// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = $_POST['email']; 
    $password = $_POST['password']; 
    

    // Check if the required fields are provided
    if (isset($email) && isset($password)) {
        


        // Create a database connection
        $conn = mysqli_connect("localhost", "root", "", "wptemp1");

        
        // Check if the connection was successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        



        // Query the database for the user with the provided username
        $sql = "SELECT * FROM customer WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();


        // Check if a user with that username exists
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verify the hashed password
            
            if (password_verify($password, $user['password'])) {
                
                // Password matches, user is authenticated  
                // Start a session and store user data
                session_start();
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                header("Location: http://localhost/Won-Peace-/Code/About%20Page/reg-login/index-dashboard.php");
                exit();
        
                

            } 
            else {
                // Password is incorrect
                echo'Password is incorrect';
            }
        }
        else {
            // User with the provided username does not exist
            echo 'username not found';
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    } else {
        // Required fields not provided
        echo "Missing username or password";
    }
} else {
    // Request method is not POST
    echo"Invalid request method";
}
?>

