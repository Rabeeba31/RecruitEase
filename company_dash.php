<html>
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="CSS/style1.css">
		<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

		<nav class="navbar navbar-fixed-top" id="top-nav">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" style="font-family:Nova Square" href="#">Campus Recruitment System</a>
				</div>
				<ul id="list1" class="nav navbar-nav">
					<li class="active"><a href="index.html">Home</a></li>
					<li class="active"><a href="index.html">Logout</a></li>
					<li class="active"><a href="company_edit.php">Edit</a></li>
					
				</ul>
			</div>
		</nav>
		
		<script>
			function trclick(s_mail,job_id,object){
				//alert("Clicked hoh ho");
				if (s_mail == "") {
					return;
				} else { 
					if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp1 = new XMLHttpRequest();
						xmlhttp2 = new XMLHttpRequest();
					} else {
						// code for IE6, IE5
						xmlhttp1 = new ActiveXObject("Microsoft.XMLHTTP");
						xmlhttp2 = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp1.onreadystatechange = function() {
						if (xmlhttp1.readyState == 4 && xmlhttp1.status == 200) {
							document.getElementById("display").innerHTML = xmlhttp1.responseText;
						}
					};
					xmlhttp2.onreadystatechange = function() {
						if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {
							document.getElementById("dispjob").innerHTML = xmlhttp2.responseText;
						}
					};
					xmlhttp1.open("GET","getstudent.php?email="+s_mail,true);
					xmlhttp2.open("GET","getjobdetails.php?job_id="+job_id,true);
					xmlhttp1.send();
					xmlhttp2.send();
				}
			};
			
			function changeStatus(val,app_id,object){
					alert(val+" "+app_id);
					if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
					} else {
						// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					/*xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("sapp").innerHTML = this.responseText;
						}
					};*/
					xmlhttp.open("GET","updateStatus.php?s="+val+"&app_id="+app_id,true);
					xmlhttp.send();
				
			};
		</script>
	</head>
	
	<body>
		<h2 align="center" style="font-family:Nova Square">COMPANY DASHBOARD</h2>
		<div class=" container-fluid" id="dash">
			<div class="row">
				<div class="col-sm-3" style= " margin:10px;" >
					<div class="well row" style="background-color: #AED4F1 ; height:auto; ">

					<img class="img-responsive " src="CSS/Image/c1.jpg" height="120px" width="120px" align="center" style="border-radius:50%"></img> 
					<br>
					<br>
					<?php
						session_start();
						$servername="localhost";
						$username="root";
						$password="";
						$dbname="project";
						
						$conn = new mysqli($servername,$username,$password,$dbname);

						if($conn->connect_error){
							die("Connection failed: ".$conn->connect_error);
						}
						$sql="Select * from company where email=\"".$_SESSION['email']."\"";
						$result = $conn->query($sql);
						$row=$result->fetch_assoc();
						 $_SESSION['name']=$row['name'];
						echo"  <div class=\"table-responsive table-bordered\" >            
						<table class=\"table table-hover\">
						  <tr>
							<th>Name</th>
							<td>".$row['name']."</td>
							</tr>
						  <tr>
							<th>Email</th>
							<td>".$row['email']."</td>

						  </tr>
						  <tr>
							<th>Contact No.</th>
							<td>".$row['phone']."</td>

						  </tr>
						 	<th>C.E.O.</th>
							<td>".$row['ceo']."</td>

						  </tr>
						  <tr>
							<th>C.T.O.</th>
							<td>".$row['cto']."</td>

						  </tr>
						  
						  <tr>
							<th>H.R.</th>
							<td>".$row['hr']."</td>
							</tr>

						</tbody>
					  </table>
					</div>";
					?>
				</div>
					<div class="well row" style="background-color: #AED4F1 ; height:auto;">
						<h3> Company jobs </h3>
						<?php
							
							$servername="localhost";
												$username="root";
												$password="";
												$dbname="project";
												
							$conn = new mysqli($servername,$username,$password,$dbname);
							if (!$conn) {
								die('Could not connect: ' . mysqli_error($conn));
							}

							$sql="SELECT * FROM vacancy WHERE company_name = '".$_SESSION['name']."'";
							$result = $conn->query($sql);



							echo "<div class=\"table-responsive table-bordered\" >            
											  <table class=\"table table-hover\">
											  <tr>
											  <th> Job Id </th>
											   <th>Job Title</th>
											   <th>Salary</th>
											   </tr>
											   ";
											   
										while($row = $result->fetch_assoc()){	   
												echo "<form action=\"deleteVacancy.php\" method=\"POST\">";
												echo		   "
											   <tr>
											   <td> <input  type=\"number\" name=\"job_id\" value=\"".$row['id']."\" readonly maxlength=\"4\" size=\"4\" style=\"width:40px;\"></td>
											   <td>".$row['job_title']."</td>
											   <td>".$row['salary']."";
												echo " <button type=\"submit\">X</button> </td>";
											   echo "</tr>";
											   echo "</form>";
										}	
										
										echo	   "
											   </table>
											   </div>";		

						?>
						<a href="vacancy.php" style="color : black">CREATE VACANCY</a>
					</div>
				</div>
				<div class="well col-sm-4" style="background-color:#AED4F1; height:auto; margin:10px;">
					<h3>DETAILS ABOUT THE STUDENT</h3>
					<div id="display">
						<img class="img-responsive " src="CSS/Image/c1.jpg" height="120px" width="120px" align="center" style="border-radius:50%"></img>
						<div class="table-responsive table-bordered" >            
							<table class="table table-hover">
							  <tr>
								<th>Name</th>
								<td>---</td>
							  </tr>
							  <tr>
								<th>Email</th>
								<td>---</td>

							  </tr>
							  <tr>
								<th>Date of Birth</th>
								<td>---</td>

							  </tr>
							  <tr>
								<th>Branch</th>
								<td>---</td>
								</tr>
							  <tr>
								<th>Year of Passing out</th>
								<td>---</td>

							  </tr>
							  <tr>
								<th>CPI</th>
								<td>---</td>

							  </tr>
							  
							  <tr>
								<th>12th Percentage</th>
								<td>---</td>
								</tr>
							  <tr>
								<th>10th Percentage</th>
								<td>---</td>

							  </tr>
							  <tr>
								<th>Contact No.</th>
								<td>---</td>

							  </tr>
							  
							  <tr>
								<th>Course</th>
								<td>---</td>
							  </tr>

							</table>
						</div>
					</div>
</div>
				<div class="well col-sm-4" style="background-color:#AED4F1; height:auto; margin:10px;">
					<h2>NAME OF STUDENTS </h2>
					<p>Click for more details about the student</p>
					<div id="sapp">
					<?php
					 $servername="localhost";
					 $username="root";
					 $password="";
					 $dbname="project";
					 
					 $conn = new mysqli($servername,$username,$password,$dbname);
					 
					 if($conn->connect_error){
						 die("Connection failed: ".$conn->connect_error);
						 }
						 
						 
						$sql="Select name,email from students WHERE cgpa_verified = 1";
						$result=$conn->query($sql);
						
			
						echo "<div class=\"table-responsive table-bordered\" >            
						<table class=\"table table-hover\">
						  <thead>
							<tr>
							  <th>Name</th>
							  <th>Email</th>
							</tr>
						  </thead>
						  <tbody>
						  ";
							  
						  while($row = $result->fetch_assoc()){
							echo "<tr id=\"clist\" onclick=\"trclick('".$row['email']."','".$row['name']."',this)\">";
							echo "<td>".$row['name']. "</td>";
							echo "<td>".$row['email']."</td>";
							echo "</tr>";
						  }
					  echo	"</tbody>
						</table>
					  </div>
					  ";
						?>
					  </div>
				</div>
	
				</div>
			
		</div>
	</body>

	<footer>
		<nav class="navbar navbad-default" id="bottom-nav">
			<div class="container-fluid">
				<div id="col1" >
					<ul id="blist1">
						<li><a href='#'>About Us</a></li>
						<li><a href='#'>FAQs</a></li>
						<li><a href='#'>Contact Us</a></li>
					</ul>
				</div>
				
				
				<div id="col3" class=" container-fluid">
				
					<ul id="blist3" >
					<li> <a href='https://www.facebook.com/lbscekasaragod?mibextid=LQQJ4d'  class="fa fa-facebook fa-2x" ></a></i></li>
						<li> <a href='https://www.instagram.com/lbsce_ksd/?igsh=MWhmcWltanIzZHc5Zw%3D%3D&utm_source=qr' class="fa fa-instagram fa-2x"></a></i></li>
						<li> <a href='https://in.linkedin.com/school/l.b.s-college-of-engineering-kasaragod/' class="fa fa-linkedin fa-2x"></a></i></li>
				
						</ul>
		
				</div>
			</div>
		</nav>
	</footer>
</html>