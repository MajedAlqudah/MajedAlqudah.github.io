<?php
include "db_conn.php";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$formType = isset($_POST["formType"]) ? $_POST["formType"] : '';
	//for participant
	$ID = isset($_POST["ID"]) ? $_POST["ID"] : '';
    $FName = isset($_POST["fname"]) ? $_POST["fname"] : '';
    $LName = isset($_POST["lname"]) ? $_POST["lname"] : '';
    $Email = isset($_POST["email"]) ? $_POST["email"] : '';
    $sex = isset($_POST["sex"]) ? $_POST["sex"] : '';
    $BOD = isset($_POST["bod"]) ? $_POST["bod"] : '';
    $Passw = isset($_POST["passw"]) ? $_POST["passw"] : '';
    $pjname = isset($_POST["Pjname"]) ? $_POST["Pjname"] : '';
    $pssn = isset($_POST["ssn"]) ? $_POST["ssn"] : '';
	$operation = isset($_POST["op"]) ? $_POST["op"] : '';

	//for admins
$AID = isset($_POST["AID"]) ? $_POST["AID"] : '';
$Aemail = isset($_POST["aE"]) ? $_POST["aE"] : '';
$Aname = isset($_POST["aname"]) ? $_POST["aname"] : '';
$Passa = isset($_POST["passA"]) ? $_POST["passA"] : '';
$operationA = isset($_POST["opA"]) ? $_POST["opA"] : '';

//operations : 




//operations for participants	


if ($operation == "Insert") {
    $q1 = "INSERT INTO conference_participant VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt1 = mysqli_prepare($connection, $q1);
    mysqli_stmt_bind_param($stmt1, 'sssssss', $ID, $pssn, $FName, $LName, $BOD, $pjname, $sex);
    $result1 = mysqli_stmt_execute($stmt1);

    $q2 = "INSERT INTO participant_username VALUES (?, ?, ?)";
    $stmt2 = mysqli_prepare($connection, $q2);
    mysqli_stmt_bind_param($stmt2, 'sss', $ID, $Email, $Passw);
    $result2 = mysqli_stmt_execute($stmt2);

    if ($result1 && $result2)
        echo "Inserted correctly";
    else
        echo "Not inserted";
}

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
           P_project_name = ?, 
           Psex = ? 
           WHERE Pid = ?";
    $stmt1 = mysqli_prepare($connection, $q1);
    mysqli_stmt_bind_param($stmt1, 'sssssss', $pssn, $FName, $LName, $BOD, $pjname, $sex, $ID);
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



//admin submition 


if ($operationA == "Insert") {
	$q = "INSERT INTO conf_admin VALUES (?, ?, ?,?)";
	$stmt = mysqli_prepare($connection, $q);
	mysqli_stmt_bind_param($stmt, 'ssss', $AID,  $Aname, $Passa, $Aemail);
	$result = mysqli_stmt_execute($stmt);
	
	if ($result)
		echo "Inserted correctly";
	else
		echo "Not inserted";
}

if ($operationA == "Delete") {
	$q = "DELETE FROM conf_admin WHERE Aid = ?";
	$stmt = mysqli_prepare($connection, $q);
	mysqli_stmt_bind_param($stmt, 's', $AID);
	$result = mysqli_stmt_execute($stmt);
	
	if ($result)
		echo "deleted correctly";
	else
		echo "Not deleted";
}

if ($operationA == "Update") {
	$q1 = "UPDATE conf_admin SET  Auname = ?, Apassword = ?, Aemail = ? WHERE Aid = ?";
    $stmt1 = mysqli_prepare($connection, $q1);
    mysqli_stmt_bind_param($stmt1, 'ssss', $Aname, $Passa, $Aemail, $AID);
    $result1 = mysqli_stmt_execute($stmt1);

    

    if ($result1)
        echo "Updated correctly";
    else
        echo "Not updated";
}

if ($operationA == "Display") {
    $q = "SELECT * FROM conf_admin WHERE Aid = ?";
    $stmt = mysqli_prepare($connection, $q);
    mysqli_stmt_bind_param($stmt, 's', $AID);
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
            <h2>Admin Information</h2>
            <p>ID: <?php echo $r['Aid']; ?></p>
            <p>Name: <?php echo $r['Auname']; ?></p>
            <!-- Add more fields as needed -->
        </div>
	        </body>
        <?php
    } else {
        echo "Error fetching data";
    }
}




?>
