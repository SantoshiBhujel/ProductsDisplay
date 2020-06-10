<?php

    include 'session.php';
    require_once 'user-model.php';
    require_once 'product-model.php';
    require_once 'category-model.php';  
    $page_title="REGISTER";
    $category = new CategoryModel();
    $rows = $category->get_all();
  
    if(isset($_POST['submit']))
    {
        $productname=$_POST['productname'];    
        $price=$_POST['price'];   
        $category=$_POST['category_id'];
       //dd($_FILES['image']);
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
        $fileDestination = 'image/'.$fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination); 

            }
            
            $product_model=new ProductModel(); 
            $rows_affected=$product_model-> insertproducts($productname, $price, $fileNameNew, $fileDestination, $category);
            if($rows_affected>0)
            {
                header('Location: product.php');
            }
        
        else
        {
            $error= "Password does not match";
        }
    }

?>


<?php include('include/header.php')?>
<?php include('include/dashboard.php')?>
    <section class="register">
        <div class="container">
            <form style="width: 800px; position:center; margin-left:180px" method="POST" action="product-new.php" enctype="multipart/form-data">
                
                <div class="form-group col-md-6">
                    <label>Product Name</label>
                    <input type="text" name="productname" class="form-control" id="name" placeholder="Product's Name">
                </div>

                <div class="form-group col-md-6">
                    <label>Price</label>
                    <input type="text" name="price" class="form-control" id="price" placeholder="Price">
                </div>

                <div class="form-group col-md-6">
                    <label>Category</label>
                
                    <select name="category_id" required>
                        <?php foreach($rows as $row): ?>
                        <option value="<?php echo $row['category_id'] ?>">
                        <?php echo $row['category_id'];echo $row['categoryname'] ?>                    
                        <?php endforeach; ?> 
                    </select>
                </div>

                <div class="form-group">
                    <label >Product Image</label>
                    <input type="file" name="image"/>
                </div>
                
            <input type="submit" name="submit" value="SUBMIT"/>
            </form>
        </div>
    </section>
<?php include('include/footer.php')?>