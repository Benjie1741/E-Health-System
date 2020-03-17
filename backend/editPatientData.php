<?php
require('../includes/conn.inc.php');

$address = $_POST['address'];
$phoneNumber = $_POST['num'];
$email = $_POST['email'];
$medicalHistory = $_POST['medicalHistory'];
$illness = $_POST['illness'];
$allergies = $_POST['allergies'];
$prescription = $_POST['prescription'];
$patientID = $_POST['pid'];

try {
	$sql = "UPDATE patients 
			SET userAddress=:userAddress,
				phoneNumber=:phoneNumber, email=:email,
				medicalHistory=:medicalHistory, illness=:illness,
				allergies=:allergies,
                prescription=:prescription
            WHERE PatientID = $patientID";
            echo '<script>console.log('. json_encode($sql) . '</script>';
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':userAddress', $address);
            $stmt->bindParam(':phoneNumber', $phoneNumber);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':medicalHistory', $medicalHistory);
            $stmt->bindParam(':illness', $illness);
            $stmt->bindParam(':allergies', $allergies);
            $stmt->bindParam(':prescription', $prescription);

            $stmt->execute();

            header("Location: ../doctor/homeDoc.php");
            
}catch (\Exception $e) {

        print $e;

        $message = $e;
        echo "<script type='text/javascript'>alert('$message');
        location.href = '../doctor/homeDoc.php';
        </script>";
        header("Location: ../doctor/homeDoc.php");
}

?>
