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
<table width="802" border="0" align="center" cellspacing="0">
  <tr>
    <td background="picture/header.png" height="219" width="800"><p>&nbsp;</p>
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
    <td height="34" align="center" valign="top" background="picture/tengah.jpg">
	<a href="cetak.php" target="_blank"><img src="picture/print.jpg" width="50" height="50" border="0" /></a><br />
	<?php
$lanjut=$_POST['lanjut'];
if ($lanjut)
{
	  $no_budget=$_SESSION['MM_nomor_budge'];
	  $periode_cuti=$_POST['periode'];
	  $jumlah_dispen=$_POST['jumlah_dispensasi'];
	  $alasan_dispen=$_POST['alasan_dispensasi'];
	 
	  $tanggal_awal=$_POST['tanggal_awal'];
	  $bulan_awal=$_POST['bulan_awal'];
	  $tahun_awal=$_POST['tahun_awal'];
	  $a=$tahun_awal."-".$bulan_awal."-".$tanggal_awal;
	  $tampil_tgl_awal=$tanggal_awal."-".$bulan_awal."-".$tahun_awal;
	  
	  $batasan=$_POST['batasan'];
	  $a=$batasan."-".;
	  $tampil_batasan=$batasan."-";
	  
	  $tanggal_akhir=$_POST['tanggal_akhir'];
	  $bulan_akhir=$_POST['bulan_akhir'];
	  $tahun_akhir=$_POST['tahun_akhir'];
	  $b=$tahun_akhir."-".$bulan_akhir."-".$tanggal_akhir;
	  $tampil_tgl_akhir=$tanggal_akhir."-".$bulan_akhir."-".$tahun_akhir;
	  $tanggal=date('Y-m-d');
	  $tampil_tanggal=date('d-m-Y');
	  $jumlah_cuti=$tanggal_akhir-$tanggal_awal+1;
	  $hak_cuti=12-$bulan_awal;
	  
$_SESSION['MM_tanggal_awal'] = $tampil_tgl_awal;
$_SESSION['MM_tanggal_akhir'] = $tampil_tgl_akhir;
$_SESSION['MM_jumlah_cuti'] = $jumlah_cuti;
$_SESSION['MM_tanggal'] = $tanggal;
$_SESSION['MM_hak_cuti'] = $hak_cuti;
$_SESSION['MM_periode'] = $periode_cuti;
$_SESSION['MM_jumlah_dispen'] = $jumlah_dispen;
$_SESSION['MM_alasan_dispen'] = $alasan_dispen;


mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
$update_dispensasi= mysql_query("UPDATE t_master_karyawan SET periode_cuti ='$periode_cuti', hak_cuti ='$hak_cuti' WHERE nomor_badge ='$no_budget'");
	  
		  mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
$query = "INSERT INTO t_cuti(nomor_badge,tanggal_awal,tanggal_akhir,jumlah_cuti,tanggal_pengajuan,jumlah_dispen,alasan_dispen,aprove) VALUES ('$no_budget','$a','$b','$jumlah_cuti','$tanggal','$jumlah_dispen','$alasan_dispen','belum')";
$hasil = mysql_query($query, $cn_db_cuti_karywan) or die(mysql_error());


echo "
<table width='500' border='0'>
        <tr>
          <td width='131'>Periode Cuti</td>
          <td width='12'>:</td>
          <td width='180'>$periode_cuti</td>
        </tr>
		<tr>
          <td width='131'>Tanggal cuti </td>
          <td width='12'>:</td>
          <td width='180'>$tampil_tgl_awal $batasan $tampil_tgl_akhir</td>
        </tr>
        <tr>
          <td>Jumlah hari cuti </td>
          <td>:</td>
          <td>$jumlah_cuti hari</td>
        </tr>
		 <tr>
          <td>Jumlah hak cuti</td>
          <td>:</td>
          <td>$hak_cuti kali (sisa)</td>
        </tr>
		 <tr>
          <td>Jumlah dispensasi</td>
          <td>:</td>
          <td>$jumlah_dispen</td>
        </tr>
		 <tr>
          <td>Alasan dispensasi</td>
          <td>:</td>
          <td>$alasan_dispen</td>
        </tr>
		<tr>
          <td>Tanggal Pengajuan</td>
          <td>:</td>
          <td>
            <input type='text' value='$tampil_tanggal' size='8' disabled='disabled'>
          </td>
        </tr>
		<form id='form1' name='form1' method='post' action='kirim_edit.php'>
		<tr>
          <td>Tanggal gugur cuti</td>
          <td>:</td>
          <td>
            <select name='tanggal_gugur'>
                     <option value='01' selected='selected'>01</option>
                      <option value='02'>02</option>
                      <option value='03'>03</option>
                      <option value='04'>04</option>
                      <option value='05'>05</option>
                      <option value='06'>06</option>
                      <option value='07'>07</option>
                      <option value='08'>08</option>
                      <option value='09'>09</option>
                      <option value='10'>10</option>
                      <option value='11'>11</option>
                      <option value='12'>12</option>
                      <option value='13'>13</option>
                      <option value='14'>14</option>
                      <option value='15'>15</option>
                      <option value='16'>16</option>
                      <option value='17'>17</option>
                      <option value='18'>18</option>
                      <option value='19'>19</option>
                      <option value='20'>20</option>
                      <option value='21'>21</option>
                      <option value='22'>22</option>
                      <option value='23'>23</option>
                      <option value='24'>24</option>
                      <option value='25'>25</option>
                      <option value='26'>26</option>
                      <option value='27'>27</option>
                      <option value='18'>28</option>
                      <option value='29'>29</option>
                      <option value='30'>30</option>
                      <option value='31'>31</option>
              </select> 
            
                    <select name='bulan_gugur'>
                             <option value='01' selected='selected'>Januari</option>
                              <option value='02'>Februari</option>
                              <option value='03'>Maret</option>
                              <option value='04'>April</option>
                              <option value='05'>Mei</option>
                              <option value='06'>Juni</option>
                              <option value='07'>Juli</option>
                              <option value='08'>Agustus</option>
                              <option value='09'>September</option>
                              <option value='10'>Oktober</option>
                              <option value='11'>November</option>
                              <option value='12'>Desember</option>
              </select> 
            
                    <select name='tahun_gugur'>
                             <option value='2009' selected='selected'>2009</option>
                              <option value='2010'>2010</option>
                              <option value='2011'>2011</option>
                              <option value='2012'>2012</option>
                              <option value='2013'>2013</option>
                              <option value='2014'>2014</option>
                              <option value='2015'>2015</option>
                              <option value='2016'>2016</option>
                              <option value='2017'>2017</option>
              </select> 
          </td>
        </tr>
		<tr>
          <td colspan='3' align='center'>
            <input type='submit' name='lanjut_hak' value='Lanjut' />
          </td>
        </tr>
		 </form>
      </table>
    ";
}
?>
 <?php 
 $no_budget=$_SESSION['MM_nomor_budge'];
 $b=$_SESSION['MM_periode'];
$c=$_SESSION['MM_tanggal_awal'];
$d=$_SESSION['MM_tanggal_akhir'];
$e=$_SESSION['MM_jumlah_cuti'];
$f=$_SESSION['MM_tanggal'];
$g=$_SESSION['MM_hak_cuti'];
$h=$_SESSION['MM_jumlah_dispen'];
$i=$_SESSION['MM_alasan_dispen'];
$tgl=$_POST['tanggal_gugur'];
$bln=$_POST['bulan_gugur'];
$thn=$_POST['tahun_gugur'];
$tanggal_gugur=$thn."-".$bln."-".$tgl;
$tampil_tanggal_gugur=$tgl."-".$bln."-".$thn;
$tampil_tanggal=date('d-m-Y');
$lanjut_hak=$_POST['lanjut_hak'];


mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
$update_gugur= mysql_query("UPDATE t_cuti SET tanggal_cuti_gugur ='$tanggal_gugur' WHERE nomor_badge ='$no_budget'");
	 if($lanjut_hak)
	 {
	 echo "
	 <table width='350' border='0'>
        <tr>
          <td width='131'>Periode Cuti</td>
          <td width='12'>:</td>
          <td width='180'>$b</td>
        </tr>
		<tr>
          <td width='131'>Tanggal cuti </td>
          <td width='12'>:</td>
          <td width='180'>$c s/d $d</td>
        </tr>
        <tr>
          <td>Jumlah hari cuti </td>
          <td>:</td>
          <td>$e hari</td>
        </tr>
		 <tr>
          <td>Jumlah hak cuti</td>
          <td>:</td>
          <td>$g kali (sisa)</td>
        </tr>
		 <tr>
          <td>Jumlah dispensasi</td>
          <td>:</td>
          <td>$h</td>
        </tr>
		 <tr>
          <td>Alasan dispensasi</td>
          <td>:</td>
          <td>$i</td>
        </tr>
		</tr>
		 <tr>
          <td>Tanggal Pengajuan</td>
          <td>:</td>
          <td>$tampil_tanggal</td>
        </tr>
		<tr>
          <td>Gugur cuti</td>
          <td>:</td>
          <td>$tampil_tanggal_gugur</td>
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
