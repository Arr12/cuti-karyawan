<?php require_once('Connections/cn_db_cuti_karywan.php'); ?><?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
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
$nomor_badge=$_GET['no_badge'];
//$tanggal_pengajuan=$_GET['tanggal_pengajuan'];
mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
//$query_rs_karyawan = "SELECT * FROM t_cuti where nomor_badge='$nomor_badge' and tanggal_pengajuan = '$tanggal_pengajuan'";
$query_rs_karyawan = "SELECT * FROM t_cuti where nomor_badge='$nomor_badge'";
$rs_karyawan = mysql_query($query_rs_karyawan, $cn_db_cuti_karywan) or die(mysql_error());
$row_rs_karyawan = mysql_fetch_assoc($rs_karyawan);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include('title.php');?></title>
<?php include('menu_atas.php'); ?>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body bgcolor="#DBFBBC">
<script language="JavaScript1.2">mmLoadMenus();</script>
<table width="802" border="0" align="center" cellspacing="0" 
  <tr>
    <td background="picture/jheader.png" height="219" width="800"><p>&nbsp;</p>
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
   <strong>EDIT CUTI KARYAWAN <br />
   </strong>
   <form id="form1" name="form1" method="post" action="">
     <table width="370" border="0">
       <tr>
         <td align='left' width="157">No Badge </td>
         <td width="17">:</td>
         <td width="174"><label>
           <input type="text" name="nomor_badge" value="<?php echo $row_rs_karyawan['nomor_badge'];?>"/>
         </label></td>
       </tr>
       <tr>
         <td align='left'>Tanggal Awal </td>
         <td>:</td>
         <td><label>
         <input type="text" name="tanggal_awal" value="<?php echo $row_rs_karyawan['tanggal_awal'];?>"/>
         </label></td>
       </tr>
       <tr>
         <td align='left'>Tanggal Akhir </td>
         <td>:</td>
         <td><label>
         <input type="text" name="tanggal_akhir" value="<?php echo $row_rs_karyawan['tanggal_akhir'];?>"/>
         </label></td>
       </tr>
       <tr>
         <td align='left'>Jumlah Cuti </td>
         <td>:</td>
         <td><label>
         <input type="text" name="jumlah_cuti" value="<?php echo $row_rs_karyawan['jumlah_cuti'];?>"/>
         </label></td>
       </tr>
       <!--tr>
         <td align='left'>Tanggal Pengajuan </td>
         <td>:</td>
         <td><label>
         <input type="text" name="tanggal_pengajuan" value="<?php echo $row_rs_karyawan['tanggal_pengajuan'];?>"/>
         </label></td>
       </tr-->
       <tr>
         <td align='left'>Jumlah Dispen </td>
         <td>:</td>
         <td><label>
         <input type="text" name="jumlah_dispen" value="<?php echo $row_rs_karyawan['jumlah_dispen'];?>"/>
         </label></td>
       </tr>
       <tr>
         <td align='left'>Alasan Dispen </td>
         <td>:</td>
         <td><label>
         <input type="text" name="alasan_dispen" value="<?php echo $row_rs_karyawan['alasan_dispen'];?>"/>
         </label></td>
       </tr>
       <tr>
         <td align='left'>Tanggal Cuti Gugur </td>
         <td>:</td>
         <td><label>
         <input type="text" name="tanggal_cuti_gugur" value="<?php echo $row_rs_karyawan['tanggal_cuti_gugur'];?>"/>
         </label></td>
       </tr>
       <tr>
         <td align='left'>Alamat</td>
         <td>:</td>
         <td><label>
         <input type="text" name="alamat_bisadihubungi" value="<?php echo $row_rs_karyawan['alamat_bisadihubungi'];?>"/>
         </label></td>
       </tr>
       <tr>
         <td colspan="3"><div align="center"><input type="submit" name="submit" value="Update" />
             </div>
         </label></td>
         </tr>
     </table>
      </form>
	  <?php 
$submit=$_POST['submit'];
if ($submit)
	{
//$tgl_sekarang=date('Y-m-d');
$nomor_badge=$_POST['nomor_badge'];
$tanggal_awal=$_POST['tanggal_awal'];
$tanggal_akhir=$_POST['tanggal_akhir'];
$jumlah_cuti=$_POST['jumlah_cuti'];
//$tanggal_pengajuan=$_POST['tanggal_pengajuan'];
$jumlah_dispen=$_POST['jumlah_dispen'];
$alasan_dispen=$_POST['alasan_dispen'];
$tanggal_cuti_gugur=$_POST['tanggal_cuti_gugur'];
$alamat_bisadihubungi=$_POST['alamat_bisadihubungi'];


		mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
		//$update_pass= mysql_query("UPDATE t_cuti SET tanggal_awal='$tanggal_awal', tanggal_akhir='$tanggal_akhir', jumlah_cuti='$jumlah_cuti', tanggal_pengajuan='$tanggal_pengajuan', jumlah_dispen='$jumlah_dispen', alasan_dispen='$alasan_dispen', tanggal_cuti_gugur='$tanggal_cuti_gugur', alamat_bisadihubungi='$alamat_bisadihubungi' WHERE nomor_badge ='$nomor_badge' and tanggal_pengajuan='$tgl_sekarang'");
		$update_pass= mysql_query("UPDATE t_cuti SET tanggal_awal='$tanggal_awal', tanggal_akhir='$tanggal_akhir', jumlah_cuti='$jumlah_cuti', jumlah_dispen='$jumlah_dispen', alasan_dispen='$alasan_dispen', tanggal_cuti_gugur='$tanggal_cuti_gugur', alamat_bisadihubungi='$alamat_bisadihubungi' WHERE nomor_badge ='$nomor_badge'");
		echo "<blink><font color='red'>Update data cuti karyawan sukses</font></blink>";
		
	}
?>
   <strong><br />
   </strong>
   <p>&nbsp;</p></td>
  </tr>
	<br />
 <tr>
  	<td background="picture/bawah.jpg" height="39"></td>
  </tr>       

</table>
<center><b><font size="1" face="Arial, Helvetica, sans-serif">Copyright@2018 Versi 2.0</font></b></center>
</body>
</html>

