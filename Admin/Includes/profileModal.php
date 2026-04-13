<?php
// Fetch first letter of first name for avatar
$firstLetter = isset($rows['firstName']) ? strtoupper($rows['firstName'][0]) : 'U';

// Optional: two-letter initials (first + last)
// $initials = '';
// if(isset($rows['firstName'])) $initials .= strtoupper($rows['firstName'][0]);
// if(isset($rows['lastName'])) $initials .= strtoupper($rows['lastName'][0]);
?>
<style>
.profile-modal-content { border-radius: 24px !important; border: none; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.2); }
.profile-header-bg { background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); height: 100px; display: flex; justify-content: center; position: relative; }
.avatar-circle-lg { width: 90px; height: 90px; background-color: #ffffff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 35px; font-weight: 800; color: #4e73df; position: absolute; bottom: -45px; box-shadow: 0 8px 20px rgba(0,0,0,0.15); border: 4px solid #ffffff; }
.profile-details-body { padding-top: 50px; text-align: center; padding-bottom: 25px; }
.user-full-name { font-size: 20px; font-weight: 700; color: #2e384d; margin-bottom: 2px; }
.user-email-text { color: #8792a2; font-size: 13px; margin-bottom: 15px; }
.identity-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; padding: 0 20px; text-align: left; }
.info-group { background: #f8f9fc; padding: 8px 12px; border-radius: 10px; border: 1px solid #e3e6f0; }
.info-label { font-size: 9px; text-transform: uppercase; color: #b7c0cd; font-weight: 800; display: block; margin-bottom: 2px; }
.info-value { font-size: 12px; color: #4e73df; font-weight: 600; word-break: break-word; }
.full-row { grid-column: span 2; }
.confirm-logout-btn { background: #ff4757; color: white !important; border-radius: 10px; padding: 10px 25px; border: none; font-weight: 600; text-decoration: none; }
.close-modal-btn { background: #edf2f7; color: #4a5568; border-radius: 10px; padding: 10px 20px; border: none; font-weight: 600; margin-right: 8px; }
</style>

<div class="modal fade" id="profileCardModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content profile-modal-content">
            <div class="profile-header-bg">
                <div class="avatar-circle-lg"><?php echo $firstLetter; ?></div>
                <!-- For two-letter initials, replace with: <?php // echo $initials; ?> -->
            </div>
            
            <div class="profile-details-body">
                <div class="user-full-name">
                    <?php echo $rows['firstName'] . ' ' . ($rows['middleName'] ?? '') . ' ' . $rows['lastName']; ?>
                </div>
                <div class="user-email-text"><?php echo $rows['emailAddress']; ?></div>
                
                <div id="modalProfileInfo">
                    <div class="identity-grid">
                        <div class="info-group">
                            <span class="info-label">Gender</span>
                            <span class="info-value"><?php echo $rows['gender'] ?? 'N/A'; ?></span>
                        </div>
                        <div class="info-group">
                            <span class="info-label">Date of Birth</span>
                            <span class="info-value"><?php echo $rows['dob'] ?? 'N/A'; ?></span>
                        </div>
                        <div class="info-group">
                            <span class="info-label">Nationality</span>
                            <span class="info-value"><?php echo $rows['nationality'] ?? 'N/A'; ?></span>
                        </div>
                        <div class="info-group">
                            <span class="info-label">Marital Status</span>
                            <span class="info-value"><?php echo $rows['maritalStatus'] ?? 'N/A'; ?></span>
                        </div>
                        <div class="info-group">
                            <span class="info-label">Phone Number</span>
                            <span class="info-value"><?php echo $rows['phoneNo'] ?? 'N/A'; ?></span>
                        </div>
                        <div class="info-group">
                            <span class="info-label">User ID</span>
                            <span class="info-value">#<?php echo $rows['Id']; ?></span>
                        </div>
                        <div class="info-group full-row">
                            <span class="info-label">Residential Address</span>
                            <span class="info-value"><?php echo $rows['address'] ?? 'Address not updated'; ?></span>
                        </div>
                    </div>
                </div>

                <p class="text-muted small px-5 mt-3" id="modalLogoutText" style="display:none;">
                    Confirm: end your <?php echo $userRole; ?> session and logout?
                </p>
                
                <div class="d-flex justify-content-center mt-3">
                    <button type="button" class="close-modal-btn shadow-sm" data-dismiss="modal">Cancel</button>
                    <a href="logout.php" class="confirm-logout-btn shadow-sm" id="modalConfirmBtn" style="display:none;">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function prepareModal(viewType) {
    const info = document.getElementById('modalProfileInfo');
    const text = document.getElementById('modalLogoutText');
    const btn = document.getElementById('modalConfirmBtn');

    if (viewType === 'logout') {
        info.style.display = 'none';
        text.style.display = 'block';
        btn.style.display = 'inline-block';
    } else {
        info.style.display = 'block';
        text.style.display = 'none';
        btn.style.display = 'none';
    }
    $('#profileCardModal').modal('show');
}
</script>