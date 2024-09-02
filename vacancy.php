<html>
	<head>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="CSS/style1.css">
		<nav class="navbar navbar-fixed-top" id="top-nav">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Campus Recruitment System</a>
				</div>
				<ul id="list1" class="nav navbar-nav">
					<li class="active"><a href="index.html">Home</a></li>
				    <li class="active"><a href="index.html">Logout</a></li>
				</ul>
			</div>
		</nav>
	  </head>
	  <body>
	  
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

		
		

		if($_SERVER["REQUEST_METHOD"]=="POST"){
			$job_title=$_POST['job_title'];
			$salary=$_POST['salary'];
			$deadline=$_POST['deadline'];
			$bond=$_POST['bond'];
			$year=$_POST['year'];
			$cgpa=$_POST['cgpa'];
			$twp=$_POST['twp'];
			$tenp=$_POST['tenp'];
			$branch=$_POST['branch'];
			$age=$_POST['age'];
			$degree=$_POST['degree'];
			/*echo $name . "<BR>";
			echo $email. "<BR>";
			echo $dob. "<BR>";
			echo $branch. "<BR>";
			echo $year. "<BR>";
			echo $cpi. "<BR>";
			echo $twp. "<BR>";
			echo $tenp. "<BR>";
			echo $pwd. "<BR>";
			echo $phone. "<BR>";
			echo $degree. "<BR>";*/
			
			$sql="INSERT into vacancy(company_name,job_title,salary,deadline,bond,age_e,degree_e,cgpa_e,year_e,twp_e,tenp_e) values(\"".$_SESSION['name']."\",\"".$job_title."\",".$salary.",\"".$deadline."\",".$bond.",".$age.",\"".$degree."\",".$cgpa.",".$year.",".$twp.",".$tenp." );";
			;
			
			if($conn->query($sql)===TRUE){
			$GLOBALS['conn']->close();
		echo "<SCRIPT type='text/javascript'> //not showing me this
								alert('Vacancy Created Succesfully!!');
								window.location.replace(\"company_dash.php\");
							</SCRIPT>";
		}else{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
			
			/*
			$GLOBALS['conn']->close();
			header('Location: company_dash.php ');
			echo '<script language="javascript">';
			echo 'alert("Vacancy succesfully created!")';
			echo '</script>';*/
		}
	  ?>
	  
		<div class=" container-fluid " id="dash" >
		<h2>CREATE VACANCY</h2>
		<form action="vacancy.php" method="POST" enctype="multipart/form-data">
        <div class="container">
		   <h3>Job Details</h3>
           <hr>
           <ol>
          
		   
		   <li><label for="job_title"><b>Job Title:</b></label>
           <input type="text" name="job_title" required></li>

          <li><label for="salary"><b>Salary:</b></label>
          <input type="decimal" placeholder="in LPA" name="salary" required> </li>
	
			
		  
	      <li><label for="deadline"><b>Deadline:</b></label>
          <input type="date" placeholder=" " name="deadline"></li>
	
          <li><label for="bond"><b>Bond:</b></label>
          <input type="number" placeholder=" " name="bond"></li>
	
	      <li><label for="tenp"><b>10th Percentage:</b></label>
          <input type="decimal" placeholder="Ex.85.5" name="tenp"></li>
		  
		  <li><label for="twp"><b>12th Percentage:</b></label>
          <input type="decimal" placeholder="Ex.85.5" name="twp"></li>
		  
		  <li><label for="year"><b>Year:</b></label>
          <input type="number" placeholder="Ex.2019" name="year"></li>
		  
		  <li><label for="cgpa"><b>CGPA:</b></label>
          <input type="decimal" placeholder="Enter minimum cgpa required" name="cgpa"></li>
		  
		  <li><label for="degree"><b>Course:</b></label>
	      <select name="degree" placeholder="Select">
          <option label="BTech">B.Tech</option>
		  <option label="MTech">M.Tech</option>
		  </select></li>
		  
		  <li><label for="branch"><b>Branch:</b></label>
	      <select name="branch" placeholder="Select">
          <option label="CSE">CSE</option>
          <option label="IT">IT</option>
          <option label="ECE">ECE</option>
	      <option label="ME">ME</option>
	      <option label="EEE">EEE</option>
	      <option label="CE">CE</option>
	      </select></li>
		  
		  <li><label for="age"><b>Maximum age:</b></label>
          <input type="number" placeholder=" " name="age"></li>
		  
		  
		  </ol>
          <hr>
		</div>
    <button type="submit" class="registerbtn">Create Vacancy</button>
  
		</form>
  		</div>

	</body>
		<footer>
		<nav class="navbar navbar-footer" id="bottom-nav" style="width:110%">
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
					<li><a href='https://www.facebook.com/lbscekasaragod?mibextid=LQQJ4d' class="fa fa-facebook fa-2x"></a></li>
                        <li><a href='https://www.instagram.com/lbsce_ksd/?igsh=MWhmcWltanIzZHc5Zw%3D%3D&utm_source=qr' class="fa fa-instagram fa-2x"></a></li>
                        <li><a href='https://in.linkedin.com/school/l.b.s-college-of-engineering-kasaragod/' class="fa fa-linkedin fa-2x"></a></li>
                    </ul>
								</div>
			</div>
		</nav>
	</footer>
</html>