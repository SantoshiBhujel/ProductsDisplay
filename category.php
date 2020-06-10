<?php
    include 'category-model.php';
    $category = new CategoryModel();
    $rows = $category->get_all();
?>



<?php include('include/header.php')?>
<?php include('include/dashboard.php')?>
    <div class="new">
        <a href="category-new.php"> Add New Category</a>
    </div>
    <div class="category">
        <table style="margin-top: 60px; margin-left:100px; border:1px solid skyblue" cellspacing="20px" cellpadding="20px">
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Image</th>
                <th colspan="2">Actions</th>
            </tr>
            <?php foreach($rows as $row): ?>
                <tr>
                    <td><?php echo $row['category_id']; ?></td>
                    <td><?php echo $row['categoryname']; ?></td>
                    <td>
                        <a href="display.php?category=<?php echo $row['category_id'];?>">
                            <?php echo "<img src='{$row['destination']}' alt='no image' style='width:100px; height:100px'/>"?>
                        </a>
                    </td>
                    <td>
                        <a href="category-update.php?id=<?php echo $row['category_id']; ?>"> 
                            Edit
                        </a>
                    </td>
                    <td>
                        <a href="category-delete.php?id=<?php echo $row['category_id']; ?>"> Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>        
        </table>       
<?php include('include/footer.php')?>