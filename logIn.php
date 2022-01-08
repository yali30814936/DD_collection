<?php
//插入連線資料庫的相關資訊
require_once 'connectvars.php';
//開啟一個會話
session_start();
$error_msg = "";
//如果使用者未登入，即未設定$_SESSION['ID']時，執行以下程式碼
if(!isset($_SESSION['ID'])){
    if(isset($_POST['submit'])){//使用者提交登入表單時執行如下程式碼
        $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        $user_username = mysqli_real_escape_string($dbc,trim($_POST['username']));
        $user_password = mysqli_real_escape_string($dbc,trim($_POST['password']));
        if(!empty($user_username)&&!empty($user_password)){
            //MySql中的SHA()函式用於對字串進行單向加密
            $query = "SELECT ID, username FROM user_table WHERE username = '$user_username' AND "."password = '$user_password'";
            //用使用者名稱和密碼進行查詢
            $data = mysqli_query($dbc,$query);
            //若查到的記錄正好為一條，則設定SESSION，同時進行頁面重定向
            if(mysqli_num_rows($data)==1){
                $row = mysqli_fetch_array($data);
                $_SESSION['ID']=$row['ID'];
                $_SESSION['username']=$row['username'];
                $home_url = 'homepage.php';
                header('Location: '.$home_url);
            }else{//若查到的記錄不對，則設定錯誤資訊
                $error_msg = 'Sorry, you must enter a valid username and password to log in.';
            }
        }else{
            $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
    }
}else{//如果使用者已經登入，則直接跳轉到已經登入頁面
    $home_url = 'homepage.php';
    header('Location: '.$home_url);
}
?>
<html>
<head>
    <title>DD_collection - Log In</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <h3>DD_collection - Log In</h3>
    <!--通過$_SESSION['ID']進行判斷，如果使用者未登入，則顯示登入表單，讓使用者輸入使用者名稱和密碼-->
    <?php
        if(!isset($_SESSION['ID'])){
        echo '<p class="error">'.$error_msg.'</p>';
        ?>
        <!-- $_SERVER['PHP_SELF']代表使用者提交表單時，呼叫自身php檔案 -->
        <form method = "post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <fieldset>
        <legend>Log In</legend>
        <label for="username">Username:</label>
        <!-- 如果使用者已輸過使用者名稱，則回顯使用者名稱 -->
        <input type="text" id="username" name="username"
        value="<?php if(!empty($user_username)) echo $user_username; ?>" />
        <br/>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"/>
        </fieldset>
        <input type="submit" value="Log In" name="submit"/>
        </form>
        <?php
        }
    ?>
</body>
</html>