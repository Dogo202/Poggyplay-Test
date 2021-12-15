<?php
$postId=$_POST['postId'];
$comment=$_POST['comment'];
$userid=$_POST['user_id'];
$db = new mysqli('localhost','root','root','test_task');//подключение к базе
$comments=$db->query("INSERT INTO comment (user_idassign_id,text) values('$userid','$postId','$comment')");//добавляем комментарий в базу
$db->close();