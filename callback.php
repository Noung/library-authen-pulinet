<?php
session_start();
include("head.php");

if (isset($_GET['code'])) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://oauth.psu.ac.th/?oauth=token");
    curl_setopt($ch, CURLOPT_POST, true);
    $curl_post_data = array(
        'grant_type' => 'authorization_code',
        'client_id' => 'oauthpsu1971', //ระบุ client_id ที่ได้จากคำร้อง
        'client_secret' => '29d4961b9d5d00d17e1514294bc4285a', //ระบุ client_secret ที่ได้จากคำร้อง
        'code' => $_GET['code'],
        'respose_type' => 'code',
        'redirect_uri' => 'https://ideatank.oas.psu.ac.th/pulinet/callback.php' //ระบุ uri callback ของระบบ
    );
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $json = json_decode(curl_exec($ch));
    $ch2 = curl_init();
    curl_setopt($ch2, CURLOPT_URL, "https://oauth.psu.ac.th?oauth=me");
    curl_setopt($ch2, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $json->access_token));
    curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch2, CURLOPT_TIMEOUT, 20);
    $json2 = json_decode(curl_exec($ch2));

    $_SESSION['user_login'] = strtolower($json2->user_login);
    $_SESSION['displayname'] = $json2->displayname;
    $_SESSION['description'] = $json2->description;
    $_SESSION['user_email'] = $json2->user_email;
    // echo var_dump($json2);
    // exit();

    if (empty($_SESSION['user_login'])) { //กรณี Authen ไม่ผ่าน ไม่พบข้อมูลผู้ใช้ *ไม่เกิดขึ้นเพราะจะติดตั้งแต่หน้า login แล้ว
?>
        ?>
        <div class="card">
            <div class="card-body text-center">
                <img src="http://www.pulinet.org/wp-content/uploads/2021/05/cropped-pulinet-logomini.png" width="60%" class="card-img-top" alt="PSU Logo">
                <!-- <img src="https://psubrand.psu.ac.th/files/20180816_110538.png" width="60%" class="card-img-top" alt="PSU Logo"> -->
                <div class="main-content">
                    <h4 class="card-title">Library Authen</h4>
                    <p class="card-text">ขออภัย ไม่พบข้อมูลนักศึกษา</p>
                    <!-- <p class="libsitename">มหาวิทยาลัยสงขลานครินทร์</p>
                        <p class="card-text"></p> -->
                    <a href="https://oauth.psu.ac.th/?oauth=authorize&client_id=oauthpsu1971&response_type=code&scope=profilepsu&redirect_uri=https://ideatank.oas.psu.ac.th/pulinet/callback.php" class="btn btn-primary"><i class="fa fa-user-circle" aria-hidden="true"></i> ยืนยันตัวตน</a>
                </div>
            </div>
        </div>
    <?php
    } else { //กรณี Authen ผ่าน พบข้อมูลผู้ใช้
    ?>
        <script>
            window.location.href = "https://ideatank.oas.psu.ac.th/pulinet/";
        </script>
    <?php
    }
} else {//กรณีมีการเข้าหน้า callback.php ตรงๆ โดยไม่ผ่านการ authen
    ?>
    <script>
        window.location.href = "https://ideatank.oas.psu.ac.th/pulinet/";
    </script>
<?php
}
include("foot.php");
?>