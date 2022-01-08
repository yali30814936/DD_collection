<?php
//使用會話記憶體儲的變數值之前必須先開啟會話
session_start();
//使用一個會話變數檢查登入狀態
if(isset($_SESSION['username'])){
echo 'You are Logged as '.$_SESSION['username'].'<br/>';
//點選“Log Out”,則轉到logOut頁面進行登出
echo '<a href="logOut.php"> Log Out('.$_SESSION['username'].')</a>';
}
/**在已登入頁面中，可以利用使用者的session如$_SESSION['username']、
* $_SESSION['ID']對資料庫進行查詢，可以做好多好多事情*/
?>