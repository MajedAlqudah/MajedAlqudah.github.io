<?php
include "db_conn.php";
if (isset($_POST["username"]) && isset($_POST["password"])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $uname = validate($_POST["username"]);
    $passw = validate($_POST["password"]);

    if(empty($uname))
    {
        header("Location: login.html?error= user name required");
        exit();
    }

    elseif(empty($passw))
    {
        header("Location: login.html?error= passwword required");
        exit();
    }
    
    else
    {
        $sql = "SELECT * FROM conf_admin WHERE Aemail = '$uname' AND Apassowrd = '$passw'";

        $result = mysqli_query($conn,$sql);

        if ($result === false) {
            // Query failed
            die("Error in SQL query: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row["Aemail"] === $uname && $row["Apassowrd"] === $passw)
            {
                $_SESSION['Aemail'] = $row['Aemail'];
                $_SESSION['Apassowrd'] = $row['Apassowrd'];
                $_SESSION['Aid'] = $row['Aid'];
                header("Location: admin_operations.html");
                exit();

            }
            else { 
                header("Location: login.html?error= inncorect pass and un");
                exit();
            }
        } else {
            echo "Incorrect username or password";
        }
    }

}
else {
    header("Location : login.html?error");
    exit();
}
?>
