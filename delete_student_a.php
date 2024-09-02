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
					<li class="active"><a href="admin_dash.php">Back</a></li>
					<li class="active"><a href="index.html">Logout</a></li>
					
					
				</ul>
			</div>
		</nav>
		
		 <?php
			  session_start();
				$servername="localhost";
					$username="root";
					$password="";
					$dbname="project";
					
					function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

					// Create connection
                   $conn = new mysqli($servername, $username, $password, $dbname);
                 // Check connection
                 if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                  } 
				  
			if($_SERVER["REQUEST_METHOD"]=="POST"){
					$uname = $_POST['uname'];
					$sql1="SELECT * from students where email=\"" . $uname . "\"";
					$result = $GLOBALS['conn']->query($sql1);
					if($result->num_rows == 0){
					    phpAlert(   "Wrong username entered!"   );
						//header('Location: student_dash.php');

					}else{
					$row=$result->fetch_assoc();
						
							$sql2="Delete from students where email='".$uname."'";
							$result = $GLOBALS['conn']->query($sql2);
							//phpAlert("Deleted!");
							//header('Location: index.html');
							
							echo "<SCRIPT type='text/javascript'> //not showing me this
								alert('Deleted');
								window.location.replace(\"admin_dash.php\");
							</SCRIPT>";
						
					}
			}
        //echo $uname . "<BR>";
        //echo $pwd . "<BR>";
    
				 
           $conn->close();
          ?>
		
	</head>
	<body>

		
		<div class="well text-center" id="main">
  			<img class="img-responsive " src="Images/bye.png" height="200" width="700">
  		</div>
		
	<div class="well container-fluid text-center" id="frm1">
		<form action="" method="POST">
			<div>
				<label for="usrnm"><b>Enter Username to delete</b></label>
				<input type="text" placeholder="Enter Username" name="uname" id="usrnm" required>
			</div>
			<div>
				<button type="submit">Delete</button>
			</div>
        </form>
</div>
	
		
	</body>
	 <footer>
		<nav class="navbar navbad-default" id="bottom-nav">
			<div class="container-fluid">
				<div id="col1" >
					<ul id="blist1">
					
                    <li><a href='https://lbscek.ac.in/career-guidance-placement-unit-cgpu/'>About Us</a></li>
                    <li><a href='faq.html'>FAQs</a></li>
                    <li><a href='https://lbscek.ac.in/contact-2/'>Contact Us</a></li>
                
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
