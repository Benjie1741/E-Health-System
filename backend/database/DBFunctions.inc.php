<?php

 	//Testing CRUD
	//Use this code to test if they work.
	//Call it from a different page and include this file

	//Testing Create function
	//create array for inputting to db
	//$testArray = array("1", "6","1", "75", "Swimming", "2020-05-08");
	//CreateNewHealthData($testArray);

	//Testing read function
	//$tableName = "healthdata";
	//$data = returnAllFromTable($tableName);

	//Testing getOneFromTable
	//$healthDataID = "1";
	//$test = getOneRecordFromTable($healthDataID)

	//Testing update
	//$testArray = array("9", "1", "7","2", "80", "Swimming, Yoga", "2020-05-09");
	//updateRecordFromHealthData($testArray)

	//Testing delete
	//$healthDataID = "9";
	//deleteRecord($healthDataID);

//Functions for healthData table

//Array Format for inputting things into db:
//Date format is "yyyy-mm-dd"
//For the healthData table:
//Array(healthDataID, userID, hoursOfSleep, hoursOfExercise, heartRate, exerciseDone,dateOfExercise)
//array("3", "2", "9", "74", "Badminton, Basketball", "2020-07-25")

//Create new healthData for patient
function CreateNewHealthData($healthDataArray)
{
	//need to require connection to db
	require('includes/conn.inc.php');

	//SQL script to insert data to healthdata table
	$sql = "INSERT INTO healthdata 
			(userID, hoursOfSleep, hoursOfExercise, 
			heartRate, exerciseDone, dateOfExercise)
			VALUES 
			($healthDataArray[0], $healthDataArray[1], $healthDataArray[2], 
			$healthDataArray[3], '$healthDataArray[4]', '$healthDataArray[5]')";

	//prepare query for execution
	$stmt = $pdo->prepare($sql);

	//bind params 
	$stmt->bindParam(':userID', $healthDataArray[0]);
	$stmt->bindParam(':hoursOfSleep', $hoursOfSleep[1]);
	$stmt->bindParam(':hoursOfExercise', $hoursOfExercise[2]);
	$stmt->bindParam(':heartRate', $heartRate[3]);
	$stmt->bindParam(':exerciseDone', $exerciseDone[4]);
	$stmt->bindParam(':dateOfExercise', $dateOfExercise[6]);

	//execute sql code
	if($stmt->execute()){
		echo "<div class='alert alert-success'>Record was saved.</div>";
	}else{
		echo "<div class='alert alert-danger'>Unable to save record.</div>";
	}
}

//Function for getting one record from healthData table
function getOneRecordFromTableHealthData($healthDataID)
{
	//require connection
	require('includes/conn.inc.php');

	//sql query and select the one you want to get
	$sql = "SELECT * FROM healthdata WHERE healthDataID = $healthDataID";

	//prepare query and run
	$stmt = $pdo->prepare($sql);

	if($stmt->execute()){
		echo "<div class='alert alert-success'>You got one record.</div>";
	}else{
		echo "<div class='alert alert-danger'>Unable to get one record.</div>";
	}

	//store retrieved row from db to variable
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	return $row;
}

//Function for Updating a record from the healthdata table
function updateRecordFromHealthData($recordArray)
{
	//require connection
	require('includes/conn.inc.php');

	//sql query for update
	$sql = "UPDATE healthdata 
			SET healthDataID=:healthDataID, userID=:userID,
				hoursOfSleep=:hoursOfSleep, hoursOfExercise=:hoursOfExercise,
				heartRate=:heartRate, exerciseDone=:exerciseDone,
				dateOfExercise=:dateOfExercise
			WHERE healthDataID = $recordArray[0]";

	//prepare query and run
	$stmt = $pdo->prepare($sql);

	//bind params
	$stmt->bindParam(':healthDataID', $recordArray[0]);
	$stmt->bindParam(':userID', $recordArray[1]);
	$stmt->bindParam(':hoursOfSleep', $recordArray[2]);
	$stmt->bindParam(':hoursOfExercise', $recordArray[3]);
	$stmt->bindParam(':heartRate', $recordArray[4]);
	$stmt->bindParam(':exerciseDone', $recordArray[5]);
	$stmt->bindParam(':dateOfExercise', $recordArray[6]);

	if($stmt->execute()){
		echo "<div class='alert alert-success'>You updated one record from the healthData table.</div>";
	}else{
		echo "<div class='alert alert-danger'>Unable to update record.</div>";
	}
}

//Function for deleting records from the healthData table
function deleteRecordFromHealthData($userID)
{
	//require connection
	require('includes/conn.inc.php');

	//sql script to delete using ID
	$sql = "DELETE FROM healthData WHERE healthDataID = $userID";
	$stmt = $pdo->prepare($sql);

	if($stmt->execute()){
		echo "<div class='alert alert-success'>You successfully deleted a record.</div>";
	}else{
		echo "<div class='alert alert-danger'>Unable to delete record.</div>";
	}
}

//Array Format for inputting things into db:
//Date format is "yyyy-mm-dd"
//For the patients table:
//Array(patientID, firstName, lastName, dateOfBirth, age, address, phoneNumber, email, 
//		password, bloodType, medicalHistory, illness, allergies, doctorID, prescription)
//array("4", "Steve", "Buscemi", "2020-08-23", "46", "Flat F, Leadmill Point",
//		"01234567891", "SBuscemi@fake.com", "SB123", "AB", "None", "Coronavirus", "Peanuts", "2", "Paracetamol")

//Functions for patients table
function CreateNewPatient($patientsTable)
{
	//need to require connection to db
	require('includes/conn.inc.php');

	//SQL script to insert data to healthdata table
	$sql = "INSERT INTO patients 
			(patientID, firstName, lastName, dateOfBirth, age, userAddress, phoneNumber, email,
			userPassword, bloodType, medicalHistory, illness, allergies, doctorID, prescription)
			VALUES 
			($patientsTable[0], '$patientsTable[1]', '$patientsTable[2]', '$patientsTable[3]', $patientsTable[4],
			'$patientsTable[5]', $patientsTable[6], '$patientsTable[7]', '$patientsTable[8]', '$patientsTable[9]',
			'$patientsTable[10]', '$patientsTable[11]', '$patientsTable[12]', $patientsTable[13], '$patientsTable[14]')";

	//prepare query for execution
	$stmt = $pdo->prepare($sql);

	//bind params 
	$stmt->bindParam(':patientID', $patientID);
	$stmt->bindParam(':firstName', $firstName);
	$stmt->bindParam(':lastName', $lastName);
	$stmt->bindParam(':dateOfBirth', $dateOfBirth);
	$stmt->bindParam(':age', $age);
	$stmt->bindParam(':userAddress', $userAddress);
	$stmt->bindParam(':phoneNumber', $phoneNumber);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':userPassword', $userPassword);
	$stmt->bindParam(':bloodType', $bloodType);
	$stmt->bindParam(':medicalHistory', $medicalHistory);
	$stmt->bindParam(':illness', $illness);
	$stmt->bindParam(':allergies', $allergies);
	$stmt->bindParam(':doctorID', $doctorID);
	$stmt->bindParam(':prescription', $prescription);

	//execute sql code
	if($stmt->execute()){
		echo "<div class='alert alert-success'>Record was saved.</div>";
	}else{
		echo "<div class='alert alert-danger'>Unable to save record.</div>";
	}
}

//Function for getting one record from healthData table
function getOneRecordFromTablePatients($patientID)
{
	//require connection
	require('includes/conn.inc.php');

	//sql query and select the one you want to get
	$sql = "SELECT * FROM patients WHERE patientID = $patientID";

	//prepare query and run
	$stmt = $pdo->prepare($sql);

	if($stmt->execute()){
		echo "<div class='alert alert-success'>Got one record from table.</div>";
	}else{
		echo "<div class='alert alert-danger'>Unable to get one record.</div>";
	}

	//store retrieved row from db to variable
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	return $row;
}

//Function for Updating a record from the healthdata table
function updateRecordFromPatients($recordArray)
{
	//require connection
	require('includes/conn.inc.php');

	//sql query for update
	$sql = "UPDATE patients 
			SET patientID=:patientID, firstName=:firstName, lastName=:lastName,
				dateOfBirth=:dateOfBirth, age=:age, userAddress=:userAddress,
				phoneNumber=:phoneNumber, email=:email, userPassword=:userPassword,
				bloodType=:bloodType, medicalHistory=:medicalHistory, illness=:illness,
				allergies=:allergies, doctorID=:doctorID, prescription=:prescription
			WHERE patientID = $recordArray[0]";

	//prepare query and run
	$stmt = $pdo->prepare($sql);

	//bind params
	$stmt->bindParam(':patientID', $recordArray[0]);
	$stmt->bindParam(':firstName', $recordArray[1]);
	$stmt->bindParam(':lastName', $recordArray[2]);
	$stmt->bindParam(':dateOfBirth', $recordArray[3]);
	$stmt->bindParam(':age', $recordArray[4]);
	$stmt->bindParam(':userAddress', $recordArray[5]);
	$stmt->bindParam(':phoneNumber', $recordArray[6]);
	$stmt->bindParam(':email', $recordArray[7]);
	$stmt->bindParam(':userPassword', $recordArray[8]);
	$stmt->bindParam(':bloodType', $recordArray[9]);
	$stmt->bindParam(':medicalHistory', $recordArray[10]);
	$stmt->bindParam(':illness', $recordArray[11]);
	$stmt->bindParam(':allergies', $recordArray[12]);
	$stmt->bindParam(':doctorID', $recordArray[13]);
	$stmt->bindParam(':prescription', $recordArray[14]);

	if($stmt->execute()){
		echo "<div class='alert alert-success'>Successfuly updated a record.</div>";
	}else{
		echo "<div class='alert alert-danger'>Unable to update table.</div>";
	}
}

//Function for deleting records from the patients table
function deleteRecordFromPatients($patientID)
{
	//include connection
	require('includes/conn.inc.php');

	//script for delete
	$sql = "DELETE FROM patients WHERE patientID = $patientID";
	$stmt = $pdo->prepare($sql);

	if($stmt->execute()){
		echo "<div class='alert alert-success'>Deleted one record from table.</div>";
	}else{
		echo "<div class='alert alert-danger'>Unable to delete record.</div>";
	}
}

//Array Format for inputting things into db:
//Date format is "yyyy-mm-dd"
//For the doctors table:
//Array(doctorID, firstName, lastName, dateOfBirth, age, userAddress, phoneNumber, 
//		email, userPassword, licenseRevalidationDate, specialty, clearanceLevel)
//array("6", "Ainsley", "Harriot", "1979-03-04", "46", "Great british bake off tent",
//		 "012112369875", "lambSauce@chelf.wow", "gordon", "2021-01-01", "gastronomy", "1")

//Functions for doctors table
function CreateNewDoctor($doctorArray)
{
	//need to require connection to db
	require('includes/conn.inc.php');

	//SQL script to insert data to healthdata table
	$sql = "INSERT INTO doctors 
			(doctorID, firstName, lastName, dateOfBirth, age, userAddress, phoneNumber, 
			email, userPassword, licenseRevalidationDate, specialty, clearanceLevel)
			VALUES 
			($doctorArray[0], '$doctorArray[1]', '$doctorArray[2]', '$doctorArray[3]', 
			$doctorArray[4], '$doctorArray[5]', $doctorArray[6], '$doctorArray[7]', 
			'$doctorArray[8]', '$doctorArray[9]', '$doctorArray[10]', $doctorArray[11])";

	//prepare query for execution
	$stmt = $pdo->prepare($sql);

	//bind params 
	$stmt->bindParam(':doctorID', $doctorID);
	$stmt->bindParam(':fistName', $firstName);
	$stmt->bindParam(':lastName', $lastName);
	$stmt->bindParam(':dateOfBirth', $dateOfBirth);
	$stmt->bindParam(':age', $age);
	$stmt->bindParam(':userAddress', $userAddress);
	$stmt->bindParam(':phoneNumber', $phoneNumber);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':userPassword', $userPassword);
	$stmt->bindParam(':licenseRevalidationDate', $licenseRevalidationDate);
	$stmt->bindParam(':specialty', $specialty);
	$stmt->bindParam(':clearanceLevel', $clearanceLevel);

	//execute sql code
	if($stmt->execute()){
		echo "<div class='alert alert-success'>Record was saved.</div>";
	}else{
		echo "<div class='alert alert-danger'>Unable to save record.</div>";
	}
}

//Function for getting one record from doctors table
function getOneRecordFromTableDoctors($doctorID)
{
	//require connection
	require('includes/conn.inc.php');

	//sql query and select the one you want to get
	$sql = "SELECT * FROM doctors WHERE doctorID = $doctorID";

	//prepare query and run
	$stmt = $pdo->prepare($sql);

	if($stmt->execute()){
		echo "<div class='alert alert-success'>Selected one record from table.</div>";
	}else{
		echo "<div class='alert alert-danger'>Unable to get one record.</div>";
	}

	//store retrieved row from db to variable
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	return $row;
}

//Function for Updating a record from the healthdata table
function updateRecordFromDoctor($recordArray)
{
	//require connection
	require('includes/conn.inc.php');

	//sql query for update
	$sql = "UPDATE doctors 
			SET doctorID=:doctorID, firstName=:firstName, lastName=:lastName,
				dateOfBirth=:dateOfBirth, age=:age, userAddress=:userAddress,
				phoneNumber=:phoneNumber, email=:email, userPassword=:userPassword,
				licenseRevalidationDate=:licenseRevalidationDate, specialty=:specialty,
				clearanceLevel=:clearanceLevel
			WHERE doctorID = $recordArray[0]";

	//prepare query and run
	$stmt = $pdo->prepare($sql);

	//bind params
	$stmt->bindParam(':doctorID', $recordArray[0]);
	$stmt->bindParam(':firstName', $recordArray[1]);
	$stmt->bindParam(':lastName', $recordArray[2]);
	$stmt->bindParam(':dateOfBirth', $recordArray[3]);
	$stmt->bindParam(':age', $recordArray[4]);
	$stmt->bindParam(':userAddress', $recordArray[5]);
	$stmt->bindParam(':phoneNumber', $recordArray[6]);
	$stmt->bindParam(':email', $recordArray[7]);
	$stmt->bindParam(':userPassword', $recordArray[8]);
	$stmt->bindParam(':licenseRevalidationDate', $recordArray[9]);
	$stmt->bindParam(':specialty', $recordArray[10]);
	$stmt->bindParam(':clearanceLevel', $recordArray[11]);

	if($stmt->execute()){
		echo "<div class='alert alert-success'>Record successfuly updated.</div>";
	}else{
		echo "<div class='alert alert-danger'>Unable to update record.</div>";
	}
}

//Function for deleting records from the db
function deleteRecordFromDoctors($doctorID)
{
	require('includes/conn.inc.php');

	$sql = "DELETE FROM doctors WHERE doctorID = $doctorID";
	$stmt = $pdo->prepare($sql);

	if($stmt->execute()){
		echo "<div class='alert alert-success'>Deleted a record from table.</div>";
	}else{
		echo "<div class='alert alert-danger'>Unable to delete record.</div>";
	}
}

//Universal functions
//Function for reading ALL data from a table
function returnAllFromTable($tableName)
{
	//require connection
	require('includes/conn.inc.php');

	//sql query 
	$sql = "SELECT * FROM $tableName";

	//prepare query and run
	$stmt = $pdo->prepare($sql);
	$stmt->execute();

	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	//return data
	return $row;
}
?>
