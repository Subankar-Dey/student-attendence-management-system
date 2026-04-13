<style>
  /* Glassmorphism Popup Styling */
  .security-overlay { 
    display: none; 
    position: fixed; 
    top: 0; 
    left: 0; 
    width: 100%; 
    height: 100%; 
    background: rgba(15, 23, 42, 0.8); 
    z-index: 9999; 
    align-items: center; 
    justify-content: center; 
    backdrop-filter: blur(10px); 
  }
  .security-card { 
    background: rgba(255, 255, 255, 0.95); 
    width: 100%; 
    max-width: 440px; 
    border-radius: 30px; 
    padding: 50px 40px; 
    text-align: center; 
    box-shadow: 0 25px 50px rgba(0,0,0,0.3); 
    border: 1px solid rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
  }
  .gate-icon {
    width: 80px;
    height: 80px;
    background: #f8fafc;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    color: #4e73df;
    font-size: 32px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
  }
  .form-control-gate {
    height: 55px;
    border-radius: 15px;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    margin-bottom: 15px;
    font-weight: 600;
    text-align: center;
  }
  .pass-wrapper { position: relative; }
  .pass-toggle { position: absolute; right: 20px; top: 18px; color: #cbd5e0; cursor: pointer; }

  .btn-gate-login {
    height: 55px;
    border-radius: 15px;
    background: #4e73df;
    border: none;
    font-weight: 700;
    color: white;
    transition: 0.3s;
  }
  .btn-gate-login:hover:not(:disabled) { background: #224abe; transform: translateY(-2px); }
  .btn-gate-cancel { background: transparent; border: none; color: #94a3b8; font-weight: 600; margin-top: 20px; }
</style>

<div id="securityGate" class="security-overlay">
  <div class="security-card">
    <div id="loginContent">
      <div class="gate-icon">
        <i class="fas fa-user-shield"></i>
      </div>
      <h4 class="font-weight-bold text-dark mb-1">Admin Gateway</h4>
      <p class="text-muted small mb-4">Authorized Personnel Only</p>
      
      <div id="gateMsg" class="mb-3 small font-weight-bold" style="display:none;"></div>

      <input type="email" id="gateEmail" class="form-control form-control-gate" placeholder="admin@mail.com" required>
      
      <div class="pass-wrapper">
          <input type="password" id="gatePass" class="form-control form-control-gate" placeholder="Password" required>
          <i class="fas fa-eye pass-toggle" onclick="toggleGatePass()"></i>
      </div>
      
      <button class="btn btn-gate-login btn-block shadow-sm" id="gateSubmit" onclick="processGateLogin()">
        <span id="btnText">Authorized Entry</span>
        <span id="btnLoader" style="display:none;"><i class="fas fa-spinner fa-spin"></i> Validating...</span>
      </button>
      
      <div class="mt-3">
        <a href="forgotPassword.php" class="small text-primary font-weight-bold">Forgot Password?</a>
      </div>

      <button class="btn-gate-cancel" onclick="closeGate()">Cancel Access</button>
    </div>

    <div id="successContent" style="display:none;">
        <div class="gate-icon" style="color: #1cc88a; background: #f0fdf4;">
            <i class="fas fa-check-circle"></i>
        </div>
        <h4 class="font-weight-bold text-dark mb-1">Identity Verified</h4>
        <p class="text-muted small">Accessing Command Center...</p>
    </div>
  </div>
</div>

<script>
  function toggleGatePass() {
    const p = document.getElementById("gatePass");
    p.type = p.type === "password" ? "text" : "password";
  }

  function openGate() {
    $('#main-wrapper').addClass('blurred');
    $('#securityGate').css('display', 'flex').hide().fadeIn(300);
  }

  function closeGate() {
    $('#main-wrapper').removeClass('blurred');
    $('#securityGate').fadeOut(300);
  }

  function processGateLogin() {
    const email = $('#gateEmail').val();
    const pass = $('#gatePass').val();
    const msg = $('#gateMsg');
    
    if(!email || !pass) {
        msg.text("Credentials required").css('color', '#e74a3b').fadeIn();
        return;
    }

    $('#btnText').hide();
    $('#btnLoader').show();
    $('#gateSubmit').prop('disabled', true);

    // Ensure index.php contains the MD5 hashing logic
    $.post('index.php', {
        admin_gate_login: 1, 
        email: email, 
        pass: pass
    }, function(response) {
        if(response.trim() === "success") {
            $('#loginContent').fadeOut(300, function() {
                $('#successContent').fadeIn();
                setTimeout(() => { window.location.href = "Admin/index.php"; }, 1000);
            });
        } else {
            $('#btnText').show();
            $('#btnLoader').hide();
            $('#gateSubmit').prop('disabled', false);
            msg.text("Access Denied: Invalid Credentials").css('color', '#e74a3b').fadeIn();
        }
    });
  }
</script>