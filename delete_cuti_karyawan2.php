<?php require_once('Connections/cn_db_cuti_karywan.php'); ?>

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
<table width="802" border="0" align="center" cellspacing="0">
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
    <td height="34" align="center" valign="top" background="picture/tengah.jpg"><p>&nbsp;</p>
	<?php
$no_badge=$_GET['no_badge'];
$tanggal_pengajuan=$_GET['tanggal_pengajuan'];

?>
<form action="delete_cuti_karyawan2.php" method="post">
<input type='hidden' name="no_badge" value="<?php echo $no_badge; ?>">
<input type='hidden' name="tgl" value="<?php echo $tanggal_pengajuan; ?>">
<input type='submit' name="tombol" value="Benarkah anda mau menghapus data cuti dengan nomor badge=<?php echo $no_badge;?>">
</form>
<?php
	$no_badge=$_POST['no_badge'];
	$tanggal_pengajuan1=$_POST['tgl'];
	$tombol=$_POST['tombol'];
	
	if ($tombol)
	{
		
	mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
  	$deleteSQL = "DELETE FROM t_cuti WHERE nomor_badge= '$no_badge' and tanggal_pengajuan='$tanggal_pengajuan1'";
	$Result1 = mysql_query($deleteSQL, $cn_db_cuti_karywan) or die(mysql_error());
/*
  $deleteGoTo = "edit_cuti_karyawan.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
  */
}
?>
    </td>
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

