<?php

    include 'session.php';
    require_once 'category-model.php';
    $category = new CategoryModel();
    $rows=$category->get_all();

    if(!isset($_POST['save']))
    {
        $id = $_GET['id'];
        $user = $category->get_by_id($id);
        $categoryname = $user['categoryname'];
    }

    else
    {
        $id = $_POST['id'];
        $categoryname=$_POST['categoryname'];
        
        $fileName = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error'];
        $fileType = $_FILES['image']['type'];
        //dd($_FILES);
        $fileExt = explode('.',$fileName); 
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpeg','jpg','png');

        if(!in_array($fileActualExt, $allowed))
        {
            echo "You cannot upload file of this extension!";
            return;
        }

        if($fileError !== 0)
        {
            echo "There was an error uploading file!";
            return;
        }

        if($fileSize > 5 * 1024 * 1024) // 5 MB
        {
            echo "Your file is too large!"; 
            return;
        }

        $fileNameNew = time().".".$fileActualExt;
        $fileDestination = 'uploads/'.$fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination); 
        $category->update($id, $categoryname ,$fileDestination);
        header('location: category.php');
    }

?>

<?php include('include/header.php')?>
<section class="register">
    <div class="container">
        <form method="POST" action="category-update.php" enctype="multipart/form-data">
            <h1>Category Update</h1>

            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label>Category Name: </label>
                <input type="text" name="categoryname" value="<?php echo $categoryname; ?>">
            </div>

            <div class="form-group">
                <label> Category Image: </label>
                <input type="file" name="image">
            </div>
        <input type="submit" value="Update" name ="save"/>
    
        </form>
    </div>
</section>
