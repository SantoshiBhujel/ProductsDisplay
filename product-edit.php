<?php
    include 'session.php';
  
    require_once 'user-model.php';
    require_once 'product-model.php';
    require_once 'category-model.php';
    $product_model= new ProductModel();
    $category = new CategoryModel();
    $rows = $category->get_all();
    session_start();
  
    if(!isset($_POST['save']))
    {
        $id=$_GET['id'];
        $product= $product_model->get_product_by_id($id);
        $productname= $product['productsname'];
        $price=$product['price'];
    }


    else
    {
        $id= $_POST['id'];
        $productname=$_POST['productname'];
        $price=$_POST['price'];  
        $category=$_POST['category'];
        $product_model-> product_update($id, $productname, $price, $category);
        header('location: product.php');
    }
?>


<?php include('include/header.php')?>
<?php include('include/dashboard.php')?>


<section class="register">
        <div class="container">
        <form method="POST" action="product-edit.php" enctype="multipart/form-data">
                <h1>Update Product Information</h1>
                <input type="hidden" name="id" value="<?php echo $id; ?>" >
                <div class="form-group">
                    <i class="fa fa-product icon"></i>
                    <label >Product's Name</label>
                    <input class="input-field" type="text" placeholder="Productname" name="productname" id="productname" autocomplete="off" value="<?php if(isset($productname)) echo $productname;?>">
                    <span class="error-message" id="nameerror"/>
                </div>

                <div class="form-group">
                    <i class="fa fa-dollar icon"></i>
                    <label>Price</label>
                    <input class="input-field" type="text" name="price" id="price" autocomplete="off" placeholder="$12345" value="<?php if(isset($price)) echo $price;?>">
                    <span id="emailerror"/>
                </div>
            

                <div class="form-group">
                    <i class="fa fa-dial icon"></i>
                    <label>Category</label>
                    <select name="category"  class="form-control" style="height:50px">
                        <?php foreach($rows as $row): ?>
                        <option value="<?php echo $row['category_id'] ?>">
                        <?php echo $row['categoryname']?>                    
                        <?php endforeach; ?> 
                    </select>
                    </input>
                    
                    <span id="contacterror"/>
                    
                </div>

                <input type="submit" value ="UPDATE" name="save">     
            </form>
        </div>
    </section>
<?php include('include/footer.php')?>