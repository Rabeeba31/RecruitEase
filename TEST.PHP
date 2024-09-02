<!DOCTYPE html>
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
                <a class="navbar-brand" href="#">Campus Recruitment System</a>
            </div>
            <ul id="list1" class="nav navbar-nav">
                <li class="active"><a href="index.html">Home</a></li>
                <li class="active"><a href="delete_student_a.php">Delete Student</a></li>
                <li class="active"><a href="delete_company_a.php">Delete Company</a></li>
                <li class="active"><a href="display_arrival.php">Company_Arrival</a></li>
                <li class="active"><a href="index.html">Logout</a></li>
            </ul>
            <button id="exportBtn" class="btn btn-primary navbar-btn pull-right">Export to Excel</button>
        </div>
    </nav>
</head>

<body>
    <h2 align="center">ADMIN DASHBOARD</h2>
    <div class="container-fluid" id="dash">
        <div class="row">
            <div class="well col-sm-12" style="background-color: #AED4F1; height:auto; margin:10px;">
                <br><br>
                <div>
                    <?php
                    session_start();
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "project";
                    
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }  
                    
                    echo "<style>
                    table, th, td {
                        border: 2px solid black;
                        border-collapse: collapse;
                    }
                    th, td {
                        padding: 5px;
                        text-align: left;    
                    }
                    </style>";
                    
                    echo "<form method='POST' action=''>
                    <select type='text' name='name' placeholder='Select'>
                    <option label='students'>TOTAL REGISTERED STUDENTS</option>
                    <option label='placed students'>TOTAL PLACED STUDENTS</option>
                    <option label='companies'>TOTAL REGISTERED COMPANIES</option>
                    <option label='vacancy'>TOTAL VACANCIES</option>
                    </select>
                    <br><br>
                    <label for='cgpaFilter'>Filter by CGPA:</label>
                    <input type='number' id='cgpaFilter' name='cgpa' step='0.01'><br>
                    <label for='backlogFilter'>Filter by Backlogs:</label>
                    <input type='number' id='backlogFilter' name='backlog'><br>
                    <label>Filter by Branch:</label><br>
                    <input type='checkbox' name='branches[]' value='CSE'> Branch 1<br>
                    <input type='checkbox' name='branches[]' value='ECE'> Branch 2<br>
                    <input type='checkbox' name='branches[]' value='EEE'> Branch 3<br>
                    <button type='submit'>Apply Filter</button>
                    </form>";
                    
                    if(isset($_POST['name']) && $_POST['name']=="TOTAL REGISTERED STUDENTS") {
                        // Retrieve filter values
                        $cgpa = isset($_POST['cgpa']) ? $_POST['cgpa'] : null;
                        $backlog = isset($_POST['backlog']) ? $_POST['backlog'] : null;
                        $branches = isset($_POST['branches']) ? $_POST['branches'] : array();
                    
                        // Construct the WHERE clause for SQL query based on selected branches
                        $branchFilter = '';
                        if (!empty($branches)) {
                            $branchFilter = "AND (";
                            foreach ($branches as $key => $branch) {
                                if ($key > 0) {
                                    $branchFilter .= " OR ";
                                }
                                $branchFilter .= "branch = '" . $conn->real_escape_string($branch) . "'";
                            }
                            $branchFilter .= ")";
                        }
                    
                        $sql = "SELECT * FROM students WHERE cgpa_verified = 1 $branchFilter";
                        $result = $conn->query($sql);
                    
                        // Output the filtered table
                        echo "<h4 align='center'>REGISTERED STUDENTS</h4><br>";
                    
                        if ($result->num_rows > 0) {
                            echo "<table class='table table-hover' id='studentsTable'><tr><th>Name</th><th>Email</th><th>Contact No.</th><th>D.O.B</th><th>Degree</th><th>Branch</th><th>Year of Passing</th><th>CGPA</th><th>12th Percentage</th><th>10th Percentage</th><th>Backlog</th></tr>";
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["phone"]."</td><td>".$row["dob"]."</td><td>".$row["degree"]."</td><td>".$row["branch"]."</td><td>".$row["year"]."</td><td>".$row["cgpa"]."</td><td>".$row["twp"]."</td><td>".$row["tenp"]."</td><td>".$row["supply"]."</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "0 results";
                        }
                    }
                    
                    if(isset($_POST['name']) && $_POST['name']=="TOTAL VACANCIES") {
                        $sql = "SELECT * FROM vacancy";
                        $result = $conn->query($sql);
                        
                        echo "<h4 align='center'>TOTAL VACANCIES</h4><br>";
                        
                        if ($result->num_rows > 0) {
                            echo "<table class='table table-hover' id='vacanciesTable'><tr><th>Company Name</th><th>Job Title</th><th>Salary</th><th>Bond</th></tr>";
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>".$row["company_name"]."</td><td>".$row["job_title"]."</td><td>".$row["salary"]."</td><td>".$row["bond"]."</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "0 results";
                        }
                    }
                    
                    if(isset($_POST['name']) && $_POST['name']=="TOTAL REGISTERED COMPANIES") {
                        $sql = "SELECT * FROM company";
                        $result = $conn->query($sql);
                        
                        echo "<h4 align='center'>REGISTERED COMPANIES</h4><br>";
                        
                        if ($result->num_rows > 0) {
                            echo "<table class='table table-hover' id='companiesTable'><tr><th>Name</th><th>Email</th><th>Phone</th><th>C.E.O.</th><th>C.T.O</th><th>H.R.</th></tr>";
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["phone"]."</td><td>".$row["ceo"]."</td><td>".$row["cto"]."</td><td>".$row["hr"]."</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "0 results";
                        }
                    }
                    
                    if(isset($_POST['name']) && $_POST['name']=="TOTAL PLACED STUDENTS") {
                        echo "<form id='filterForm'>
                        <label for='deptFilter'>Filter by Department:</label>
                        <input type='text' id='deptFilter' name='branch'><br>
                        <button type='button' onclick='filterTable()'>Apply Filter</button>
                        </form>";
                        
                        $sql = "SELECT * FROM students as S,student_info as I,vacancy as V where S.email=I.email and V.company_name=I.company_name";
                        $result = $conn->query($sql);
                        
                        echo "<h4 align='center'>PLACED STUDENTS</h4><br>";
                        
                        if ($result->num_rows > 0) {
                            echo "<table class='table table-hover' id='placedStudentsTable'><tr><th>Name</th><th>Email</th><th>Contact No.</th><th>Degree</th><th>Branch</th><th>C.P.I.</th><th>12th Percentage</th><th>10th Percentage</th><th>Company</th><th>Job Title</th><th>Salary (LPA)</th></tr>";
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["phone"]."</td><td>".$row["degree"]."</td><td>".$row["branch"]."</td><td>".$row["cgpa"]."</td><td>".$row["twp"]."</td><td>".$row["tenp"]."</td><td>".$row["company_name"]."</td><td>".$row["job_title"]."</td><td>".$row["salary"]."</td><td>".$row["salary"]."</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "0 results";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.1/xlsx.full.min.js"></script>
    <script>
        function filterTable() {
            // Get filter values
            var cgpa = document.getElementById('cgpaFilter').value;
            var backlog = document.getElementById('backlogFilter').value;
            var branch = document.getElementById('deptFilter').value;
            
            // Get table and rows
            var table = document.getElementById('studentsTable');
            var rows = table.getElementsByTagName('tr');
            
            // Loop through rows and filter
            for (var i = 1; i < rows.length; i++) {
                var cgpaCell = rows[i].getElementsByTagName('td')[7];
                var backlogCell = rows[i].getElementsByTagName('td')[10];
                var branchCell = rows[i].getElementsByTagName('td')[5];
                
                var showRow = true;
                
                if (cgpa && parseFloat(cgpaCell.textContent) < parseFloat(cgpa)) {
                    showRow = false;
                }
                
                if (backlog && parseInt(backlogCell.textContent) > parseInt(backlog)) {
                    showRow = false;
                }
                
                if (branch && branchCell.textContent.indexOf(branch) === -1) {
                    showRow = false;
                }
                
                rows[i].style.display = showRow ? '' : 'none';
            }
        }
        
        document.getElementById('exportBtn').addEventListener('click', function() {
    var visibleTable = findVisibleTable();
    
    if (visibleTable) {
        var wb = XLSX.utils.table_to_book(visibleTable, { sheet: "Sheet JS" });
        XLSX.writeFile(wb, "ExportedData.xlsx");
    } else {
        console.error("No visible table found to export.");
    }
});

function findVisibleTable() {
    var tables = document.querySelectorAll('table'); // Assuming all tables need to be checked
    
    for (var i = 0; i < tables.length; i++) {
        if (isVisible(tables[i])) {
            return tables[i];
        }
    }
    
    return null;
}

function isVisible(element) {
    return !!(element.offsetWidth || element.offsetHeight || element.getClientRects().length);
}

    </script>
</body>
</html>
