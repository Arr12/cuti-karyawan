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
if ($operator==admin)
{
	$no_budget=$_SESSION['MM_nomor_budge'];
	mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
	$query_rs_cuti_karyawan = "SELECT * FROM t_master_karyawan WHERE nomor_badge = '$no_budget'";
	$rs_cuti_karyawan = mysql_query($query_rs_cuti_karyawan, $cn_db_cuti_karywan) or die(mysql_error());
	$row_rs_cuti_karyawan = mysql_fetch_assoc($rs_cuti_karyawan);
	
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
	$tgl_kerja=$row_rs_cuti_karyawan['tgl_mulai_kerja'];
	$tgl=date('Y-m-d');
	$a = datediff("$tgl_kerja", "$tgl"); 
	$lama_kerja=$a[years]; 
	  
	if ($lama_kerja>=1)
		{
		mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
		$query_rs_karyawan = sprintf("SELECT * FROM t_master_karyawan WHERE nomor_badge = '$no_budget'");
		$rs_karyawan = mysql_query($query_rs_karyawan, $cn_db_cuti_karywan) or die(mysql_error());
		$row_rs_karyawan = mysql_fetch_assoc($rs_karyawan);
		
		mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
		$query_rs_cuti = sprintf("SELECT * FROM t_cuti WHERE nomor_badge = '$no_budget' and jumlah_cuti !='0'");
		$rs_cuti = mysql_query($query_rs_cuti, $cn_db_cuti_karywan) or die(mysql_error());
		
		while ($data = mysql_fetch_assoc($rs_cuti))
			{ 
			
			$jumlah_cuti=$data['jumlah_cuti'];
			$totalcuti[]=$jumlah_cuti;
			$totalsekarang = array_sum($totalcuti);
			
			}
			$sisa_cuti=$row_rs_karyawan['hak_cuti']-$totalsekarang;
				
			if ($sisa_cuti>0)
				{
?>
	<form id="form1" name="form1" method="post" action="dispen.php">
	<input type="hidden" name="sisa" value="<?php echo $sisa_cuti;?>">
      <table width="694" border="0">
        <tr>
          <td height="35" colspan="3" align="center" valign="top"><strong>PROSES CUTI </strong></td>
        </tr>
        <tr>
          <td align="left" width="121">Tanggal cuti </td>
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
            </td>
        </tr>
        <tr>
          <td align="left">Jumlah hari cuti </td>
          <td align="left">:</td>
          <td align="left">
            <input name="jumlah_cuti" type="text" size="3" />
            hari
          </td>
        </tr>
		 <tr>
          <td align="left">Tanggal Pengajuan</td>
          <td>:</td>
          <td align="left">
            <input name="tanggal" type="text" size="8" value="<?php echo date('d-m-Y');?>" disabled="disabled"/>
            hari
          </td>
        </tr>
		</tr>
	
        <tr>
          <td colspan="3" align="center">
            <input type="submit" name="lanjut" value="Lanjut" />
          </td>
        </tr>
      </table>
	  </form>
	 <?php 
	 			}
				else
				{
					echo "<center><blink><font color='red' size='3'>Maaf sisa cuti anda sudah habis</font></blink></center>";
				}
	 		}
	 		else
			{
			echo "<center><font color='red' size='3'>Maaf anda tidak bisa melakukan proses cuti karena masa kerja anda belum 1 tahun.</center>"; 
			echo "<blink><b>Lama bekerja $a[years] tahun $a[months] bulan</blink></b></font>";
			}
	 }
		else
			{
		echo "<center><blink><b><font color='red' size='4'>Maaf halaman ini tidak bisa anda akses</font></b></blink></center>";
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
