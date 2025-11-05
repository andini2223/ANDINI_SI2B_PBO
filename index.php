<?php
// File: index.php (Dashboard, Barang, Customer, Supplier View)
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit();
}

include ('koneksi.php');
$koneksi = new database();

$tipe_user = $_SESSION['tipe_user'];
$modul = isset($_GET['modul']) ? $_GET['modul'] : 'barang';

$data_tampil = [];
$nama_modul = "";
$kata_kunci = ""; 

// Logika Pengambilan Data
if ($modul == 'barang') {
    $nama_modul = "Barang";
    $kata_kunci = isset($_GET['cari']) ? $_GET['cari'] : '';
    // Memanggil fungsi tampil_data yang sudah mendukung pencarian
    $data_tampil = $koneksi->tampil_data($kata_kunci);
    
} elseif ($modul == 'customer' && ($tipe_user == 'Administrator' || $tipe_user == 'Staf')) {
    $nama_modul = "Customer";
    $kata_kunci = isset($_GET['cari']) ? $_GET['cari'] : '';
    // Memanggil fungsi tampil_data_customer yang sudah mendukung pencarian
    $data_tampil = $koneksi->tampil_data_customer($kata_kunci); 
    
} elseif ($modul == 'supplier' && $tipe_user == 'Administrator') {
    $nama_modul = "Supplier";
    $kata_kunci = isset($_GET['cari']) ? $_GET['cari'] : '';
    // Memanggil fungsi tampil_data_supplier yang sudah mendukung pencarian
    $data_tampil = $koneksi->tampil_data_supplier($kata_kunci); 
    
} else {
    // Fallback
    $modul = 'barang'; $nama_modul = "Barang"; $data_tampil = $koneksi->tampil_data();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Data <?php echo $nama_modul; ?></title>
    <style type="text/css">
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        #menu_akses a { margin-right: 15px; text-decoration: none; font-weight: bold; }
        .inline-button { display: inline-block; margin-right: 5px; }
    </style>
</head>
<body>
    <h2>Selamat Datang, <?php echo $_SESSION['username']; ?></h2>
    <hr>
    
    <div id="menu_akses">
        <a href="?modul=barang">Kelola Barang</a>
        <?php if($tipe_user == 'Administrator' || $tipe_user == 'Staf'): ?>
            <a href="?modul=customer">Kelola Customer</a>
        <?php endif; ?>
        <?php if($tipe_user == 'Administrator'): ?>
            <a href="?modul=supplier">Kelola Supplier</a>
        <?php endif; ?>
        <a href="logout.php" style="float: right;">Logout</a>
    </div>

    <h3>Data <?php echo $nama_modul; ?></h3>
    <hr>

    <?php if ($modul == 'barang'): ?>
        <form method="get" style="display:inline;" class="inline-button">
            <input type="hidden" name="modul" value="barang">
            <input type="text" name="cari" placeholder="Cari Nama Barang" value="<?php echo htmlspecialchars($kata_kunci); ?>">
            <input type="submit" value="Cari">
        </form>
        <a href="tambah_data.php" class="inline-button"><button>Tambah Data</button></a>
        <a href="cetak.php" target="_BLANK" class="inline-button"><button>Print Data Barang</button></a> 
        <form method="get" action="cetak_satuan.php" target="_BLANK" style="display:inline;" class="inline-button">
            <input type="text" name="kd_barang" placeholder="Masukkan Kode Barang"><input type="submit" value="Print Satuan Barang">
        </form>
        
        <table border="1">
            <tr><th>No</th><th>Kode Barang</th><th>Barang</th><th>Stok</th><th>Harga Beli</th><th>Harga Jual</th><th>Action</th></tr>
            <?php $no = 1; if (!empty($data_tampil)) { foreach($data_tampil as $row){ ?>
            <tr><td><?php echo $no++; ?></td><td><?php echo $row['kd_barang']; ?></td><td><?php echo $row['nama_barang']; ?></td>
                <td><?php echo $row['stok']; ?></td><td><?php echo $row['harga_beli']; ?></td><td><?php echo $row['harga_jual']; ?></td>
                <td><a href="edit_data.php?id_barang=<?php echo $row['id_barang']; ?>&action=edit">Edit</a>/
                    <a href="proses_barang.php?id_barang=<?php echo $row['id_barang']; ?>&action=delete" onclick="return confirm('Yakin hapus?')">Hapus</a></td></tr>
            <?php } } else { echo "<tr><td colspan='7' style='text-align:center;'>Hasil pencarian tidak ditemukan.</td></tr>"; } ?>
        </table>
        
    <?php elseif ($modul == 'customer'): ?>
        <form method="get" style="display:inline;" class="inline-button">
            <input type="hidden" name="modul" value="customer">
            <input type="text" name="cari" placeholder="Cari Nama/NIK/Email Customer" value="<?php echo htmlspecialchars($kata_kunci); ?>">
            <input type="submit" value="Cari Customer">
        </form>
        <a href="customer/tambah.php" class="inline-button"><button>Tambah Data Customer</button></a>
        <a href="customer/cetak_customer.php" target="_BLANK" class="inline-button"><button>Print Data Customer</button></a>
        
        <table border="1">
            <tr><th>No</th><th>ID Customer</th><th>NIK Customer</th><th>Nama Customer</th><th>Telepon</th><th>Email</th><th>Action</th></tr>
            <?php $no = 1; if (!empty($data_tampil)) { foreach($data_tampil as $row){ ?>
            <tr><td><?php echo $no++; ?></td><td><?php echo $row['id_customer']; ?></td><td><?php echo $row['nik_customer']; ?></td>
                <td><?php echo $row['nama_customer']; ?></td><td><?php echo $row['telepon_customer']; ?></td><td><?php echo $row['email_customer']; ?></td>
                <td><a href="customer/edit.php?id_customer=<?php echo $row['id_customer']; ?>&action=edit">Edit</a>/
                    <a href="customer/proses.php?id_customer=<?php echo $row['id_customer']; ?>&action=delete" onclick="return confirm('Yakin hapus?')">Hapus</a></td></tr>
            <?php } } else { echo "<tr><td colspan='7' style='text-align:center;'>Data customer belum tersedia atau tidak ditemukan.</td></tr>"; } ?>
        </table>

    <?php elseif ($modul == 'supplier'): ?>
        <form method="get" style="display:inline;" class="inline-button">
            <input type="hidden" name="modul" value="supplier">
            <input type="text" name="cari" placeholder="Cari Nama/Email Supplier" value="<?php echo htmlspecialchars($kata_kunci); ?>">
            <input type="submit" value="Cari Supplier">
        </form>
        <a href="supplier/tambah.php" class="inline-button"><button>Tambah Data Supplier</button></a>
        <a href="supplier/cetak_supplier.php" target="_BLANK" class="inline-button"><button>Print Data Supplier</button></a>
        
        <table border="1">
            <tr><th>No</th><th>ID Supplier</th><th>Nama Supplier</th><th>Alamat</th><th>Telepon</th><th>Email</th><th>Action</th></tr>
            <?php $no = 1; if (!empty($data_tampil)) { foreach($data_tampil as $row){ ?>
            <tr><td><?php echo $no++; ?></td><td><?php echo $row['id_supplier']; ?></td><td><?php echo $row['nama_supplier']; ?></td>
                <td><?php echo $row['alamat_supplier']; ?></td><td><?php echo $row['telepon_supplier']; ?></td><td><?php echo $row['email_supplier']; ?></td>
                <td><a href="supplier/edit.php?id_supplier=<?php echo $row['id_supplier']; ?>&action=edit">Edit</a>/
                    <a href="supplier/proses.php?id_supplier=<?php echo $row['id_supplier']; ?>&action=delete" onclick="return confirm('Yakin hapus?')">Hapus</a></td></tr>
            <?php } } else { echo "<tr><td colspan='7' style='text-align:center;'>Data supplier belum tersedia atau tidak ditemukan.</td></tr>"; } ?>
        </table>
    <?php else: ?>
        <p>Modul tidak ditemukan atau akses ditolak.</p>
    <?php endif; ?>
</body>
</html>