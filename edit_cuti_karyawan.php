<?php require_once('Connections/cn_db_cuti_karywan.php'); ?><?php
//$tgl=date('Y-m-d');
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

mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
$query_rs_karyawan = "SELECT * FROM v_cuti_karyawan ORDER BY nama_karyawan ASC";
$rs_karyawan = mysql_query($query_rs_karyawan, $cn_db_cuti_karywan) or die(mysql_error());
$totalRows_rs_karyawan = mysql_num_rows($rs_karyawan);
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
<script language="JavaScript">
    // konfirmasi menghapus record tertentu
    function konfirmasi(id)
    {
        tanya = confirm('Anda yakin ingin menghapus data cuti dengan nama '+ id + '?');
        if (tanya == true)
            return true;
        else
            return false;
    }
 </script>
 <?php
    $to=$_GET['to']; 
	$no_badge=$_GET['no_badge'];
	$tanggal_pengajuan=$_GET['tanggal_pengajuan'];
	if ($to == delete)
	{
	mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
  	$deleteSQL = "DELETE FROM t_cuti WHERE nomor_badge= '$no_badge' and tanggal_pengajuan='$tanggal_pengajuan'";
	$Result1 = mysql_query($deleteSQL, $cn_db_cuti_karywan) or die(mysql_error());
?>
<meta http-equiv="refresh" content="0;url=edit_cuti_karyawan.php" /> 
<?php }?>
<?php include('menu_atas.php'); ?>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body bgcolor="#DBFBBC">
<script language="JavaScript1.2">mmLoadMenus();</script>
<table width="1000" border="0" align="center" cellspacing="0">
  <tr>
    <td background="picture/jgg99.png" height="219" width="800"><p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
 <tr>
    <td height="60" background="picture/2.png">
		<table width="758" height="39" align="center">
		  <tr><td width="416"><img src="picture/menu.png" name="image1" width="280" height="26" border="0" usemap="#Map" id="image1" /></td>
			   <td width="330" align="left"><font color="#FF0000">Operator : <?php echo $operator;?></font></td>
      </tr></table>
	</td>
  </tr>
<tr>
  	<td background="picture/4.png" height="42"></td>
  </tr>
<tr>
    <td height="34" align="center" valign="top" background="picture/3.png">
	<?php 
if ($operator==admin)
{
?>
   <strong>DAFTAR CUTI HARIAN KARYAWAN <br />
<?php echo date('d-m-Y');?><br /></strong><br />

<form name="form1" method="get" action="">
    <table width="484" border="0">
      <tr> 
        <td width="250">&nbsp;</td>
        <td width="148"><label for="tcari"></label>
        <input type="text" name="tcari" id="tcari"></td>
        <td width="39"><input type="submit" name="button" id="button" value="Cari"></td>
      </tr>
	  


    <table width="750" border="0">
      <tr bgcolor="#6CA034">
	   	<td width="20" align="center"><font color="#FFFF00" size="2"><strong>NO</strong></font></td>
        <td width="70" align="center"><font color="#FFFF00" size="2"><strong>NOMOR BUDGE </strong></font></td>
        <td width="200" align="center"><font color="#FFFF00" size="2"><strong>NAMA KARYAWAN </strong></font></td>
		<td width="50" align="center"><font color="#FFFF00" size="2"><strong>TANGGAL PENGAJUAN </strong></font></td>
        <td width="70" align="center"><font color="#FFFF00" size="2"><strong>TAGGAL AWAL </strong></font></td>
        <td width="70" align="center"><font color="#FFFF00" size="2"><strong>TANGGAL AKHIR </strong></font></td>
        <td width="30" align="center"><font color="#FFFF00" size="2"><strong>JML CUTI </strong></font></td>
        <td width="50" align="center"><font color="#FFFF00" size="2"><strong>JUMLAH DISPEN </strong></font></td>
        <td align="center"><font color="#FFFF00" size="2"><strong>ALASAN DISPEN </strong></font></td>
		<td align="center"><font color="#FFFF00" size="2"><strong>UPDATE</strong></font></td>
        </tr>
		
		<?php 
if(isset($_GET['tcari'])){
	$cari = $_GET['tcari'];
	echo "<b>Hasil pencarian : ".$cari."</b>";
}
?>
		
		<?php 
	if(isset($_GET['tcari'])){
		$cari = $_GET['tcari'];
		$data = mysql_query("select * from v_cuti_karyawan where nomor_badge like '%".$cari."%' or nama_karyawan like '%".$cari."%' or tanggal_awal like '%".$cari."%' or tanggal_pengajuan like '%".$cari."%'");				
	}else{
		$data = mysql_query("SELECT * FROM v_cuti_karyawan ORDER BY nama_karyawan ASC");		
	}
	$no = 0;
	while($row_rs_karyawan = mysql_fetch_array($data)){
	?>
	
	<?php
				  $temp=explode("-",$row_rs_karyawan['tgl_mulai_kerja']);
				 $tglvalid=$temp[2]."-".$temp[1]."-".$temp[0];
				 $no++;
					 if ($no % 2 == 0) 
				{
					$warna = "#CCFF33";
				}
				else 
				{
				$warna = "#CCFF99";
				}
		  ?>
	
	      <tr bgcolor='<?php echo $warna; ?>' class="isilist" onMouseOver="bgr_color(this, '#FFCC00')" onMouseOut="bgr_color(this, '')">
	  	<td align='center'><?php echo $no; ?></td>
        <td><?php echo $row_rs_karyawan['nomor_badge']; ?></td>
        <td><?php echo $row_rs_karyawan['nama_karyawan']; ?></td>
		<td><?php echo $row_rs_karyawan['tanggal_pengajuan']; ?></td>
        <td><?php echo $row_rs_karyawan['tanggal_awal']; ?></td>
        <td><?php echo $row_rs_karyawan['tanggal_akhir']; ?></td>
        <td align='center'><?php echo $row_rs_karyawan['jumlah_cuti']; ?></td>
        <td><?php echo $row_rs_karyawan['jumlah_dispen']; ?></td>
        <td><?php echo $row_rs_karyawan['alasan_dispen']; ?></td>
		<td><?php echo "<a href='edit_cuti_karyawan2.php?no_badge=$row_rs_karyawan[nomor_badge]&tanggal_pengajuan=$row_rs_karyawan[tanggal_pengajuan]'>[Edit]</a>&nbsp;&nbsp;<a href='delete_cuti_karyawan2.php?no_badge=$row_rs_karyawan[nomor_badge]&tanggal_pengajuan=$row_rs_karyawan[tanggal_pengajuan]'>[Delete]</a>"; ?>
		</td>
        </tr>
	<?php } ?>

		
<?php 
	  function kd_status($status)
{
	switch($status){
	case ya;
	  $status = 'Setuju';
	break;
	case tidak;
	 $status = 'tidak disetujui';
	break;
	}
	return $status;
}
 

$no=0;
?>

<?php while ($row_rs_karyawan = mysql_fetch_assoc($rs_karyawan)) 
		  { 
		  $no++;
			 if ($no % 2 == 0) 
	{
		$warna = "#CCFF33";
	}
	else 
	{
		$warna = "#CCFF99";
	}

?>

		 <?php } ?>
    </table> 
	<?php }
		else
			{
		echo "<center><blink><b><font color='red' size='4'>Maaf halaman ini tidak bisa anda akses</font></b></blink></center>";
			}
	  ?>

    <p>&nbsp;</p></td>
  </tr>
	<br />
 <tr>
  	<td background="picture/bawah.png" height="39"></td>
  </tr>       
</table>
<center><b><font size="1" face="Arial, Helvetica, sans-serif">Copyright@2018 Versi 2.0</font></b></center>
</body>
</html>
<?php
mysql_free_result($rs_karyawan);
?>
