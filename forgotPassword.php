<?php 
include 'Includes/dbcon.php';
session_start();

/**
 * Handle Password Reset Logic
 * Synchronized with your attendancemsystem.sql schema
 */
if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']); // HTML date picker matches YYYY-MM-DD
    $newPass = $_POST['newPassword'];
    $hashedPass = md5($newPass); // Uses MD5 to match your existing system
    
    // Step 1: Verify Identity and Update Administrator
    $checkAdmin = $conn->query("SELECT * FROM tbladmin WHERE emailAddress='$email' AND dob='$dob'");
    
    if($checkAdmin && $checkAdmin->num_rows > 0){
        $update = $conn->query("UPDATE tbladmin SET password='$hashedPass' WHERE emailAddress='$email'");
        
        if($conn->affected_rows > 0){
            $successMsg = "Admin password updated successfully!";
        } else {
            $infoMsg = "New password is the same as the current one.";
        }
    } else {
        // Step 2: Fallback to verify and update Teacher
        $checkTeacher = $conn->query("SELECT * FROM tblclassteacher WHERE emailAddress='$email' AND dob='$dob'");
        
        if($checkTeacher && $checkTeacher->num_rows > 0){
            $conn->query("UPDATE tblclassteacher SET password='$hashedPass' WHERE emailAddress='$email'");
            if($conn->affected_rows > 0){
                $successMsg = "Teacher password updated successfully!";
            } else {
                $infoMsg = "Teacher password remains unchanged (same as current).";
            }
        } else {
            $errorMsg = "Verification Failed: Email or Date of Birth does not match our records.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="img/logo/attnlg.jpg" rel="icon">
  <title>AMS | Security Reset</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; margin: 0; padding: 20px; }
    .glass-card { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 28px; border: none; width: 100%; max-width: 440px; }
    .form-control-reset { height: 55px; border-radius: 15px; border: 1px solid #e2e8f0; background: #f8fafc; margin-bottom: 15px; padding: 0 20px; font-weight: 600; }
    .btn-update { height: 55px; border-radius: 15px; background: #4e73df; border: none; font-weight: 700; color: white; transition: 0.3s; }
    .btn-update:hover:not(:disabled) { background: #224abe; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
    .icon-box { width: 65px; height: 65px; background: rgba(78, 115, 223, 0.1); color: #4e73df; border-radius: 18px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 26px; }
  </style>
</head>

<body>
  <div class="card glass-card shadow-lg p-5">
    <div class="text-center mb-4">
      <div class="icon-box"><i class="fas fa-user-shield"></i></div>
      <h4 class="font-weight-bold text-dark">Account Recovery</h4>
      <p class="text-muted small">Verify identity to update your password</p>
    </div>

    <?php if(isset($successMsg)): ?>
        <div class="alert alert-success small font-weight-bold text-center rounded-pill mb-4">
            <?php echo $successMsg; ?> <a href="index.php" class="alert-link">Login Now</a>
        </div>
    <?php elseif(isset($infoMsg)): ?>
        <div class="alert alert-info small font-weight-bold text-center rounded-pill mb-4">
            <?php echo $infoMsg; ?>
        </div>
    <?php elseif(isset($errorMsg)): ?>
        <div class="alert alert-danger small font-weight-bold text-center rounded-pill mb-4">
            <?php echo $errorMsg; ?>
        </div>
    <?php endif; ?>

    <form method="Post" action="">
      <div class="form-group mb-2">
        <label class="small font-weight-bold ml-2">Registered Email</label>
        <input type="email" class="form-control form-control-reset" name="email" placeholder="admin@mail.com" required>
      </div>
      
      <div class="form-group mb-4">
        <label class="small font-weight-bold ml-2">Date of Birth</label>
        <input type="date" class="form-control form-control-reset" name="dob" required>
      </div>

      <hr class="my-4">
      
      <input type="password" name="newPassword" id="p1" class="form-control form-control-reset" placeholder="New Password" onkeyup="checkMatch()" required>
      <input type="password" name="confirmPassword" id="p2" class="form-control form-control-reset" placeholder="Confirm Password" onkeyup="checkMatch()" required>
      
      <div id="matchMsg" class="text-center small font-weight-bold mb-3"></div>

      <button type="submit" name="submit" id="subBtn" class="btn-update btn-block shadow-sm" disabled>Update Password</button>
    </form>
    
    <div class="text-center mt-4 pt-3 border-top">
      <a href="index.php" class="small font-weight-bold text-muted text-decoration-none">
          <i class="fas fa-arrow-left mr-2"></i>Back to Portal
      </a>
    </div>
  </div>

  <script>
    /**
     * Real-time password validation
     */
    function checkMatch() {
      const p1 = document.getElementById("p1").value;
      const p2 = document.getElementById("p2").value;
      const btn = document.getElementById("subBtn");
      const msg = document.getElementById("matchMsg");

      if (p1 && p2) {
        if (p1 === p2) {
          btn.disabled = false;
          msg.innerHTML = "<span class='text-success'>✓ Passwords Match</span>";
        } else {
          btn.disabled = true;
          msg.innerHTML = "<span class='text-danger'>✗ Passwords Mismatch</span>";
        }
      } else {
        msg.innerHTML = "";
        btn.disabled = true;
      }
    }
  </script>
</body>
</html>