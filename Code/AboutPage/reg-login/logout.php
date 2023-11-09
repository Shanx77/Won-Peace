//End the session on logout and redirect to the home page
<?php
session_start();
header("Location: http://localhost/Won-Peace-/Code/About%20Page/index-aboutpage.php");  
exit;   
?>