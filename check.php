<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
	
	$job_id= $_GET['job_id'];
	$s_mail= $_GET['s_mail'];
	
	$servername="localhost";
					$username="root";
					$password="";
					$dbname="project";
					
	$conn = new mysqli($servername,$username,$password,$dbname);
	if (!$conn) {
		die('Could not connect: ' . mysqli_error($conn));
	}

	$sql1="SELECT * FROM students WHERE email = '".$s_mail."'";
	$result1 = $conn->query($sql1);
	if (!$result1) {
		die("Query 1 failed: " . $conn->error);
	}
	$row1 = $result1->fetch_assoc();

	$sql2="SELECT * FROM vacancy WHERE id = '".$job_id."'";
	$result2 = $conn->query($sql2);
	if (!$result2) {
		die("Query 2 failed: " . $conn->error);
	}
	$row2 = $result2->fetch_assoc();
	
	//Pending!
	//echo $row1['degree']." ".$row2['degree_e']." ".$row1['cpi']." ".$row2['cpi_e'] ." ". $row1['year']." ".$row2['year_e'] ." ". $row1['12p']." ".$row2['12p_e'] ." ". $row1['10p']." ".$row2['10p_e'] ;
	if ($row1 && $row2) {
  
	if($row1['degree']==$row2['degree_e'])
		echo "Degree required ".$row2['degree_e']." <img src=\"Images/tick.png\" height=\"20\" width=\"20\" ><BR>";
	else
		echo "Degree required ".$row2['degree_e']." <img src=\"Images/cross.png\" height=\"20\" width=\"20\" ><BR>";
	
	if($row1['cgpa']>=$row2['cgpa_e'])
		echo "CGPA required greater than ".$row2['cgpa_e']." <img src=\"Images/tick.png\" height=\"20\" width=\"20\" ><BR>";
	else
		echo "CGPA required greater than ".$row2['cgpa_e']." <img src=\"Images/cross.png\" height=\"20\" width=\"20\" ><BR>";
	
	if($row1['year']>=$row2['year_e'])
		echo "Year of passing required greater than ".$row2['year_e']." <img src=\"Images/tick.png\" height=\"20\" width=\"20\" ><BR>";
	else
		echo "Year of passing required greater than ".$row2['year_e']." <img src=\"Images/cross.png\" height=\"20\" width=\"20\" ><BR>";
	
	if($row1['twp']>=$row2['twp_e'])
		echo "12th % required greater than ".$row2['twp_e']." <img src=\"Images/tick.png\" height=\"20\" width=\"20\" ><BR>";
	else
		echo "12th % required greater than ".$row2['twp_e']." <img src=\"Images/cross.png\" height=\"20\" width=\"20\" ><BR>";
	
	if($row1['tenp']>=$row2['tenp_e'])
		echo "10th % required greater than ".$row2['tenp_e']." <img src=\"Images/tick.png\" height=\"20\" width=\"20\" ><BR>";
	else
		echo "10th % required greater than ".$row2['tenp_e']." <img src=\"Images/cross.png\" height=\"20\" width=\"20\" ><BR>";
	
		if ($row1['degree'] == $row2['degree_e'] && $row1['cgpa'] >= $row2['cgpa_e'] /* Add other criteria here */) {
            echo "<h3>You're eligible!</h3><br>";
           // echo "<input type=\"button\" value=\"Apply\" onclick=\"apply_fun('".$job_id."','".$s_mail."','".$row2['company_name']."',this)\">";
        } else {
            echo "<h3>You're not eligible!</h3><br>";
        }
	} else {
		// Handle the case when no data is found
		echo "No data found.";
	}
    

?>
</body>
<footer>
</footer>
</html>