<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$formType = isset($_POST["formType"]) ? $_POST["formType"] : '';
	//for participant
	$ID = isset($_POST["ID"]) ? $_POST["ID"] : '';
    $FName = isset($_POST["fname"]) ? $_POST["fname"] : '';
    $LName = isset($_POST["lname"]) ? $_POST["lname"] : '';
    $Email = isset($_POST["email"]) ? $_POST["email"] : '';
    
    $BOD = isset($_POST["bod"]) ? $_POST["bod"] : '';
    $Passw = isset($_POST["passw"]) ? $_POST["passw"] : '';
    
    $pssn = isset($_POST["ssn"]) ? $_POST["ssn"] : '';
	$operation = isset($_POST["op"]) ? $_POST["op"] : '';

	

//operations : 

$connection = mysqli_connect('localhost','root','');
if(!$connection)
	die("not connected".mysqli_connect_error());
else
	echo"";
$db = mysqli_select_db($connection,'conference_information_system');
if(!$db)
	die("no db");
else
	echo "";


//operations for participants	


if ($operation == "Delete") {
    $q1 = "DELETE FROM conference_participant WHERE Pid = ?";
    $stmt1 = mysqli_prepare($connection, $q1);
    mysqli_stmt_bind_param($stmt1, 's', $ID);
    $result1 = mysqli_stmt_execute($stmt1);

    $q2 = "DELETE FROM participant_username WHERE Pid = ?";
    $stmt2 = mysqli_prepare($connection, $q2);
    mysqli_stmt_bind_param($stmt2, 's', $ID);
    $result2 = mysqli_stmt_execute($stmt2);

    if ($result1 && $result2)
        echo "Deleted";
    else
        echo "Not deleted";
}


elseif ($operation == "Update") {
    $q1 = "UPDATE conference_participant SET 
           Pssn = ?, 
           Pfname = ?, 
           Plname = ?, 
           Pbod = ?, 
        
           WHERE Pid = ?";
    $stmt1 = mysqli_prepare($connection, $q1);
    mysqli_stmt_bind_param($stmt1, 'sssssss', $pssn, $FName, $LName, $BOD, $ID);
    $result1 = mysqli_stmt_execute($stmt1);

    $q2 = "UPDATE participant_username SET 
           Pemail = ?, 
           Ppassword = ? 
           WHERE PID = ?";
    $stmt2 = mysqli_prepare($connection, $q2);
    mysqli_stmt_bind_param($stmt2, 'sss', $Email, $Passw, $ID);
    $result2 = mysqli_stmt_execute($stmt2);

    if ($result1 && $result2)
        echo "Updated";
    else
        echo "Not updated";
}


if ($operation == "Display") {
    $q = "SELECT * FROM conference_participant WHERE Pid = ?";
    $stmt = mysqli_prepare($connection, $q);
    mysqli_stmt_bind_param($stmt, 's', $ID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $r = mysqli_fetch_assoc($result);
		?>
		<html>
		<head>
			<link rel="stylesheet" type="text/css" href="styles.css">
		</head>
		<body>
		<div class="output-container">
			<h2>Participant Information</h2>
			<p>ID: <?php echo $r['Pid']; ?></p>
			<p>First Name: <?php echo $r['Pfname']; ?></p>
			<p>Last Name: <?php echo $r['Plname']; ?></p>
			
			<p>Sex: <?php echo $r['Psex']; ?></p>
			<p>Birth Date: <?php echo $r['Pbod']; ?></p>
			<p>Project Name: <?php echo $r['P_project_name']; ?></p>
			
		</div>
		</body>
		</html>
		<?php
    } else {
        echo "Error fetching data";
    }
    }
}









?>
