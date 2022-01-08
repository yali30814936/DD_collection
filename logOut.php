<?php
    //即使是登出時，也必須首先開始會話才能訪問會話變數
    session_start();
    //使用一個會話變數檢查登入狀態
    if(isset($_SESSION['ID'])){
        //要清除會話變數，將$_SESSION超級全域性變數設定為一個空陣列
        $_SESSION = array();
        //如果存在一個會話cookie，通過將到期時間設定為之前1個小時從而將其刪除
        if(isset($_COOKIE[session_name()])){
            setcookie(session_name(),'',time()-3600);
        }
        //使用內建session_destroy()函式呼叫撤銷會話
        session_destroy();
    }
    //location首部使瀏覽器重定向到另一個頁面
    $home_url = 'logIn.php';
    header('Location:'.$home_url);
?>