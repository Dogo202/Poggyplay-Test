<?php
$user_id=$_COOKIE['user_id'];
$amount=$_POST['amount'];
$db = new mysqli('localhost','root','root','test_task');//подключение к базе
$users=$db->query("Select * from user where id='$user_id'");//находим аккаунт по primary key
$userss=$users->fetch_assoc();
$wallet_total=$userss['wallet_total_refilled'];//вытаскиваем его текущий баланс и  сумму, на которую юзер пополнил баланс за все время
$wallet_count=$userss['wallet_balance'];
$wallet_count=$wallet_count+$amount;//добавляем их пополняемой суммой
$wallet_total=$wallet_total+$amount;
$likes=$db->query("Update user set wallet_balance='$wallet_count',wallet_total_refilled='$wallet_total' where id='$user_id'");
print_r($wallet_count);
$db->close();