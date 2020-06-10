<?php

    include 'session.php';
    require_once 'category-model.php';

    if(!isset($_POST['submit']))
    {
        $id = $_GET['id']; 
    }

    if(isset($_POST['submit'])) 
    {
        $id = $_POST['id']; // value from hidden field
        $category_model = new CategoryModel();

        if($category_model->delete($id))    
        {
            header('location: category.php');
        }
        else 
        {
            $error = 'Category could not be deleted.';
        }
    }

?>

<?php include('include/header.php')?>
    <h1>Delete User</h1>
    
    <?php if(isset($error)): ?>
        <p style="color: red"><?php echo $error; ?></p>
    <?php endif; ?>

    <p>Are you sure you want to delete this category?</p>
    <form method="POST" action="category-delete.php">
        <input type="hidden" name="id" value="<?php if(isset($id)) echo $id; ?>">
        <input type="submit" value="Yes" name="submit" class="button">

        <a href="category-list.php" class="button">No</a>
    </form> 
</body>
</html>