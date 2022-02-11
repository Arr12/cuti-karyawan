<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cn_db_cuti_karywan = "localhost";
$database_cn_db_cuti_karywan = "db_cuti_karyawan";
$username_cn_db_cuti_karywan = "root";
$password_cn_db_cuti_karywan = "";
$cn_db_cuti_karywan = mysql_pconnect($hostname_cn_db_cuti_karywan, $username_cn_db_cuti_karywan, $password_cn_db_cuti_karywan) or trigger_error(mysql_error(),E_USER_ERROR); 
?>