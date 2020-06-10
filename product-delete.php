
<?php
    include 'session.php';
    require_once 'user-model.php';
    require_once 'product-model.php';
    $page_title="User Delete";
    
    if(!isset($_POST['submit']))
    {
        $id= $_GET['id']; //value from url parameter
    }

    else
    {
        $id= $_POST['id']; //value from hidden field
        $product_model=new ProductModel;

        if($product_model->productdelete($id))
        {
            header('Location: product.php');
        }

        else
        {
            $error="User could not be deleted";
        }
    }

?>

<?php include('include/header.php')?>
<?php include('include/dashboard.php')?>  
<p>Are you sure?</p>

<form method="POST" action="product-delete.php">

    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="submit" value="DELETE?" name='submit'>

    <?php if (isset($error)):?>
        <span>
                <?php echo $error;?>
        </span>
    <?php endif;?>

</form>

<a href="product.php"> NO </a>

<?php include('include/footer.php')?>