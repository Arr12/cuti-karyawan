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
?>
<?php
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
			<form id="form1" name="form1" method="post" action="cuti_bersama.php">
			  <p>&nbsp;</p>
			  <table width="700" border="0">
				<tr>
				  <td align='left' width="70"><strong>PILIH STATUS</strong> </td>
				  <td align="left" width="7">:</td>
				  <td align='left' width="180"><select name="shift">
                    <option value="shift">Shift</option>
                    <option value="non shift">Non Shift</option>
                  </select></td>
				 </tr>
			   </table>
			   <table width="700" border="0">
				 <tr>
				  <td align="left" width="121"><strong>TANGGAL CUTI</strong> </td>
				  <td align="left" width="7">:</td>
				  <td align="left" width="569">Dari tgl 
					<select name="tanggal_awal">
                     <option value="01" selected="selected">01</option>
                      <option value="02">02</option>
                      <option value="03">03</option>
                      <option value="04">04</option>
                      <option value="05">05</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09">09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                      <option value="24">24</option>
                      <option value="25">25</option>
                      <option value="26">26</option>
                      <option value="27">27</option>
                      <option value="28">28</option>
                      <option value="29">29</option>
                      <option value="30">30</option>
                      <option value="31">31</option>
					</select> 
                    <select name="bulan_awal">
                             <option value="01" selected="selected">Januari</option>
                              <option value="02">Februari</option>
                              <option value="03">Maret</option>
                              <option value="04">April</option>
                              <option value="05">Mei</option>
                              <option value="06">Juni</option>
                              <option value="07">Juli</option>
                              <option value="08">Agustus</option>
                              <option value="09">September</option>
                              <option value="10">Oktober</option>
                              <option value="11">November</option>
                              <option value="12">Desember</option>
					 </select> 
                     <select name="tahun_awal">
                             <option value="2018" selected="selected">2018</option>
                              <option value="2019">2019</option>
                              <option value="2020">2020</option>
                              <option value="2021">2021</option>
                              <option value="2022">2022</option>
                              <option value="2023">2023</option>
                              <option value="2024">2024</option>
                              <option value="2025">2025</option>
                              <option value="2026">2026</option>
							  <option value="2027">2027</option>
					          <option value="2028">2028</option>
							  <option value="2029">2029</option>

					 </select> 
			          s/d tgl   
					 <select name="tanggal_akhir">
                   <option value="01" selected="selected">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
				</select> 
              
                  <select name="bulan_akhir">
                          <option value="01" selected="selected">Januari</option>
                          <option value="02">Februari</option>
                          <option value="03">Maret</option>
                          <option value="04">April</option>
                          <option value="05">Mei</option>
                          <option value="06">Juni</option>
                          <option value="07">Juli</option>
                          <option value="08">Agustus</option>
                          <option value="09">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>
              </select> 
              
                  <select name="tahun_akhir">
                         <option value="2009" selected="selected">2009</option>
                          <option value="2010">2010</option>
                          <option value="2011">2011</option>
                          <option value="2012">2012</option>
                          <option value="2013">2013</option>
                          <option value="2014">2014</option>
                          <option value="2015">2015</option>
                          <option value="2016">2016</option>
                          <option value="2017">2017</option>
						  <option value="2018">2018</option>
					      <option value="2019">2019</option>
						  <option value="2020">2020</option>
              </select> 
            </td>
        </tr>
		</table>
		<table width="700" border="0">
				<tr>
				  <td align='left' width="50"><strong>JUMLAH CUTI </strong>
				  <td align="left" width="7">:</td>
				  <td align='left' width="180">
				    <input name="jml" type="text" size="3" />
				  <input type="submit" name="Submit" value="Kirim" />
				  </td>
				</tr>
		</table>
			  <p>&nbsp;</p>
			</form>
		<?php 
		$shift=$_POST['shift'];
		$jml=$_POST['jml'];
		$tanggal_awal=$_POST['tanggal_awal'];
		$tanggal_akhir=$_POST['tanggal_akhir'];
		$bulan_awal=$_POST['bulan_awal'];
		$bulan_akhir=$_POST['bulan_akhir'];
		$tahun_awal=$_POST['tahun_awal'];
		$tahun_akhir=$_POST['tahun_akhir'];
		$submit=$_POST['Submit'];
		$tgl_awal=$tahun_awal.'-'.$bulan_awal.'-'.$tanggal_awal;
		$tgl_akhir=$tahun_akhir.'-'.$bulan_akhir.'-'.$tanggal_akhir;
		$tgl_sekarang=date('Y-m-d');
		if ($submit)
		{
			mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
			$query_rs_karyawan = "SELECT * FROM t_master_karyawan where keterangan_shift='$shift' ORDER BY nama_karyawan ASC";
			$rs_karyawan = mysql_query($query_rs_karyawan, $cn_db_cuti_karywan) or die(mysql_error());
			while ($row_rs_karyawan = mysql_fetch_assoc($rs_karyawan))
			{
			$hak=$row_rs_karyawan['hak_cuti'];
			$hak_update=$hak-$jml;
			$nmr=$row_rs_karyawan['nomor_badge'];
			mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
			/*
	 		$update_hak_cuti= mysql_query("UPDATE t_master_karyawan SET hak_cuti ='$hak_update' WHERE nomor_badge ='$nmr'");
			*/
			$ins_cuti_bersama = "INSERT INTO t_cuti(nomor_badge,tanggal_awal,tanggal_akhir,jumlah_cuti,tanggal_pengajuan) VALUES ('$nmr','$tgl_awal','$tgl_akhir','$jml','$tgl_sekarang')";
			$hasil_cuti_bersama = mysql_query($ins_cuti_bersama, $cn_db_cuti_karywan) or die(mysql_error());
			
			}
			echo "<center><blink><font color='red' size='3'>Proses cuti bersama sukses</font></blink></center>";
		}
		}
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