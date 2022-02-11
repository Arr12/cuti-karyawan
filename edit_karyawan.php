<?php require_once('Connections/cn_db_cuti_karywan.php'); ?><?php
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
mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
$query_rs_karyawan = "SELECT * FROM t_master_karyawan where nomor_badge='$nomor_badge'";
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
<table width="802" border="0" align="center" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
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
   <strong>EDIT KARYAWAN <br />
   </strong>
   <form id="form1" name="form1" method="post" action="">
     <table width="370" border="0">
       <tr>
         <td width="157">No Badge </td>
         <td width="17">:</td>
         <td width="174"><label>
           <input type="text" name="nomor_badge" value="<?php echo $row_rs_karyawan['nomor_badge'];?>"/>
         </label></td>
       </tr>
       <tr>
         <td>Nama Karyawan </td>
         <td>:</td>
         <td><label>
         <input type="text" name="nama_karyawan" value="<?php echo $row_rs_karyawan['nama_karyawan'];?>"/>
         </label></td>
       </tr>
       <tr>
         <td>Group Kerja </td>
         <td>:</td>
         <td><label>
         <input type="text" name="group_kerja" value="<?php echo $row_rs_karyawan['group_kerja'];?>"/>
         </label></td>
       </tr>
       <tr>
         <td>Klasifikasi</td>
         <td>:</td>
         <td><label>
         <input type="text" name="klasifikasi" value="<?php echo $row_rs_karyawan['klasifikasi'];?>"/>
         </label></td>
       </tr>
       <tr>
         <td>Dep. Biro Bagian </td>
         <td>:</td>
         <td><label>
         <input type="text" name="dep_biro_bagian" value="<?php echo $row_rs_karyawan['dep_biro_bagian'];?>"/>
         </label></td>
       </tr>
       <tr>
         <td>Alamat</td>
         <td>:</td>
         <td><label>
         <input type="text" name="alamat" value="<?php echo $row_rs_karyawan['alamat'];?>"/>
         </label></td>
       </tr>
       <tr>
         <td>Tanggal Mulai Kerja </td>
         <td>:</td>
         <td><label>
         <input type="text" name="tgl" value="<?php echo $row_rs_karyawan['tgl_mulai_kerja'];?>"/>
         </label></td>
       </tr>
       <tr>
         <td>Periode Cuti </td>
         <td>:</td>
         <td><label>
         <input type="text" name="periode_cuti" value="<?php echo $row_rs_karyawan['periode_cuti'];?>"/>
         </label></td>
       </tr>
       <tr>
         <td>Hak Cuti </td>
         <td>:</td>
         <td><label>
         <input type="text" name="hak_cuti" value="<?php echo $row_rs_karyawan['hak_cuti'];?>"/>
         </label></td>
       </tr>
       <tr>
         <td>Keteranagan Shift </td>
         <td>:</td>
         <td><label>
         <input type="text" name="keterangan_shift" value="<?php echo $row_rs_karyawan['keterangan_shift'];?>"/>
         </label></td>
       </tr>
       <tr>
         <td colspan="3"><label>
           <div align="center">
             <input type="submit" name="submit" value="Update" />
             </div>
         </label></td>
         </tr>
     </table>
      </form>
	  <?php 
$submit=$_POST['submit'];
if ($submit)
	{
$nomor_badge=$_POST['nomor_badge'];
$nama_karyawan=$_POST['nama_karyawan'];
$group_kerja=$_POST['group_kerja'];
$klasifikasi=$_POST['klasifikasi'];
$dep_biro_bagian=$_POST['dep_biro_bagian'];
$alamat=$_POST['alamat'];
$tgl_ganti=$_POST['tgl'];
$periode_cuti=$_POST['periode_cuti'];
$hak_cuti=$_POST['hak_cuti'];
$keterangan_shift=$_POST['keterangan_shift'];

		mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
		$update_pass= mysql_query("UPDATE t_master_karyawan SET nama_karyawan='$nama_karyawan', group_kerja='$group_kerja', klasifikasi='$klasifikasi', dep_biro_bagian='$dep_biro_bagian', alamat='$alamat', tgl_mulai_kerja='$tgl_ganti', periode_cuti='$periode_cuti', hak_cuti='$hak_cuti', keterangan_shift='$keterangan_shift' WHERE nomor_badge ='$nomor_badge'");
		echo "<blink><font color='red'>Update data karyawan sukses</font></blink>";
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
		
<tr>
    <td><center><b><font size="1" face="Arial, Helvetica, sans-serif">Copyright@2018 Versi 2.0</font></b></center></td>
  </tr>
</table>

</body>
</html>

