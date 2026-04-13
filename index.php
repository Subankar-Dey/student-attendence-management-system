<?php 
include 'Includes/dbcon.php';
session_start();

/**
 * AJAX: Check Admin registration status
 */
if(isset($_POST['check_bio_status'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $query = $conn->query("SELECT tbladmin.Id, tbladmin.dob, tbladmin_fingerprints.fingerprint_data 
                           FROM tbladmin 
                           LEFT JOIN tbladmin_fingerprints ON tbladmin.Id = tbladmin_fingerprints.adminId 
                           WHERE tbladmin.emailAddress = '$email'");
    $res = $query->fetch_assoc();
    echo json_encode([
        'exists' => !empty($res['Id']),
        'registered' => !empty($res['fingerprint_data']), 
        'id' => $res['Id'] ?? 0,
        'db_dob' => $res['dob'] ?? ''
    ]);
    exit();
}

/**
 * AJAX: Admin Gateway Login Handler (Used by the popup)
 */
if(isset($_POST['admin_gate_login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['pass']);

    $query = "SELECT * FROM tbladmin WHERE emailAddress = '$email' AND password = '$password'";
    $rs = $conn->query($query);
    
    if($rs && $rs->num_rows > 0){
        $rows = $rs->fetch_assoc();
        $_SESSION['userId'] = $rows['Id'];
        $_SESSION['firstName'] = $rows['firstName'];
        $_SESSION['lastName'] = $rows['lastName'];
        $_SESSION['emailAddress'] = $rows['emailAddress'];
        echo "success";
    } else {
        echo "failed";
    }
    exit();
}

/**
 * PHP: Standard Form Login Handler
 */
if(isset($_POST['login'])){
    $userType = $_POST['userType'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    if($userType == "Administrator"){
        $query = "SELECT * FROM tbladmin WHERE emailAddress = '$username' AND password = '$password'";
    } else if($userType == "ClassTeacher"){
        $query = "SELECT * FROM tblclassteacher WHERE emailAddress = '$username' AND password = '$password'";
    } else if($userType == "Student"){
        $query = "SELECT * FROM tblstudents WHERE admissionNumber = '$username' AND password = '$password'";
    }

    $rs = $conn->query($query);
    if($rs && $rs->num_rows > 0){
        $rows = $rs->fetch_assoc();
        $_SESSION['userId'] = $rows['Id'];
        $_SESSION['userType'] = $userType;
        
        // Critical for Topbar/Profile
        $_SESSION['firstName'] = $rows['firstName'] ?? 'User';
        $_SESSION['lastName'] = $rows['lastName'] ?? '';

        if($userType == "Administrator") header("Location: Admin/index.php");
        else if($userType == "ClassTeacher") header("Location: ClassTeacher/index.php");
        else if($userType == "Student") header("Location: Student/index.php");
    } else {
        $errorMsg = "Access Denied: Invalid Credentials!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>AMS - Login Portal</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; margin: 0; transition: filter 0.4s ease; }
    #main-wrapper { width: 100%; max-width: 420px; transition: all 0.4s ease; }
    .blurred { filter: blur(15px); transform: scale(0.97); pointer-events: none; }
    .glass-card { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 28px; border: none; }
    .form-control { border-radius: 14px; padding: 1.2rem 1rem; height: auto; border: 1px solid #e3e6f0; font-weight: 600; }
    .btn-login { border-radius: 14px; padding: 0.9rem; font-weight: 700; background: #4e73df; border: none; color: white; transition: 0.3s; }
    .btn-login:hover { background: #224abe; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
  </style>
</head>
<body>
  <div id="main-wrapper">
    <div class="card glass-card shadow-lg p-5">
      <div class="text-center mb-4">
        <img src="img/logo/attnlg.jpg" class="rounded-circle shadow-sm mb-3" style="width:85px; height:85px; border: 3px solid #fff; object-fit: cover;">
        <h4 class="text-dark font-weight-bold">System Portal</h4>
        <p class="text-muted small">Standard Secure Access</p>
      </div>

      <?php if(isset($errorMsg)) echo "<div class='alert alert-danger small text-center rounded-pill font-weight-bold'>$errorMsg</div>"; ?>

      <form method="Post" action="">
        <div class="form-group">
          <select required name="userType" id="userType" class="form-control">
            <option value="Student">Student</option>
            <option value="ClassTeacher" selected>Class Teacher</option>
            <option value="Administrator" style="display:none;">Administrator</option>
          </select>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="username" placeholder="Admission ID / Email" required>
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" name="login" class="btn-login btn-block mt-4 shadow">Sign In</button>
      </form>

      <div class="text-center mt-4">
          <a href="forgotPassword.php" class="small font-weight-bold text-muted text-decoration-none">Forgot Password?</a>
      </div>
    </div>
  </div>

  <?php include 'admin_security_popup.php'; ?>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
    // Hidden Gateway: Ctrl + A
    window.addEventListener('keydown', function(e) {
      if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'a') {
        e.preventDefault();
        openGate();
      }
    });
  </script>
</body>
</html>