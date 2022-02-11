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
$operator=$_SESSION['MM_Username'];
$no=0;
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
<table width="802" border="0" align="center" cellspacing="0">
   <tr>
    <td background="picture/header.jpg" height="240" width="800"></td>
  </tr>
 <tr>
    <td height="49" background="picture/menu_atas.jpg">
		<table width="758" height="39" align="center">
		  <tr><td><img src="picture/menu.jpg" name="image1" width="280" height="26" border="0" usemap="#Map" id="image1" /></td>
			   <td width="330" align="left"><font color="#FF0000">Operator : <?php echo $operator;?></font></td>
      </tr></table>
	</td>
  </tr>
  <tr>
  	<td background="picture/atas.jpg" height="29"></td>
  </tr>

<tr>
    <td height="34" align="center" valign="top" background="picture/tengah.jpg">
<?php 
if ($operator==admin)
{
?>
<form id="form1" name="form1" method="post" action=""><div align="right">
	  <table width="337" border="0">
            <tr>
              <td width="326"><strong><font color="#FF0000" face="Times New Roman, Times, serif">Tampilkan Karyawan</font><font color="#FF0000"> :</font></strong>
                <select name="shift">
                  <option value="Shift">Shift</option>
                  <option value="Non Shift">Non Shift</option>
              </select>
                <label>
                <input name="lihat" type="submit" id="lihat" value="Lihat" />
              </label></td>
              <td width="10">&nbsp;</td>
            </tr>
          </table>
        </div>
	    </label>
        
	  </form>
	 <?
$lihat=$_POST['lihat'];
$shift=$_POST['shift'];
  if ($lihat)
	  	{
		$currentPage = $_SERVER["PHP_SELF"];
			
			$maxRows_rs_karyawan = 50;
			$pageNum_rs_karyawan = 0;
			if (isset($_GET['pageNum_rs_karyawan'])) {
			  $pageNum_rs_karyawan = $_GET['pageNum_rs_karyawan'];
			}
			$startRow_rs_karyawan = $pageNum_rs_karyawan * $maxRows_rs_karyawan;
			
			mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
			$query_rs_karyawan = "SELECT * FROM t_master_karyawan where keterangan_shift='$shift' ORDER BY nama_karyawan ASC";
			$query_limit_rs_karyawan = sprintf("%s LIMIT %d, %d", $query_rs_karyawan, $startRow_rs_karyawan, $maxRows_rs_karyawan);
			$rs_karyawan = mysql_query($query_limit_rs_karyawan, $cn_db_cuti_karywan) or die(mysql_error());
			$row_rs_karyawan = mysql_fetch_assoc($rs_karyawan);
			
			if (isset($_GET['totalRows_rs_karyawan'])) {
			  $totalRows_rs_karyawan = $_GET['totalRows_rs_karyawan'];
			} else {
			  $all_rs_karyawan = mysql_query($query_rs_karyawan);
			  $totalRows_rs_karyawan = mysql_num_rows($all_rs_karyawan);
			}
			$totalPages_rs_karyawan = ceil($totalRows_rs_karyawan/$maxRows_rs_karyawan)-1;
			
			$queryString_rs_karyawan = "";
			if (!empty($_SERVER['QUERY_STRING'])) {
			  $params = explode("&", $_SERVER['QUERY_STRING']);
			  $newParams = array();
			  foreach ($params as $param) {
				if (stristr($param, "pageNum_rs_karyawan") == false && 
					stristr($param, "totalRows_rs_karyawan") == false) {
				  array_push($newParams, $param);
				}
			  }
			  if (count($newParams) != 0) {
				$queryString_rs_karyawan = "&" . htmlentities(implode("&", $newParams));
			  }
			}
			$queryString_rs_karyawan = sprintf("&totalRows_rs_karyawan=%d%s", $totalRows_rs_karyawan, $queryString_rs_karyawan);

?>
	<p><strong>DAFTAR KARYAWAN</strong> </p>
      <table width="760" border="0" align="center">
        <tr bgcolor="#6CA034">
          <td><div align="center"><font color="#FFFF00" size="2"><strong>NO</strong></font></div></td>
          <td><div align="center"><font color="#FFFF00" size="2"><strong>NOMOR BADGE </strong></font></div></td>
		  <td><div align="center"><font color="#FFFF00" size="2"><strong>NAMA KARYAWAN</strong></font></div></td>
          <td><div align="center"><font color="#FFFF00" size="2"><strong>GROUP KERJA </strong></font></div></td>
          <td><div align="center"><font color="#FFFF00" size="2"><strong>KLASIFIKASI</strong></font></div></td>
          <td><div align="center"><font color="#FFFF00" size="2"><strong>DEP. BIRO BAGIAN </strong></font></div></td>
          <td><div align="center"><font color="#FFFF00" size="2"><strong>TANGGAL MULAI KERJA </strong></font></div></td>
          <td width="80"><div align="center"><font color="#FFFF00" size="2"><strong>UPDATE</strong></font></div></td>
        </tr>
        
          <?php do { 
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
              <td align='center'><font size="-1"><?php echo $no;?></font></td>
              <td><font size="-1"><?php echo $row_rs_karyawan['nomor_badge']; ?></font></td>
              <td><?php echo $row_rs_karyawan['nama_karyawan']; ?></td>
              <td><?php echo $row_rs_karyawan['group_kerja']; ?></td>
              <td><?php echo $row_rs_karyawan['klasifikasi']; ?></td>
              <td><?php echo $row_rs_karyawan['dep_biro_bagian']; ?></td>
              <td><?php echo $tglvalid; ?></td>
              <td><div align="center"><font size="-1"><?php echo "<a href='edit_karyawan.php?no_badge=$row_rs_karyawan[nomor_badge]'>[Edit]</a>&nbsp;&nbsp;<a href='delete_karyawan.php?no_badge=$row_rs_karyawan[nomor_badge]'>[Delete]</a>"; ?></font></div></td>
            </tr>
            <?php } while ($row_rs_karyawan = mysql_fetch_assoc($rs_karyawan)); ?>
         
      </table> 
	  <br />
	     <a href="<?php printf("%s?pageNum_rs_karyawan=%d%s", $currentPage, 0, $queryString_rs_karyawan); ?>">[First]</a> <a href="<?php printf("%s?pageNum_rs_karyawan=%d%s", $currentPage, max(0, $pageNum_rs_karyawan - 1), $queryString_rs_karyawan); ?>">[Previous]</a> <a href="<?php printf("%s?pageNum_rs_karyawan=%d%s", $currentPage, min($totalPages_rs_karyawan, $pageNum_rs_karyawan + 1), $queryString_rs_karyawan); ?>">[Next]</a> <a href="<?php printf("%s?pageNum_rs_karyawan=%d%s", $currentPage, $totalPages_rs_karyawan, $queryString_rs_karyawan); ?>">[Last]</a></div>  
    </td>
</tr>


<?php
mysql_free_result($rs_karyawan);
?>
<?php
  }
		else
		{
		echo "<center><blink><font color='red' size='3'>Tampilkan karyawan belum dipilih</font></blink></center>";
		}
	}

	
else
{
echo "<center><blink><b><font color='red' size='4'>Maaf halaman ini tidak bisa anda akses</font></b></blink></center>";
}
?>
<tr>
  	<td background="picture/bawah.jpg" height="39"><div align="center"></td>
</tr>
<tr>
    <td><center><b><font size="1" face="Arial, Helvetica, sans-serif">Copyright@2018 Versi 2.0</font></b></center></td>
  </tr>
</table>
</body>
</html>


