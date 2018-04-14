<!DOCTYPE html>
<html>
<head>
<meta charset = "utf-8"/>
</head>
<body>
    <form enctype="multipart/form-data" action="./process.php?mode=insert" method="POST">
        <p>title : <input type="text" name="title"></p>
        <p>contents : <textarea name="description" id="" cols="30" rows="10"></textarea></p>
        <p><input type = "file" name="fileToUpload" id="fileToUpload"/>
        <p><input type = "submit" value="Write!"/></p>            
    </form>
</body>
</html>