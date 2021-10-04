-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Okt 2021 pada 12.53
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_polsektbs`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `ID_BARANG` int(11) NOT NULL,
  `TIPE_FOTO` enum('unggah','url') NOT NULL,
  `FOTO` varchar(255) NOT NULL,
  `BARANG` varchar(200) NOT NULL,
  `LOKASI` varchar(200) NOT NULL,
  `KETERANGAN` varchar(255) NOT NULL,
  `CREATE_AT` datetime NOT NULL,
  `UPDATE_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `PUBLISH` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`ID_BARANG`, `TIPE_FOTO`, `FOTO`, `BARANG`, `LOKASI`, `KETERANGAN`, `CREATE_AT`, `UPDATE_AT`, `PUBLISH`) VALUES
(9, 'unggah', 'Screenshot_2_(2).jpg', 'fvbcxbc', 'bcvbvcb', 'cvbcvb', '2021-09-17 15:05:00', '2021-09-17 07:05:50', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_berita`
--

CREATE TABLE `tbl_berita` (
  `ID_BERITA` int(11) NOT NULL,
  `ID_PENGGUNA` int(11) NOT NULL,
  `JUDUL` varchar(200) NOT NULL,
  `ISI` text NOT NULL,
  `PATH` varchar(225) NOT NULL,
  `TIPE_THUMBNAIL` enum('unggah','url') NOT NULL,
  `URL_THUMBNAIL` varchar(225) NOT NULL,
  `CREATE_AT` date NOT NULL,
  `UPDATE_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `DILIHAT` double NOT NULL,
  `PUBLISH` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_berita`
--

INSERT INTO `tbl_berita` (`ID_BERITA`, `ID_PENGGUNA`, `JUDUL`, `ISI`, `PATH`, `TIPE_THUMBNAIL`, `URL_THUMBNAIL`, `CREATE_AT`, `UPDATE_AT`, `DILIHAT`, `PUBLISH`) VALUES
(18, 1, 'Polresta Bandar Lampung Salurkan Bansos Untuk Masyarakat Terdampak Covid-19', '<p style=\"color: var(--p-color); font-size: var(--p-font-size); font-weight: var(--font-weight-light); line-height: 1.5em; font-family: Plain, sans-serif;\">Bandar Lampung, Kota Bandar Lampung masih memberlakukan Pembatasan Pembatasan Kegiatan Masyarakat (PPKM) Level 4 karena masih tingginya angka sebaran kasus Covid-19.</p><p style=\"color: var(--p-color); font-size: var(--p-font-size); font-weight: var(--font-weight-light); line-height: 1.5em; font-family: Plain, sans-serif;\">Untuk meringankan beban warga kecil terdampak Covid-19 dan pemberlakukan pembatasan tersebut, Polresta Bandar Lampung memberikan bantuan paket Sembako kepada perwakilan masyarakat yang terdamapak Covid-19 dan juga PPKM ini ataupun pelaku usaha kecil, Kamis (29/7).</p><p style=\"color: var(--p-color); font-size: var(--p-font-size); font-weight: var(--font-weight-light); line-height: 1.5em; font-family: Plain, sans-serif;\"><img data-filename=\"WhatsApp Image 2021-07-29 at 10.23.21 (1).jpeg\" src=\"https://polrestabandarlampung.com/storage/uploads/berita/polres-berita_20210729_103324-6102218419491.png\" style=\"width: 427.5px;\"><br></p><p style=\"color: var(--p-color); font-size: var(--p-font-size); font-weight: var(--font-weight-light); line-height: 1.5em; font-family: Plain, sans-serif;\">Kapolresta Bandar Lampung Kombes Pol Yan Budi Jaya, S.IK., M.M., dalam sambutannya memberikan apresiasi kepada berbagai pihak yang turut berandil memberikan bantuan untuk meringankan beban masyarakat.</p><p style=\"color: var(--p-color); font-size: var(--p-font-size); font-weight: var(--font-weight-light); line-height: 1.5em; font-family: Plain, sans-serif;\">\"Saya Berserta Jajaran Mengucapkan Terimakasih dan mengucapkan apresiasi dan rasa penghormatan yang besar karena membantu meringankan beban masyarakat yang terdampak dari PPKM Level 4,\" ungkapnya.</p><p style=\"color: var(--p-color); font-size: var(--p-font-size); font-weight: var(--font-weight-light); line-height: 1.5em; font-family: Plain, sans-serif;\">Dalam acara yang juga dihadiri Wakapolresta Bandar Lampung AKBP Ganda MH.Saragih, S.IK. seluruh Pejabat Utama Polresta dan Kapolsek Jajaran serta elemen perwakilan organisasi kemahasiswaan seperti&nbsp; HMI ,GMNI, PMKRI, IMM dan GMKI.</p><p style=\"color: var(--p-color); font-size: var(--p-font-size); font-weight: var(--font-weight-light); line-height: 1.5em; font-family: Plain, sans-serif;\"><img data-filename=\"WhatsApp Image 2021-07-29 at 10.23.21 (2).jpeg\" src=\"https://polrestabandarlampung.com/storage/uploads/berita/polres-berita_20210729_103324-610221841e9e3.png\" style=\"width: 427.5px;\"></p><p style=\"color: var(--p-color); font-size: var(--p-font-size); font-weight: var(--font-weight-light); line-height: 1.5em; font-family: Plain, sans-serif;\"><img data-filename=\"WhatsApp Image 2021-07-29 at 10.23.22 (1).jpeg\" src=\"https://polrestabandarlampung.com/storage/uploads/berita/polres-berita_20210729_103324-6102218431f68.png\" style=\"width: 427.5px;\"><br></p><p style=\"color: var(--p-color); font-size: var(--p-font-size); font-weight: var(--font-weight-light); line-height: 1.5em; font-family: Plain, sans-serif;\">Kapolresta menyampaikan, paket Sembako ini nantinya akan disalurkan oleh anggota Bhabinkamtibmas langsung kepada masyarakat yang memang benar-benar membutuhkan terutama yang terdampak langsung Covid-19 seperti anak yatim yang orang tuanya meninggal karena covid-19 ataupun masyarakat yang sedang terkena Covid-19 serta pelaku usaha kecil yang terdampak langsung PPKM di Kota Bandar Lampung.</p><p style=\"color: var(--p-color); font-size: var(--p-font-size); font-weight: var(--font-weight-light); line-height: 1.5em; font-family: Plain, sans-serif;\">Dalam kesempatan ini Polresta Menerima Bantuan dari Para Donator sejumlah 3000 Paket sembako yang isinya Beras, Mie instan, Biskuit kaleng, sarden, gula pasir dan Susu.</p><p style=\"color: var(--p-color); font-size: var(--p-font-size); font-weight: var(--font-weight-light); line-height: 1.5em; font-family: Plain, sans-serif;\"><img data-filename=\"WhatsApp Image 2021-07-29 at 10.23.20 (1).jpeg\" src=\"https://polrestabandarlampung.com/storage/uploads/berita/polres-berita_20210729_103324-6102218447a6d.png\" style=\"width: 427.5px;\"><br></p><p style=\"color: var(--p-color); font-size: var(--p-font-size); font-weight: var(--font-weight-light); line-height: 1.5em; font-family: Plain, sans-serif;\"><span style=\"font-size: 1rem;\">Kapolresta juga berpesan kepada perwakilan penerima bantuan sembako untuk tidak segan memberitahu atau meminta tolong kepada Polisi setempat bila membutuhkan bantuan dan pasti akan dibantu dan terakhir Kapolresta Berpesan kepada Masyarakat dan Seluruh Personil Untuk Tetap Patuh Terhadap Protokol Kesehatan dan Berani Menegur Orang Lain bila ada yang tidak mentaati Protokol kesehatan karena ini sebagai upaya kita memutus penyebaran covid-19.</span></p>', '1631573746613fd6f2b71b0', 'url', 'https://polrestabandarlampung.com/storage/uploads/berita/polres-berita_20210729_103323-61022183e8918.jpeg', '2021-09-14', '2021-09-17 07:03:38', 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bhabin`
--

CREATE TABLE `tbl_bhabin` (
  `ID_BHABIN` int(11) NOT NULL,
  `NAMA_BHABIN` varchar(200) NOT NULL,
  `TIPE_FOTO_BHABIN` enum('unggah','url') NOT NULL,
  `FOTO_BHABIN` varchar(255) NOT NULL,
  `WA_BHABIN` char(20) NOT NULL,
  `TLP_BHABIN` char(20) NOT NULL,
  `NAMA_KRINGSERSE` varchar(200) NOT NULL,
  `TIPE_FOTO_KRINGSERSE` enum('unggah','url') NOT NULL,
  `FOTO_KRINGSERSE` varchar(255) NOT NULL,
  `WA_KRINGSERSE` char(20) NOT NULL,
  `TLP_KRINGSERSE` char(20) NOT NULL,
  `ID_KELURAHAN` int(11) NOT NULL,
  `CREATE_AT` date NOT NULL,
  `UPDATE_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `PUBLISH` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_bhabin`
--

INSERT INTO `tbl_bhabin` (`ID_BHABIN`, `NAMA_BHABIN`, `TIPE_FOTO_BHABIN`, `FOTO_BHABIN`, `WA_BHABIN`, `TLP_BHABIN`, `NAMA_KRINGSERSE`, `TIPE_FOTO_KRINGSERSE`, `FOTO_KRINGSERSE`, `WA_KRINGSERSE`, `TLP_KRINGSERSE`, `ID_KELURAHAN`, `CREATE_AT`, `UPDATE_AT`, `PUBLISH`) VALUES
(9, 'Doni Sandi', 'unggah', 'yt02.jpg', '62346346346', '6243634643', 'Sulis Tiawati', 'unggah', 'yt01.jpg', '62346765756', '6234534', 1, '2021-09-14', '2021-09-17 07:04:44', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_buronan`
--

CREATE TABLE `tbl_buronan` (
  `ID_BURONAN` int(11) NOT NULL,
  `NAMA` varchar(225) NOT NULL,
  `TIPE_FOTO` enum('unggah','url') NOT NULL,
  `FOTO` varchar(225) NOT NULL,
  `TMP_LAHIR` varchar(150) NOT NULL,
  `TGL_LAHIR` date NOT NULL,
  `KASUS` varchar(225) NOT NULL,
  `KETERANGAN` varchar(225) NOT NULL,
  `CREATE_AT` date NOT NULL,
  `UPDATE_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `PUBLISH` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kecamatan`
--

CREATE TABLE `tbl_kecamatan` (
  `ID_KECAMATAN` int(11) NOT NULL,
  `KECAMATAN` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kecamatan`
--

INSERT INTO `tbl_kecamatan` (`ID_KECAMATAN`, `KECAMATAN`) VALUES
(1, 'Teluk Betung Selatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kelurahan`
--

CREATE TABLE `tbl_kelurahan` (
  `ID_KELURAHAN` int(11) NOT NULL,
  `ID_KECAMATAN` int(11) NOT NULL,
  `KELURAHAN` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kelurahan`
--

INSERT INTO `tbl_kelurahan` (`ID_KELURAHAN`, `ID_KECAMATAN`, `KELURAHAN`) VALUES
(1, 1, 'Sumur Putri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_nomor`
--

CREATE TABLE `tbl_nomor` (
  `ID_NOMOR` int(11) NOT NULL,
  `INSTANSI` varchar(200) NOT NULL,
  `TLP` char(20) NOT NULL,
  `WA` char(20) NOT NULL,
  `CREATE_AT` date NOT NULL,
  `UPDATE_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `PUBLISH` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_nomor`
--

INSERT INTO `tbl_nomor` (`ID_NOMOR`, `INSTANSI`, `TLP`, `WA`, `CREATE_AT`, `UPDATE_AT`, `PUBLISH`) VALUES
(11, 'Ambulance', '7513', '345345345', '2021-09-03', '2021-09-12 03:59:25', 1),
(12, 'sdfdsf', '45345', '34543534', '2021-09-16', '2021-09-16 18:53:21', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_orang`
--

CREATE TABLE `tbl_orang` (
  `ID_ORANG` int(11) NOT NULL,
  `NAMA` varchar(200) NOT NULL,
  `TIPE_FOTO` enum('unggah','url') NOT NULL,
  `FOTO` varchar(225) NOT NULL,
  `TMP_LAHIR` varchar(150) NOT NULL,
  `TGL_LAHIR` date NOT NULL,
  `KETERANGAN` varchar(255) NOT NULL,
  `CREATE_AT` date NOT NULL,
  `UPDATE_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `PUBLISH` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_orang`
--

INSERT INTO `tbl_orang` (`ID_ORANG`, `NAMA`, `TIPE_FOTO`, `FOTO`, `TMP_LAHIR`, `TGL_LAHIR`, `KETERANGAN`, `CREATE_AT`, `UPDATE_AT`, `PUBLISH`) VALUES
(5, 'dsafsd', 'unggah', '4.jpg', 'fsdfsdf', '2021-09-17', 'sdfsdfsdf', '2021-09-09', '2021-09-17 07:06:51', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengaduan`
--

CREATE TABLE `tbl_pengaduan` (
  `ID_PENGADUAN` int(11) NOT NULL,
  `NIK` varchar(16) NOT NULL,
  `NAMA` varchar(225) NOT NULL,
  `TGL_LAHIR` date NOT NULL,
  `JENKEL` enum('Pria','Wanita') NOT NULL,
  `TLP` char(20) NOT NULL,
  `EMAIL` char(200) NOT NULL,
  `ALAMAT` text NOT NULL,
  `PERIHAL` varchar(225) NOT NULL,
  `ISI` text NOT NULL,
  `LAMPIRAN` varchar(225) NOT NULL,
  `CREATE_AT` datetime NOT NULL,
  `UPDATE_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `STATUS` enum('DITERIMA','DIPERIKSA','DITANGANI','SELESAI','DITOLAK') NOT NULL,
  `JENIS_ADUAN` enum('umum','covid-19') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pengaduan`
--

INSERT INTO `tbl_pengaduan` (`ID_PENGADUAN`, `NIK`, `NAMA`, `TGL_LAHIR`, `JENKEL`, `TLP`, `EMAIL`, `ALAMAT`, `PERIHAL`, `ISI`, `LAMPIRAN`, `CREATE_AT`, `UPDATE_AT`, `STATUS`, `JENIS_ADUAN`) VALUES
(1, '1871132501980003', 'Rio Ananda putra', '1998-01-25', 'Pria', '085789989287', 'rioanandaputra1998@gmail.com', 'Jl. Makam Gunung Wetan, No. 11, RT/RW 004/-, Kel. Pinang Jaya, Kec. Kemiling, Kota Bnadar Lampung, lampung', 'Laporan Jalan Berlubang Kemiling', 'On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains', '-', '2021-09-05 11:11:30', '2021-09-08 07:31:31', 'DITERIMA', 'umum'),
(2, '1871132501980003', 'Doni Sandino', '1998-01-25', 'Pria', '085789989287', 'doni@gmail.com', 'Jl. Makam Gunung Wetan, No. 11, RT/RW 004/-, Kel. Pinang Jaya, Kec. Kemiling, Kota Bnadar Lampung, lampung', 'Laporan Jalan Berlubang Kemiling', 'On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains', '-', '2021-09-05 11:11:30', '2021-09-08 08:40:54', 'DITERIMA', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `ID_PENGGUNA` int(11) NOT NULL,
  `NAMA` varchar(200) NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `TELPON` varchar(20) NOT NULL,
  `ALAMAT` text NOT NULL,
  `TIPE_IMAGE` enum('unggah','url') NOT NULL,
  `URL_IMAGE` varchar(225) NOT NULL,
  `USERNAME` char(200) NOT NULL,
  `PASSWORD` varchar(225) NOT NULL,
  `CREATE_AT` datetime NOT NULL,
  `UPDATE_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `LAST_LOGIN` datetime NOT NULL,
  `TINGKATAN` enum('ADMIN','HUMAS','SPK','KAPOLSEK','BHABIN') NOT NULL,
  `ACC` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`ID_PENGGUNA`, `NAMA`, `EMAIL`, `TELPON`, `ALAMAT`, `TIPE_IMAGE`, `URL_IMAGE`, `USERNAME`, `PASSWORD`, `CREATE_AT`, `UPDATE_AT`, `LAST_LOGIN`, `TINGKATAN`, `ACC`) VALUES
(1, 'admin', 'admin@gmail.com', '08588888', 'sadasd', 'url', 'https://tpc.googlesyndication.com/simgad/4620446250354793608', 'admin', 'admin', '2021-08-31 10:02:08', '2021-08-31 08:02:43', '2021-08-31 10:02:08', 'ADMIN', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tahanan`
--

CREATE TABLE `tbl_tahanan` (
  `ID_TAHANAN` int(11) NOT NULL,
  `NAMA` varchar(225) NOT NULL,
  `TIPE_FOTO` enum('unggah','url') NOT NULL,
  `FOTO` varchar(225) NOT NULL,
  `TMP_LAHIR` varchar(200) NOT NULL,
  `TGL_LAHIR` date NOT NULL,
  `KASUS` varchar(225) NOT NULL,
  `KETERANGAN` varchar(225) NOT NULL,
  `CREATE_AT` date NOT NULL,
  `UPDATE_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `PUBLISH` tinyint(1) NOT NULL,
  `KESATUAN` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tipeb`
--

CREATE TABLE `tbl_tipeb` (
  `ID_TIPEB` int(11) NOT NULL,
  `NO_LAP` varchar(200) NOT NULL,
  `NAMA_PELAPOR` varchar(200) NOT NULL,
  `TGL_LAHIR_PELAPOR` date NOT NULL,
  `TMPT_LAHIR_PELAPOR` varchar(200) NOT NULL,
  `JENKEL_PELAPOR` enum('Pria','Wanita') NOT NULL,
  `PEKERJAAN_PELAPOR` varchar(200) NOT NULL,
  `ALAMAT_PELAPOR` varchar(255) NOT NULL,
  `TLP_PELAPOR` char(20) NOT NULL,
  `EMAIL_PELAPOR` char(200) NOT NULL,
  `AGAMA_PELAPOR` varchar(50) NOT NULL,
  `WAKTU_KEJADIAN` datetime NOT NULL,
  `TMPT_KEJADIAN` varchar(255) NOT NULL,
  `YG_TERJADI` varchar(200) NOT NULL,
  `URAIAN_KEJADIAN` text NOT NULL,
  `TINDAKAN_DIAMBIL` varchar(200) NOT NULL,
  `TINDAK_PIDANA` varchar(200) NOT NULL,
  `BRG_BUKTI` varchar(200) NOT NULL,
  `CREATE_AT` date NOT NULL,
  `UPDATE_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CK_KORBAN` tinyint(1) NOT NULL,
  `CK_TERLAPOR` tinyint(1) NOT NULL,
  `CK_SAKSI` tinyint(1) NOT NULL,
  `STATUS` enum('BELUM','SUDAH') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_tipeb`
--

INSERT INTO `tbl_tipeb` (`ID_TIPEB`, `NO_LAP`, `NAMA_PELAPOR`, `TGL_LAHIR_PELAPOR`, `TMPT_LAHIR_PELAPOR`, `JENKEL_PELAPOR`, `PEKERJAAN_PELAPOR`, `ALAMAT_PELAPOR`, `TLP_PELAPOR`, `EMAIL_PELAPOR`, `AGAMA_PELAPOR`, `WAKTU_KEJADIAN`, `TMPT_KEJADIAN`, `YG_TERJADI`, `URAIAN_KEJADIAN`, `TINDAKAN_DIAMBIL`, `TINDAK_PIDANA`, `BRG_BUKTI`, `CREATE_AT`, `UPDATE_AT`, `CK_KORBAN`, `CK_TERLAPOR`, `CK_SAKSI`, `STATUS`) VALUES
(36, '1', 'Rio Ananda Putra1', '1998-01-25', 'Gunung Wetan', 'Pria', 'Web Developer', 'Jl. Makam Gununung Wetan, Kel. Pinang Jaya, Kec. Kemiling', '6285789989287', 'rioanandaputra1998@gmail.com', 'Islam', '2021-09-27 15:36:00', 'Rumah Pelapor', 'Genteng Bocor', '<p>----- Pada hari Senin, tanggal 27 September 2021 sekira pukul 15:36 WIB di Rumah Pelapor <strong>telah terjadi tindak pidana Genteng Bocor</strong> -----<br>----- Kronologis Kejadian It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32. -----<br>----- <strong>Atas kejadian tersebut saya laporkan ke Polsek Teluk Betung Selatan guna Pengusutan Lebih Lanjut</strong> -----</p>', '<ol type=\"a\"><li>sss</li><li>sss</li><li>ss</li></ol>', 'Genteng Bocor', 'Genteng', '2021-09-27', '2021-10-03 08:02:34', 1, 1, 1, 'SUDAH');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tipeb_detail`
--

CREATE TABLE `tbl_tipeb_detail` (
  `ID_TIPEB_DETAIL` int(11) NOT NULL,
  `ID_TIPEB` int(11) NOT NULL,
  `NAMA` varchar(200) NOT NULL,
  `TMPT_LAHIR` varchar(200) NOT NULL,
  `TGL_LAHIR` date NOT NULL,
  `JENKEL` enum('Pria','Wanita') NOT NULL,
  `ALAMAT` varchar(255) NOT NULL,
  `KET` enum('Korban','Terlapor','Saksi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tipec`
--

CREATE TABLE `tbl_tipec` (
  `ID_TIPEC` int(11) NOT NULL,
  `NIK` char(20) NOT NULL,
  `NAMA` varchar(200) NOT NULL,
  `JENKEL` enum('Pria','Wanita') NOT NULL,
  `TMPT_LAHIR` varchar(200) NOT NULL,
  `TGL_LAHIR` date NOT NULL,
  `AGAMA` varchar(100) NOT NULL,
  `ALAMAT` text NOT NULL,
  `PEKERJAAN` varchar(200) NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `NO_TLPN` char(20) NOT NULL,
  `KEWARGANEGARAAN` enum('WNI','WNA') NOT NULL,
  `TGL_KEJADIAN` datetime NOT NULL,
  `LOKASI_KEJADIAN` text NOT NULL,
  `TOKEN_GENERATE` varchar(60) NOT NULL,
  `IP_ADDRESS` varchar(20) NOT NULL,
  `CREATE_AT` datetime NOT NULL,
  `UPDATE_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `STATUS` enum('BELUM','SUDAH') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_tipec`
--

INSERT INTO `tbl_tipec` (`ID_TIPEC`, `NIK`, `NAMA`, `JENKEL`, `TMPT_LAHIR`, `TGL_LAHIR`, `AGAMA`, `ALAMAT`, `PEKERJAAN`, `EMAIL`, `NO_TLPN`, `KEWARGANEGARAAN`, `TGL_KEJADIAN`, `LOKASI_KEJADIAN`, `TOKEN_GENERATE`, `IP_ADDRESS`, `CREATE_AT`, `UPDATE_AT`, `STATUS`) VALUES
(1, '1871132501980003', 'Rio Ananda Putra', 'Pria', 'Gunung Wetan', '1998-01-25', 'Islam', 'Jl. Makam Gunung Wetan, RT/RW 004/-, Kel. Pinang Jaya, Kec. Kemiling, Bandar Lampung', 'Web Developer', 'rioanandaputra1998@gmail.com', '6285789989287', 'WNI', '2021-09-27 10:03:59', 'Jl. Cik ditiro Kemiling', '1', '1', '2021-09-27 10:03:59', '2021-09-27 11:10:43', 'SUDAH');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tipec_detail`
--

CREATE TABLE `tbl_tipec_detail` (
  `ID_TIPEC_DETAIL` int(11) NOT NULL,
  `TOKEN_GENERATE` varchar(60) NOT NULL,
  `JENIS_KEHILANGAN` varchar(50) NOT NULL,
  `NOMOR_IDENTITAS` varchar(50) NOT NULL,
  `IDENTITAS_NAMA` varchar(200) NOT NULL,
  `JUMLAH_IDENTITAS` int(5) NOT NULL,
  `KETERANGAN_IDENTITAS` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_tipec_detail`
--

INSERT INTO `tbl_tipec_detail` (`ID_TIPEC_DETAIL`, `TOKEN_GENERATE`, `JENIS_KEHILANGAN`, `NOMOR_IDENTITAS`, `IDENTITAS_NAMA`, `JUMLAH_IDENTITAS`, `KETERANGAN_IDENTITAS`) VALUES
(1, '1', 'KTP', '1871132501980003', 'Pelapor', 1, '-'),
(2, '1', 'SIM C', '2346875682234', 'Pelapor', 1, '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tpengaduan`
--

CREATE TABLE `tbl_tpengaduan` (
  `ID_TPENGADUAN` int(11) NOT NULL,
  `ID_PENGADUAN` int(11) NOT NULL,
  `PENGIRIM` varchar(200) NOT NULL,
  `TANGGAPAN` varchar(255) NOT NULL,
  `CREATE_AT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`ID_BARANG`);

--
-- Indeks untuk tabel `tbl_berita`
--
ALTER TABLE `tbl_berita`
  ADD PRIMARY KEY (`ID_BERITA`);

--
-- Indeks untuk tabel `tbl_bhabin`
--
ALTER TABLE `tbl_bhabin`
  ADD PRIMARY KEY (`ID_BHABIN`);

--
-- Indeks untuk tabel `tbl_buronan`
--
ALTER TABLE `tbl_buronan`
  ADD PRIMARY KEY (`ID_BURONAN`);

--
-- Indeks untuk tabel `tbl_kecamatan`
--
ALTER TABLE `tbl_kecamatan`
  ADD PRIMARY KEY (`ID_KECAMATAN`);

--
-- Indeks untuk tabel `tbl_kelurahan`
--
ALTER TABLE `tbl_kelurahan`
  ADD PRIMARY KEY (`ID_KELURAHAN`);

--
-- Indeks untuk tabel `tbl_nomor`
--
ALTER TABLE `tbl_nomor`
  ADD PRIMARY KEY (`ID_NOMOR`);

--
-- Indeks untuk tabel `tbl_orang`
--
ALTER TABLE `tbl_orang`
  ADD PRIMARY KEY (`ID_ORANG`);

--
-- Indeks untuk tabel `tbl_pengaduan`
--
ALTER TABLE `tbl_pengaduan`
  ADD PRIMARY KEY (`ID_PENGADUAN`);

--
-- Indeks untuk tabel `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`ID_PENGGUNA`);

--
-- Indeks untuk tabel `tbl_tahanan`
--
ALTER TABLE `tbl_tahanan`
  ADD PRIMARY KEY (`ID_TAHANAN`);

--
-- Indeks untuk tabel `tbl_tipeb`
--
ALTER TABLE `tbl_tipeb`
  ADD PRIMARY KEY (`ID_TIPEB`);

--
-- Indeks untuk tabel `tbl_tipeb_detail`
--
ALTER TABLE `tbl_tipeb_detail`
  ADD PRIMARY KEY (`ID_TIPEB_DETAIL`);

--
-- Indeks untuk tabel `tbl_tipec`
--
ALTER TABLE `tbl_tipec`
  ADD PRIMARY KEY (`ID_TIPEC`);

--
-- Indeks untuk tabel `tbl_tipec_detail`
--
ALTER TABLE `tbl_tipec_detail`
  ADD PRIMARY KEY (`ID_TIPEC_DETAIL`);

--
-- Indeks untuk tabel `tbl_tpengaduan`
--
ALTER TABLE `tbl_tpengaduan`
  ADD PRIMARY KEY (`ID_TPENGADUAN`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `ID_BARANG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_berita`
--
ALTER TABLE `tbl_berita`
  MODIFY `ID_BERITA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tbl_bhabin`
--
ALTER TABLE `tbl_bhabin`
  MODIFY `ID_BHABIN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_buronan`
--
ALTER TABLE `tbl_buronan`
  MODIFY `ID_BURONAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_kecamatan`
--
ALTER TABLE `tbl_kecamatan`
  MODIFY `ID_KECAMATAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_kelurahan`
--
ALTER TABLE `tbl_kelurahan`
  MODIFY `ID_KELURAHAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_nomor`
--
ALTER TABLE `tbl_nomor`
  MODIFY `ID_NOMOR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_orang`
--
ALTER TABLE `tbl_orang`
  MODIFY `ID_ORANG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengaduan`
--
ALTER TABLE `tbl_pengaduan`
  MODIFY `ID_PENGADUAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `ID_PENGGUNA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_tahanan`
--
ALTER TABLE `tbl_tahanan`
  MODIFY `ID_TAHANAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_tipeb`
--
ALTER TABLE `tbl_tipeb`
  MODIFY `ID_TIPEB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `tbl_tipeb_detail`
--
ALTER TABLE `tbl_tipeb_detail`
  MODIFY `ID_TIPEB_DETAIL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT untuk tabel `tbl_tipec`
--
ALTER TABLE `tbl_tipec`
  MODIFY `ID_TIPEC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbl_tipec_detail`
--
ALTER TABLE `tbl_tipec_detail`
  MODIFY `ID_TIPEC_DETAIL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_tpengaduan`
--
ALTER TABLE `tbl_tpengaduan`
  MODIFY `ID_TPENGADUAN` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
