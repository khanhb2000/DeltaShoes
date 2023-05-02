<?php

class Shoes {
    use Model;

    /*public function connect_() {
        $this->connect();
    }*/

    public function query_($query, $data = [])
    {
        return $this->query($query, $data);
    }

    public function getAllShoes() {
        //$this->connect_();
        $array = $this->query("SELECT * from products JOIN products_sku on products_sku.product_id = products.id");
        return $array;
    }

    
    public function getDetailShoes($productId){
        //$this->connect_();
        $query =  "SELECT products.id as id,price, discount_price, brand, products.name as name, image1, description, categories.name as category FROM products JOIN (products_sku,categories) on (products_sku.product_id = products.id and products.categories_id = categories.id) WHERE products.id = ";
        $query .= $productId;
        $array = $this->query($query);
        return $array;
    }


}