<?php
   
   if (isset($_POST["choices"]) ){
    
    $choice = $_POST["choices"];

    if ($choice === "Admin") {
        header("Location: login.html");
        exit();
    } elseif ($choice === "Participant") {
        header("Location: Plogin.html");
        exit();
    } else {
        // Invalid choice, redirect back to the choice page with an error message
        header("Location: choice.php?error=Invalid choice");
        exit();
    }
 

}
?>
