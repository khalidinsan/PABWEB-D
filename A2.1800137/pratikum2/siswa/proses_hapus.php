<?php 
	// panggil file database.php untuk kneksi ke database
	require_once "config/database.php";
	// jika tombol hapus diklik
	if (isset($_GET['nis'])) {
		// ambil data get dari form
		$nis = $_GET['nis'];
		// perintah query untuk menampilkan data foto siswa berdasarkan nis
		$query = mysqli_query($db, "SELECT foto FROM tbl_siswa WHERE nis='$nis'") or die('Ada kesalahan pada query tampil data foto :'.mysqli_error($db));
		$data = mysqli_fetch_assoc($query);

		$foto = $data['foto'];

		// hapus file foto dari folder foto
		$hapus_file = unlink("foto/$foto");
		// cek hapus file
		if ($hapus_file) {
			// jika file berhasil dihapus jalankan perintah query untuk menghapus data pada tabel siswa
			$delete = mysqli_query($db, "DELETE FROM tbl_siswa WHERE nis='$nis'") or die('Ada kesalahan pada query delete :'.mysqli_error($db));
			// cek hasil query
			if ($delete) {
				// jika berhasil tampilkan pesan berhasil delete data
				header("location: index.php?alert=3");
			}
		}
	}
	// tutup koneksi
	mysqli_close($db);
 ?>