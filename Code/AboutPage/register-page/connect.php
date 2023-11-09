<?php
// Start the session    
session_start();

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "wptemp1");
// Check for connection error
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Get the form data
$email = $_SESSION['email'];       
$Sex = $_POST['Sex'];
$Age = $_POST['Age'];
$Height = $_POST['Height'];
$RR_Count = $_POST['RR_Count'];
$v_nv = $_POST['v_nv'];
$allergies = $_POST['allergies'];
// Insert the data into the Customer table
$query = "UPDATE customer 
          SET Sex = '$Sex', Age = '$Age', Height = '$Height', RR_Count = '$RR_Count', v_nv = '$v_nv'
          WHERE email = '$email'";
mysqli_query($conn, $query);
// Calculate the Calorie_ID
if ($Sex == "Male") {
    $Calorie_ID = -5 * $Age + 32.875 * $Height - 453;
} else {
    $Calorie_ID = -5 * $Age + 29.475 * $Height - 446;
}
// Constraint for Calorie_ID
if ($Calorie_ID < 1125) {
    $Calorie_ID = 1000;
} else if ($Calorie_ID >= 1125 && $Calorie_ID < 1375) {
    $Calorie_ID = 1250;
} else if ($Calorie_ID >= 1375 && $Calorie_ID < 1625) {
    $Calorie_ID = 1500;
} else if ($Calorie_ID >= 1625 && $Calorie_ID < 1875) {
    $Calorie_ID = 1750;
} else if ($Calorie_ID >= 1875) {
    $Calorie_ID = 2000;
}
// Update the Calorie_ID in the Customer table
$query = "UPDATE customer SET Calorie_ID = '$Calorie_ID' WHERE email = '$email'";
mysqli_query($conn, $query);
// Insert the allergies into the Allergy table
if (!empty($allergies)) {
    foreach ($allergies as $allergy) {
        $query = "INSERT INTO customer_allergy (email, Allergy_ID) VALUES ('$email', '$allergy')";
        mysqli_query($conn, $query);
    }
}
// Close the connection
mysqli_close($conn);
// Redirect to the dashboard
header("Location: http://localhost/Won-Peace-/Code/About%20Page/reg-login/index-dashboard.php");
exit;
?>  
