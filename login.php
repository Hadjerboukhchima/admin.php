<?php
session_start();
include("php/config.php");
$msg="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
  $u=$_POST['username'];
  $p=sha1($_POST['password']);

  $q=$conn->query("SELECT * FROM admins WHERE username='$u' AND password='$p'");
  if($q->num_rows){
    $_SESSION['admin']=true;
    header("Location: admin.php");
    exit;
  }else{
    $msg="❌ اسم المستخدم أو كلمة المرور غير صحيحة";
  }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>دخول الإدارة</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap');

body{
  margin:0;
  height:100vh;
  display:flex;
  justify-content:center;
  align-items:center;
  background:linear-gradient(135deg,#0b1c2d,#1f3b57);
  font-family:'Cairo',sans-serif;
}

.login-box{
  background:#fff;
  padding:30px;
  width:350px;
  border-radius:15px;
  box-shadow:0 10px 30px rgba(0,0,0,.3);
  text-align:center;
}

.login-box h2{
  margin-bottom:25px;
  color:#0b1c2d;
}

input,button{
  width:100%;
  padding:12px;
  margin-bottom:15px;
  border-radius:8px;
  font-size:1em;
}

input{
  border:1px solid #ccc;
}

button{
  background:#d4af37;
  color:#0b1c2d;
  border:none;
  font-weight:bold;
  cursor:pointer;
}

button:hover{
  background:#c39b2d;
}

.error{
  background:#ffd4d4;
  color:#900;
  padding:10px;
  margin-bottom:15px;
  border-radius:8px;
}
</style>
</head>

<body>

<div class="login-box">
  <h2>🔐 دخول الإدارة</h2>

  <?php if($msg): ?>
    <div class="error"><?= $msg ?></div>
  <?php endif; ?>

  <form method="post">
    <input type="text" name="username" placeholder="اسم المستخدم" required>
    <input type="password" name="password" placeholder="كلمة المرور" required>
    <button type="submit">دخول</button>
  </form>
</div>

</body>
</html>
