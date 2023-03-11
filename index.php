<?php
session_start();
include("inc/head.php");

if (empty($_SESSION['user_login'])) {
?>
    <div class="card">
        <div class="card-body text-center">
            <img src="http://www.pulinet.org/wp-content/uploads/2021/05/cropped-pulinet-logomini.png" width="60%" class="card-img-top" alt="PSU Logo">
            <!-- <img src="https://psubrand.psu.ac.th/files/20180816_110538.png" width="60%" class="card-img-top" alt="PSU Logo"> -->
            <div class="main-content">
                <h4 class="card-title">Library Authen</h4>
                <p class="card-text">นักศึกษายืนยันตัวตนเพื่อเข้าใช้บริการห้องสมุดด้วยสิทธิ์ของสมาชิก PULINET</p>
                <!-- <p class="libsitename">มหาวิทยาลัยสงขลานครินทร์</p> -->
                <div class="libsitename">
                    <select id="uniName" name="uniName" onchange="onChangeUni()" style="text-align: center;" required>
                        <option value="">ระบุมหาวิทยาลัยต้นสังกัด</option>
                        <option value="cmu">มหาวิทยาลัยเชียงใหม่</option>
                        <option value="kku">มหาวิทยาลัยขอนแก่น</option>
                        <option value="stou">มหาวิทยาลัยสุโขทัยธรรมาธิราช</option>
                        <option value="buu">มหาวิทยาลัยบูรพา</option>
                        <option value="https://oauth.psu.ac.th/?oauth=authorize&client_id=oauthpsu1971&response_type=code&scope=jfkprofile&redirect_uri=https://ideatank.oas.psu.ac.th/pulinet/callback.php">มหาวิทยาลัยสงขลานครินทร์</option>
                    </select>
                </div>
                <p class="card-text"></p>
                <a id="calltoact" href="#" class="btn btn-primary"><i class="fa fa-id-badge" aria-hidden="true"></i> ยืนยันตัวตน</a>
            </div>
        </div>
    </div>
<?php
} else {
?>
    <div class="card">
        <div class="card-body text-center">
            <img src="http://www.pulinet.org/wp-content/uploads/2021/05/cropped-pulinet-logomini.png" width="60%" class="card-img-top" alt="PSU Logo">
            <!-- <img src="https://psubrand.psu.ac.th/files/20180816_110538.png" width="60%" class="card-img-top" alt="PSU Logo"> -->
            <div class="main-content">
                <h4 class="card-title">Library Authen</h4>
                <p class="card-text">ยินดีต้อนรับคุณ</p>
                <!-- <p class="libsitename">มหาวิทยาลัยสงขลานครินทร์</p> -->
                <p class="card-text">
                <h4><?= $_SESSION['description'] ?></h4><?= $_SESSION['user_email'] ?></p>
                <div class="barcode">
                    <img alt="Barcode" src="inc/barcode.php?text=<?= $_SESSION['user_login'] ?>" />
                    <span class="barcode-text"><?= $_SESSION['user_login'] ?></span> <!--*0014924*-->
                </div>
                <!-- <a href="https://oauth.psu.ac.th/?oauth=authorize&client_id=oauthpsu1971&response_type=code&scope=jfkprofile&redirect_uri=https://ideatank.oas.psu.ac.th/pulinet/callback.php" class="btn btn-primary"><i class="fa fa-id-badge" aria-hidden="true"></i> ยืนยันตัวตน</a> -->
            </div>
        </div>
    </div>
<?php
}
include("inc/foot.php");
?>