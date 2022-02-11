<?php require_once('Connections/cn_db_cuti_karywan.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
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
$nom=$_GET['nomor_badge'];
$ket=$_GET['ket'];
mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
$update_aprove= mysql_query("UPDATE t_cuti SET aprove = '$ket' WHERE nomor_badge ='$nom'");


mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
$query_rs_cuti_karyawan = "SELECT * FROM t_cuti where aprove ='belum' ORDER BY tanggal_pengajuan ASC";
$rs_cuti_karyawan = mysql_query($query_rs_cuti_karyawan, $cn_db_cuti_karywan) or die(mysql_error());
$row_rs_cuti_karyawan = mysql_fetch_assoc($rs_cuti_karyawan);
$totalRows_rs_cuti_karyawan = mysql_num_rows($rs_cuti_karyawan);


?>
<?php

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
<script type="text/javascript">
<!--
function bgr_color(obj, color) {
    obj.style.backgroundColor=color
}
//-->
</script>
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
    <td background="picture/header.jpg" height="219" width="800"></td>
  </tr>
 <tr>
    <td height="49" background="picture/menu_atas.jpg">
		<table width="758" height="39" align="center">
		  <tr><td><img src="picture/menu.jpg" name="image1" width="280" height="26" border="0" usemap="#Map" id="image1" /></td>
			   <td align="right">Operator : <?php echo $operator;?></td>
      </tr></table>
	</td>
  </tr>
<tr>
  	<td background="picture/atas.jpg" height="42"></td>
  </tr>
<tr>
    <td height="34" align="center" valign="top" background="picture/tengah.jpg">
   <strong>DAFTAR CUTI HARIAN KARYAWAN <br />
   <?php echo date('d-m-Y');?><br /></strong><br />
   <?php 
   if ($operator=='direksi')
   {
   ?>
    <table width="750" border="1">
      <tr bgcolor="#6CA034">
        <td width="70" align="center"><font color="#FFFF00" size="2"><strong>NOMOR BUDGE </strong></font></td>
        <td width="100" align="center"><font color="#FFFF00" size="2"><strong>NAMA KARYAWAN </strong></font></td>
        <td width="70" align="center"><font color="#FFFF00" size="2"><strong>TAGGAL AWAL </strong></font></td>
        <td width="70" align="center"><font color="#FFFF00" size="2"><strong>TANGGAL AKHIR </strong></font></td>
        <td width="50" align="center"><font color="#FFFF00" size="2"><strong>JUMLAH CUTI </strong></font></td>
        <td width="70" align="center"><font color="#FFFF00" size="2"><strong>TANGGAL PENGAJUAN </strong></font></td>
        <td width="50" align="center"><font color="#FFFF00" size="2"><strong>JUMLAH DISPEN </strong></font></td>
        <td align="center"><font color="#FFFF00" size="2"><strong>ALASAN DISPEN </strong></font></td>
        <td align="center"><font color="#FFFF00" size="2"><strong>APROVE</strong></font></td>
      </tr>
      <?php 
	  	  
	  do { 
		  
	  ?>
        <tr class="isilist" onMouseOver="bgr_color(this, '#FFCC00')" onMouseOut="bgr_color(this, '#AFEF63')">
            <td><?php echo $row_rs_cuti_karyawan['nomor_badge']; ?></td>
          <td><?php echo $row_rs_nomor['nama_karyawan']; ?></td>
          <td><?php echo $row_rs_cuti_karyawan['tanggal_awal']; ?></td>
          <td><?php echo $row_rs_cuti_karyawan['tanggal_akhir']; ?></td>
          <td align='center'><?php echo $row_rs_cuti_karyawan['jumlah_cuti']; ?></td>
          <td><?php echo $row_rs_cuti_karyawan['tanggal_pengajuan']; ?></td>
          <td><?php echo $row_rs_cuti_karyawan['jumlah_dispen']; ?></td>
          <td><?php echo $row_rs_cuti_karyawan['alasan_dispen']; ?></td>
          <td align='center'><?php echo "<a href='aprove.php?ket=ya&nomor_badge=$row_rs_cuti_karyawan[nomor_badge]'>"; ?>[Ya]</a>&nbsp;<?php echo "<a href='aprove.php?ket=tidak&nomor_badge=$row_rs_cuti_karyawan[nomor_badge]'>"; ?>[Tidak]</a></td>
        </tr>
        <?php } while ($row_rs_cuti_karyawan = mysql_fetch_assoc($rs_cuti_karyawan)); ?>
    </table> 
	<?php 
   }
	  else
	  {
		  echo "<blink><font color='red'>Maaf Anda tidak mempunyai hak di halaman ini</font></blink>";
	  }
	 ?>
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
<?php
mysql_free_result($rs_cuti_karyawan);
?>