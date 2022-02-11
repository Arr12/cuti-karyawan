<?php require_once('Connections/cn_db_cuti_karywan.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}



if (!isset($_SESSION)) {
  session_start();
}
$no_budget=$_POST['nomor_badge'];
$operator=$_SESSION['MM_Username'];
$tanggal=$_POST['tanggal_insert'];
$tanggal_pengajuan=explode("-",$_POST['tanggal_insert']);
$tanggal_pengajuan_valid=$tanggal_pengajuan[2]."-".$tanggal_pengajuan[1]."-".$tanggal_pengajuan[0];
function kdbulan($jkel)
{
	switch($jkel){
	case 01;
	  $jkel = 'Januari';
	break;
	case 02;
	 $jkel = 'Februari';
	break;
	case 03;
	 $jkel = 'Maret';
	break;
	case 04;
	 $jkel = 'April';
	break;
	case 05;
	 $jkel = 'Mei';
	break;
	case 06;
	 $jkel = 'Juni';
	break;
	case 07;
	 $jkel = 'Juli';
	break;
	case 08;
	 $jkel = 'Agustus';
	break;
	case 09;
	 $jkel = 'September';
	break;
	case 10;
	 $jkel = 'Oktober';
	break;
	case 11;
	 $jkel = 'November';
	break;
	case 12;
	 $jkel = 'Desember';
	break;
	}
	return $jkel;
}

mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
$query_rs_cuti = sprintf("SELECT * FROM t_cuti WHERE nomor_badge = '$no_budget' and tanggal_pengajuan='$tanggal_pengajuan_valid'");
$rs_cuti = mysql_query($query_rs_cuti, $cn_db_cuti_karywan) or die(mysql_error());
$row_rs_cuti = mysql_fetch_assoc($rs_cuti);
$totalRows_rs_cuti = mysql_num_rows($rs_cuti);
/*
if ($row_rs_cuti['aprove']==ya)
{
*/
mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
$query_rs_karyawan = sprintf("SELECT * FROM t_master_karyawan WHERE nomor_badge = '$no_budget'");
$rs_karyawan = mysql_query($query_rs_karyawan, $cn_db_cuti_karywan) or die(mysql_error());
$row_rs_karyawan = mysql_fetch_assoc($rs_karyawan);
$totalRows_rs_karyawan = mysql_num_rows($rs_karyawan);

$temp=explode("-",$row_rs_cuti['tanggal_awal']);
$tglvalid=$temp[2]." ".kdbulan($temp[1])." ".$temp[0];

$temp2=explode("-",$row_rs_cuti['tanggal_akhir']);
$tglvalid2=$temp2[2]." ".kdbulan($temp2[1])." ".$temp2[0];
function datediff($d1, $d2){  
			$d1 = (is_string($d1) ? strtotime($d1) : $d1);  
			$d2 = (is_string($d2) ? strtotime($d2) : $d2);  
			$diff_secs = abs($d1 - $d2);  
			$base_year = min(date("Y", $d1), date("Y", $d2));  
			$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);  
			return array(  
			"years" => date("Y", $diff) - $base_year,  
			"months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,  
			"months" => date("n", $diff) - 1,  
			"days_total" => floor($diff_secs / (3600 * 24)),  
			"days" => date("j", $diff) - 1,  
			"hours_total" => floor($diff_secs / 3600),  
			"hours" => date("G", $diff),  
			"minutes_total" => floor($diff_secs / 60),  
			"minutes" => (int) date("i", $diff),  
			"seconds_total" => $diff_secs,  
			"seconds" => (int) date("s", $diff)  
			);  
			}  
			
	
	 		$temp_1=explode("-",$row_rs_karyawan['tgl_mulai_kerja']);
			$tglvalid_1=$temp_1[2];
			$blnvalid_1=$temp_1[1];
			$tgl_now=date('d');
			$bln_now=date('m');
			
			
			if ($blnvalid_1<=$bln_now)
			{
			$temp_kerja=explode("-",$row_rs_karyawan['tgl_mulai_kerja']);
			$thn_cuti_timbul=$temp_kerja[0]+1;
			$thn=date('Y');
			$tglvalid_kerja=$temp_kerja[2]."-".$temp_kerja[1]."-".$thn;
			}
			else
			{
			$thn=$temp_kerja[0];
			$temp_kerja=explode("-",$row_rs_karyawan['tgl_mulai_kerja']);
			$thn=date('Y')-1;
			$tglvalid_kerja=$temp_kerja[2]."-".$temp_kerja[1]."-".$thn;
			}
			
			


include('nama_pejabat.php');
$tanggal_now=date('d-m-Y');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include('title.php');?></title>
<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<table width="1000" border="0" align="center">
  <tr>
    <td colspan="3"><strong>Dinas Sosial Profinsi Jawa timur </strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><span class="style1">SURAT PERMOHONAN CUTI </span></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><U><span class="style1">Karyawan Dinas Sosial Profinsi Jawa timur </span></U></td>
  </tr>
  <tr>
    <td width="227">&nbsp;</td>
    <td width="477">&nbsp;</td>
    <td width="282">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Yang bertandatangan di bawah ini : </td>
  </tr>
  <tr>
    <td>1. Nama </td>
    <td>: <?php echo $row_rs_karyawan['nama_karyawan']; ?></td>
    <td>Nomor Badge : <?php echo $row_rs_karyawan['nomor_badge']; ?></td>
  </tr>
  <tr>
    <td>2. Klasifikasi </td>
    <td>: <?php echo $row_rs_karyawan['klasifikasi']; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>3. Dept/Biro/Bagian/Seksi </td>
    <td>: <?php echo $row_rs_karyawan['dep_biro_bagian']; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>4. Tanggal cuti timbul </td>
    <td> : <?php echo $tglvalid_kerja; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Pengajuan cuti untuk : </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>1. Cuti Tahunan </td>
    <td> :&nbsp; <?php echo $row_rs_cuti['jumlah_cuti']; ?> hari </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>2. Cuti alasan penting </td>
    <td>: &nbsp;<?php echo $row_rs_cuti['jumlah_dispen']; ?> hari </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;- terhitung mulai tanggal </td>
    <td>: <?php echo $tglvalid; ?>  s/d  <?php echo $tglvalid2; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>3. Alasan cuti </td>
    <td>:&nbsp;<?php echo $row_rs_cuti['alasan_dispen']; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>4. Alamat cuti </td>
    <td>:&nbsp;<?php echo $row_rs_cuti['alamat_bisadihubungi']; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Surabaya, <?php echo $tanggal_now;?> </td>
  </tr>
  <tr>
    <td align="left">Yang Bretugas </td>
    <td>&nbsp;</td>
    <td>Pemohon,</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><u>(.................................................... ) </u></td>
    <td>&nbsp;</td>
    <td><u>( <?php echo $row_rs_karyawan['nama_karyawan']; ?>)</u></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">---------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td colspan="2">Pendapat atasan yang bersangkutan </td>
    <td>Surabaya, ....................................</td>
  </tr>
  <tr>
    <td height="21">Diizinkan / Ditunda .</td>
    <td>: .............. hari</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21">Mulai tanggal </td>
    <td>: ............................. s/d .............................</td>
    <td>.................................................</td>
  </tr>
  <tr>
    <td colspan="3">---------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td>Pendelegasian tugas rutin :</td>
    <td><div align="center">TTD</div></td>
    <td><div align="center">TTD</div></td>
  </tr>
  <tr>
    <td height="21">1......................................................</td>
    <td><div align="center">..........................................</div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21">2......................................................</td>
    <td><div align="center"></div></td>
    <td><div align="center">..........................................</div></td>
  </tr>
  <tr>
    <td colspan="3">---------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td colspan="3">Catatan Administratsi Dinas Sosial Profinsi Jawa timur </td>
  </tr>
  <tr>
    <td>1. Berhak cuti untuk periode  </td>
    <td>: <?php echo $row_rs_karyawan['periode_cuti']; ?></td>
    <td>: <?php echo $row_rs_karyawan['hak_cuti']; ?> hari</td>
  </tr>
  <tr>
    <td valign="top">2. Cuti telah diambil </td>
    <td> 
	<?php
mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
$query_rs_cuti_limit = sprintf("SELECT * FROM t_cuti WHERE nomor_badge = '$no_budget'");
$rs_cuti_limit = mysql_query($query_rs_cuti_limit, $cn_db_cuti_karywan) or die(mysql_error());
$totalRows_rs_cuti_limit = mysql_num_rows($rs_cuti_limit);
$limit=$totalRows_rs_cuti_limit-1;

mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
$query_rs_cuti_lagi = sprintf("SELECT * FROM t_cuti WHERE nomor_badge = '$no_budget' ORDER BY tanggal_pengajuan ASC LIMIT 0,$limit");
$rs_cuti_lagi = mysql_query($query_rs_cuti_lagi, $cn_db_cuti_karywan) or die(mysql_error());
$totalRows_rs_cuti_lagi = mysql_num_rows($rs_cuti_lagi);

	?>
	<table>
	<?php 
while ($data = mysql_fetch_assoc($rs_cuti_lagi))
{ 
	$temp_ulang=explode("-",$data['tanggal_awal']);
$tglvalid_ulang=$temp_ulang[2]."-".$temp_ulang[1]."-".$temp_ulang[0];

$temp_ulang1=explode("-",$data['tanggal_akhir']);
$tglvalid_ulang1=$temp_ulang1[2]."-".$temp_ulang1[1]."-".$temp_ulang1[0];

$jumlah_cuti_lagi=$data['jumlah_cuti'];
$totalcuti[]=$jumlah_cuti_lagi;
$totalsekarang = array_sum($totalcuti);

	?>
	<tr><td>
	<?php echo "$tglvalid_ulang"; ?>
	</td>
	<td> s/d	</td>
	<td><?php echo "$tglvalid_ulang1"; ?>	</td>
	<td> :	</td>
	<td><?php echo $data['jumlah_cuti']; ?></td>
	</tr>
	<?php }  ?>
	<tr>
	<td colspan="3">Total</td>
	<td>:</td>
	<td><?php echo "$totalsekarang";?>	</tr>
	</table>	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">Sisa cuti </td>
    <td>: <?php echo $row_rs_karyawan['hak_cuti']-$totalsekarang-$row_rs_cuti['jumlah_cuti']; ?> hari </td>
  </tr>
  <tr>
    <td>- Cuti yang ke</td>
    <td>:  <?php echo $totalRows_rs_cuti_lagi; ?></td>
    <td>Surabaya, ....................................</td>
  </tr>
  <tr>
    <td>- Cuti gugur tgl </td>
    <td>: <? $gugur=explode("-",$tglvalid_kerja);
	$thn_gugur_new=$gugur[2]+1;
	$tglvalid_kerja_gugur=$gugur[0]."-".$gugur[1]."-".$thn_gugur_new;
	echo $tglvalid_kerja_gugur; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><u><?php echo $kabid_personalia;?></u></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Kepala Dinas</td>
  </tr>
  <tr>
    <td colspan="3">---------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td><u>Permohonan cuti</u> </td>
    <td>&nbsp;</td>
    <td>Surabaya, ....................................</td>
  </tr>
  <tr>
    <td>a. Diizinkan untuk </td>
    <td>: ................... hari </td>
    <td>Dinas Sosial Profinsi Jawa timur </td>
  </tr>
  <tr>
    <td>b. Tidak diizinkan </td>
    <td>: ................... hari </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>c. Ditunda </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Cc. : 1. Atasan yang bersangkutan </td>
    <td align="left"><u><?php echo $gm;?></u> </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Adm. Dinas Sosial Profinsi Jawa timur </td>
    <td align="left">Kepala Dinas Sosial Profinsi Jawa Timur </td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($rs_cuti);
mysql_free_result($rs_cuti_lagi);
mysql_free_result($rs_karyawan);

/*
else
{
	echo "<center><blink><b><font color='red' size='5'>Maaf pengajuan cuti anda belum disetujui oleh direksi</font></b></blink></center>";
}
*/
?>

