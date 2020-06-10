<?php

require_once 'database.php';

class CategoryModel
{

    function login($categoryname, $password) 
    {
        $database = new Database();
        $parameters = [
            'categoryname' => $categoryname,
        ];        
        $sql = "select * from category where categoryname = :categoryname ";
        $rows = $database->fetchAll($sql, $parameters);
        return count($rows) > 0;
    }

    function get_all() 
    {
        $database = new Database();
        $sql = 'select * from category';
        return $database->fetchAll($sql);
    }

    function get_by_id($id) 
    {
        $database = new Database();
        $parameters = [
            'category_id' => $id
        ];
        $sql = 'select * from category where category_id = :category_id';
        $row = $database->fetchAll($sql, $parameters);
        if(count($row) == 0)
            return NULL;
        return $row[0];
    }
    function get_categoryname_by_id($id) 
    {
        $database = new Database();
        $parameters = [
            'category_id' => $id
        ];
        $sql = 'select categoryname from category where category_id = :category_id';
        $row = $database->fetchAll($sql, $parameters);
        if(count($row) == 0)
            return NULL;
        return $row[0];
    }

    function insert($categoryname, $destination) 
    {
        $database = new Database();
        $parameters = [
            'categoryname' => $categoryname,
            'destination' => $destination,
        ];        
        $sql = 'insert into category (categoryname, destination) values (:categoryname, :destination)';
        return $database->execute($sql, $parameters);
    }

    function update($id, $categoryname , $destination) 
    {
        $database = new Database();
        $parameters = [
            'category_id' => $id,
            'categoryname' => $categoryname,
            'destination' => $destination
        ];        
        $sql = 'update category set categoryname = :categoryname , destination = :destination where category_id = :category_id';
        return $database->execute($sql, $parameters);
    }

    function delete($id) 
    {
        $database = new Database();
        $parameters = [
            'id' => $id,
        ];        
        $sql = 'delete from category where category_id = :id';
        return $database->execute($sql, $parameters);
    }

}