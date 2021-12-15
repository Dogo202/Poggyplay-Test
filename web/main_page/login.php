<?php
$login=$_POST['login'];
$password=$_POST['password'];
$db = new mysqli('localhost','root','root','test_task');//подключение к базе
$users=$db->query("Select * from user where email='$login' and password='$password'");
if(($user=$users->fetch_assoc())==''){//если не найден пользователь с ввелёнными данными то выдаём ошибку
    ?><script>
        alert('incorrect password or login')</script><?php
}else{//иначе запоминаем в кеше его логин и айди и выдаём уведомление о входе в систему
    $_COOKIE['user']=$login;
    $_COOKIE['user_id']=$user['id'];
    ?>
    <script>
        alert('you logged in')</script><?php
}
$db->close();