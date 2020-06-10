<?php

include 'session.php';
require_once 'category-model.php';

if(isset($_POST['save'])) 
{
    $categoryname = $_POST['categoryname'];

    if ($categoryname == NULL)
    {
            $error_msg = ' Enter Category name';
    }
    else
    {
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

        $category_model = new CategoryModel();
        $rows_affected = $category_model->insert($categoryname,$fileDestination);
        if($rows_affected > 0)
        header('location: category.php') ;
}

}
?>

<?php include('include/header.php')?>
    <section class="register">
    <div class="container"> 
            <form method="POST" action="category-new.php" enctype="multipart/form-data">
                <h1>New category</h1> 
                <div class="form-group">
                    <label> Category </label>
                    <input type="text" placeholder="Category Name" name="categoryname">
                </div>

                <div class="form-group">
                    <label for="uname"> Category Image</label>
                    <input type="file" name="image">
                </div>
            

                <?php if(isset($error_msg)): ?>
                    <p><?php echo $error_msg; ?></p>
                 <?php endif; ?>
                <input type="submit" value="Add" name ="save">
        </form>
    </div>
</section>