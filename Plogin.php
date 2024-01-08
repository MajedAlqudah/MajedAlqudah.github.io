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
        header("Location: PLogin.html?error= user name required");
        exit();
    }

    elseif(empty($passw))
    {
        header("Location: PLogin.html?error= passwword required");
        exit();
    }
    
    else
    {
        $sql = "SELECT * FROM participant_username WHERE Pemail = '$uname' AND Ppassword = '$passw'";

        $result = mysqli_query($conn,$sql);

        if ($result === false) {
            // Query failed
            die("Error in SQL query: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row["Pemail"] === $uname && $row["Ppassword"] === $passw)
            {
                $_SESSION['Pemail'] = $row['Pemail'];
                $_SESSION['Ppassword'] = $row['Ppassword'];
                $_SESSION['PID'] = $row['PID'];
                header("Location: participant_operations.html");
                exit();

            }
            else { 
                header("Location: PLogin.html?error= inncorect pass and un");
                exit();
            }
        } else {
            echo "Incorrect username or password";
        }
    }

}
else {
    header("Location : PLogin.html?error");
    exit();
}
?>
