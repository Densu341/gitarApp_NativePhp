<?php
    session_start();
    include 'db.php';
    if ($_SESSION['status_login'] != true) {
        echo '<script>window.location="login.php"</script>';
    }

    $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id='".$_SESSION['a_id']."'");
    $d = mysqli_fetch_object($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil | GitarKu</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
    <!--header-->
    <header>
        <div class="container">
            <h1>GitarKu</h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data_kategori.php">Kategori</a></li>
                <li><a href="data_produk.php">Produk</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header>
    <!--content-->
    <div class="section">
        <div class="container">
            <h3>Profil</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_name?>" required>
                    <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username?>"required>
                    <input type="text" name="hp" placeholder="No Hp" class="input-control" value="<?php echo $d->admin_telp?>" required>
                    <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email?>" required>
                    <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->admin_address?>" required>
                    <input type="submit" name="submit" value="Ubah Profil" class="btn">
                </form>
                <?php 
                    if(isset($_POST['submit'])) {
                        $nama   =ucwords($_POST['nama']);
                        $user   =$_POST['user'];
                        $hp     =$_POST['hp'];
                        $email  =$_POST['email'];
                        $alamat =ucwords($_POST['alamat']);

                        $update = mysqli_query($conn, "UPDATE tb_admin SET
                                        admin_name  ='".$nama."',
                                        username  ='".$user."',
                                        admin_telp  ='".$hp."',
                                        admin_email  ='".$email."',
                                        admin_address  ='".$alamat."'
                                        WHERE admin_id ='".$d->admin_id."' ");
                        if($update){
                            echo'<script>alert("Update data berhasil")</script>';
                            echo'<script>window.location="profil.php"</script>';
                        } else {
                            echo'gagal'.mysqli_error($conn);
                        }
                    }
                ?>
            </div>

            <h3>Ubah Password</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
                    <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="input-control" required>
                    <input type="submit" name="ubah_password" value="Ubah Password" class="btn">
                </form>
                <?php 
                    if(isset($_POST['ubah_password'])) {
                        $pass1      =$_POST['pass1'];
                        $pass2      =$_POST['pass2'];

                        if($pass2 != $pass1) {
                            echo '<script>alert("Konfirmasi Password Baru Tidak Sesuai")</script>';
                        } else {
                            $u_pass = mysqli_query($conn, "UPDATE tb_admin SET
                                        password  ='".MD5($pass1)."'
                                        WHERE admin_id ='".$d->admin_id."' ");
                            if($u_pass) {
                                echo '<script>alert("Password Berhasil Diubah")</script>';
                                echo '<script>window.location="profil.php"</script>';
                            } else {
                                echo 'gagal'.mysqli_error($conn);
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <!--footer-->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2022 - Deni Irawan</small>
        </div>
    </footer>
</body>
</html>