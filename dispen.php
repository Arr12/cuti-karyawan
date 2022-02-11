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

$colname_rs_karyawan_cuti = "-1";
if (isset($_GET['nomor_badge'])) {
  $colname_rs_karyawan_cuti = (get_magic_quotes_gpc()) ? $_GET['nomor_badge'] : addslashes($_GET['nomor_badge']);
}
mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
$query_rs_karyawan_cuti = sprintf("SELECT * FROM t_cuti WHERE nomor_badge = %s", GetSQLValueString($colname_rs_karyawan_cuti, "text"));
$rs_karyawan_cuti = mysql_query($query_rs_karyawan_cuti, $cn_db_cuti_karywan) or die(mysql_error());
$row_rs_karyawan_cuti = mysql_fetch_assoc($rs_karyawan_cuti);
$totalRows_rs_karyawan_cuti = mysql_num_rows($rs_karyawan_cuti);
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";


function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  $isValid = False; 

  if (!empty($UserName)) { 

    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
$operator=$_SESSION['MM_Username'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include('title.php');?></title>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<?php include('menu_atas.php'); ?>
</head>

<body bgcolor="#DBFBBC">
<script language="JavaScript1.2">mmLoadMenus();</script>
<table width="800" border="0" align="center" cellspacing="0">
  <tr>
    <td background="picture/jgg99.png" height="219" width="800"><p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
 <tr>
    <td height="60" background="picture/menu_atas.png">
		<table width="758" height="39" align="center">
		  <tr><td width="416"><img src="picture/menu.png" name="image1" width="280" height="26" border="0" usemap="#Map" id="image1" /></td>
			   <td width="330" align="left"><font color="#FF0000">Operator : <?php echo $operator;?></font></td>
      </tr></table>
	</td>
  </tr>
  <tr>
  	<td background="picture/atas.jpg" height="42"></td>
  </tr>
<tr>
    <td height="34" align="center" valign="top" background="picture/tengah.jpg"><br />
	<?php
$lanjut=$_POST['lanjut'];
if ($lanjut)
{
	  $no_budget=$_SESSION['MM_nomor_budge'];
	 
	  $tanggal_awal=$_POST['tanggal_awal'];
	  $bulan_awal=$_POST['bulan_awal'];
	  $tahun_awal=$_POST['tahun_awal'];
	  $a=$tahun_awal."-".$bulan_awal."-".$tanggal_awal;
	  $tampil_tgl_awal=$tanggal_awal."-".$bulan_awal."-".$tahun_awal;
		  
	  $tanggal_akhir=$_POST['tanggal_akhir'];
	  $bulan_akhir=$_POST['bulan_akhir'];
	  $tahun_akhir=$_POST['tahun_akhir'];
	  $b=$tahun_akhir."-".$bulan_akhir."-".$tanggal_akhir;
	  $tanggal=date('Y-m-d');
	  $tanggal_tampil=date('d-m-Y');
	  $jumlah_cuti=$_POST['jumlah_cuti'];
	  $tampil_tgl_akhir=$tanggal_akhir."-".$bulan_akhir."-".$tahun_akhir;
	  $jam=date('H:i:s');
	  $sisa=$_POST['sisa'];
	  $ket_cuti=$_POST['ket_cuti'];
	  
$_SESSION['MM_tanggal_awal'] = $tampil_tgl_awal;
$_SESSION['MM_tanggal_akhir'] = $tampil_tgl_akhir;
$_SESSION['MM_jumlah_cuti'] = $jumlah_cuti;
$_SESSION['MM_tanggal'] = $tanggal_tampil;
$_SESSION['MM_jam'] = $jam;

/*
mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
$cek = "select count(*)as ADA from t_cuti where tanggal_pengajuan='$tanggal' and nomor_badge='$no_budget'";
$hasil_cek = mysql_query($cek, $cn_db_cuti_karywan) or die(mysql_error());
$ada = mysql_fetch_array($hasil_cek);
if($ada['ADA'] <= 0){
*/
if($ket_cuti==0)
{
		if ($sisa>=$jumlah_cuti)
			{
			$query = "INSERT INTO t_cuti(nomor_badge,tanggal_awal,tanggal_akhir,jumlah_cuti,tanggal_pengajuan,aprove,jam) VALUES ('$no_budget','$a','$b','$jumlah_cuti','$tanggal','belum','$jam')";
			$hasil = mysql_query($query, $cn_db_cuti_karywan) or die(mysql_error());
			


		$c=$_SESSION['MM_tanggal_awal'];
		$d=$_SESSION['MM_tanggal_akhir'];
		$e=$_SESSION['MM_jumlah_cuti'];
		$f=$_SESSION['MM_tanggal'];
		echo "
		<table width='350' border='0'>
				<tr>
				  <td align='left' width='131'>Tanggal cuti </td>
				  <td align='left' width='12'>:</td>
				  <td align='left' width='180'>$c  s/d  $d</td>
				</tr>
				<tr>
				  <td align='left'>Jumlah hari cuti </td>
				  <td align='left'>:</td>
				  <td align='left'>$e hari</td>
				</tr>
				<tr>
				  <td align='left'>Tanggal pengajuan </td>
				  <td align='left'>:</td>
				  <td align='left'>$f</td>
				</tr>
			   </table>
			  <br>
		<form id='form1' name='form1' method='post' action='dispen.php'>
			  <table width='222' border='0'>
				<tr>
				  <td height='35' colspan='3' align='center' valign='top'><strong>DAPAT DISPENSASI</strong></td>
				</tr>
				<tr>
				  <td width='131' align='center'> <input type='submit' name='ya' value='Ya' /></td>
				  <td width='143' align='center'> <input type='submit' name='tidak' value='Tidak' /></td>
				</tr>
				</table>
			  </form>
		";
			}
			else
			{
			echo "<font color='red'>Maaf cuti yang anda masukan melebihi sisa cuti (sisa cuti = $sisa)</font>";
			}
	}
	else
	{
		$query = "INSERT INTO t_cuti(nomor_badge,tanggal_awal,tanggal_akhir,jumlah_cuti,tanggal_pengajuan,aprove,jam) VALUES ('$no_budget','$a','$b','$jumlah_cuti','$tanggal','belum','$jam')";
			$hasil = mysql_query($query, $cn_db_cuti_karywan) or die(mysql_error());
			


		$c=$_SESSION['MM_tanggal_awal'];
		$c=$_SESSION['MM_tanggal_awal'];
		$d=$_SESSION['MM_tanggal_akhir'];
		$e=$_SESSION['MM_jumlah_cuti'];
		$f=$_SESSION['MM_tanggal'];
		echo "
		<table width='350' border='0'>
				<tr>
				  <td align='left' width='131'>Tanggal cuti </td>
				  <td align='left' width='12'>:</td>
				  <td align='left' width='180'>$c s/d $d</td>
				</tr>
				<tr>
				  <td align='left'>Jumlah hari cuti </td>
				  <td align='left'>:</td>
				  <td align='left'>$e hari</td>
				</tr>
				<tr>
				  <td align='left'>Tanggal pengajuan </td>
				  <td align='left'>:</td>
				  <td align='left'>$f</td>
				</tr>
			   </table>
			  <br>
		<form id='form1' name='form1' method='post' action='dispen.php'>
			  <table width='222' border='0'>
				<tr>
				  <td height='35' colspan='3' align='center' valign='top'><strong>DAPAT DISPENSASI</strong></td>
				</tr>
				<tr>
				  <td width='131' align='center'> <input type='submit' name='ya' value='Ya' /></td>
				  <td width='143' align='center'> <input type='submit' name='tidak' value='Tidak' /></td>
				</tr>
				</table>
			  </form>
		";
	}
}

?>
 <?php 
$no_budget=$_SESSION['MM_nomor_budge'];
$c=$_SESSION['MM_tanggal_awal'];
$d=$_SESSION['MM_tanggal_akhir'];
$e=$_SESSION['MM_jumlah_cuti'];
$f=$_SESSION['MM_tanggal'];
$tanggal=date('Y-m-d');
	 $ya=$_POST['ya'];
	
	 if($ya)
	 {
	 echo "
	 <table width='350' border='0'>
        <tr>
          <td align='left' width='131'>Tanggal cuti </td>
          <td align='left' width='12'>:</td>
          <td align='left' width='180'>$c s/d $d</td>
        </tr>
        <tr>
          <td align='left'>Jumlah hari cuti </td>
          <td align='left'>:</td>
          <td align='left'>$e hari</td>
        </tr>
        <tr>
          <td align='left'>Tanggal pengajuan </td>
          <td align='left'>:</td>
          <td align='left'>$f</td>
        </tr>
        <tr>
		<td align='left'>
	   Keterangan 
	   </td>
	   <td align='left'>: </td>
	   <td align='left'>
	   Dapat Dispensasi
	   </td>
	   </tr>
	  </table>
	   
	 ";
	 
	 mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
	 $update_hak_cuti= mysql_query("UPDATE t_cuti SET keterangan_dispen ='ya' WHERE nomor_badge ='$no_budget' and tanggal_pengajuan='$tanggal'");
		
	 echo "
	 <form name='form1' method='post' action='dispen.php'>
	 <center>
	 <table>
	 <tr>
	 <td>Masukan Jumlah dispensasi</td>
	 <td> : </td>
	 <td><input type='text' name='jumlah_dispensasi' size='3' value='0'></td>
	 </tr>
	 <tr>
	 <td>Masukan Alasan dispensasi</td><td> : </td>
	 <td><textarea name='alasan_dispensasi'></textarea></td>
	 </tr>
	 <tr><td colspan='3' align='center'><input type='submit' name='submit_dispen' value='Simpan'></td></tr>
	 </table>
	 </center>
	 </form>
	 ";
	}
	 ?>
	  <?php 
$c=$_SESSION['MM_tanggal_awal'];
$d=$_SESSION['MM_tanggal_akhir'];
$e=$_SESSION['MM_jumlah_cuti'];
$f=$_SESSION['MM_tanggal'];
$no_budget=$_SESSION['MM_nomor_budge'];
$tanggal=date('Y-m-d');

	 $tidak=$_POST['tidak'];
	 if($tidak)
	 {
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
			
	 $sql_hak_cuti =("SELECT * FROM t_master_karyawan where nomor_badge ='$no_budget'");
	 $query_hak_cuti = mysql_query($sql_hak_cuti, $cn_db_cuti_karywan) or die(mysql_error());
	 $row_hak_cuti = mysql_fetch_array($query_hak_cuti);
	 $hak_cuti_awal=$row_hak_cuti['hak_cuti'];
	 $jumlah_hak_cuti=$hak_cuti_awal-$e;

	 mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
	$update_hak_cuti= mysql_query("UPDATE t_cuti SET alasan_dispen ='Kepentingan keluarga' WHERE nomor_badge ='$no_budget' and tanggal_pengajuan='$tanggal'");

	
	 		$tgl_kerja=$row_hak_cuti['tgl_mulai_kerja'];
			$tgl=date('Y-m-d');
			$a = datediff("$tgl_kerja", "$tgl"); 
			$lama_kerja=$a[years];
			
			if ($lama_kerja<3)
			{
					
			function add_days($my_date,$numdays) {
			$date_t = strtotime($my_date.' UTC');
			return gmdate('Y-m-d',$date_t - ($numdays*86400));
				}
				$my_date = $row_hak_cuti['tgl_mulai_kerja'];
				$a=add_days($my_date,1);
				
			$temp_kerja=explode("-",$row_hak_cuti['tgl_mulai_kerja']);
			$thn_cuti_gugur=$temp_kerja[0]+2;
			$tgl_date_kerja=explode("-",$a);
			$tgl_cuti_gugur=$tgl_date_kerja[2];
			$thn=date('Y')+1;
			$tglvalid_kerja=$tgl_cuti_gugur."-".$tgl_date_kerja[1]."-".$thn;
			}
			else
			{
			function add_days($my_date,$numdays) {
			$date_t = strtotime($my_date.' UTC');
			return gmdate('Y-m-d',$date_t - ($numdays*86400));
				}
				$my_date = $row_hak_cuti['tgl_mulai_kerja'];
				$a=add_days($my_date,1);

			$thn=date("Y");
			$temp_kerja=explode("-",$row_hak_cuti['tgl_mulai_kerja']);
			$tgl_date_kerja=explode("-",$a);
			$tgl_cuti_gugur=$tgl_date_kerja[2];
			$thn_1=date('Y')+1;
			$tglvalid_kerja=$tgl_cuti_gugur."-".$tgl_date_kerja[1]."-".$thn_1;
			
			}
		
		mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
		$update_hak_cuti= mysql_query("UPDATE t_cuti SET keterangan_dispen ='tidak' WHERE nomor_badge ='$no_budget' and tanggal_pengajuan='$tanggal'");
	 
		
	 echo "
	 <form action='dispen.php' method='post'>
	 <table width='400' border='0'>
        <tr>
          <td align='left' width='131'>Tanggal cuti </td>
          <td align='left' width='12'>:</td>
          <td align='left' width='180'>$c s/d $d</td>
        </tr>
        <tr>
          <td align='left'>Jumlah hari cuti </td>
          <td align='left'>:</td>
          <td align='left'>$e hari</td>
        </tr>
        <tr>
          <td align='left'>Tanggal pengajuan </td>
          <td align='left'>:</td>
          <td align='left'>$f</td>
        </tr>
        <tr>
	   <td align='left'>
	   Alamat Bisa dihubungi
	   </td>
	   <td align='left'>:</td>
	   <td align='left'><input type='text' name='alamat-cuti' value='$row_hak_cuti[alamat]'>
	   </td>
	   </tr>
	   <tr>
	   <td align='left'>
	   Tanggal cuti gugur
	   </td>
	   <td align='left'>:</td>
	   <td align='left'>
	   <input type='text' name='tgl_cuti_gugur' value='$tglvalid_kerja'>
	   </td>
	   </tr>
	   <tr><td align='left' colspan='3'></td></tr>
	   <tr>
	   <td align='left' align='center' colspan='3'><input type='submit' name='proses_akhir' value='Lanjut'>
	   </td>
	   </tr>
	   </table>
	   </form>
	 ";
}	 
?>
	 <?php
$no_budget=$_SESSION['MM_nomor_budge'];
$c=$_SESSION['MM_tanggal_awal'];
$d=$_SESSION['MM_tanggal_akhir'];
$e=$_SESSION['MM_jumlah_cuti'];
$f=$_SESSION['MM_tanggal'];
$submit_dispen=$_POST['submit_dispen'];
$jumlah_dispensasi=$_POST['jumlah_dispensasi'];
$alasan_dispensasi=$_POST['alasan_dispensasi'];
$tanggal=date('Y-m-d');
$jumlah_cuti_akhir=$e-$jumlah_dispensasi;

if($submit_dispen)
{

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
			
	 $sql_hak_cuti =("SELECT * FROM t_master_karyawan where nomor_badge ='$no_budget'");
	 $query_hak_cuti = mysql_query($sql_hak_cuti, $cn_db_cuti_karywan) or die(mysql_error());
	 $row_hak_cuti = mysql_fetch_array($query_hak_cuti);
	 $hak_cuti_awal=$row_hak_cuti['hak_cuti'];
	 $jumlah_hak_cuti=$hak_cuti_awal-$e;
	 
	 		$tgl_kerja=$row_hak_cuti['tgl_mulai_kerja'];
			$tgl=date('Y-m-d');
			$a = datediff("$tgl_kerja", "$tgl"); 
			$lama_kerja=$a[years];
			if ($lama_kerja<3)
			{
					
			function add_days($my_date,$numdays) {
			$date_t = strtotime($my_date.' UTC');
			return gmdate('Y-m-d',$date_t - ($numdays*86400));
				}
				$my_date = $row_hak_cuti['tgl_mulai_kerja'];
				$a=add_days($my_date,1);
				
			$temp_kerja=explode("-",$row_hak_cuti['tgl_mulai_kerja']);
			$thn_cuti_gugur=$temp_kerja[0]+2;
			$tgl_date_kerja=explode("-",$a);
			$tgl_cuti_gugur=$tgl_date_kerja[2];
			$thn=date('Y')+1;
			$tglvalid_kerja=$tgl_cuti_gugur."-".$tgl_date_kerja[1]."-".$thn;
			}
			else
			{
			function add_days($my_date,$numdays) {
			$date_t = strtotime($my_date.' UTC');
			return gmdate('Y-m-d',$date_t - ($numdays*86400));
				}
				$my_date = $row_hak_cuti['tgl_mulai_kerja'];
				$a=add_days($my_date,1);

			$thn=date("Y");
			$temp_kerja=explode("-",$row_hak_cuti['tgl_mulai_kerja']);
			$tgl_date_kerja=explode("-",$a);
			$tgl_cuti_gugur=$tgl_date_kerja[2];
			$thn_1=date('Y')+1;
			$tglvalid_kerja=$tgl_cuti_gugur."-".$tgl_date_kerja[1]."-".$thn_1;
			
			}
		
		
mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
		$update_dispensasi= mysql_query("UPDATE t_cuti SET jumlah_dispen ='$jumlah_dispensasi', jumlah_cuti= '$jumlah_cuti_akhir', alasan_dispen='$alasan_dispensasi', keterangan_dispen='ya' WHERE nomor_badge ='$no_budget' and tanggal_pengajuan='$tanggal'");

		 $sql_hak_cuti =("SELECT * FROM t_master_karyawan where nomor_badge ='$no_budget'");
	 $query_hak_cuti = mysql_query($sql_hak_cuti, $cn_db_cuti_karywan) or die(mysql_error());
	 $row_hak_cuti = mysql_fetch_array($query_hak_cuti);
echo "
<form action='dispen.php' method='post'>
	 <table width='400' border='0'>
        <tr>
          <td align='left' width='131'>Tanggal cuti </td>
          <td align='left' width='12'>:</td>
          <td align='left' width='180'>$c s/d $d</td>
        </tr>
        <tr>
          <td align='left'>Jumlah hari cuti </td>
          <td align='left'>:</td>
          <td align='left'>$e hari</td>
        </tr>
        <tr>
          <td align='left'>Tanggal pengajuan </td>
          <td align='left'>:</td>
          <td align='left'>$f</td>
        </tr>
        <tr>
		<td align='left'>
	   Keterangan 
	   </td>
	   <td align='left'>: </td>
	   <td align='left'>
	   Dapat Dispensasi
	   </td>
	  <tr>
	  <td align='left'>
	   jumlah_dispensasi
	   </td>
	   <td align='left'> : </td>
	   <td align='left'>$jumlah_dispensasi
	   </td>
	   <tr>
	   <td align='left'>
	   alasan_dispensasi 
	   </td>
	   <td>:</td>
	   <td align='left'>
	    $alasan_dispensasi
	   </td>
	   </tr>
	   
	   <tr>
	   <td align='left'>
	   Alamat Bisa dihubingi
	   </td>
	   <td align='left'>:</td>
	   <td align='left'><input type='text' name='alamat-cuti' value='$row_hak_cuti[alamat]'>
	   </td>
	   </tr>
	   <tr>
	   <td align='left'>
	   Tanggal cuti gugur
	   </td>
	   <td align='left'>:</td>
	   <td align='left'>
	   <input type='text' name='tgl_cuti_gugur' value='$tglvalid_kerja'>
	   </td>
	   </tr>
	   <tr>
	   <td align='center' colspan='3'><input type='submit' name='proses_akhir' value='Lanjut'>
	   </td>
	   </tr>
	   </table>
	   </form>
	 ";
}	 
?>
<?php

$proses_akhir=$_POST['proses_akhir'];
if ($proses_akhir)
{
$alamat=$_POST['alamat-cuti'];
$no_budget=$_SESSION['MM_nomor_budge'];
$c=$_SESSION['MM_tanggal_awal'];
$d=$_SESSION['MM_tanggal_akhir'];
$e=$_SESSION['MM_jumlah_cuti'];
$f=$_SESSION['MM_tanggal'];
$tanggal=date('Y-m-d');

	  $tgl_cuti_gugur=$_POST['tgl_cuti_gugur'];
	  
	  	$temp_kerja=explode("-",$tgl_cuti_gugur);
		$tglvalid_kerja=$temp_kerja[2]."-".$temp_kerja[1]."-".$temp_kerja[0];
		mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
		$update_hak_cuti= mysql_query("UPDATE t_cuti SET alamat_bisadihubungi ='$alamat', tanggal_cuti_gugur='$tglvalid_kerja' WHERE nomor_badge ='$no_budget' and tanggal_pengajuan='$tanggal'");


echo "

<table width='400' border='0'>
<tr>
	 <td align='center' colspan='3'>
	 <a href='cetak.php' target='_blank'><img src='picture/print.jpg' width='50' height='50' border='0' /></a>
	 </td>
	 </tr>
        <tr>
          <td align='left' width='131'>Tanggal cuti </td>
          <td align='left' width='12'>:</td>
          <td align='left' width='180'>$c s/d $d</td>
        </tr>
        <tr>
          <td align='left'>Jumlah hari cuti </td>
          <td align='left'>:</td>
          <td align='left'>$e hari</td>
        </tr>
        <tr>
          <td align='left'>Tanggal pengajuan </td>
          <td align='left'>:</td>
          <td align='left'>$f</td>
        </tr>
       <tr>
	   <td align='left'>
	   Alamat Bisa dihubingi
	   </td>
	   <td align='left'>:</td>
	   <td align='left'>$alamat
	   </td>
	   </tr>
	   <tr>
	   <td align='left'>
	   Tanggal cuti gugur
	   </td>
	   <td align='left'>:</td>
	   <td align='left'>
	   $tgl_cuti_gugur
	   </td>
	   </tr>
	   </table>
";
}
?>

      
      <p>&nbsp;</p></td></tr>
  <tr>
  	<td background="picture/bawah.jpg" height="39"></td>
  </tr>
<tr>
    <td><center><b><font size="1" face="Arial, Helvetica, sans-serif">Copyright@2018 Versi 2.0</font></b></center></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($rs_karyawan_cuti);
?>
