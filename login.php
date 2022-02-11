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

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_cn_db_cuti_karywan, $cn_db_cuti_karywan);
  
  $LoginRS__query=sprintf("SELECT Username, Password FROM t_admin WHERE Username=%s AND Password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $cn_db_cuti_karywan) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
$operator=$_SESSION['MM_Username'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>
<?php include('title.php');?>
</title>
<?php include('menu_atas.php');?>
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
  	<td height="42" align="center" background="picture/atas.png">
	<table width="676" border="0">
      <tr>
        <td><?php include('pesan.php');?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="175" align="center" valign="top" background="picture/tengah.jpg"><br />
        <form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
          <table width="450" height="220" border="0" background="picture/login.png">
            <tr>
              <td height="68" colspan="4" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td width="118" height="24" align="center">&nbsp;</td>
              <td width="90" align="center">Username</td>
              <td width="20" align="center">:</td>
              <td width="204" align="center"><div align="left">
                <input name="username" type="text" id="Username" />
              </div></td>
            </tr>
            <tr>
              <td height="32" align="center">&nbsp;</td>
              <td align="center">Password</td>
              <td align="center">:</td>
              <td align="center"><div align="left">
                <input name="password" type="password" id="password" />
              </div></td>
            </tr>
            <tr>
              <td height="26" colspan="4" align="center"><input type="submit" name="Submit" value="Login" /></td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
          </table>
      </form>
      <p>&nbsp;</p></td>
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
