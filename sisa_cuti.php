<?php require_once('Connections/cn_db_cuti_karywan.php'); ?>
<?php
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
  	<td background="picture/atas.png" height="42">
	<table align="center" width="676" border="0">
      <tr>
        <td><?php include('pesan.php');?></td>
      </tr>
    </table>
	</td>
  </tr>
<tr>
    <td height="34" align="center" valign="top" background="picture/tengah.jpg">
	  <form id="form1" name="form1" method="post" action="sisa_cuti.php">
			 
			  <table width="415" border="0">
				<tr>
				  <td width="163"><strong>MASUKAN NOMOR</strong> </td>
				  <td width="242"><input name="nomor_badge" type="text" id="nomor_badge" size="15" />
						<input type="submit" name="submit" value="Masuk" /></td>
				</tr>
			  </table>
	   
			    <?php 
			$no_budget=$_POST['nomor_badge'];
			$submit=$_POST['submit'];
			
if ($submit)
{
mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
$query_rs_karyawan = sprintf("SELECT * FROM t_master_karyawan WHERE nomor_badge = '$no_budget'");
$rs_karyawan = mysql_query($query_rs_karyawan, $cn_db_cuti_karywan) or die(mysql_error());
$row_rs_karyawan = mysql_fetch_assoc($rs_karyawan);
$totalRows_rs_karyawan = mysql_num_rows($rs_karyawan);

mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
$query_rs_cuti = sprintf("SELECT * FROM t_cuti WHERE nomor_badge = '$no_budget' and jumlah_cuti !='0'");
$rs_cuti = mysql_query($query_rs_cuti, $cn_db_cuti_karywan) or die(mysql_error());
$totalRows_rs_cuti = mysql_num_rows($rs_cuti);

$tampil_sisa=$row_rs_karyawan['hak_cuti'];

?>
	<table width='200' align="center">
			<tr><td colspan='3' align='center'><b>DAFTAR RINCIAN</b></td></tr>
			<tr>
				<td width='100' align='left'>Hak Cuti</td>
				<td width='10' align='center'>:</td>
				<td width='90' align='center'><?php echo "$tampil_sisa"; ?></td>
			</tr>
	</table>
	<table width="462" border="1">
	<tr bgcolor="#6CA034">
        <td colspan="5"><div align="center"><font color="#FFFF00"><strong>Rincian Pengajuan Cuti </strong></font></div>          </td>
      </tr>
      <tr bgcolor="#6CA034">
        <td><div align="center"><font color="#FFFF00">Tanggal Pengajuan </font></div></td>
        <td><div align="center"><font color="#FFFF00">Tanggal Awal </font></div></td>
        <td><div align="center"><font color="#FFFF00">Tanggal Akhir </font></div></td>
        <td><div align="center"><font color="#FFFF00">Jumlah cuti </font></div></td>
      </tr>
			
			<?php 
			while ($data = mysql_fetch_assoc($rs_cuti))
			{ 
			
			$jumlah_cuti=$data['jumlah_cuti'];
			$totalcuti[]=$jumlah_cuti;
			$totalsekarang = array_sum($totalcuti);
			
			$temp_pengajuan=explode("-",$data['tanggal_pengajuan']);
			$tglvalid_pengajuan=$temp_pengajuan[2]."-".$temp_pengajuan[1]."-".$temp_pengajuan[0];
			
			$temp_awal=explode("-",$data['tanggal_awal']);
			$tglvalid_awal=$temp_awal[2]."-".$temp_awal[1]."-".$temp_awal[0];
			
			$temp_akhir=explode("-",$data['tanggal_akhir']);
			$tglvalid_akhir=$temp_akhir[2]."-".$temp_akhir[1]."-".$temp_akhir[0];
			?>
			
			 
      <tr bgcolor="#CCFF33">
        <td><div align="center"><?php echo "$tglvalid_pengajuan"; ?></div></td>
        <td><div align="center"><?php echo "$tglvalid_awal"; ?></div></td>
        <td><div align="center"><?php echo "$tglvalid_akhir"; ?></div></td>
        <td><div align="center"><?php echo "$jumlah_cuti"; }?></div></td>
      </tr>
    </table>
	
	<table>
			
			
			<tr>
				<td width='100' align='left'>Total Cuti</td>
				<td width='10' align='center'>:</td>
				<td width='90' align='center'><?php
					echo "$totalsekarang";
				?></td>
			</tr>
			<tr>
				<td width='100' align='left'><font color="#FF0000"><b><blink>Sisa Cuti</blink></b></font></td>
				<td width='10' align='center'>:</td>
				<td width='90' align='center'><?php
					$sisa=$row_rs_karyawan['hak_cuti']-$totalsekarang;
					echo "<b><font color='#FF0000'><blink>$sisa</blink></font></b>";
				?></td>
			</tr>
</table>	
    <p>
      <?php } ?>
</p>
    </p>
   
    <p>&nbsp;</p>
	  </form>
			
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
