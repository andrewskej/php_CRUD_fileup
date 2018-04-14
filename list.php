<?php
$connect = mysqli_connect('localhost','root','wjssbdhQk3','opentutorials');
if(mysqli_connect_errno()){
    echo "Failed to connect to DB: ".mysqli_connect_error();
}else{
    echo "Connected to DB";
}
$query = 'SELECT * FROM topic';
$list_result = mysqli_query($connect,$query);
echo "<br><br>";

if(!empty($_GET['id'])){
    $topic_result = mysqli_query($connect,'SELECT * FROM topic WHERE id= '.($_GET['id']));
    $topic = mysqli_fetch_row($topic_result);
}else{
    // echo "if its empty=you didn't choose any";
}
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8"/>
    <style type="text/css">
            body {
                font-size: 0.8em;
                font-family: dotum;
                line-height: 1.6em;
            }
            header {
                border-bottom: 1px solid #ccc;
                padding: 20px 0;
            }
            nav {
                float: left;
                margin-right: 20px;
                min-height: 1000px;
                min-width:150px;
                border-right: 1px solid #ccc;
            }
            nav ul {
                list-style: none;
                padding-left: 0;
                padding-right: 20px;
            }
            article {
                float: left;
            }
            .description{
                width:500px;
            }
    </style>
    </head>
    <body id = "body">
        <div>
            <nav>
                <ul>
                    <?php
                        while($row= $list_result->fetch_row()){
                            echo "<li><a href='?id=$row[0]'>$row[0]</a>".' '.$row[1].' '.$row[3]."</li>";
                        }
                    ?>
                </ul>
                <ul>
                    <li><a href="input.php"><button>add</button></a></li>
                </ul>
            </nav>
            <article>
            <!-- This is where you are supposed to get ind.articles -->
                <?php
                if(!empty($topic)){
                ?>
                <h2><?php echo htmlspecialchars($topic[1]);?></h2>
                <div class="description">
                    <?=htmlspecialchars($topic[2])?><br><br>
                    <img src="<?=htmlspecialchars($topic[4])?>" style="width:300px;">
                </div>
                <div>
                <br><br>
                    <button><a href="modify.php?id=<?=$topic[0]?>">Edit</a></button><br><br>
                    <form method="POST" action="process.php?mode=delete">
                        <input type="hidden" name="id" value="<?=$topic[0]?>" />
                        <input type="submit" value="delete"/>
                    </form>
                </div>
                <?php   
                    }else{
                        // echo "$topic is empty. (means you didn't choose any articles yet.)";
                    }
                ?>
            </article>


        </div>
    </body>
</html>