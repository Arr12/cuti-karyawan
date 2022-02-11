-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 13. September 2014 jam 10:27
-- Versi Server: 5.1.41
-- Versi PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_cuti_karyawan`
--

-- --------------------------------------------------------

--
-- Structure for view `v_cuti_karyawan`
--

CREATE ALGORITHM=TEMPTABLE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_cuti_karyawan` AS select `o`.`nomor_badge` AS `nomor_badge`,`o`.`nama_karyawan` AS `nama_karyawan`,`c`.`tanggal_awal` AS `tanggal_awal`,`c`.`tanggal_akhir` AS `tanggal_akhir`,`c`.`jumlah_cuti` AS `jumlah_cuti`,`c`.`tanggal_pengajuan` AS `tanggal_pengajuan`,`c`.`tanggal_cuti_gugur` AS `tanggal_cuti_gugur`,`c`.`jumlah_dispen` AS `jumlah_dispen`,`c`.`alasan_dispen` AS `alasan_dispen`,`c`.`aprove` AS `status` from (`t_cuti` `c` join `t_master_karyawan` `o`) where (`o`.`nomor_badge` = `c`.`nomor_badge`);

--
-- VIEW  `v_cuti_karyawan`
-- Data: tanpa
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
