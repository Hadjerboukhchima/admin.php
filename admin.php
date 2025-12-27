<?php
session_start();
if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit;
}
include("php/config.php");
$res=$conn->query("SELECT * FROM inscriptions ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>لوحة التحكم</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap');

body{
  font-family:'Cairo',sans-serif;
  background:#f5f7fa;
  margin:0;
}

header{
  background:#0b1c2d;
  color:#fff;
  padding:20px;
  display:flex;
  justify-content:space-between;
  align-items:center;
}

header a{
  color:#d4af37;
  text-decoration:none;
  font-weight:bold;
}

.container{
  width:95%;
  margin:30px auto;
}

h2{
  color:#0b1c2d;
  margin-bottom:20px;
}

table{
  width:100%;
  border-collapse:collapse;
  background:#fff;
  box-shadow:0 8px 20px rgba(0,0,0,.1);
  border-radius:12px;
  overflow:hidden;
}

th,td{
  padding:12px;
  text-align:center;
}

th{
  background:#0b1c2d;
  color:#fff;
}

tr:nth-child(even){
  background:#f2f2f2;
}

a.delete{
  color:red;
  font-size:18px;
  text-decoration:none;
}
</style>
</head>

<body>

<header>
  <h1>📊 لوحة التحكم</h1>
  <a href="logout.php">🚪 تسجيل الخروج</a>
</header>

<div class="container">
  <h2>قائمة التسجيلات</h2>

  <table>
    <tr>
      <th>ID</th>
      <th>الاسم</th>
      <th>البريد</th>
      <th>الدورة</th>
      <th>حذف</th>
    </tr>

    <?php while($r=$res->fetch_assoc()): ?>
    <tr>
      <td><?= $r['id'] ?></td>
      <td><?= $r['name'] ?></td>
      <td><?= $r['email'] ?></td>
      <td><?= $r['course'] ?></td>
      <td>
        <a class="delete" href="delete.php?id=<?= $r['id'] ?>" 
           onclick="return confirm('هل أنت متأكد؟')">🗑</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

</body>
</html>
