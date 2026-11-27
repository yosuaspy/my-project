<!--
Catatan: Saya pakai name="" pada <input type="submit"> sebagai Sensor/Perintah tindakan apa selanjutnya.
Seperti $_POST['semua'], $_POST['search']
-->

<?php
//connect
    session_start();
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "db_sarpras";
    $connect = mysqli_connect($server, $user, $password, $database);
    $server = NULL;
    $user = NULL;
    $password = NULL;
    $database = NULL;
?>git
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kerusakan</title>
    <link rel="stylesheet" href="style.css">
    <h1 class="title">Laporan Kerusakan Fasilitas Sekolah</h1>
    <div class="search">
    <h2 class="subtitle">Daftar Laporan</h2>
    <?php
    //Periksa Input Search Sebelumnya
        if(!empty($_POST['semua'])){
            header('location: index.php');
        }

        $_SESSION['search-kategori'] = trim($_POST['kategori'] ?? '');
        $_SESSION['search-input'] = trim($_POST['search-input'] ?? '');    
    ?>
    <!--Search-->
    <form method="post" class="search-menu">
    <!--Input-->
        <input class="search-input" type="text" name="search-input" placeholder="Cari" value="<?php echo trim($_POST['search-input'] ?? ''); ?>">   
    <!--Kategori-->
        <select name="kategori" class="search-kategori">
        <?php if($_SESSION['search-kategori'] == "id"){ ?>
            <option value="id" selected>ID</option>
            <option value="nama">Nama</option>
            <option value="lokasi">Lokasi</option>
            <option value="fasilitas">Fasilitas</option>
            <option value="kerusakan">Kerusakan</option>
            <option value="tanggal">Tanggal</option>
        <?php }elseif($_SESSION['search-kategori'] == "nama"){ ?>
            <option value="id">ID</option>
            <option value="nama" selected>Nama</option>
            <option value="lokasi">Lokasi</option>
            <option value="fasilitas">Fasilitas</option>
            <option value="kerusakan">Kerusakan</option>
            <option value="tanggal">Tanggal</option>
        <?php }elseif($_SESSION['search-kategori'] == "lokasi"){ ?>
            <option value="id">ID</option>
            <option value="nama">Nama</option>
            <option value="lokasi" selected>Lokasi</option>
            <option value="fasilitas">Fasilitas</option>
            <option value="kerusakan">Kerusakan</option>
            <option value="tanggal">Tanggal</option>
        <?php }elseif($_SESSION['search-kategori'] == "fasilitas"){ ?>
            <option value="id">ID</option>
            <option value="nama">Nama</option>
            <option value="lokasi">Lokasi</option>
            <option value="fasilitas" selected>Fasilitas</option>
            <option value="kerusakan">Kerusakan</option>
            <option value="tanggal">Tanggal</option>
        <?php }elseif($_SESSION['search-kategori'] == "kerusakan"){ ?>
            <option value="id" >ID</option>
            <option value="nama">Nama</option>
            <option value="lokasi">Lokasi</option>
            <option value="fasilitas">Fasilitas</option>
            <option value="kerusakan" selected>Kerusakan</option>
            <option value="tanggal">Tanggal</option>
        <?php }elseif($_SESSION['search-kategori'] == "tanggal"){ ?>
            <option value="id" >ID</option>
            <option value="nama">Nama</option>
            <option value="lokasi">Lokasi</option>
            <option value="fasilitas">Fasilitas</option>
            <option value="kerusakan">Kerusakan</option>
            <option value="tanggal" selected>Tanggal</option>
        <?php }else{ ?>
            <option value="" selected>Pilih Kategori</option>
            <option value="id" >ID</option>
            <option value="nama">Nama</option>
            <option value="lokasi">Lokasi</option>
            <option value="fasilitas">Fasilitas</option>
            <option value="kerusakan">Kerusakan</option>
            <option value="tanggal">Tanggal</option>
        <?php }?>
        
        </select>
    <!--Submit-->
        <input type="submit" name="search" value="🔍Cari" class="search-submit">
        
        <?php if(!empty($_POST['search'])){ ?>
            <input type="submit" name="semua" value="❌" class="search-reset">
            <?php if(empty($_POST['kategori'])){
                ?> <br><span style="color: red; backround-color:black; padding: 0 10px; border-radius:5px;">Pilih Kategori Search</span> <?php
            }} ?>
    </form> 
    </div>
</head>
<body>
<div class="body">
<!--Tambah-->
    <br>
    <a href="tambah.php" class="tambah-button">➕ Tambah Laporan</a>
    

<!--Tabel-->
    <table border="1" cellpadding="10px" cellspacing="0" class="table">
        <thead>
        <!--Tabel Head-->
            <tr>
                <th>ID</th>
                <th>Nama Pelapor</th>
                <th>Lokasi</th>
                <th>Fasilitas Rusak</th>
                <th>Kerusakan</th>
                <th>Tanggal</th>
                
            </tr>
        </thead>
        <?php

        //Periksa Kategori Search        
            if(isset($_POST['search'])){
                if(empty($_POST['search-input'])){
                    header('location: index.php');
                }else{
                    if($_POST['kategori'] == ""){
                        $kategori = "";
                    }elseif($_POST['kategori'] == "id"){
                        $kategori = "id_laporan = '".$_POST['search-input']."'";
                    }elseif($_POST['kategori'] == "nama"){
                        $kategori = "nama_pelapor = '".$_POST['search-input']."'";
                    }elseif($_POST['kategori'] == "lokasi"){
                        $kategori = "lokasi_ruang = '".$_POST['search-input']."'";
                    }elseif($_POST['kategori'] == "fasilitas"){
                        $kategori = "fasilitas = '".$_POST['search-input']."'";
                    }elseif($_POST['kategori'] == "kerusakan"){
                        $kategori = "tingkat_kerusakan = '".$_POST['search-input']."'";
                    }elseif($_POST['kategori'] == "tanggal"){
                        $kategori = "tanggal_laporan = '".$_POST['search-input']."'";
                    }
                }
            }

        //SOrtir Search
            if(empty($_POST['search'])){
                $query = mysqli_query($connect, "SELECT * FROM laporan");
            }else{
                if(($_POST['kategori']) != ""){
                    $query = mysqli_query($connect, "SELECT * FROM laporan WHERE ".$kategori);
                }else{
                    $query = mysqli_query($connect, "SELECT * FROM laporan");
                }
            }

        //Tampilkan Tabel Data
            while ($baris = mysqli_fetch_assoc($query)){
            ?>
                <tr>
                    <td><?php echo $baris['id_laporan'] ?></td>
                    <td><?php echo $baris['nama_pelapor'] ?></td>
                    <td><?php echo $baris['lokasi_ruang'] ?></td>
                    <td><?php echo $baris['fasilitas'] ?></td>
                    <td><?php echo $baris['tingkat_kerusakan'] ?></td>
                    <td><?php echo $baris['tanggal_laporan'] ?></td>
                    
                </tr>
            <?php
            }
        ?>
    </table>

</div>
</body>
<?php
//Hilangin Session
    unset($_SESSION['errors']);
    unset($_SESSION['old_input']);
    unset($_SESSION['success']);
?>
</html>