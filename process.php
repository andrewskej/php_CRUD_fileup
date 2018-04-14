<?php


$connect = mysqli_connect('localhost','root','wjssbdhQk3','opentutorials');
switch($_GET['mode']){
    case 'insert':
//    $target_dir = "uploads/"; WHY THE FUCK THIS FOLDER NAME IS NOT WORKING? TOO COMMON? DUP?
    $target_dir = "fileUpload/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOK = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    //fake or real filecheck
    if(isset($_POST["submit"])){
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false){
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOK = 1;
        }else{
            echo "File is not an image.";
            $uploadOK = 0;
        }
    }

    //check if file already exists
    if(file_exists($target_file)){
        echo "The file already exists";
        $uploadOK = 0;
    }

    if($_FILES["fileToUpload"]["size"]>500000){
        echo "Please upload files smaller than 500kb";
        $uploadOK = 0;
    }

    //file type limitation
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType !="jpeg"){
        echo "Please make sure you upload jpg/png/jpeg formatted files only";
        $uploadOK = 0;
    }
    
    //file upload
    if($uploadOK == 0){
        echo "file upload failed - for some reason ..";
    }else{
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file)){
            echo "The file " . basename($_FILES["fileToUpload"]["tmp_name"]). " has been uploaded"."<br/>";
        }else{
            echo "again, something went wrong (Shit that I don't know what it is)";
        }
    }
    
    $title = ($_POST['title']);
    $desc = ($_POST['description']);
    $img = ($target_file);
    $query = "INSERT INTO topic (title, description, img) VALUES ('$title', '$desc', '$img')";
    
    $result = mysqli_query($connect, $query);
    header("Location: list.php"); 
    break;




    case 'delete':
    $result = mysqli_query($connect, "DELETE FROM topic WHERE id= ".($_POST['id']));
    header("Location: list.php");
    break;

    case 'modify':
    $result =mysqli_query($connect, 'UPDATE topic SET title = "'.($_POST['title']).'", description = "'.($_POST['description']).'" WHERE id = '.($_POST['id']));
    header("Location: list.php?id={$_POST['id']}");
    break;
}
?>