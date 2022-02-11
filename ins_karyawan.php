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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO t_master_karyawan (nomor_badge, nama_karyawan, group_kerja, klasifikasi, dep_biro_bagian, alamat, tgl_mulai_kerja, periode_cuti, hak_cuti, keterangan_shift, bagian) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nomor_badge'], "text"),
                       GetSQLValueString($_POST['nama_karyawan'], "text"),
                       GetSQLValueString($_POST['group_kerja'], "text"),
                       GetSQLValueString($_POST['klasifikasi'], "text"),
                       GetSQLValueString($_POST['dep_biro_bagian'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['tgl_mulai_kerja'], "date"),
                       GetSQLValueString($_POST['periode_cuti'], "text"),
					   GetSQLValueString($_POST['hak_cuti'], "text"),
					   GetSQLValueString($_POST['keterangan_shift'], "text"),
					   GetSQLValueString($_POST['bagian'], "text"));

  mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
  $Result1 = mysql_query($insertSQL, $cn_db_cuti_karywan) or die(mysql_error());

  $insertGoTo = "daftar_karyawan.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
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
<?php include('menu_atas.php'); ?>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body bgcolor="#DBFBBC">
<script language="JavaScript1.2">mmLoadMenus();</script>
<table width="802" border="0" align="center" cellspacing="0">
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
    <td height="34" align="center" valign="top" background="picture/tengah.jpg">
	<?php 
if ($operator==admin)
{
?>
	  <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
<table width="366" border="0">
  <tr>
    <td colspan="3" align="center"><strong>INSERT DATA KARYAWAN </strong></td>
    </tr>
  <tr>
    <td align="left" width="166">Nomor badge </td>
    <td align="left" width="13">:</td>
    <td align="left" width="151">
      <input name="nomor_badge" type="text" id="nomor_badge" />    </td>
  </tr>
  <tr>
    <td align="left">Nama karyawan </td>
    <td align="left">:</td>
    <td align="left"><label>
      <input name="nama_karyawan" type="text" id="nama_karyawan" />
    </label></td>
  </tr>
  <tr>
    <td align="left">Group kerja </td>
    <td align="left">:</td>
    <td align="left"><label>
    <input name="group_kerja" type="text" id="group_kerja" />
    </label></td>
  </tr>
  <tr>
    <td align="left">Klasifikasi</td>
    <td align="left">:</td>
    <td align="left"><label>
    <input name="klasifikasi" type="text" id="klasifikasi" />
    </label></td>
  </tr>
  <tr>
    <td align="left">Dep. biro</td>
    <td align="left">:</td>
    <td align="left"><label>
    <input name="dep_biro_bagian" type="text" id="dep_biro_bagian" /><input name="hak_cuti" type="hidden" id="dep_biro_bagian" value="12" />
    </label></td>
  </tr>
  <tr>
    <td align="left">Bagian</td>
    <td align="left">:</td>
    <td align="left"><label>
    <input name="bagian" type="text" id="bagian" />
    </label></td>
  </tr>
  <tr>
    <td align="left">Alamat</td>
    <td align="left">:</td>
    <td align="left"><label>
    <textarea name="alamat" id="alamat"></textarea>
    </label></td>
  </tr>
  <tr>
    <td align="left">Tanggal mulai kerja </td>
    <td align="left">:</td>
    <td align="left"><label>
    <input name="tgl_mulai_kerja" type="text" id="tgl_mulai_kerja" value="<?php echo date('Y-m-d')?>" />
    </label></td>
  </tr>
  <tr>
    <td align="left">Periode cuti </td>
    <td align="left">:</td>
    <td align="left"><label>
    <select name="periode_cuti" id="periode_cuti">
      
      <option value="2013/2014">2013/2014</option>
	  <option value="2014/2015">2014/2015</option>
	  <option value="2015/2016">2015/2016</option>
	  <option value="2016/2017">2016/2017</option>
	  <option value="2017/2018">2017/2018</option>
	  <option value="2018/2019">2018/2019</option>
	  <option value="2019/2020">2019/2020</option>
	  <option value="2020/2021">2020/2021</option>
	  <option value="2021/2022">2021/2022</option>
	  <option value="2022/2023">2022/2023</option>
	  <option value="2023/2024">2023/2024</option>
	  <option value="2024/2025">2024/2025</option>
	  <option value="2025/2026">2025/2026</option>
    </select>
    </label></td>
  </tr>
  <tr>
    <td align="left">Keterangan shift </td>
    <td align="left">:</td>
    <td align="left"><label>
      <select name="keterangan_shift" id="keterangan_shift">
        <option value="Shift">Shift</option>
        <option value="Non Shift">Non Shift</option>
      </select>
    </label></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><label>
      <input type="submit" name="Submit" value="Simpan" />
    </label></td>
    </tr>
</table>
<input type="hidden" name="MM_insert" value="form1">
</p>
            </form>
			
	 <?php }
		else
			{
		echo "<center><blink><b><font color='red' size='4'>Maaf halaman ini tidak bisa anda akses</font></b></blink></center>";
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
