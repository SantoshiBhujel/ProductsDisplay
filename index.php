<?php
    include 'category-model.php';
    include 'functions.php';
    $category = new CategoryModel();
    $rows = $category->get_all();
?>

<?php include('include/header.php') ?>
    <section class="dashboard">
    <div class="side_nav">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul >
                <li >
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                        Category
                        </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="category.php">
                        <?php foreach($rows as $row): ?>
                            <?php echo $row['categoryname']; ?>
                            <br>
                        <?php endforeach; ?>
                    
                    </a>   
                </li>  
            </ul>

        </div>
    </nav>
    </div>


    <div class="main_body">
    <div style="margin-left:200px; display:flex; flex-wrap:wrap">
        <?php foreach($rows as $row): ?>
            <div class="form-group col-md-4">
                <a href="category.php" > 
                <?php echo "<img src='{$row['destination']}' alt='no image' style='width:200px; height:200px'/>"?>
                </a>
                <div class="container">
                    <?php echo $row['categoryname']; ?></td>
                </div>
            </div>
        <?php endforeach; ?>
        
    </div>
    <?php include('include/footer.php')?>