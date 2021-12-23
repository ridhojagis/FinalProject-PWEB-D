<?php
session_start();
if(!isset($_SESSION['email']) || (isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'siswa')){
  header("location:login-siswa.php");
}
include_once("database/db_connection.php");
$email = $_SESSION['email'];
 
$query = "SELECT * FROM siswa WHERE siswa_email='$email'";
$swdata = mysqli_fetch_assoc(mysqli_query($conn, $query));
$id = $swdata['siswa_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // if (isset($_POST['submit']) && $_POST['submit'] == 'profile') {
    if(true) {
	    $name = (isset($_POST['name'])) ? $_POST['name'] : $swdata['siswa_name'];
        $email = (isset($_POST['email'])) ? $_POST['email'] : $swdata;
        $address = (isset($_POST['address'])) ? "'".$_POST['address']."'" : "null";
        $tel = (isset($_POST['tel'])) ? "'".$_POST['tel']."'" : "null";
        $dob = (isset($_POST['dob'])) ? "'".$_POST['dob']."'" : "null";
        $pob = (isset($_POST['pob'])) ? "'".$_POST['pob']."'" : "null";
        $sex = (isset($_POST['sex'])) ? "'".$_POST['sex']."'" : "null";

        $query = "UPDATE siswa
                    SET siswa_nama = '$name',
                    siswa_email = '$email',
                    siswa_alamat = ".$address.",
                    siswa_kontak = ".$tel.",
                    siswa_tempatlahir = ".$pob.",
                    siswa_jkel = ".$sex.",
                    siswa_tanggallahir = ".$dob."
                    WHERE siswa_id = $id";
        // echo $query;
        if(mysqli_query($conn, $query)) { 
            header('Location: profil-siswa.php');
	    } else {
	    	$error = $conn->errno . ' ' . $conn->error;
	    	echo $error; // 1054 Unknown column 'foo' in 'field list'
	    }
    }

    // if (isset($_POST['submit']) && $_POST['submit'] == 'password') {
    //     $old_password = $_POST['old_password'];
    //     $new_password = $_POST['new_password'];
    //     $confirm_password = $_POST['confirm_password'];

    //     $query = "UPDATE pcr_password SET pcr_password = ? WHERE pcr_id = ?";
    //     if($stmt = $conn->prepare($query)) { 
    //         $stmt->bind_param('si', $new_password, $id);
    //         $stmt->execute();   // Execute the prepared query.
    //         // header('Location = profil_carijasa.php');
    //     }
    // }    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Profil Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>   

    <!-- Resource -->
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <header id="header" class="fixed-top d-flex " style="background-color: rgba(5, 87, 158, 0.9);">
        <div class="container d-flex align-items-center ">
    
          <h1 class="logo"><a href="index.php">SEKOLAHKU</a></h1>
          
    
          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="nav-link scrollto" href="dashboard-siswa.php">Dashboard</a></li>
              <li>
            <div class="dropdown">
              
              <a class="getstarted scrollto dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['email']; ?>
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="profil-siswa.php">Profil</a>
                <a class="dropdown-item" href="logout.php">Keluar</a>
              </ul>
            </div>
          </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav>
    
        </div>
      </header>
<div class="container"> 
<div class="col-md-12">  
    <div class="col-md-4">      
        <div class="portlet light profile-sidebar-portlet bordered">
            <div class="profile-userpic">
                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="img-responsive" alt=""> </div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name"> <?php echo $swdata['siswa_nama']?> </div>
            </div>
            <div class="profile-usermenu">
                <ul class="nav">
                    <li >
                        <a href="#profil">
                            <i class="icon-home"></i> Profil </a>
                    </li>
                    <li>
                        <a href="#ubahkatasandi">
                            <i class="icon-info"></i> Ubah Kata Sandi </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-8"> 
        <!-- Tab Profil -->
        <div class="portlet light bordered">
            <div class="portlet-title tabbable-line">
                <div class="caption caption-md" id="profil">
                    <i class="icon-globe theme-font hide"></i>
                    <span class="caption-subject font-blue-madison bold uppercase">Profil Siswa</span>
                </div>
            </div>
            <div class="portlet-body">
                <div>
                
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="Home">
                            <form action="" method="POST">
                              <div class="form-group">
                                <label for="inputName">Nama Lengkap</label>
                                <input type="text" class="form-control profile" id="inputName" name="name" value="<?php echo $swdata['siswa_nama']?>" disabled readonly>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control profile" id="InputEmail" name="email" value="<?php echo $swdata['siswa_email']?>" disabled readonly>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">No. HP</label>
                                <input type="text" class="form-control profile" id="InputNo" name="tel" pattern="[0-9]{11}" value="<?php echo $swdata['siswa_kontak']?>" disabled readonly>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Alamat</label>
                                <input type="text" class="form-control profile" id="InputAlamat" name="address" value="<?php echo $swdata['siswa_alamat']?>" disabled readonly>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Jenis Kelamin (L/P)</label>
                                <input type="text" class="form-control profile" id="InputJenisKel" name="sex" value="<?php echo $swdata['siswa_jkel']?>" disabled readonly>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Tempat Lahir</label>
                                <input type="text" class="form-control profile" id="InputTempatlahir" name="pob" value="<?php echo $swdata['siswa_tempatlahir']?>" disabled readonly>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Lahir (yyyy-mm-dd)</label>
                                <input type="text" class="form-control profile" id="InputTgllahir" name="dob" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="<?php echo $swdata['siswa_tanggallahir']?>" disabled readonly>
                              </div>
                              
                              <button type="submit" class="btn btn-primary profile" value="profile" disabled>Save</button>
                            </form>
                            <button id="editButton" class="btn btn-default" onclick="editProfile()">Edit</button>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">Profile</div>
                        <div role="tabpanel" class="tab-pane" id="messages">Messages</div>
                        <div role="tabpanel" class="tab-pane" id="settings">Settings</div>
                    </div>
                
                </div>
            </div>
        </div>

        <!-- Tab Ubah Kata Sandi -->
        <div class="portlet light bordered">
            <div class="portlet-title tabbable-line">
                <div class="caption caption-md" id="ubahkatasandi">
                    <i class="icon-globe theme-font hide"></i>
                    <span class="caption-subject font-blue-madison bold uppercase">Ubah Kata Sandi</span>
                </div>
            </div>
            <div class="portlet-body">
                <div>
                
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="Home">
                            <form>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Password Lama</label>
                                <div class="input-group">
                                    <input type="password" class="form-control pwd" id="InputOldPassword" placeholder="Password lama" name="old-password" value="">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                                    </span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Password Baru</label>
                                <div class="input-group">
                                    <input type="password" class="form-control pwd1" id="InputNewPassword" placeholder="Password baru" name="new-password" value="">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default reveal1" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                                    </span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Ketik ulang password baru</label>
                                <div class="input-group">
                                    <input type="password" class="form-control pwd1" id="RetypeNewPassword" placeholder="Password baru" name="confirm-password" value="">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default reveal1" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                                    </span>
                                </div>
                              </div>
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox"> Check me out
                                </label>
                              </div>
                              <button type="submit" class="btn btn-primary" value="profile" onclick="changePassword" >Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<style type="text/css">

#header {
  background: rgba(0, 0, 0);
  height: 70px;
}

#header .navbar{
    margin-top: 1%;
    margin-left: 68%;
}

body{
    background:#e9ecf3; 
    /* font-family: 'Nunito';    */
}

.col-md-12{
    margin-top: 10%;
}

/*profile*/
.profile-sidebar {
    float: left;
    width: 300px;
    margin-right: 20px
}

.profile-content {
    overflow: hidden
}

.profile-sidebar-portlet {
    padding: 30px 0 0!important
}

.profile-userpic img {
    float: none;
    margin: 0 auto;
    width: 50%;
    height: 20%;
    -webkit-border-radius: 50%!important;
    -moz-border-radius: 50%!important;
    border-radius: 50%!important
}

.profile-usertitle {
    text-align: center;
    margin-top: 20px
}

.profile-usertitle-name {
    color: #5a7391;
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 7px
}

.profile-usertitle-job {
    text-transform: uppercase;
    color: #5b9bd1;
    font-size: 13px;
    font-weight: 800;
    margin-bottom: 7px
}

.profile-userbuttons {
    text-align: center;
    margin-top: 10px
}

.profile-userbuttons .btn {
    margin-right: 5px
}

.profile-userbuttons .btn:last-child {
    margin-right: 0
}

.profile-userbuttons button {
    text-transform: uppercase;
    font-size: 11px;
    font-weight: 600;
    padding: 6px 15px
}

.profile-usermenu {
    margin-top: 30px;
    padding-bottom: 20px;
}

.profile-usermenu ul li {
    border-bottom: 1px solid #f0f4f7;
    width: 100%;
}

.profile-usermenu ul li:last-child {
    border-bottom: none
}

.profile-usermenu ul li a {
    color: #93a3b5;
    font-size: 16px;
    font-weight: 700;
    text-align: center;
}

.profile-usermenu ul li a i {
    margin-right: 8px;
    font-size: 16px
}

.profile-usermenu ul li a:hover {
    background-color: #fafcfd;
    color: #5b9bd1
}

.profile-usermenu ul li.active a {
    color: #5b9bd1;
    background-color: #f6f9fb;
    border-left: 2px solid #5b9bd1;
    margin-left: -2px
}

.profile-stat {
    padding-bottom: 20px;
    border-bottom: 1px solid #f0f4f7
}

.profile-stat-title {
    color: #7f90a4;
    font-size: 25px;
    text-align: center
}

.profile-stat-text {
    color: #5b9bd1;
    font-size: 11px;
    font-weight: 800;
    text-align: center
}

.profile-desc-title {
    color: #7f90a4;
    font-size: 17px;
    font-weight: 600
}

.profile-desc-text {
    color: #7e8c9e;
    font-size: 14px
}

.profile-desc-link i {
    width: 22px;
    font-size: 19px;
    color: #abb6c4;
    margin-right: 5px
}

.profile-desc-link a {
    font-size: 14px;
    font-weight: 600;
    color: #5b9bd1
}

@media (max-width:991px) {
    .profile-sidebar {
        float: none;
        width: 100%!important;
        margin: 0
    }
    .profile-sidebar>.portlet {
        margin-bottom: 20px
    }
    .profile-content {
        overflow: visible
    }
}


/*portlet*/
.page-portlet-fullscreen {
    overflow: hidden
}

.portlet {
    margin-top: 0;
    margin-bottom: 25px;
    padding: 0;
    border-radius: 4px
}

.portlet.portlet-fullscreen {
    z-index: 10060;
    margin: 0;
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background: #fff
}

.portlet.portlet-fullscreen>.portlet-body {
    overflow-y: auto;
    overflow-x: hidden;
    padding: 0 10px
}

.portlet.portlet-fullscreen>.portlet-title {
    padding: 0 10px
}

.portlet>.portlet-title {
    border-bottom: 1px solid #eee;
    padding: 0;
    margin-bottom: 10px;
    min-height: 41px;
    -webkit-border-radius: 4px 4px 0 0;
    -moz-border-radius: 4px 4px 0 0;
    -ms-border-radius: 4px 4px 0 0;
    -o-border-radius: 4px 4px 0 0;
    border-radius: 4px 4px 0 0
}

.portlet>.portlet-title:after,
.portlet>.portlet-title:before {
    content: " ";
    display: table
}

.portlet>.portlet-title:after {
    clear: both
}

.portlet>.portlet-title>.caption {
    /* float: left; */
    display: inline-block;
    font-size: 18px;
    line-height: 18px;
    padding: 10px 0
}

.portlet>.portlet-title>.caption.bold {
    font-weight: 400
}

.portlet>.portlet-title>.caption>i {
    /* float: left; */
    margin-top: 4px;
    display: inline-block;
    font-size: 13px;
    margin-right: 5px;
    color: #666
}

.portlet>.portlet-title>.caption>i.glyphicon {
    margin-top: 2px
}

.portlet>.portlet-title>.caption>.caption-helper {
    padding: 0;
    margin: 0;
    line-height: 13px;
    color: #9eacb4;
    font-size: 13px;
    font-weight: 400
}

.portlet>.portlet-title>.actions {
    /* float: right; */
    display: inline-block;
    padding: 6px 0
}

.portlet>.portlet-title>.actions>.dropdown-menu i {
    color: #555
}

.portlet>.portlet-title>.actions>.btn,
.portlet>.portlet-title>.actions>.btn-group>.btn,
.portlet>.portlet-title>.actions>.btn-group>.btn.btn-sm,
.portlet>.portlet-title>.actions>.btn.btn-sm {
    padding: 4px 10px;
    font-size: 13px;
    line-height: 1.5
}

.portlet>.portlet-title>.actions>.btn-group>.btn.btn-default,
.portlet>.portlet-title>.actions>.btn-group>.btn.btn-sm.btn-default,
.portlet>.portlet-title>.actions>.btn.btn-default,
.portlet>.portlet-title>.actions>.btn.btn-sm.btn-default {
    padding: 3px 9px
}

.portlet>.portlet-title>.actions>.btn-group>.btn.btn-sm>i,
.portlet>.portlet-title>.actions>.btn-group>.btn>i,
.portlet>.portlet-title>.actions>.btn.btn-sm>i,
.portlet>.portlet-title>.actions>.btn>i {
    font-size: 13px
}

.portlet>.portlet-title>.actions .btn-icon-only {
    padding: 5px 7px 3px
}

.portlet>.portlet-title>.actions .btn-icon-only.btn-default {
    padding: 4px 6px 2px
}

.portlet>.portlet-title>.actions .btn-icon-only.btn-default>i {
    font-size: 14px
}

.portlet>.portlet-title>.actions .btn-icon-only.btn-default.fullscreen {
    font-family: FontAwesome;
    color: #a0a0a0;
    padding-top: 3px
}

.portlet>.portlet-title>.actions .btn-icon-only.btn-default.fullscreen.btn-sm {
    padding: 3px!important;
    height: 27px;
    width: 27px
}

.portlet>.portlet-title>.actions .btn-icon-only.btn-default.fullscreen:before {
    content: "\f065"
}

.portlet>.portlet-title>.actions .btn-icon-only.btn-default.fullscreen.on:before {
    content: "\f066"
}

.portlet>.portlet-title>.tools {
    /* float: right; */
    display: inline-block;
    padding: 12px 0 8px
}

.portlet>.portlet-title>.tools>a {
    display: inline-block;
    height: 16px;
    margin-left: 5px;
    opacity: 1;
    filter: alpha(opacity=100)
}

.portlet>.portlet-title>.tools>a.fullscreen {
    display: inline-block;
    top: -3px;
    position: relative;
    font-size: 13px;
    font-family: FontAwesome;
    color: #ACACAC
}

.portlet>.portlet-title>.tools>a.fullscreen:before {
    content: "\f065"
}

.portlet>.portlet-title>.tools>a.fullscreen.on:before {
    content: "\f066"
}

.portlet>.portlet-title>.tools>a:hover {
    text-decoration: none;
    -webkit-transition: all .1s ease-in-out;
    -moz-transition: all .1s ease-in-out;
    -o-transition: all .1s ease-in-out;
    -ms-transition: all .1s ease-in-out;
    transition: all .1s ease-in-out;
    opacity: .8;
    filter: alpha(opacity=80)
}

.portlet>.portlet-title>.pagination {
    /* float: right; */
    display: inline-block;
    margin: 2px 0 0;
    border: 0;
    padding: 4px 0
}

.portlet>.portlet-title>.nav-tabs {
    background: 0 0;
    margin: 1px 0 0;
    /* float: right; */
    display: inline-block;
    border: 0
}

.portlet>.portlet-title>.nav-tabs>li {
    background: 0 0;
    margin: 0;
    border: 0
}

.portlet>.portlet-title>.nav-tabs>li>a {
    background: 0 0;
    margin: 5px 0 0 1px;
    border: 0;
    padding: 8px 10px;
    color: #fff
}

.portlet>.portlet-title>.nav-tabs>li.active>a,
.portlet>.portlet-title>.nav-tabs>li:hover>a {
    color: #333;
    background: #fff;
    border: 0
}

.portlet>.portlet-body {
    clear: both;
    -webkit-border-radius: 0 0 4px 4px;
    -moz-border-radius: 0 0 4px 4px;
    -ms-border-radius: 0 0 4px 4px;
    -o-border-radius: 0 0 4px 4px;
    border-radius: 0 0 4px 4px
}

.portlet>.portlet-body p {
    margin-top: 0
}

.portlet>.portlet-empty {
    min-height: 125px
}

.portlet.full-height-content {
    margin-bottom: 0
}

.portlet.bordered {
    border-left: 2px solid #e6e9ec!important
}

.portlet.bordered>.portlet-title {
    border-bottom: 0
}

.portlet.solid {
    padding: 0 10px 10px;
    border: 0
}

.portlet.solid>.portlet-title {
    border-bottom: 0;
    margin-bottom: 10px
}

.portlet.solid>.portlet-title>.caption {
    padding: 16px 0 2px
}

.portlet.solid>.portlet-title>.actions {
    padding: 12px 0 6px
}

.portlet.solid>.portlet-title>.tools {
    padding: 14px 0 6px
}

.portlet.solid.bordered>.portlet-title {
    margin-bottom: 10px
}

.portlet.box {
    padding: 0!important
}

.portlet.box>.portlet-title {
    border-bottom: 0;
    padding: 0 10px;
    margin-bottom: 0;
    color: #fff
}

.portlet.box>.portlet-title>.caption {
    padding: 11px 0 9px
}

.portlet.box>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box>.portlet-title>.actions {
    padding: 7px 0 5px
}

.portlet.box>.portlet-body {
    background-color: #fff;
    padding: 15px
}

.portlet.light {
    padding: 12px 20px 15px;
    background-color: #fff
}

.portlet.light.bordered {
    border: 1px solid #e7ecf1!important
}

.portlet.light.bordered>.portlet-title {
    border-bottom: 1px solid #eef1f5
}

.portlet.light.bg-inverse {
    background: #f1f4f7
}

.portlet.light>.portlet-title {
    padding: 0;
    min-height: 48px
}

.portlet.light>.portlet-title>.caption {
    color: #666;
    padding: 10px 0
}

.portlet.light>.portlet-title>.caption>.caption-subject {
    font-size: 16px
}

.portlet.light>.portlet-title>.caption>i {
    color: #777;
    font-size: 15px;
    font-weight: 300;
    margin-top: 3px
}

.portlet.solid.blue-chambray>.portlet-title>.caption,
.portlet.solid.blue-dark>.portlet-title>.caption,
.portlet.solid.blue-ebonyclay>.portlet-title>.caption,
.portlet.solid.blue-hoki>.portlet-title>.caption,
.portlet.solid.blue-madison>.portlet-title>.caption,
.portlet.solid.blue-oleo>.portlet-title>.caption,
.portlet.solid.blue-sharp>.portlet-title>.caption,
.portlet.solid.blue-soft>.portlet-title>.caption,
.portlet.solid.blue-steel>.portlet-title>.caption,
.portlet.solid.blue>.portlet-title>.caption,
.portlet.solid.dark>.portlet-title>.caption,
.portlet.solid.default>.portlet-title>.caption,
.portlet.solid.green-dark>.portlet-title>.caption,
.portlet.solid.green-haze>.portlet-title>.caption,
.portlet.solid.green-jungle>.portlet-title>.caption,
.portlet.solid.green-meadow>.portlet-title>.caption,
.portlet.solid.green-seagreen>.portlet-title>.caption,
.portlet.solid.green-sharp>.portlet-title>.caption,
.portlet.solid.green-soft>.portlet-title>.caption,
.portlet.solid.green-steel>.portlet-title>.caption,
.portlet.solid.green-turquoise>.portlet-title>.caption,
.portlet.solid.green>.portlet-title>.caption,
.portlet.solid.grey-cararra>.portlet-title>.caption,
.portlet.solid.grey-cascade>.portlet-title>.caption,
.portlet.solid.grey-gallery>.portlet-title>.caption,
.portlet.solid.grey-mint>.portlet-title>.caption,
.portlet.solid.grey-salt>.portlet-title>.caption,
.portlet.solid.grey-silver>.portlet-title>.caption,
.portlet.solid.grey-steel>.portlet-title>.caption,
.portlet.solid.grey>.portlet-title>.caption,
.portlet.solid.purple-intense>.portlet-title>.caption,
.portlet.solid.purple-medium>.portlet-title>.caption,
.portlet.solid.purple-plum>.portlet-title>.caption,
.portlet.solid.purple-seance>.portlet-title>.caption,
.portlet.solid.purple-sharp>.portlet-title>.caption,
.portlet.solid.purple-soft>.portlet-title>.caption,
.portlet.solid.purple-studio>.portlet-title>.caption,
.portlet.solid.purple-wisteria>.portlet-title>.caption,
.portlet.solid.purple>.portlet-title>.caption,
.portlet.solid.red-flamingo>.portlet-title>.caption,
.portlet.solid.red-haze>.portlet-title>.caption,
.portlet.solid.red-intense>.portlet-title>.caption,
.portlet.solid.red-mint>.portlet-title>.caption,
.portlet.solid.red-pink>.portlet-title>.caption,
.portlet.solid.red-soft>.portlet-title>.caption,
.portlet.solid.red-sunglo>.portlet-title>.caption,
.portlet.solid.red-thunderbird>.portlet-title>.caption,
.portlet.solid.red>.portlet-title>.caption,
.portlet.solid.white>.portlet-title>.caption,
.portlet.solid.yellow-casablanca>.portlet-title>.caption,
.portlet.solid.yellow-crusta>.portlet-title>.caption,
.portlet.solid.yellow-gold>.portlet-title>.caption,
.portlet.solid.yellow-haze>.portlet-title>.caption,
.portlet.solid.yellow-lemon>.portlet-title>.caption,
.portlet.solid.yellow-mint>.portlet-title>.caption,
.portlet.solid.yellow-saffron>.portlet-title>.caption,
.portlet.solid.yellow-soft>.portlet-title>.caption,
.portlet.solid.yellow>.portlet-title>.caption {
    font-weight: 400
}

.portlet.light>.portlet-title>.caption.caption-md>.caption-subject {
    font-size: 15px
}

.portlet.light>.portlet-title>.caption.caption-md>i {
    font-size: 14px
}

.portlet.light>.portlet-title>.actions {
    padding: 6px 0 14px
}

.portlet.light>.portlet-title>.actions .btn-default {
    color: #666
}

.portlet.light>.portlet-title>.actions .btn-icon-only {
    height: 27px;
    width: 27px
}

.portlet.light>.portlet-title>.actions .dropdown-menu li>a {
    color: #555
}

.portlet.light>.portlet-title>.inputs {
    /* float: right; */
    display: inline-block;
    padding: 4px 0
}

.portlet.light>.portlet-title>.inputs>.portlet-input .input-icon>i {
    font-size: 14px;
    margin-top: 9px
}

.portlet.light>.portlet-title>.inputs>.portlet-input .input-icon>.form-control {
    height: 30px;
    padding: 2px 26px 3px 10px;
    font-size: 13px
}

.portlet.light>.portlet-title>.inputs>.portlet-input>.form-control {
    height: 30px;
    padding: 3px 10px;
    font-size: 13px
}

.portlet.light>.portlet-title>.pagination {
    padding: 2px 0 13px
}

.portlet.light>.portlet-title>.tools {
    padding: 10px 0 13px;
    margin-top: 2px
}

.portlet.light>.portlet-title>.nav-tabs>li {
    margin: 0;
    padding: 0
}

.portlet.light>.portlet-title>.nav-tabs>li>a {
    margin: 0;
    padding: 12px 13px 13px;
    font-size: 13px;
    color: #666
}

.portlet.light>.portlet-title>.nav-tabs>li.active>a,
.portlet.light>.portlet-title>.nav-tabs>li:hover>a {
    margin: 0;
    background: 0 0;
    color: #333
}

.portlet.light.form-fit {
    padding: 0
}

.portlet.light.form-fit>.portlet-title {
    padding: 17px 20px 10px;
    margin-bottom: 0
}

.portlet.light .portlet-body {
    padding-top: 8px
}

.portlet.light.portlet-fullscreen>.portlet-body {
    padding: 8px 0
}

.portlet.light.portlet-fit {
    padding: 0
}

.portlet.light.portlet-fit>.portlet-title {
    padding: 15px 20px 10px
}

.portlet.light.portlet-fit>.portlet-body {
    padding: 10px 20px 20px
}

.portlet.light.portlet-fit.portlet-form>.portlet-body {
    padding: 0
}

.portlet.light.portlet-fit.portlet-form>.portlet-body .form-actions {
    background: 0 0
}

.portlet.box.white>.portlet-title,
.portlet.white,
.portlet>.portlet-body.white {
    background-color: #fff
}

.portlet.light.portlet-datatable.portlet-fit>.portlet-body {
    padding-top: 10px;
    padding-bottom: 25px
}

.tab-pane>p:last-child {
    margin-bottom: 0
}

.tabs-reversed>li {
    float: right;
    margin-right: 0
}

.tabs-reversed>li>a {
    margin-right: 0
}

.portlet-sortable-placeholder {
    border: 2px dashed #eee;
    margin-bottom: 25px
}

.portlet-sortable-empty {
    box-shadow: none!important;
    height: 45px
}

.portlet-collapsed {
    display: none
}

@media (max-width:991px) {
    .portlet-collapsed-on-mobile {
        display: none
    }
}

.portlet.solid.white>.portlet-body,
.portlet.solid.white>.portlet-title {
    border: 0;
    color: #666
}

.portlet.solid.white>.portlet-title>.caption>i {
    color: #666
}

.portlet.solid.white>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.white {
    border: 1px solid #fff;
    border-top: 0
}

.portlet.box.white>.portlet-title>.caption,
.portlet.box.white>.portlet-title>.caption>i {
    color: #666
}

.portlet.box.white>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #fff;
    color: #fff
}

.portlet.box.default>.portlet-title,
.portlet.default,
.portlet>.portlet-body.default {
    background-color: #e1e5ec
}

.portlet.box.white>.portlet-title>.actions .btn-default>i {
    color: #fff
}

.portlet.box.white>.portlet-title>.actions .btn-default.active,
.portlet.box.white>.portlet-title>.actions .btn-default:active,
.portlet.box.white>.portlet-title>.actions .btn-default:focus,
.portlet.box.white>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #fff;
    color: #fff
}

.portlet.solid.default>.portlet-body,
.portlet.solid.default>.portlet-title {
    border: 0;
    color: #666
}

.portlet.solid.default>.portlet-title>.caption>i {
    color: #666
}

.portlet.solid.default>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.default {
    border: 1px solid #fff;
    border-top: 0
}

.portlet.box.default>.portlet-title>.caption,
.portlet.box.default>.portlet-title>.caption>i {
    color: #666
}

.portlet.box.default>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #fff;
    color: #fff
}

.portlet.box.dark>.portlet-title,
.portlet.dark,
.portlet>.portlet-body.dark {
    background-color: #2f353b
}

.portlet.box.default>.portlet-title>.actions .btn-default>i {
    color: #fff
}

.portlet.box.default>.portlet-title>.actions .btn-default.active,
.portlet.box.default>.portlet-title>.actions .btn-default:active,
.portlet.box.default>.portlet-title>.actions .btn-default:focus,
.portlet.box.default>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #fff;
    color: #fff
}

.portlet.solid.dark>.portlet-body,
.portlet.solid.dark>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.dark>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.dark>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.dark {
    border: 1px solid #464f57;
    border-top: 0
}

.portlet.box.dark>.portlet-title>.caption,
.portlet.box.dark>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.dark>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #616d79;
    color: #6c7a88
}

.portlet.blue,
.portlet.box.blue>.portlet-title,
.portlet>.portlet-body.blue {
    background-color: #3598dc
}

.portlet.box.dark>.portlet-title>.actions .btn-default>i {
    color: #738290
}

.portlet.box.dark>.portlet-title>.actions .btn-default.active,
.portlet.box.dark>.portlet-title>.actions .btn-default:active,
.portlet.box.dark>.portlet-title>.actions .btn-default:focus,
.portlet.box.dark>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #798794;
    color: #8793a0
}

.portlet.solid.blue>.portlet-body,
.portlet.solid.blue>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.blue>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.blue>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.blue {
    border: 1px solid #60aee4;
    border-top: 0
}

.portlet.box.blue>.portlet-title>.caption,
.portlet.box.blue>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.blue>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #95c9ed;
    color: #aad4f0
}

.portlet.blue-madison,
.portlet.box.blue-madison>.portlet-title,
.portlet>.portlet-body.blue-madison {
    background-color: #578ebe
}

.portlet.box.blue>.portlet-title>.actions .btn-default>i {
    color: #b7daf3
}

.portlet.box.blue>.portlet-title>.actions .btn-default.active,
.portlet.box.blue>.portlet-title>.actions .btn-default:active,
.portlet.box.blue>.portlet-title>.actions .btn-default:focus,
.portlet.box.blue>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #c0dff4;
    color: #d6eaf8
}

.portlet.solid.blue-madison>.portlet-body,
.portlet.solid.blue-madison>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.blue-madison>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.blue-madison>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.blue-madison {
    border: 1px solid #7ca7cc;
    border-top: 0
}

.portlet.box.blue-madison>.portlet-title>.caption,
.portlet.box.blue-madison>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.blue-madison>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #a8c4dd;
    color: #bad1e4
}

.portlet.blue-chambray,
.portlet.box.blue-chambray>.portlet-title,
.portlet>.portlet-body.blue-chambray {
    background-color: #2C3E50
}

.portlet.box.blue-madison>.portlet-title>.actions .btn-default>i {
    color: #c5d8e9
}

.portlet.box.blue-madison>.portlet-title>.actions .btn-default.active,
.portlet.box.blue-madison>.portlet-title>.actions .btn-default:active,
.portlet.box.blue-madison>.portlet-title>.actions .btn-default:focus,
.portlet.box.blue-madison>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #cdddec;
    color: #dfeaf3
}

.portlet.solid.blue-chambray>.portlet-body,
.portlet.solid.blue-chambray>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.blue-chambray>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.blue-chambray>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.blue-chambray {
    border: 1px solid #3e5871;
    border-top: 0
}

.portlet.box.blue-chambray>.portlet-title>.caption,
.portlet.box.blue-chambray>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.blue-chambray>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #547698;
    color: #5f83a7
}

.portlet.blue-ebonyclay,
.portlet.box.blue-ebonyclay>.portlet-title,
.portlet>.portlet-body.blue-ebonyclay {
    background-color: #22313F
}

.portlet.box.blue-chambray>.portlet-title>.actions .btn-default>i {
    color: #698bac
}

.portlet.box.blue-chambray>.portlet-title>.actions .btn-default.active,
.portlet.box.blue-chambray>.portlet-title>.actions .btn-default:active,
.portlet.box.blue-chambray>.portlet-title>.actions .btn-default:focus,
.portlet.box.blue-chambray>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #6f90b0;
    color: #809cb9
}

.portlet.solid.blue-ebonyclay>.portlet-body,
.portlet.solid.blue-ebonyclay>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.blue-ebonyclay>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.blue-ebonyclay>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.blue-ebonyclay {
    border: 1px solid #344b60;
    border-top: 0
}

.portlet.box.blue-ebonyclay>.portlet-title>.caption,
.portlet.box.blue-ebonyclay>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.blue-ebonyclay>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #496a88;
    color: #527798
}

.portlet.blue-hoki,
.portlet.box.blue-hoki>.portlet-title,
.portlet>.portlet-body.blue-hoki {
    background-color: #67809F
}

.portlet.box.blue-ebonyclay>.portlet-title>.actions .btn-default>i {
    color: #587ea2
}

.portlet.box.blue-ebonyclay>.portlet-title>.actions .btn-default.active,
.portlet.box.blue-ebonyclay>.portlet-title>.actions .btn-default:active,
.portlet.box.blue-ebonyclay>.portlet-title>.actions .btn-default:focus,
.portlet.box.blue-ebonyclay>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #5d83a7;
    color: #6d90b0
}

.portlet.solid.blue-hoki>.portlet-body,
.portlet.solid.blue-hoki>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.blue-hoki>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.blue-hoki>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.blue-hoki {
    border: 1px solid #869ab3;
    border-top: 0
}

.portlet.box.blue-hoki>.portlet-title>.caption,
.portlet.box.blue-hoki>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.blue-hoki>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #acb9ca;
    color: #bbc7d4
}

.portlet.blue-steel,
.portlet.box.blue-steel>.portlet-title,
.portlet>.portlet-body.blue-steel {
    background-color: #4B77BE
}

.portlet.box.blue-hoki>.portlet-title>.actions .btn-default>i {
    color: #c5ceda
}

.portlet.box.blue-hoki>.portlet-title>.actions .btn-default.active,
.portlet.box.blue-hoki>.portlet-title>.actions .btn-default:active,
.portlet.box.blue-hoki>.portlet-title>.actions .btn-default:focus,
.portlet.box.blue-hoki>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #cbd4de;
    color: #dbe1e8
}

.portlet.solid.blue-steel>.portlet-body,
.portlet.solid.blue-steel>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.blue-steel>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.blue-steel>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.blue-steel {
    border: 1px solid #7093cc;
    border-top: 0
}

.portlet.box.blue-steel>.portlet-title>.caption,
.portlet.box.blue-steel>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.blue-steel>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #9db5dc;
    color: #b0c3e3
}

.portlet.blue-soft,
.portlet.box.blue-soft>.portlet-title,
.portlet>.portlet-body.blue-soft {
    background-color: #4c87b9
}

.portlet.box.blue-steel>.portlet-title>.actions .btn-default>i {
    color: #bbcce7
}

.portlet.box.blue-steel>.portlet-title>.actions .btn-default.active,
.portlet.box.blue-steel>.portlet-title>.actions .btn-default:active,
.portlet.box.blue-steel>.portlet-title>.actions .btn-default:focus,
.portlet.box.blue-steel>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #c3d2e9;
    color: #d6e0f0
}

.portlet.solid.blue-soft>.portlet-body,
.portlet.solid.blue-soft>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.blue-soft>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.blue-soft>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.blue-soft {
    border: 1px solid #71a0c7;
    border-top: 0
}

.portlet.box.blue-soft>.portlet-title>.caption,
.portlet.box.blue-soft>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.blue-soft>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #9dbdd9;
    color: #afc9e0
}

.portlet.blue-dark,
.portlet.box.blue-dark>.portlet-title,
.portlet>.portlet-body.blue-dark {
    background-color: #5e738b
}

.portlet.box.blue-soft>.portlet-title>.actions .btn-default>i {
    color: #bad1e4
}

.portlet.box.blue-soft>.portlet-title>.actions .btn-default.active,
.portlet.box.blue-soft>.portlet-title>.actions .btn-default:active,
.portlet.box.blue-soft>.portlet-title>.actions .btn-default:focus,
.portlet.box.blue-soft>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #c1d6e7;
    color: #d4e2ee
}

.portlet.solid.blue-dark>.portlet-body,
.portlet.solid.blue-dark>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.blue-dark>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.blue-dark>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.blue-dark {
    border: 1px solid #788da4;
    border-top: 0
}

.portlet.box.blue-dark>.portlet-title>.caption,
.portlet.box.blue-dark>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.blue-dark>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #9dacbd;
    color: #acb8c7
}

.portlet.blue-sharp,
.portlet.box.blue-sharp>.portlet-title,
.portlet>.portlet-body.blue-sharp {
    background-color: #5C9BD1
}

.portlet.box.blue-dark>.portlet-title>.actions .btn-default>i {
    color: #b5c0cd
}

.portlet.box.blue-dark>.portlet-title>.actions .btn-default.active,
.portlet.box.blue-dark>.portlet-title>.actions .btn-default:active,
.portlet.box.blue-dark>.portlet-title>.actions .btn-default:focus,
.portlet.box.blue-dark>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #bbc5d1;
    color: #cad2db
}

.portlet.solid.blue-sharp>.portlet-body,
.portlet.solid.blue-sharp>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.blue-sharp>.portlet-title>.caption>i {
    color: #FFF
}


.portlet.solid.blue-sharp>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.blue-sharp {
    border: 1px solid #84b3dc;
    border-top: 0
}

.portlet.box.blue-sharp>.portlet-title>.caption,
.portlet.box.blue-sharp>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.blue-sharp>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #b4d1ea;
    color: #c7ddef
}

.portlet.blue-oleo,
.portlet.box.blue-oleo>.portlet-title,
.portlet>.portlet-body.blue-oleo {
    background-color: #94A0B2
}

.portlet.box.blue-sharp>.portlet-title>.actions .btn-default>i {
    color: #d3e4f3
}

.portlet.box.blue-sharp>.portlet-title>.actions .btn-default.active,
.portlet.box.blue-sharp>.portlet-title>.actions .btn-default:active,
.portlet.box.blue-sharp>.portlet-title>.actions .btn-default:focus,
.portlet.box.blue-sharp>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #dbe9f5;
    color: #eff5fb
}

.portlet.solid.blue-oleo>.portlet-body,
.portlet.solid.blue-oleo>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.blue-oleo>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.blue-oleo>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.blue-oleo {
    border: 1px solid #b2bac7;
    border-top: 0
}

.portlet.box.blue-oleo>.portlet-title>.caption,
.portlet.box.blue-oleo>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.blue-oleo>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #d5dae1;
    color: #e4e7ec
}

.portlet.box.green>.portlet-title,
.portlet.green,
.portlet>.portlet-body.green {
    background-color: #32c5d2
}

.portlet.box.blue-oleo>.portlet-title>.actions .btn-default>i {
    color: #edeff2
}

.portlet.box.blue-oleo>.portlet-title>.actions .btn-default.active,
.portlet.box.blue-oleo>.portlet-title>.actions .btn-default:active,
.portlet.box.blue-oleo>.portlet-title>.actions .btn-default:focus,
.portlet.box.blue-oleo>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #f3f4f6;
    color: #fff
}

.portlet.solid.green>.portlet-body,
.portlet.solid.green>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.green>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.green>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.green {
    border: 1px solid #5cd1db;
    border-top: 0
}

.portlet.box.green>.portlet-title>.caption,
.portlet.box.green>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.green>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #8edfe6;
    color: #a3e5eb
}

.portlet.box.green-meadow>.portlet-title,
.portlet.green-meadow,
.portlet>.portlet-body.green-meadow {
    background-color: #1BBC9B
}

.portlet.box.green>.portlet-title>.actions .btn-default>i {
    color: #afe8ee
}

.portlet.box.green>.portlet-title>.actions .btn-default.active,
.portlet.box.green>.portlet-title>.actions .btn-default:active,
.portlet.box.green>.portlet-title>.actions .btn-default:focus,
.portlet.box.green>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #b8ebef;
    color: #cdf1f4
}

.portlet.solid.green-meadow>.portlet-body,
.portlet.solid.green-meadow>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.green-meadow>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.green-meadow>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.green-meadow {
    border: 1px solid #2ae0bb;
    border-top: 0
}

.portlet.box.green-meadow>.portlet-title>.caption,
.portlet.box.green-meadow>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.green-meadow>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #5fe8cc;
    color: #75ebd3
}

.portlet.box.green-seagreen>.portlet-title,
.portlet.green-seagreen,
.portlet>.portlet-body.green-seagreen {
    background-color: #1BA39C
}

.portlet.box.green-meadow>.portlet-title>.actions .btn-default>i {
    color: #83edd7
}

.portlet.box.green-meadow>.portlet-title>.actions .btn-default.active,
.portlet.box.green-meadow>.portlet-title>.actions .btn-default:active,
.portlet.box.green-meadow>.portlet-title>.actions .btn-default:focus,
.portlet.box.green-meadow>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #8ceeda;
    color: #a2f2e1
}

.portlet.solid.green-seagreen>.portlet-body,
.portlet.solid.green-seagreen>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.green-seagreen>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.green-seagreen>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.green-seagreen {
    border: 1px solid #22cfc6;
    border-top: 0
}

.portlet.box.green-seagreen>.portlet-title>.caption,
.portlet.box.green-seagreen>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.green-seagreen>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #4de1da;
    color: #63e5de
}

.portlet.box.green-turquoise>.portlet-title,
.portlet.green-turquoise,
.portlet>.portlet-body.green-turquoise {
    background-color: #36D7B7
}

.portlet.box.green-seagreen>.portlet-title>.actions .btn-default>i {
    color: #70e7e1
}

.portlet.box.green-seagreen>.portlet-title>.actions .btn-default.active,
.portlet.box.green-seagreen>.portlet-title>.actions .btn-default:active,
.portlet.box.green-seagreen>.portlet-title>.actions .btn-default:focus,
.portlet.box.green-seagreen>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #78e9e3;
    color: #8eece8
}

.portlet.solid.green-turquoise>.portlet-body,
.portlet.solid.green-turquoise>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.green-turquoise>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.green-turquoise>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.green-turquoise {
    border: 1px solid #61dfc6;
    border-top: 0
}

.portlet.box.green-turquoise>.portlet-title>.caption,
.portlet.box.green-turquoise>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.green-turquoise>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #94ead9;
    color: #a9eee0
}

.portlet.box.green-haze>.portlet-title,
.portlet.green-haze,
.portlet>.portlet-body.green-haze {
    background-color: #44b6ae
}

.portlet.box.green-turquoise>.portlet-title>.actions .btn-default>i {
    color: #b6f0e5
}

.portlet.box.green-turquoise>.portlet-title>.actions .btn-default.active,
.portlet.box.green-turquoise>.portlet-title>.actions .btn-default:active,
.portlet.box.green-turquoise>.portlet-title>.actions .btn-default:focus,
.portlet.box.green-turquoise>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #bef2e8;
    color: #d3f6ef
}

.portlet.solid.green-haze>.portlet-body,
.portlet.solid.green-haze>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.green-haze>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.green-haze>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.green-haze {
    border: 1px solid #67c6bf;
    border-top: 0
}

.portlet.box.green-haze>.portlet-title>.caption,
.portlet.box.green-haze>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.green-haze>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #93d7d2;
    color: #a6deda
}

.portlet.box.green-jungle>.portlet-title,
.portlet.green-jungle,
.portlet>.portlet-body.green-jungle {
    background-color: #26C281
}

.portlet.box.green-haze>.portlet-title>.actions .btn-default>i {
    color: #b1e2de
}

.portlet.box.green-haze>.portlet-title>.actions .btn-default.active,
.portlet.box.green-haze>.portlet-title>.actions .btn-default:active,
.portlet.box.green-haze>.portlet-title>.actions .btn-default:focus,
.portlet.box.green-haze>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #b9e5e2;
    color: #cbece9
}

.portlet.solid.green-jungle>.portlet-body,
.portlet.solid.green-jungle>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.green-jungle>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.green-jungle>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.green-jungle {
    border: 1px solid #41da9a;
    border-top: 0
}

.portlet.box.green-jungle>.portlet-title>.caption,
.portlet.box.green-jungle>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.green-jungle>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #74e4b5;
    color: #8ae8c1
}

.portlet.box.green-soft>.portlet-title,
.portlet.green-soft,
.portlet>.portlet-body.green-soft {
    background-color: #3faba4
}

.portlet.box.green-jungle>.portlet-title>.actions .btn-default>i {
    color: #96ebc8
}

.portlet.box.green-jungle>.portlet-title>.actions .btn-default.active,
.portlet.box.green-jungle>.portlet-title>.actions .btn-default:active,
.portlet.box.green-jungle>.portlet-title>.actions .btn-default:focus,
.portlet.box.green-jungle>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #9feccc;
    color: #b4f0d7
}

.portlet.solid.green-soft>.portlet-body,
.portlet.solid.green-soft>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.green-soft>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.green-soft>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.green-soft {
    border: 1px solid #5bc2bc;
    border-top: 0
}

.portlet.box.green-soft>.portlet-title>.caption,
.portlet.box.green-soft>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.green-soft>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #87d3ce;
    color: #9adad6
}

.portlet.box.green-dark>.portlet-title,
.portlet.green-dark,
.portlet>.portlet-body.green-dark {
    background-color: #4DB3A2
}

.portlet.box.green-soft>.portlet-title>.actions .btn-default>i {
    color: #a5deda
}

.portlet.box.green-soft>.portlet-title>.actions .btn-default.active,
.portlet.box.green-soft>.portlet-title>.actions .btn-default:active,
.portlet.box.green-soft>.portlet-title>.actions .btn-default:focus,
.portlet.box.green-soft>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #ade1dd;
    color: #bfe7e5
}

.portlet.solid.green-dark>.portlet-body,
.portlet.solid.green-dark>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.green-dark>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.green-dark>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.green-dark {
    border: 1px solid #71c2b5;
    border-top: 0
}

.portlet.box.green-dark>.portlet-title>.caption,
.portlet.box.green-dark>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.green-dark>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #9cd5cb;
    color: #addcd4
}

.portlet.box.green-sharp>.portlet-title,
.portlet.green-sharp,
.portlet>.portlet-body.green-sharp {
    background-color: #2ab4c0
}

.portlet.box.green-dark>.portlet-title>.actions .btn-default>i {
    color: #b8e1da
}

.portlet.box.green-dark>.portlet-title>.actions .btn-default.active,
.portlet.box.green-dark>.portlet-title>.actions .btn-default:active,
.portlet.box.green-dark>.portlet-title>.actions .btn-default:focus,
.portlet.box.green-dark>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #bfe4de;
    color: #d1ebe7
}

.portlet.solid.green-sharp>.portlet-body,
.portlet.solid.green-sharp>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.green-sharp>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.green-sharp>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.green-sharp {
    border: 1px solid #46cbd7;
    border-top: 0
}

.portlet.box.green-sharp>.portlet-title>.caption,
.portlet.box.green-sharp>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.green-sharp>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #79d9e2;
    color: #8edfe6
}

.portlet.box.green-steel>.portlet-title,
.portlet.green-steel,
.portlet>.portlet-body.green-steel {
    background-color: #29b4b6
}

.portlet.box.green-sharp>.portlet-title>.actions .btn-default>i {
    color: #9ae3e9
}

.portlet.box.green-sharp>.portlet-title>.actions .btn-default.active,
.portlet.box.green-sharp>.portlet-title>.actions .btn-default:active,
.portlet.box.green-sharp>.portlet-title>.actions .btn-default:focus,
.portlet.box.green-sharp>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #a2e5eb;
    color: #b7ebef
}

.portlet.solid.green-steel>.portlet-body,
.portlet.solid.green-steel>.portlet-title {
    border: 0;
    color: #FFF
}

.portlet.solid.green-steel>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.solid.green-steel>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.green-steel {
    border: 1px solid #3ed1d4;
    border-top: 0
}

.portlet.box.green-steel>.portlet-title>.caption,
.portlet.box.green-steel>.portlet-title>.caption>i {
    color: #FFF
}

.portlet.box.green-steel>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #70dddf;
    color: #85e2e4
}

.portlet.box.grey>.portlet-title,
.portlet.grey,
.portlet>.portlet-body.grey {
    background-color: #E5E5E5
}

.portlet.box.green-steel>.portlet-title>.actions .btn-default>i {
    color: #92e5e6
}

.portlet.box.green-steel>.portlet-title>.actions .btn-default.active,
.portlet.box.green-steel>.portlet-title>.actions .btn-default:active,
.portlet.box.green-steel>.portlet-title>.actions .btn-default:focus,
.portlet.box.green-steel>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #9ae7e8;
    color: #afeced
}

.portlet.solid.grey>.portlet-body,
.portlet.solid.grey>.portlet-title {
    border: 0;
    color: #333
}

.portlet.solid.grey>.portlet-title>.caption>i {
    color: #333
}

.portlet.solid.grey>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.grey {
    border: 1px solid #fff;
    border-top: 0
}

.portlet.box.grey>.portlet-title>.caption,
.portlet.box.grey>.portlet-title>.caption>i {
    color: #333
}

.portlet.box.grey>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #fff;
    color: #fff
}

.portlet.box.grey-steel>.portlet-title,
.portlet.grey-steel,
.portlet>.portlet-body.grey-steel {
    background-color: #e9edef
}

.portlet.box.grey>.portlet-title>.actions .btn-default>i {
    color: #fff
}

.portlet.box.grey>.portlet-title>.actions .btn-default.active,
.portlet.box.grey>.portlet-title>.actions .btn-default:active,
.portlet.box.grey>.portlet-title>.actions .btn-default:focus,
.portlet.box.grey>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #fff;
    color: #fff
}

.portlet.solid.grey-steel>.portlet-body,
.portlet.solid.grey-steel>.portlet-title {
    border: 0;
    color: #80898e
}

.portlet.solid.grey-steel>.portlet-title>.caption>i {
    color: #80898e
}

.portlet.solid.grey-steel>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.grey-steel {
    border: 1px solid #fff;
    border-top: 0
}

.portlet.box.grey-steel>.portlet-title>.caption,
.portlet.box.grey-steel>.portlet-title>.caption>i {
    color: #80898e
}

.portlet.box.grey-steel>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #fff;
    color: #fff
}

.portlet.box.grey-cararra>.portlet-title,
.portlet.grey-cararra,
.portlet>.portlet-body.grey-cararra {
    background-color: #fafafa
}

.portlet.box.grey-steel>.portlet-title>.actions .btn-default>i {
    color: #fff
}

.portlet.box.grey-steel>.portlet-title>.actions .btn-default.active,
.portlet.box.grey-steel>.portlet-title>.actions .btn-default:active,
.portlet.box.grey-steel>.portlet-title>.actions .btn-default:focus,
.portlet.box.grey-steel>.portlet-title>.actions .btn-default:hover {
    border: 1px solid #fff;
    color: #fff
}

.portlet.solid.grey-cararra>.portlet-body,
.portlet.solid.grey-cararra>.portlet-title {
    border: 0;
    color: #333
}

.portlet.solid.grey-cararra>.portlet-title>.caption>i {
    color: #333
}

.portlet.solid.grey-cararra>.portlet-title>.tools>a.fullscreen {
    color: #fdfdfd
}

.portlet.box.grey-cararra {
    border: 1px solid #fff;
    border-top: 0
}

.portlet.box.grey-cararra>.portlet-title>.caption,
.portlet.box.grey-cararra>.portlet-title>.caption>i {
    color: #333
}

.portlet.box.grey-cararra>.portlet-title>.actions .btn-default {
    background: 0 0!important;
    border: 1px solid #fff;
    color: #fff
}

.portlet.box.grey-gallery>.portlet-title,
.portlet.grey-gallery,
.portlet>.portlet-body.grey-gallery {
    background-color: #555
}

.portlet.box.grey-cararra>.portlet-title>.actions .btn-default>i {
    color: #fff
}

.portlet.box.grey-cararra>.portlet-title>.actions .btn-default.active,
.portlet.box.grey-cararra>.portlet-title>.actions .btn-default:active,
.portlet.box.grey-cararra>.portlet-title>.actions .btn-default

/* css riwayat pesanan */
.cell-1 {
    border-collapse: separate;
    border-spacing: 0 4em;
    background: #fff;
    border-bottom: 5px solid transparent;
    background-clip: padding-box
}

thead {
    background: #dddcdc
}

.toggle-btn {
    width: 40px;
    height: 21px;
    background: grey;
    border-radius: 50px;
    padding: 3px;
    cursor: pointer;
    -webkit-transition: all 0.3s 0.1s ease-in-out;
    -moz-transition: all 0.3s 0.1s ease-in-out;
    -o-transition: all 0.3s 0.1s ease-in-out;
    transition: all 0.3s 0.1s ease-in-out
}

.toggle-btn>.inner-circle {
    width: 15px;
    height: 15px;
    background: #fff;
    border-radius: 50%;
    -webkit-transition: all 0.3s 0.1s ease-in-out;
    -moz-transition: all 0.3s 0.1s ease-in-out;
    -o-transition: all 0.3s 0.1s ease-in-out;
    transition: all 0.3s 0.1s ease-in-out
}

.toggle-btn.active {
    background: blue !important
}

.toggle-btn.active>.inner-circle {
    margin-left: 19px
}

.table .badge.badge-success{
    background-color: rgb(4, 156, 4);
}
.table .badge.badge-info{
    background-color: #2ab4c0;
}
.table .badge.badge-danger{
    background-color: red;
}
</style>

<script type="text/javascript">
    $(".reveal").on('click',function() {
        var $pwd = $(".pwd");
        if ($pwd.attr('type') === 'password') {
            $pwd.attr('type', 'text');
        } else {
            $pwd.attr('type', 'password');
        }
    });
    $(".reveal1").on('click',function() {
        var $pwd = $(".pwd1");
        if ($pwd.attr('type') === 'password') {
            $pwd.attr('type', 'text');
        } else {
            $pwd.attr('type', 'password');
        }
    });
</script>
<script>
    var editButton = document.getElementById("editButton");
    
    function editProfile() {
        var inputs = document.querySelectorAll("input.profile");
        for (var i = 0; i < inputs.length; i++) {
            console.log(inputs[i].value);
            inputs[i].disabled = false;
            inputs[i].readOnly = false; 
        }
        document.querySelector("button.profile").disabled = false;
        editButton.disabled=true;
    }
 </script>
</body>
</html>