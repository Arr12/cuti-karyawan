-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 11. Februari 2022 jam 18:14
-- Versi Server: 5.1.41
-- Versi PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `db_cuti_karyawan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_admin`
--

CREATE TABLE IF NOT EXISTS `t_admin` (
  `no_id` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(10) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`no_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `t_admin`
--

INSERT INTO `t_admin` (`no_id`, `username`, `password`) VALUES
(3, 'ajg', '09196'),
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_cuti`
--

CREATE TABLE IF NOT EXISTS `t_cuti` (
  `nomor_badge` varchar(12) COLLATE latin1_general_ci NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `jumlah_cuti` int(3) NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `jumlah_dispen` int(3) DEFAULT NULL,
  `alasan_dispen` longtext COLLATE latin1_general_ci,
  `tanggal_cuti_gugur` date DEFAULT NULL,
  `aprove` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `alamat_bisadihubungi` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `keterangan_dispen` varchar(6) COLLATE latin1_general_ci DEFAULT NULL,
  `jam` time NOT NULL,
  UNIQUE KEY `constr_ajgcuti` (`nomor_badge`,`tanggal_awal`,`tanggal_akhir`,`tanggal_pengajuan`,`jam`),
  KEY `jam` (`jam`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `t_cuti`
--

INSERT INTO `t_cuti` (`nomor_badge`, `tanggal_awal`, `tanggal_akhir`, `jumlah_cuti`, `tanggal_pengajuan`, `jumlah_dispen`, `alasan_dispen`, `tanggal_cuti_gugur`, `aprove`, `alamat_bisadihubungi`, `keterangan_dispen`, `jam`) VALUES
('k. 002', '2020-01-01', '2020-01-01', -1, '2020-05-12', 1, '', '2021-10-15', 'belum', 'JL. GUBERNUR SURYO XII/95 GRESIK', 'ya', '20:18:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_master_karyawan`
--

CREATE TABLE IF NOT EXISTS `t_master_karyawan` (
  `nomor_badge` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `nama_karyawan` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `group_kerja` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `klasifikasi` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `dep_biro_bagian` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `tgl_mulai_kerja` date NOT NULL,
  `periode_cuti` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `hak_cuti` int(3) DEFAULT NULL,
  `keterangan_shift` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `bagian` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`nomor_badge`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `t_master_karyawan`
--

INSERT INTO `t_master_karyawan` (`nomor_badge`, `nama_karyawan`, `group_kerja`, `klasifikasi`, `dep_biro_bagian`, `alamat`, `tgl_mulai_kerja`, `periode_cuti`, `hak_cuti`, `keterangan_shift`, `bagian`) VALUES
('1', '1', '1', '1', '1', '1', '2019-12-17', '2013/2014', 12, 'Shift', '1'),
('2', 'a', 'a', 'a', 'a', 'a', '2019-12-17', '2018/2019', 12, 'Shift', 'a'),
('K. 001', 'SUYATNO', 'ANEKA JASA GRHADIKA,', 'HARIAN TEMPORER', 'DEPT. LATSIN', 'PONGANGAN RT 1/RW 1 MANYAR GRESIK', '1996-11-18', '', 12, '', 'LAS FABRIKASI II'),
('K. 002', 'SHOLIHAN', 'ANEKA JASA GRHADIKA,', 'HARIAN TEMPORER', 'DEPT. HAR. I', 'JL. GUBERNUR SURYO XII/95 GRESIK', '1993-10-16', '', 12, '', 'SIPIL I'),
('K. 003', 'ADELAN', 'ANEKA JASA GRHADIKA,', 'HARIAN TEMPORER', 'DEPT. HAR. I', 'DS.INDRO 30 RT 2/RW 01 BUNGAH GRESIK', '1993-10-01', '', 12, '', 'SIPIL I'),
('K. 004', 'ZAINAL MAHFUDZ', 'ANEKA JASA GRHADIKA,', 'HARIAN TEMPORER', 'DEPT. LATSIN', 'TEBALOAN RT 2/RW 1 DUDUK S. GRESIK', '1996-09-05', '', 12, '', 'LAS FABRIKASI II'),
('K. 005', 'AGUS TOTOK SUSIANTO', 'ANEKA JASA GRHADIKA,', 'HARIAN TEMPORER', 'DEPT. LATSIN', 'JL. USMAN SADAR 22/4 SUKORAME GRESIK', '1997-01-16', '', 12, '', 'LAS FABRIKASI II'),
('', '', '', '', '', '', '0000-00-00', '', 0, '', ''),
('5', 'ervan', 'semoro', 'g', 'g', 'g', '2020-05-12', '2013/2014', 12, 'Shift', 'g'),
('9696', 'ervan', 'semoro', 'temporer', 'kebersihan', 'g', '2020-05-12', '2013/2014', 12, 'Shift', 'tetap'),
('k.9696', 'ervan', 'semoro', 'temporer', 'kebersihan', 'g', '2020-05-12', '2013/2014', 12, 'Shift', 'tetap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `v_cuti_karyawan`
--

CREATE ALGORITHM=TEMPTABLE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `db_cuti_karyawan`.`v_cuti_karyawan` AS select `o`.`nomor_badge` AS `nomor_badge`,`o`.`nama_karyawan` AS `nama_karyawan`,`c`.`tanggal_awal` AS `tanggal_awal`,`c`.`tanggal_akhir` AS `tanggal_akhir`,`c`.`jumlah_cuti` AS `jumlah_cuti`,`c`.`tanggal_pengajuan` AS `tanggal_pengajuan`,`c`.`tanggal_cuti_gugur` AS `tanggal_cuti_gugur`,`c`.`jumlah_dispen` AS `jumlah_dispen`,`c`.`alasan_dispen` AS `alasan_dispen`,`c`.`aprove` AS `status` from (`db_cuti_karyawan`.`t_cuti` `c` join `db_cuti_karyawan`.`t_master_karyawan` `o`) where (`o`.`nomor_badge` = `c`.`nomor_badge`);

--
-- Dumping data untuk tabel `v_cuti_karyawan`
--

INSERT INTO `v_cuti_karyawan` (`nomor_badge`, `nama_karyawan`, `tanggal_awal`, `tanggal_akhir`, `jumlah_cuti`, `tanggal_pengajuan`, `tanggal_cuti_gugur`, `jumlah_dispen`, `alasan_dispen`, `status`) VALUES
('K. 002', 'SHOLIHAN', '2020-01-01', '2020-01-01', -1, '2020-05-12', '2021-10-15', 1, '', 'belum');
