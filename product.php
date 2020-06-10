<?php
    require_once 'database.php';
    require_once 'user-model.php';
    require_once 'product-model.php';
    require_once 'category-model.php';
    require_once 'functions.php';
    $page_title='Products List';
   
    $product_model=new ProductModel();
    $rows= $product_model->get_all_products();
    //dd($rows);
?>

<?php include('include/header.php')?>
<?php include('include/dashboard.php')?>

    <div class="product">
        FIND THE EXCITING NEW PRODUCTS
        <br>
        <br>
        <a href="product-new.php">Insert New Product?</a>
        <table style="margin-top: 60px; margin-left:100px; border:1px solid skyblue" cellspacing="30px" cellpadding="30px">
        <tr >
            <th>Product ID</th>
            
            <th>Image</th>
            <th>Product's Name</th>
            <th>Price</th>
            <th>Category</th>
            <th colspan="2">Action</th>
        </tr>
        
        <?php foreach($rows as $row):?>
            <tr style="border:1px solid skyblue">

                <td> <?php echo $row['productsid']?></td>
                <td> 
                    <?php echo "<img src='{$row['destination']}' style='width:100px; height:100px'/>"?> 
                    <a href="product-image-update.php?id=<?php echo $row['productsid'];?>" > Change picture?</a>
                </td>
                <td> <?php echo $row['productsname'];?></td> 
                
                <td> <?php echo $row['price']?> </td>
                <td>
                    <?php 
                    
                        $id= $row['category_id'];
                        //$id=$id+1;
                        $category_model= new CategoryModel();
                        $category= $category_model->get_categoryname_by_id($id);
                        //dd($category);
                        echo $category['categoryname'];
                    ?>
                    
                </td>                
                <td>
                    <a href="product-edit.php?id=<?php echo $row['productsid'];?>" class="button">
                        EDIT 
                    </a>  
                </td>

                <td>
                    <a href="product-delete.php?id=<?php echo $row['productsid'];?>" class="button">
                        DELETE
                    </a>  
                </td>
                
            </tr>
        <?php endforeach;?>

    </table>   
<?php include('include/footer.php')?>