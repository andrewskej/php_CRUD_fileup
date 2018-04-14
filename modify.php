<?php
$connect = mysqli_connect('localhost', 'root', 'wjssbdhQk3','opentutorials');
$result = mysqli_query($connect, 'SELECT * FROM topic WHERE id = '.($_GET['id']));
if($result){
$topic = mysqli_fetch_row($result);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
    </head>   
    <body>
        <form action="./process.php?mode=modify" method="POST">
            <input type="hidden" name="id" value="<?=$topic[0]?>" />
            <p>title : <input type="text" name="title" value="<?=htmlspecialchars($topic[1])?>"></p>
            <p>contents : <textarea name="description" id="" cols="30" rows="10"><?=htmlspecialchars($topic[2])?></textarea></p>
            <p><input type="submit" /></p>
        </form>
    </body>
</html>