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
<?php include('menu_atas.php'); ?>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body bgcolor="#DBFBBC">
<script language="JavaScript1.2">mmLoadMenus();</script>
<table width="802" border="0" align="center" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <td background="picture/jgg99.png" height="219" width="800"></td>
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
			<form id="form1" name="form1" method="post" action="">
			  <p>&nbsp;</p>
			  <table width="415" border="0">
				<tr>
				  <td width="163"><strong>MASUKAN NOMOR</strong> </td>
				  <td width="242"><input name="nomor_badge" type="text" id="nomor_badge" size="15" />
						<input type="submit" name="Submit" value="Masuk" /></td>
				</tr>
			  </table>
			</form>
	  <p>
	  
      </p>
			<table bgcolor="#AFEF63">
					<tr>
						<td width="177" align="center"><?php include('menu.php');?>
						</td>
						<td>
							<table align="center">
			<?php 
								
		$tombol=$_POST['Submit'];
		$nomor_badge=$_POST['nomor_badge'];
		$_SESSION['MM_nomor_budge'] = $nomor_badge;
		if ($tombol)
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
	
			mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
			$query_rs_cuti_karyawan = sprintf("SELECT * FROM t_master_karyawan WHERE nomor_badge = '$nomor_badge'");
			$rs_cuti_karyawan = mysql_query($query_rs_cuti_karyawan, $cn_db_cuti_karywan) or die(mysql_error());
			$row_rs_cuti_karyawan = mysql_fetch_assoc($rs_cuti_karyawan);
			$totalRows_rs_cuti_karyawan = mysql_num_rows($rs_cuti_karyawan);
			
			
			mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
			$query_banyak_cuti = sprintf("SELECT * FROM t_cuti WHERE nomor_badge = '$nomor_badge' and jumlah_cuti !='0'");
			$banyak_cuti = mysql_query($query_banyak_cuti, $cn_db_cuti_karywan) or die(mysql_error());
			$totalRows_banyak_cuti = mysql_num_rows($banyak_cuti);
			
			$tampil_sisa=$row_rs_cuti_karyawan['hak_cuti'];
			
		
			$temp_1=explode("-",$row_rs_cuti_karyawan['tgl_mulai_kerja']);
			$tglvalid_1=$temp_1[2];
			$blnvalid_1=$temp_1[1];
			$tgl_now=date('d');
			$bln_now=date('m');

			if ($tglvalid_1>=$tgl_now)
			{
			if ($blnvalid_1<=$bln_now)
			{
			$temp_kerja=explode("-",$row_rs_cuti_karyawan['tgl_mulai_kerja']);
			$thn_cuti_timbul=$temp_kerja[0]+1;
			$thn=date('Y');
			$tglvalid_kerja=$temp_kerja[2]."-".$temp_kerja[1]."-".$thn;
			}
			else
			{
		
			$thn=$temp_kerja[0];
			$temp_kerja=explode("-",$row_rs_cuti_karyawan['tgl_mulai_kerja']);
			$thn=date('Y')-1;
			$tglvalid_kerja=$temp_kerja[2]."-".$temp_kerja[1]."-".$thn;
			}
			}
			else
			{
			$temp_kerja=explode("-",$row_rs_cuti_karyawan['tgl_mulai_kerja']);
			$thn=date('Y')-1;
			$tglvalid_kerja=$temp_kerja[2]."-".$temp_kerja[1]."-".$thn;
			}

			
			 ?>
									 

		
									 
									<tr>
									<td colspan="4" align="center"><strong>DATA KARYAWAN </strong></td>
								  </tr>
									<tr>
									<td width="170"><div align="left">Nama Karyawan </div></td>
									<td width="4"><div align="left">:</div></td>
									<td width="228"><div align="left"><?php echo $row_rs_cuti_karyawan['nama_karyawan']; ?></div></td>
								  </tr>
								  <tr>
									<td><div align="left">Nomor Badge </div></td>
									<td><div align="left">:</div></td>
									<td><div align="left"><?php echo $row_rs_cuti_karyawan['nomor_badge']; ?></div></td>
								  </tr>
								  <tr>
									<td><div align="left">Group Kerja </div></td>
									<td><div align="left">:</div></td>
									<td><div align="left"><?php echo $row_rs_cuti_karyawan['group_kerja']; ?></div></td>
								  </tr>
								  <tr>
									<td><div align="left">Klasifikasi</div></td>
									<td><div align="left">:</div></td>
									<td><div align="left"><?php echo $row_rs_cuti_karyawan['klasifikasi']; ?></div></td>
								  </tr>
								  <tr>
									<td><div align="left">Dep/Biro/Bagian</div></td>
									<td><div align="left">:</div></td>
									<td><div align="left"><?php echo $row_rs_cuti_karyawan['dep_biro_bagian']; ?> / <?php echo $row_rs_cuti_karyawan['bagian']; ?></div></td>
								  </tr>
								  <tr>
									<td><div align="left">Tanggal Cuti Timbul </div></td>
									<td><div align="left">:</div></td>
									<td>
									  <div align="left"><?php echo $tglvalid_kerja; ?>
								        <?php 
										}
										else
										{
										echo "<blink><font color='red'>Nomor Belum dimasukan</font></blink>";
										}
									?>
							                  </div></td>
						   </tr>
								
					  </table>
					   <?php }
		else
			{
		echo "<center><blink><b><font color='red' size='4'>Maaf halaman ini tidak bisa anda akses</font></b></blink></center>";
			}
	  ?>
					</td>
				</tr>
	  </table>
	 
	</td>
  </tr>
<tr>
  	<td background="picture/bawah.jpg" height="39"></td>
  </tr>
<tr>
    <td><center><b><font size="1" face="Arial, Helvetica, sans-serif">Copyright@2018 Versi 2.0</font></b></center></td>
  </tr>
</table>
</body>
</html>