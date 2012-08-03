<?php
$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
		'About',
);
?>
<div class="page-header">
	<h1>Version</h1>
</div>

<p>
	1.5.4<br> Modifikasi hampir semua module code. <br> 1. Simplifikasi
	View yang sama isinya, <br> 2. Penambahan Index2, <br> 3. Ilmu baru,
	Criteria Join<br> 4. Penambahan view mysql, v_anakasuh1, <br> 5.
	Perbaikan Action Delete, <br> 6.
<p>
	1.5.3<br> 1. Enhancement: Commited AA seperti yang diminta ibu via SMS
	untuk dikoordinasikan dengan Ezra sudah saya masukan dalam Laporan Data
	Donatur (Report Donatur 4). Report ini tersedia untuk Maria tapi yang
	membutuhkan adalah Ezra, Gimana menurut pendapat ibu?<br> 2. Bug:
	Report Donatur 6 sedikit mengalami problem ketika memasukan parameter
	pemilihan Status Donatur. Tidak masalah ketika parameter yang dipilih
	seluruh Donatur. Problem ketika memilih Khusus Donatur Active, Non
	Active. Bug ini sudah diperbaiki<br> 3. Enhancement: Maria meminta
	untuk dibuatkan tampilan Saldo Debet saja untuk Donatur tertentu yang
	mau dicari tujuannya agar ketika donatur bertanya kapan terakhir dana
	pengiriman uang diterima, dapat dengan mudah dicari karena selama ini
	tergabung datanya dengan kredit (transferan ke anak asuh). Sudah
	dibuatkan dan diterima dengan baik<br>
<p>
	1.5.2<br> 1. Enhancement: Penambahan No. Telp di Alokasi untuk
	keperluan menghubungi penerima (requested: Lidya)<br> 2. Correction:
	Penghitungan Saldo Akhir yang salah karena tanggal terakhir bisa saja
	terdiri dari berbagai transaksi<br> 3. Enhancement: Nama anak
	ditampilkan di kolom Referensi di Laporan Transaksi Donatur. Transaksi
	yang terjadi sebelum perbaikan ini dilaksanakan, tidak berubah.
	Perbaikan ini hanya terjadi untuk transaksi baru terhitung hari ini..<br>
	4. Correction: Perbaikan penghitungan Saldo Awal yang salah di Report
	Transaksi Donatur Penerimaan dan Pengeluaran <br> 5. Modification:
	Pemindahan posisi Saldo Awal yang kurang tepat di Report Transaksi
	Donatur Penerimaan dan Pengeluaran<br> 6. Correction: Ada Alokasi yang
	tidak tampil di Report Alokasi tertunda <br> 7. Correction: Angka yang
	salah di Report Donatur Saat ini yakni Jumlah Anak Asuh yang dilayani
	oleh si Donatur <br> 8. Correction: Data Laporan Jumlah Anak Asuh per
	Koord Lokal yang salah (H0F1 - KL1) (requested: Ezra) <br> 9.
	Modification: Perubahan posisi Tabular Donatur agar memudahkan
	pencarian Dana Donatur
<p>
	1.5.1<br> 1. Correction: Perbaikan Report Alokasi Permohonan Pengiriman
	Dana Bantuan Anak Asuh. Penentuan Periode Tanggal LEBIH DARI SAMA
	DENGAN dan KURANG DARI SAMA DENGAN Sudah Selesai diperbaiki, jadi
	periode sudah bisa LEBIH DARI SAMA DENGAN dan KURANG DARI SAMA DENGAN<br>

	2. Add New: Pembuatan Report Laporan Tanda Terima Alokasi Dana Bantuan
	Anak Asuh yang belom kembali (Report no 15). SUDAH SELESAI<br> 3.
	Correction: Perbaikan Bug yang tadinya tidak bisa delete Dana Donatur
	yang salah input/double.<br> 4. Enhancement: Penambahan Fitur Jurnal
	Pembalik untuk Transaksi Dana Donatur yang salah input, Jurnal Pembalik
	untuk Dana Donatur Tidak dikenal dikurangi kembali dananya dan
	dimasukkan ke Donatur yang sebenarnya. Atau transaksi Debet apa saja
	yang ingin dijurnal balik.<br> 5. Correction: Proses Alokasi Periode
	yang sama untuk alokasi2 yang dikosongkan (zero action). Sudah kembali
	berfungsi normal.<br> 6. Enhancement: Penambahan Field Baru
	NAMA_PERUSAHAAN di tabel Donatur untuk menampung penulisan Nama
	Perusahaan, Nama Gedung, Alamat Organisasi Dan memperbaiki struktur
	alamat di Laporan Tanda Terima Donatur agar dapat masuk ke jendela
	Amplop<br> <br> <br> Peter J. Kambey<br> peterjkambey@gmail.com<br> 082
	1100 46 046