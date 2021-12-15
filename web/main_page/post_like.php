<?php
$postId=$_POST['postId'];
$db = new mysqli('localhost','root','root','test_task'); //подключение к базе
$likes=$db->query("Select from post where id='$postId'");//вытаскиваем все данные выбранного поста
$like=$likes->fetch_assoc();
$user_id=$_COOKIE['user_id'];
$users=$db->query("Select like_balance from user where id='$user_id'");//вытаскиваем количество лайков на балансе авторизованного пользователя
$userss=$users->fetch_assoc();
$like_count=$userss['like_balance'];
if($like_count!=0){//если баланс пользователя не нулевой то меняем количество лайков на посте и списываем кол-во лайков у пользователя
    $new_count=$like['likes']+1;
    $like_count--;
    $likes=$db->query("Update post set likes='$new_count' id='$postId'");
    $likes=$db->query("Update user set like_balance='$like_count' where id='$user_id'");
}else{//если же пустой , то тогда выводим ошибку о том что на его балансе недостаточно средств(лайков)
    ?>
    <script>
        alert('you dont have enough likes');
    </script>
    <?php
}
$db->close();