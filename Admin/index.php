<?php 
include '../Includes/dbcon.php';
include '../Includes/session.php';
include 'Includes/chart-functions.php';

// Form Inputs
$selectedStudent = $_POST['admissionNo'] ?? '';
$selectedClass = $_POST['classId'] ?? '';
$selectedArm = $_POST['classArmId'] ?? '';
$selectedSession = $_POST['sessionId'] ?? '';
$selectedMonth = $_POST['month'] ?? date('m');
$selectedYear = $_POST['year'] ?? date('Y');

// Global Counters for Stats Cards
$totalStudents = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tblstudents"));
$totalTeachers = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tblclassteacher"));
$totalClassArms = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tblclassarms"));

// Calendar Logic
$calendarData = (!empty($selectedStudent)) ? getCalendarData($conn, $selectedStudent, $selectedMonth, $selectedYear) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>AMS Dashboard | Admin</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8f9fc; }
    .stat-card-link { text-decoration: none !important; transition: all 0.3s ease; display: block; }
    .stat-card-link:hover { transform: translateY(-5px); }
    .interactive-card { border-radius: 20px; border: none; overflow: hidden; position: relative; }
    .card-icon-bg { position: absolute; right: -10px; bottom: -10px; font-size: 5rem; opacity: 0.1; transform: rotate(-15deg); }
    
    /* Calendar UI */
    .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 10px; }
    .day-cell { height: 65px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1rem; font-weight: bold; border: 1px solid #edf2f7; background: #fff; transition: 0.2s; position: relative; }
    .bg-present { background-color: #1cc88a !important; color: white !important; border: none; box-shadow: 0 4px 10px rgba(28, 200, 138, 0.2); }
    .bg-absent { background-color: #e74a3b !important; color: white !important; border: none; box-shadow: 0 4px 10px rgba(231, 74, 59, 0.2); }
    .day-label { text-align: center; font-size: 0.75rem; font-weight: 800; color: #4e73df; text-transform: uppercase; padding-bottom: 10px; }
    
    .filter-card { border-radius: 20px; border: none; background: #fff; }
    .form-control-sm { border-radius: 10px; height: 40px; }
  </style>
</head>

<body id="page-top">
  <div id="wrapper">
    <?php include "Includes/sidebar.php";?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include "Includes/topbar.php";?>

        <div class="container-fluid">
          <div class="row mb-4">
            <div class="col-xl-4 col-md-6 mb-4">
              <a href="manageStudents.php" class="stat-card-link">
                <div class="card interactive-card bg-gradient-primary text-white p-4 shadow-sm">
                  <div class="h2 font-weight-bold mb-0"><?php echo $totalStudents; ?></div>
                  <div class="font-weight-bold">Total Students</div>
                  <i class="fas fa-user-graduate card-icon-bg"></i>
                </div>
              </a>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <a href="createClassTeacher.php" class="stat-card-link">
                <div class="card interactive-card bg-gradient-success text-white p-4 shadow-sm">
                  <div class="h2 font-weight-bold mb-0"><?php echo $totalTeachers; ?></div>
                  <div class="font-weight-bold">Total Teachers</div>
                  <i class="fas fa-chalkboard-teacher card-icon-bg"></i>
                </div>
              </a>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <a href="createClassArms.php" class="stat-card-link">
                <div class="card interactive-card bg-gradient-info text-white p-4 shadow-sm">
                  <div class="h2 font-weight-bold mb-0"><?php echo $totalClassArms; ?></div>
                  <div class="font-weight-bold">Total Class Arms</div>
                  <i class="fas fa-door-open card-icon-bg"></i>
                </div>
              </a>
            </div>
          </div>

          <div class="card filter-card mb-4 shadow-sm">
            <div class="card-body">
              <form method="POST" action="index.php" class="row align-items-end">
                <div class="col-md-2 mb-2">
                  <label class="small font-weight-bold">Class</label>
                  <select name="classId" class="form-control form-control-sm">
                    <option value="">-- Class --</option>
                    <?php 
                    $classes = mysqli_query($conn, "SELECT * FROM tblclass");
                    while($c = mysqli_fetch_assoc($classes)) echo "<option value='".$c['Id']."' ".($selectedClass == $c['Id'] ? 'selected':'').">".$c['className']."</option>";
                    ?>
                  </select>
                </div>
                <div class="col-md-3 mb-2">
                  <label class="small font-weight-bold">Student</label>
                  <select name="admissionNo" class="form-control form-control-sm" required>
                    <option value="">-- Select Student --</option>
                    <?php 
                    $stds = mysqli_query($conn, "SELECT admissionNumber, firstName, lastName FROM tblstudents");
                    while($st = mysqli_fetch_assoc($stds)) echo "<option value='".$st['admissionNumber']."' ".($selectedStudent == $st['admissionNumber'] ? 'selected':'').">".$st['firstName']." ".$st['lastName']."</option>";
                    ?>
                  </select>
                </div>
                <div class="col-md-2 mb-2">
                  <label class="small font-weight-bold">Month</label>
                  <select name="month" class="form-control form-control-sm">
                    <?php for($m=1;$m<=12;$m++) echo "<option value='$m' ".($selectedMonth == $m ? 'selected':'').">".date('F', mktime(0,0,0,$m,1))."</option>"; ?>
                  </select>
                </div>
                <div class="col-md-2 mb-2">
                  <label class="small font-weight-bold">Year</label>
                  <select name="year" class="form-control form-control-sm">
                    <?php for($y=date('Y');$y>=2023;$y--) echo "<option value='$y' ".($selectedYear == $y ? 'selected':'').">$y</option>"; ?>
                  </select>
                </div>
                <div class="col-md-2 mb-2">
                  <button type="submit" class="btn btn-primary btn-block shadow-sm" style="border-radius:10px; height:40px; font-weight:700;">View Report</button>
                </div>
              </form>
            </div>
          </div>

          <?php if(!empty($calendarData)): ?>
          <div class="card shadow-sm border-0 mb-5" style="border-radius:25px;">
            <div class="card-header bg-white py-4 border-0">
              <h5 class="m-0 font-weight-bold text-dark text-center">
                Attendance for <?php echo date('F Y', mktime(0,0,0,$selectedMonth, 1, $selectedYear)); ?>
              </h5>
            </div>
            <div class="card-body p-4">
              <div class="calendar-grid">
                <?php 
                foreach(['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $d) echo "<div class='day-label'>$d</div>";
                $offset = date('w', mktime(0, 0, 0, $selectedMonth, 1, $selectedYear));
                for($i=0; $i<$offset; $i++) echo "<div></div>";
                
                foreach($calendarData as $day => $info): 
                  $statusClass = ($info['status'] == '1') ? "bg-present" : (($info['status'] == '0') ? "bg-absent" : "");
                ?>
                  <div class="day-cell <?php echo $statusClass; ?>">
                    <?php echo $day; ?>
                  </div>
                <?php endforeach; ?>
              </div>
              
              <div class="d-flex justify-content-center mt-4">
                <div class="small mr-4"><span class="badge bg-present mr-2">&nbsp;</span> Present</div>
                <div class="small"><span class="badge bg-absent mr-2">&nbsp;</span> Absent</div>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <?php include 'Includes/footer.php';?>
    </div>
  </div>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>
</html>