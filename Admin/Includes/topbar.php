<?php 
  // Initialize fallbacks to prevent undefined variable errors
  $fullName = "Administrator"; 
  $userRole = "Administrator"; 

  if (isset($_SESSION['userId'])) {
      $userId = $_SESSION['userId'];
      $query = "SELECT * FROM tbladmin WHERE Id = '$userId'";
      $rs = $conn->query($query);
      
      if ($rs && $rs->num_rows > 0) {
          $rows = $rs->fetch_assoc();
          $firstName = $rows['firstName'] ?? 'Admin';
          $lastName = $rows['lastName'] ?? '';
          $fullName = trim($firstName . " " . $lastName);
          $emailAddress = $rows['emailAddress'] ?? 'admin@mail.com';
      }
  }
?>

<style>
    .topbar {
        background: rgba(255, 255, 255, 0.8) !important;
        backdrop-filter: blur(12px); /* Glassmorphism Effect */
        border-bottom: 1px solid rgba(231, 234, 243, 0.7);
        padding: 0.5rem 1rem;
    }
    .welcome-msg { font-size: 0.8rem; color: #a0aec0; margin-bottom: -4px; display: block; }
    .user-name-display { font-size: 0.95rem; font-weight: 700; color: #2d3748; }
    
    .nav-profile-img { 
        border: 2px solid #edf2f7; 
        padding: 2px; 
        transition: transform 0.2s ease, border-color 0.2s ease; 
    }
    .nav-item:hover .nav-profile-img { border-color: #4e73df; transform: scale(1.05); }

    /* Interactive Dropdown Styles */
    .bg-light-danger { background-color: #fff5f5; }
    .icon-circle { width: 35px; height: 35px; border-radius: 10px; display: flex; align-items: center; justify-content: center; transition: 0.3s; }
    .dropdown-item:hover .icon-circle { transform: scale(1.1); }
    .dropdown-item:active { background-color: #f8f9fc; }
</style>

<nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow-sm">
  <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" data-toggle="dropdown">
        <div class="text-right mr-3 d-none d-lg-block">
            <span class="welcome-msg">Logged in as,</span>
            <span class="user-name-display"><?php echo $fullName; ?></span>
        </div>
        <img class="nav-profile-img rounded-circle shadow-sm" src="img/user-icn.png" style="width: 42px; height: 42px;">
      </a>
      
      <div class="dropdown-menu dropdown-menu-right shadow border-0 animated--grow-in" style="border-radius: 20px; min-width: 250px; padding: 10px;">
        <div class="dropdown-header text-center py-4">
            <div class="mx-auto mb-2 d-flex align-items-center justify-content-center bg-primary text-white rounded-circle shadow-sm" style="width: 50px; height: 50px; font-size: 20px; font-weight: 700;">
                <?php echo strtoupper(substr($fullName, 0, 1)); ?>
            </div>
            <h6 class="font-weight-bold mb-0 text-dark"><?php echo $fullName; ?></h6>
            <p class="small text-muted mb-0"><?php echo $userRole; ?></p>
        </div>
        
        <div class="dropdown-divider"></div>
        
        <a class="dropdown-item py-3 d-flex align-items-center" href="javascript:void(0);" onclick="prepareModal('profile')" style="border-radius: 12px;">
            <div class="icon-circle bg-light mr-3">
                <i class="fas fa-user text-primary"></i>
            </div>
            <div>
                <span class="font-weight-bold d-block text-dark">My Profile</span>
                <small class="text-muted">View account details</small>
            </div>
        </a>

        <a class="dropdown-item py-3 d-flex align-items-center" href="javascript:void(0);" onclick="prepareModal('logout')" style="border-radius: 12px;">
            <div class="icon-circle bg-light-danger mr-3">
                <i class="fas fa-power-off text-danger"></i>
            </div>
            <div>
                <span class="font-weight-bold text-danger d-block">Sign Out</span>
                <small class="text-muted">End current session</small>
            </div>
        </a>
      </div>
    </li>
  </ul>
</nav>

<?php include "profileModal.php"; ?>