
<?php
session_start();

date_default_timezone_set("Asia/Bangkok");


if (!file_exists(dirname(__FILE__) . '/classes/database.php')) {
	die('File database.php Tidak ada');
}

// menyisipkan file config

require dirname(__FILE__) . '/classes/database.php';

if (!file_exists(dirname(__FILE__) . '/classes/resultSet.php')) {
	die('File result.php Tidak ada');
}

// menyisipkan file config

require dirname(__FILE__) . '/classes/resultSet.php';

if (!file_exists(dirname(__FILE__) . '/classes/crud.php')) {
	die('File result.php Tidak ada');
}

// menyisipkan file config

require dirname(__FILE__) . '/classes/crud.php';

$crud = new crud();


if (isset($_POST['register'])) {
	$value = [
		'nama' => $_POST['name'],
		'username' => $_POST['username'],
		'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),	
		'level' => $_POST['level'],
	];
	$where = [
		'username' => $_POST['username'],
	];
	$resultSet = new resultSet($crud->read("users", $where));
	if($_POST['password_confirmation'] == $_POST['password']){
		if ($resultSet->numRows() == 0) {
			$crud->insert("users", $value);
			$resultSet = new resultSet($crud->read("users", $where));
			$data = $resultSet->toArray();
			// print_r($resultSet->toArray());
			$_SESSION['login'] = true;
			$_SESSION['id_user'] = $data[0]['id_user']; 
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['password'] = $_POST['password'];
			$_SESSION['level'] = $_POST['level'];
			$_SESSION['nama'] = $_POST['name'];
			header("Location: http://localhost:8080/restoQ/?page=Home");
		}else {
			$_SESSION['old_nama'] = $_POST['name'];
			// $_SESSION['old_username'] = $_POST['username'];
			$_SESSION['old_password'] = $_POST['password'];
			$_SESSION['old_level']	= $_POST['level'];
	
			$_SESSION['msg_username'] = "Username telah digunakan";
			// echo $_SESSION['msg_username'];
			header("Location: http://localhost:8080/restoQ/?page=register");
		}
	}else{
		$_SESSION['old_nama'] = $_POST['name'];
		$_SESSION['old_username'] = $_POST['username'];
		// $_SESSION['old_password'] = $_POST['password'];
		$_SESSION['old_level']	= $_POST['level'];
		$_SESSION['old_username'] = $_POST['username'];

		$_SESSION['msg_passc'] = "Password tidak sama bos";
		// echo $_SESSION['msg_username'];
		header("Location: http://localhost:8080/restoQ/?page=register");
	}
}elseif (isset($_POST['login'])) {
	$where = [
		'username' => $_POST['username']
	];
	$resultSet = new resultSet($crud->read("users", $where));
	if ($resultSet->numRows() == 1) {
		// $value = ['password' => $_POST['password'] ];
		$resultSet = new resultSet($crud->read("users", $where));
		$data = $resultSet->toArray();
		if (password_verify($_POST['password'], $data[0]['password'])) {
			$_SESSION['login'] = true;
			$_SESSION['id_user'] = $data[0]['id_user']; 
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['level'] = $data[0]['level'];
			$_SESSION['nama'] = $data[0]['nama'];
			// echo $data[0]['level'];
			header("Location: http://localhost:8080/restoQ/?page=Home");
		} else {
			echo 'Invalid password.';
		}
	}else {
		header("Location: http://localhost:8080/restoQ/?page=login");
	}
}elseif(isset($_POST['tambah_meja'])){
	$no = $crud->escape_string($_POST['nomor']);
	$nama = $crud->escape_string($_POST['nama']);
	$status = $crud->escape_string(0);
	$sql = "CALL insertMeja('$no', '$nama', '$status')";
	$crud->sProcedure($sql);
	$_SESSION['msg'] = "Berhasil Tambah Meja";
	header("Location: http://localhost:8080/restoQ/?page=EntriMeja");
}elseif(isset($_GET['deleteMeja'])){
	$no = $_GET['deleteMeja'];
	$sql = "CALL deleteMeja('$no')";
	$crud->sProcedure($sql);
	$_SESSION['msg'] = "Delete Berhasil";
	header("Location: http://localhost:8080/restoQ/?page=EntriMeja");
}elseif(isset($_POST['updateMeja'])){
	$nama = $_POST['nama'];
	$status = $_POST['status'];
	$no = $_POST['nomor'];
	$sql = "CALL updateMeja('$nama', '$status', '$no')";
	$crud->sProcedure($sql);
	$_SESSION['msg'] = "Update Berhasil";
	header("Location: http://localhost:8080/restoQ/?page=EntriMeja");
}elseif(isset($_POST['tambah_barang'])){
	$kode 	= $crud->escape_string($_POST['kode']);
	$nama 	= $crud->escape_string($_POST['nama']);
	$harga	= $crud->escape_string($_POST['harga']);
	// $stok = $crud->escape_string($_POST['stok']);
	$sql = "CALL insertBarang('$kode', '$nama', '$harga')";
	$crud->sProcedure($sql);
	$_SESSION['msg'] = "Berhasil Tambah Barang";
	header("Location: http://localhost:8080/restoQ/?page=EntriBarang");
}elseif(isset($_GET['deleteBarang'])){
	$kode = $_GET['deleteBarang'];
	$sql = "CALL deleteBarang('$kode')";
	$crud->sProcedure($sql);
	// $crud->update("barang", $data = ['stok' => $jumlahAkhir], $where = ['kode' => $kodem]);
	// echo $sql;
	// print_r($data);
	// print_r($data2);
	// echo $jumlahAkhir;
	$_SESSION['msg'] = "Delete Berhasil";
	header("Location: http://localhost:8080/restoQ/?page=EntriBarang");
}elseif(isset($_POST['updateBarang'])){
	$kode 	= $crud->escape_string($_POST['kode']);
	$nama 	= $crud->escape_string($_POST['nama']);
	$harga	= $crud->escape_string($_POST['harga']);
	$sql = "CALL updateBarang('$nama', '$harga', '$kode')";
	$crud->sProcedure($sql);
	$_SESSION['msg'] = "Update Berhasil";
	header("Location: http://localhost:8080/restoQ/?page=EntriBarang");
}elseif(isset($_POST['tambah_pesanan'])){
	$kode_meja 	= $crud->escape_string($_POST['kode_meja']);
	$menu 	= $crud->escape_string($_POST['menu']);
	$jumlah	= $crud->escape_string($_POST['jumlah']);
	$idpelanggan	= $crud->escape_string($_POST['idpel']);
	// $desk	= "";
	$id_user= $crud->escape_string($_SESSION['id_user']);
	$sql = "CALL insertPesanan('$menu', '$kode_meja', '$jumlah', $id_user, '$idpelanggan')";
	$crud->sProcedure($sql);

	$data2 = [
		'status' => 1
	];
	$where2 = [
		'no' => $kode_meja
	];
	$crud->update("meja", $data2, $where2);
	$_SESSION['msg'] = "Berhasil";
	header("Location: http://localhost:8080/restoQ/?page=EntriPesanan");
}elseif(isset($_GET['deletePesanan'])){
	$kode = $_GET['deletePesanan'];
	$where = [
		'id' => $kode
	];
	$resultSet = new resultSet($crud->read("pesanan", $where));
	$data = $resultSet->toArray();
	$nomeja = $data[0]['no_meja'];
	$data2 = [
		'status' => 0
	];
	$where2 = [
		'no' => $nomeja
	];
	$crud->update("meja", $data2, $where2);
	$sql = "CALL deletePesanan('$kode')";
	$crud->sProcedure($sql);
	$_SESSION['msg'] = "Delete Berhasil";
	header("Location: http://localhost:8080/restoQ/?page=EntriPesanan");
}elseif(isset($_POST['updatePesanan'])){
	$kode_meja 	= $crud->escape_string($_POST['kode_meja']);
	$menu 	= $crud->escape_string($_POST['id_menu']);
	$jumlah	= $crud->escape_string($_POST['jumlah']);
	$desk	= "";
	$id = $_SESSION['id_user'];
	
	$sql = "CALL updatePesanan('$kode_meja', '$menu', $jumlah, $id)";
	// echo $sql;
	$crud->sProcedure($sql);
	$_SESSION['msg'] = "Berhasil";
	header("Location: http://localhost:8080/restoQ/?page=EntriPesanan");
}elseif(isset($_POST['insert_transaksi'])){
	$idPes 	= $crud->escape_string($_POST['idPes']);
	$total 	= $crud->escape_string($_POST['total']);
	$bayar	= $crud->escape_string($_POST['bayar']);
	$created= date("Y-m-d");
	$sql = "CALL insertTransaksi('$idPes', '$total', '$bayar', '$created')";
	$crud->sProcedure($sql);
	
	$where = [
		'id' => $idPes
	];
	$resultSet = new resultSet($crud->read("pesanan", $where));
	$data = $resultSet->toArray();
	$nomeja = $data[0]['no_meja'];
	$data2 = [
		'status' => '0'
	];
	$where2 = [
		'no' => $nomeja
	];
	$crud->update("meja", $data2, $where2);
	$data2 = [
		'status' => '1'
	];
	$crud->update("pesanan", $data2, $where);
	$_SESSION['msg'] = "Berhasil";
	header("Location: http://localhost:8080/restoQ/?page=Transaksi");
}elseif(isset($_POST['tambah_pelanggan'])){
	$idpel = $_POST['idpel'];
	$nama = $_POST['nama'];
	$jk	= $_POST['jk'];
	$nohp = $_POST['nohp'];
	$alamat = $_POST['alamat'];
	$crud->sProcedure("CALL insertPelanggan('$idpel','$nama', '$jk', '$nohp', '$alamat')");
	$_SESSION['msg'] = "Berhasil";
	header("Location: http://localhost:8080/restoQ/?page=EntriPelanggan");
}elseif(isset($_GET['delete_pelanggan'])){
	$id = $_GET['delete_pelanggan'];
	$crud->sProcedure("CALL deletePelanggan('$id')");
	$_SESSION['msg'] = "Berhasil";
	header("Location: http://localhost:8080/restoQ/?page=EntriPelanggan");
}elseif(isset($_POST['updatePelanggan'])){
	$idpel = $_POST['idpel'];
	$nama = $_POST['nama'];
	$jk	= $_POST['jk'];
	$nohp = $_POST['nohp'];
	$alamat = $_POST['alamat'];
	$crud->sProcedure("CALL updatePelanggan('$idpel','$nama', '$jk', '$nohp', '$alamat')");
}












// =========================== TAMBAH PESANAN SISTEM PENGURANGAN STOK
// elseif(isset($_POST['tambah_pesanan'])){
// 	$kode_meja 	= $crud->escape_string($_POST['kode_meja']);
// 	$menu 	= $crud->escape_string($_POST['menu']);
// 	$jumlah	= $crud->escape_string($_POST['jumlah']);
// 	$desk	= $crud->escape_string($_POST['deskripsi']);
// 	$id_user= $crud->escape_string($_SESSION['id_user']);
// 	$sql = "CALL insertPesanan('$menu', '$kode_meja', $jumlah, '$desk', $id_user)";
// 	$where = [
// 		'kode' => $menu
// 	];
// 	$resultSet = new resultSet($crud->read("barang", $where));
// 	$data = $resultSet->toArray();
// 	$stok = $data[0]['stok'];
// 	$kode = $data[0]['kode'];
// 	if ($jumlah > $stok){
// 		$_SESSION['stok_msg'] = "Stok Tersedia " . $stok;
// 		header("Location: http://localhost/restoQ/?page=EntriPesanan");
// 	}else{
// 		// $crud->sProcedure($sql);
// 		$kurang = $stok - $jumlah;
// 		$data = [
// 			'stok' => $kurang
// 		];
// 		$where = [
// 			'kode' => $kode
// 		];
// 		$data2 = [
// 			'status' => 1
// 		];
// 		$where2 = [
// 			'no' => $kode_meja
// 		];
// 		$crud->sProcedure($sql);
// 		$crud->update("meja", $data2, $where2);
// 		$crud->update("barang", $data, $where);
// 		$_SESSION['msg'] = "Berhasil Tambah Pesanan";
// 		header("Location: http://localhost/restoQ/?page=EntriPesanan");
// 	}
// }elseif(isset($_GET['deletePesanan'])){
// 	$kode = $_GET['deletePesanan'];
// 	$resultSet = new resultSet($crud->read("pesanan", $where = ['id' => $kode]));
// 	$data = $resultSet->toArray();
// 	$jumlah = $data[0]['jumlah'];
// 	$kodem = $data[0]['id_menu'];
// 	$resultSet2 = new resultSet($crud->read("barang", $where = ['kode' => $kodem]));
// 	$data2 = $resultSet2->toArray();
// 	$jumlahB = $data2[0]['stok'];
// 	$jumlahAkhir = $jumlah + $jumlahB;
// 	$sql = "CALL deletePesanan('$kode')";
// 	$crud->update("barang", $data = ["stok" => $jumlahAkhir], $where = ['kode' => $kodem]);
// 	$crud->sProcedure($sql);
// 	$_SESSION['msg'] = "Delete Berhasil";
// 	header("Location: http://localhost/restoQ/?page=EntriPesanan");
// }elseif(isset($_POST['updatePesanan'])){
// 	$kode_meja 	= $crud->escape_string($_POST['kode_meja']);
// 	$menu 	= $crud->escape_string($_POST['menu']);
// 	$jumlah	= $crud->escape_string($_POST['jumlah']);
// 	$desk	= $crud->escape_string($_POST['deskripsi']);
// }






// if (isset($_POST['login2'])) {
// 	$value = ['kode' => $_POST['kode'], 'nama' => $_POST['nama'], ];
// 	$resultSet = new resultSet($crud->read("pemilik", $value));
// 	if ($resultSet->numRows() == 1) {
// 		$resultSet = new resultSet($crud->read("pemilik", $value));
// 		$data = $resultSet->toArray();
// 		$_SESSION['login'] = true;
// 		$_SESSION['kode'] = $_POST['kode'];
// 		$_SESSION['id_level'] = '1';
// 		$_SESSION['nama'] = $_POST['nama'];
// 		header("Location: http://localhost/WEBek/?page=GenerateLaporan");
// 	}
// 	else {
// 		header("Location: http://localhost/WEBek/?login=PEMILIKers123");
// 	}
// }
// else
// if (isset($_POST['login'])) {
// 	$value = ['username' => $_POST['username'], 'password' => $_POST['password'], ];
// 	$resultSet = new resultSet($crud->read("users", $value));
// 	if ($resultSet->numRows() == 1) {
// 		$resultSet = new resultSet($crud->read("users", $value));
// 		$data = $resultSet->toArray();
// 		$_SESSION['login'] = true;
// 		$_SESSION['username'] = $_POST['code'];
// 		$_SESSION['id_level'] = $data[0]['id_level'];
// 		$_SESSION['password'] = $_POST['password'];
// 		header("Location: http://localhost/WEBek/");
// 	}
// 	else {
// 		header("Location: http://localhost/WEBek/?login=ADMINers123");
// 	}
// }
// else
// if (isset($_POST['kendaraan_inp'])) {
// 	$request = ['noPlat' => $crud->escape_string($_POST['noPlat']) , 'tahun' => $crud->escape_string($_POST['tahun']) , 'tarifperjam' => $crud->escape_string($_POST['tarif']) , 'statusRental' => $crud->escape_string($_POST['status']) , ];
// 	$crud->insert("kendaraan", $request);
// 	$_SESSION['msg'] = "Berhasil Tambah Data";
// 	header("Location: http://localhost/WEBek/?page=Kendaraan");
// }
// else
// if (isset($_GET['deleteKendaraan'])) {
// 	$param = ['noPlat' => $_GET['deleteKendaraan']];
// 	$_SESSION['msg'] = "Delete Berhasil";
// 	$crud->delete("kendaraan", $param);
// 	header("Location: http://localhost/WEBek/?page=Kendaraan");
// }
// else
// if (isset($_POST['kendaraan_upd'])) {
// 	$request = ['id_type' => $crud->escape_string($_POST['id_type']) , 'kd_merk' => $crud->escape_string($_POST['kd_merk']) , 'tahun' => $crud->escape_string($_POST['tahun']) , 'kd_pemilik' => $crud->escape_string($_POST['kd_pemilik']) , 'tarifperjam' => $crud->escape_string($_POST['tarifperjam']) , 'statusRental' => $crud->escape_string($_POST['status']) , ];
// 	$where = ['noPlat' => $_POST['noPlat']];
// 	$crud->update('kendaraan', $request, $where);
// 	$_SESSION['msg'] = "Berhasil Update Data";
// 	header("Location: http://localhost/WEBek/?page=Kendaraan");
// }
// else
// if (isset($_POST['tambah_pemilik'])) {

// 	// echo "ook";

// 	$request = ['kode' => $crud->escape_string($_POST['kode_pemilik']) , 'nama' => $crud->escape_string($_POST['nama_pemilik']) , 'alamat' => $crud->escape_string($_POST['alamat_pemilik']) , 'telp' => $crud->escape_string($_POST['telpon_pemilik']) ];
// 	$crud->insert("pemilik", $request);
// 	$_SESSION['msg'] = "Berhasil Tambah Pemilik";
// 	header("Location: http://localhost/WEBek/?page=Pemilik");
// }
// else
// if (isset($_POST['tambah_type_kendaraan'])) {
// 	$request = ['nama' => $crud->escape_string($_POST['nama_type']) ];
// 	$crud->insert("type", $request);
// 	$_SESSION['msg'] = "Berhasil Tambah Type";
// 	header("Location: http://localhost/WEBek/");
// }
// else
// if (isset($_POST['tambah_merk_kendaraan'])) {
// 	$request = ['kode' => $crud->escape_string($_POST['kode_merk']) , 'nama' => $crud->escape_string($_POST['nama_merk']) , 'id_type' => $crud->escape_string($_POST['id_type']) ];
// 	$crud->insert("merk", $request);
// 	$_SESSION['msg'] = "Berhasil Tambah Merk";
// 	header("Location: http://localhost/WEBek/");
// }
// else
// if (isset($_POST['tambah_kendaraan'])) {
// 	$request = ['noPlat' => $crud->escape_string($_POST['noPlat']) , 'id_type' => $crud->escape_string($_POST['id_type']) , 'kode_merk' => $crud->escape_string($_POST['kode_merk']) , 'tahun' => $crud->escape_string($_POST['tahun']) , 'tarifperjam' => $crud->escape_string($_POST['tarifperjam']) , 'statusRental' => $crud->escape_string(0) , 'kd_pemilik' => $crud->escape_string($_POST['kode_pemilik']) , ];
// 	$crud->insert("kendaraan", $request);
// 	$_SESSION['msg'] = "Berhasil Tambah Kendaraan";
// 	header("Location: http://localhost/WEBek/?page=Kendaraan");
// }
// else
// if (isset($_POST['tambah_sopir'])) {
// 	$request = ['id_supir' => $crud->escape_string($_POST['id_supir']) , 'nama' => $crud->escape_string($_POST['nama_supir']) , 'alamat' => $crud->escape_string($_POST['alamat_supir']) , 'telp' => $crud->escape_string($_POST['telp_supir']) , 'noSim' => $crud->escape_string($_POST['noSim_supir']) , 'tarifperjam' => $crud->escape_string($_POST['tarifperjam']) , 'status' => 0];
// 	$crud->insert("sopir", $request);
// 	$_SESSION['msg'] = "Berhasil Tambah Sopir";
// 	header("Location: http://localhost/WEBek/?page=Sopir");
// }
// else
// if (isset($_POST['setoran'])) {
// 	$request = ['noSetoran' => $crud->escape_string($_POST['noSetoran']) , 'kode_pemilik' => $crud->escape_string($_POST['kode_pemilik']) , 'tgl' => $crud->escape_string($_POST['tgl']) , 'jumlah' => $crud->escape_string($_POST['jumlah']) ];
// 	$crud->insert("setoran", $request);
// 	$_SESSION['msg'] = "Berhasil Setoran";
// 	header("Location: http://localhost/WEBek/?page=Setoran");
// }
// else
// if (isset($_POST['service'])) {
// 	$request = ['kode' => $crud->escape_string($_POST['kode_service']) , 'noPlat' => $crud->escape_string($_POST['noPlat']) , 'id_jenis_service' => $crud->escape_string($_POST['jenis_service']) , 'tgl' => $crud->escape_string($_POST['tgl']) , 'biaya' => $crud->escape_string($_POST['biaya']) ];
// 	$crud->insert("service", $request);
// 	$_SESSION['msg'] = "Berhasil Simpan";
// 	header("Location: http://localhost/WEBek/?page=Service");
// }
// else
// if (isset($_POST['tambah_jenis_service'])) {
// 	$request = ['nama' => $crud->escape_string($_POST['nama']) , ];
// 	$crud->insert("jenisservice", $request);
// 	$_SESSION['msg'] = "Berhasil Tambah Jenis Service";
// 	header("Location: http://localhost/WEBek/?page=Service");
// }
// else
// if (isset($_POST['tambah_pelanggan'])) {
// 	$request = ['noKTP' => $crud->escape_string($_POST['noKTP']) , 'nama' => $crud->escape_string($_POST['nama']) , 'alamat' => $crud->escape_string($_POST['alamat']) , 'telp' => $crud->escape_string($_POST['telp']) ];
// 	$crud->insert("pelanggan", $request);
// 	$_SESSION['msg'] = "Berhasil Tambah Pelanggan";
// 	header("Location: http://localhost/WEBek/?page=Pelanggan");
// }
// else
// if (isset($_POST['transaksi'])) {
// 	$request = ['no_transaksi' => $crud->escape_string($_POST['no_transaksi']) , 'noPlat' => $crud->escape_string($_POST['noPlat']) , 'noKTP' => $crud->escape_string($_POST['noKTP']) , 'tgl_pesan' => $crud->escape_string($_POST['tgl_pesan']) , 'tgl_pinjam' => $crud->escape_string($_POST['tgl_pinjam']) , 'jam_pinjam' => $crud->escape_string($_POST['jam_pinjam']) , 'tgl_kembali_rencana' => $crud->escape_string($_POST['tgl_kembali_rencana']) , 'jam_kembali_rencana' => $crud->escape_string($_POST['jam_kembali_rencana']) , 'denda' => $crud->escape_string($_POST['denda']) , 'kilometerPinjam' => $crud->escape_string($_POST['km_pinjam']) , 'kilometerKembali' => $crud->escape_string($_POST['km_kembali']) , 'BBMpinjam' => $crud->escape_string($_POST['bbm_pinjam']) , 'BBMkembali' => $crud->escape_string($_POST['bbm_kembali']) , 'kondisiMobilPinjam' => $crud->escape_string($_POST['kondisi_mobil_pinjam']) , 'kondisiMobilKembali' => $crud->escape_string($_POST['kondisi_mobil_kembali']) , 'kerusakan' => $crud->escape_string($_POST['kerusakan']) , 'biayaKerusakan' => $crud->escape_string($_POST['biaya_kerusakan']) , 'biayaBBM' => $crud->escape_string($_POST['biaya_bbm']) , ];
// 	if ($crud->insert("transaksisewa", $request)) {
// 		$where = ['kode_peminjaman' => $_POST['kodePeminjaman']];
// 		$crud->delete("peminjaman", $where);
// 		$_SESSION['msg'] = "Berhasil Transaksi";
// 		header("Location: http://localhost/WEBek/?page=Transaksi");
// 	}
// }
// else
// if (isset($_POST['peminjaman'])) {
// 	$request = ['kode_peminjaman' => $crud->escape_string($_POST['kode_peminjaman']) , 'noPlat' => $crud->escape_string($_POST['noPlat']) , 'id_supir' => $crud->escape_string($_POST['id_supir']) , 'noKTP' => $crud->escape_string($_POST['noKTP']) , 'tgl_pesan' => $crud->escape_string($_POST['tgl_pesan']) , 'tgl_pinjam' => $crud->escape_string($_POST['tgl_pinjam']) , 'jam_pinjam' => $crud->escape_string($_POST['jam_pinjam']) , 'tgl_kembali_rencana' => $crud->escape_string($_POST['tgl_kembali_rencana']) , 'jam_kembali_rencana' => $crud->escape_string($_POST['jam_kembali_rencana']) , 'kilometerPinjam' => $crud->escape_string($_POST['km_pinjam']) , 'BBMpinjam' => $crud->escape_string($_POST['bbm_pinjam']) , 'kondisiMobilPinjam' => $crud->escape_string($_POST['kondisi_mobil_pinjam']) , ];
// 	if ($crud->insert("peminjaman", $request)) {
// 		$data = ['status' => 1];
// 		$where = ['id_supir' => $_POST['id_supir']];
// 		$crud->update("sopir", $data, $where);
// 		$data = ['statusRental' => 1];
// 		$where = ['noPlat' => $_POST['noPlat']];
// 		$crud->update("kendaraan", $data, $where);
// 		$_SESSION['msg'] = "Berhasil Peminjaman";
// 		header("Location: http://localhost/WEBek/?page=Peminjaman");
// 	}
// }
// else
// if (isset($_POST['action_type']) AND $_POST['action_type'] == "transaksi") {
// 	$where = ['noKTP' => $_POST['noKTP'], 'noPlat' => $_POST['noPlat']];
// 	$resultSet = new resultSet($crud->read("peminjaman", $where));
// 	$data = $resultSet->toArray();
// 	echo json_encode($data);
// }
// else
// if (isset($_POST['pemilik_upd'])) {
// 	$data = ['nama' => $crud->escape_string($_POST['nama']) , 'alamat' => $crud->escape_string($_POST['alamat']) , 'telp' => $crud->escape_string($_POST['telpon']) ];
// 	$where = ['kode' => $crud->escape_string($_POST['kode']) ];
// 	echo "asd";
// 	$crud->update("pemilik", $data, $where);
// 	$_SESSION['msg'] = "Berhasil Update";
// 	header("Location: http://localhost/WEBek/?page=Pemilik");
// }
// else
// if (isset($_GET['deletePemilik'])) {
// 	$kode = ['kode' => $_GET['deletePemilik']];
// 	$crud->delete("pemilik", $kode);
// 	$_SESSION['msg'] = "Berhasil Delete";
// 	header("Location: http://localhost/WEBek/?page=Pemilik");
// }
// else
// if (isset($_POST['action_type']) AND $_POST['action_type'] == "noKTPCheck") {
// 	$where = ['noKTP' => $_POST['noKTP'], ];
// 	$resultSet = new resultSet($crud->read("pelanggan", $where));
// 	if ($data = $resultSet->numRows()) {
// 		echo '1';
// 	}
// 	else {
// 		echo '0';
// 	}
// }
// else
// if (isset($_POST['pelanggan_upd'])) {
// 	$data = ['nama' => $crud->escape_string($_POST['nama']) , 'alamat' => $crud->escape_string($_POST['alamat']) , 'telp' => $crud->escape_string($_POST['telpon']) ];
// 	$where = ['noKTP' => $_POST['noKTP']];
// 	$crud->update("pelanggan", $data, $where);
// 	$_SESSION['msg'] = "Berhasil Update";
// 	header("Location: http://localhost/WEBek/?page=Pemilik");
// }
// else
// if (isset($_GET['deletePelanggan'])) {
// 	$noKTP = ['noKTP' => $_GET['deletePelanggan']];
// 	$crud->delete("pelanggan", $noKTP);
// 	$_SESSION['msg'] = "Berhasil Delete";
// 	header("Location: http://localhost/WEBek/?page=Pelanggan");
// }
// elseif (isset($_POST['sopir_upd'])) {
// 	$data = ['nama' => $crud->escape_string($_POST['nama']) , 'alamat' => $crud->escape_string($_POST['alamat']) , 'telp' => $crud->escape_string($_POST['telpon']) , 'noSim' => $crud->escape_string($_POST['noSim']) , 'tarifperjam' => $crud->escape_string($_POST['tarif']) , 'status' => $crud->escape_string($_POST['status']) ];
// 	$where = ['id_supir' => $_POST['id_supir']];
// 	$crud->update("sopir", $data, $where);
// 	$_SESSION['msg'] = "Berhasil Update";
// 	header("Location: http://localhost/WEBek/?page=Sopir");
// }
// elseif (isset($_GET['deleteSopir'])) {
// 	$id = ['id_supir' => $_GET['deleteSopir']];
// 	$crud->delete("sopir", $id);
// 	$_SESSION['msg'] = "Berhasil Delete";
// 	header("Location: http://localhost/WEBek/?page=Sopir");
// }
// elseif (isset($_POST['service_upd'])) {
// 	$data = ['id_jenis_service' => $crud->escape_string($_POST['jenis']) , 'tgl' => $crud->escape_string($_POST['tgl']) , 'biaya' => $crud->escape_string($_POST['biaya']) , 'noPlat' => $crud->escape_string($_POST['noPlat']) , ];
// 	$where = ['kode' => $_POST['kode']];
// 	$crud->update("service", $data, $where);
// 	$_SESSION['msg'] = "Berhasil Update";
// 	header("Location: http://localhost/WEBek/?page=Service");
// }
// elseif (isset($_POST['jservice_upd'])) {
// 	$data = ['nama' => $crud->escape_string($_POST['nama']) ];
// 	$where = ['id' => $_POST['id']];
// 	$crud->update("jenisservice", $data, $where);
// 	$_SESSION['msg'] = "Berhasil Update";
// 	header("Location: http://localhost/WEBek/?page=Service");
// }
// elseif (isset($_GET['deleteService'])) {
// 	$id = ['id' => $_GET['deleteService']];
// 	$crud->delete("jenisservice", $id);
// 	$_SESSION['msg'] = "Berhasil Delete";
// 	header("Location: http://localhost/WEBek/?page=Service");
// }
// elseif (isset($_GET['kdeleteService'])) {
// 	$id = ['kode' => $_GET['kdeleteService']];
// 	$crud->delete("service", $id);
// 	$_SESSION['msg'] = "Berhasil Delete";
// 	header("Location: http://localhost/WEBek/?page=Service");
// }
// elseif (isset($_GET['deletePeminjaman'])) {
// 	$where = ['kode_peminjaman' => $_GET['deletePeminjaman']];
// 	$resultSet = new resultSet($crud->read("peminjaman", $where));
//     $data = $resultSet->toArray();
// 	$whereSopir = ['id_supir' => $data[0]['id_supir']];
// 	$val = ['status' => '0'];
//     $crud->update("sopir", $val, $whereSopir);
//     $whereNoPlat = ['noPlat' => $data[0]['noPlat']];
//     $val = ['statusRental' => '0'];
//     $crud->update("kendaraan", $val, $whereNoPlat);
// 	$crud->delete("peminjaman", $where);
// 	$_SESSION['msg'] = "Berhasil Delete";
// 	header("Location: http://localhost/WEBek/?page=Peminjaman");
// }elseif(isset($_POST['peminjaman_upd'])){
// 	$request = [
// 		'noPlat' => $crud->escape_string($_POST['noPlat']) , 
// 		'id_supir' => $crud->escape_string($_POST['id_supir']) , 
// 		'noKTP' => $crud->escape_string($_POST['noKTP']) , 
// 		'tgl_pesan' => $crud->escape_string($_POST['tgl_pesan']) , 
// 		'tgl_pinjam' => $crud->escape_string($_POST['tgl_pinjam']) ,
// 		'jam_pinjam' => $crud->escape_string($_POST['jam_pinjam']) , 
// 		'tgl_kembali_rencana' => $crud->escape_string($_POST['tgl_kembali_rencana']) , 
// 		'jam_kembali_rencana' => $crud->escape_string($_POST['jam_kembali_rencana']) , 
// 	];
// 	$where = [
// 		'kode_peminjaman' => $crud->escape_string($_POST['kode_peminjaman'])
// 	];
// 	$crud->update("peminjaman", $request, $where);
// 	$_SESSION['msg'] = "Berhasil Update";
// 	header("Location: http://localhost/WEBek/?page=Peminjaman");
// }

// ?>