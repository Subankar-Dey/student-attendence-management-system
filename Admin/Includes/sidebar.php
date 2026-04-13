<style>
  /* Sidebar Container */
  #accordionSidebar { 
    background: #ffffff !important; 
    border-right: 1px solid #eef2f7;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }

  /* Navigation Links */
  .sidebar-light .nav-item .nav-link { 
    color: #4a5568; 
    font-weight: 600; 
    margin: 8px 15px;
    padding: 12px 15px;
    border-radius: 14px;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
  }

  /* Interactive Hover Effect */
  .sidebar-light .nav-item .nav-link:hover { 
    background: #f4f7fe;
    color: #4e73df;
    transform: translateX(5px);
  }

  /* Active State Highlight - Dynamic Gradient */
  .sidebar-light .nav-item.active .nav-link { 
    background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    color: #ffffff !important;
    box-shadow: 0 8px 15px rgba(78, 115, 223, 0.2);
  }

  /* Force icon color to white when active */
  .sidebar-light .nav-item.active .nav-link i { 
    color: #ffffff !important; 
  }
  
  /* Section Headings */
  .sidebar-heading { 
    font-size: 0.7rem; 
    font-weight: 800; 
    color: #cbd5e0; 
    padding: 0 25px; 
    margin: 20px 0 10px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  /* Brand/Logo Area */
  .sidebar-brand { 
    background: #fff !important; 
    padding: 1.5rem 1rem;
    border-bottom: 1px solid #f8f9fc;
    height: auto !important;
  }

  /* Hide scrollbar for a cleaner look */
  #accordionSidebar::-webkit-scrollbar { 
    display: none; 
  }
</style>

<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
            <img src="img/logo/attnlg.jpg" style="width: 38px; border-radius: 10px;">
        </div>
        <div class="sidebar-brand-text mx-3" style="color: #2e384d; font-weight: 800;">AMS Admin</div>
    </a>
    
    <div class="sidebar-heading">Analytics</div>
    <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-chart-pie"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <div class="sidebar-heading">Management</div>
    
    <li class="nav-item <?php echo (strpos($_SERVER['PHP_SELF'], 'Class') !== false) ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClass" aria-expanded="true" aria-controls="collapseClass">
            <i class="fas fa-fw fa-school"></i>
            <span>Classes</span>
        </a>
        <div id="collapseClass" class="collapse <?php echo (strpos($_SERVER['PHP_SELF'], 'Class') !== false) ? 'show' : ''; ?>" aria-labelledby="headingClass" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded shadow-sm">
                <a class="collapse-item" href="createClass.php">Setup Class</a>
                <a class="collapse-item" href="createClassArms.php">Class Arms</a>
            </div>
        </div>
    </li>

    <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'createStudents.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="createStudents.php">
            <i class="fas fa-fw fa-user-graduate"></i>
            <span>Students</span>
        </a>
    </li>

    <div class="sidebar-heading">System</div>
    <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'createSessionTerm.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="createSessionTerm.php">
            <i class="fas fa-fw fa-cog"></i>
            <span>Settings</span>
        </a>
    </li>
</ul>