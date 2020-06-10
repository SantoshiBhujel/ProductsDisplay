<?php

    require_once 'database.php';

    class ProductModel
    {
        function insertproducts($productname, $price, $image, $destination, $category)
        {
            $database=new Database();
            $parameters=[              
            'productsname'=>$productname,
            'price'=>$price,
            'image'=>$image,
            'destination'=>$destination,
            'category'=>$category
            ];

            $sql = 'insert into products (productsname, price, image, destination, category_id) values(:productsname ,:price, :image, :destination, :category)';
            return $database->execute($sql, $parameters);
        }

        function get_all_products() 
        {
            $database = new Database();
            $sql = 'select * from products';
            return $database->fetchAll($sql);
        }

        function get_product_by_id($id)
        {
            $database= new Database();
            $parameters=[
                'productsid'=> $id
            ];
            $sql = 'select * from products where productsid = :productsid';
            $row = $database->fetchAll($sql,$parameters);
            if(count($row)==0)
                return NULL;
            return $row[0];
        }

        function product_update($id,$productname,$price, $category)
        {
            $database=new Database();
            
            $parameters=[                
            'productsid'=> $id,
            'productsname'=>$productname,
            'price'=> $price,
            'category'=>$category
            ];
            $sql ='update products set productsname= :productsname, price= :price, category_id=:category where productsid= :productsid';
            return $database->execute($sql,$parameters);
        }

        function product_image_update($id, $image, $destination)
        {
            $database=new Database();
            
            $parameters=[                
            'productsid'=> $id ,
            'image'=>$image,
            'destination'=>$destination
            ];
            $sql ='update products set image= :image, destination= :destination where productsid= :productsid';
            return $database->execute($sql,$parameters);
        }

        function productdelete($id)
        {
            $database=new Database();
            $parameters=[ 
                'productsid'=> $id
            ];
            $sql ='delete from products where productsid= :productsid';
            return $database->execute($sql,$parameters);
        }

        function get_product($category)
        {
            $database = new Database();
            $parameters=[ 
                'category'=> $category
            ];
            $sql = 'select * from products where category_id= :category';
            return $database->fetchAll($sql, $parameters);  
        }
    }