<?php

class Product {
    use Model;
    protected $table = 'products';

    public function add() {
        $categories = $this->query("SELECT * FROM categories");
        $sub_categories = $this->query("SELECT * FROM sub_categories");
        return ["categories" => $categories, "sub_categories" => $sub_categories];
    }


    public function edit() {
        if (isset($_GET['id'])) {
            $categories = $this->query("SELECT * FROM categories");
            $sub_categories = $this->query("SELECT * FROM sub_categories");
            $images = $this->query("SELECT * FROM images where products_id = ".$_GET['id']);
            $products = $this->select(['id' => $_GET['id']])[0];
            $products_sku = $this->query("SELECT * FROM products_sku WHERE products_sku.product_id = ".$_GET['id']);
            $colors = $this->query("SELECT DISTINCT color FROM products_sku WHERE products_sku.product_id = ".$_GET['id']);
            return ["categories" => $categories, "sub_categories" => $sub_categories, "images" => $images, "product" => $products, "products_sku" => $products_sku, "colors" => $colors];
        }
        return []; 
    }

    public function search($key) {
        $query = "SELECT products.id, products.name, products.categories_id, categories.name AS 'category', products.sub_categories_id, sub_categories.name AS 'sub_category', 
        color, discount_price, price, in_stock, size, images.name AS 'image' FROM products 
        LEFT JOIN products_sku ON products_sku.product_id=products.id 
        LEFT JOIN images ON images.products_id = products.id
        LEFT JOIN categories ON categories.id = products.categories_id
        LEFT JOIN sub_categories ON sub_categories.id = products.sub_categories_id
        WHERE products.name LIKE '%". $key ."%' OR products.brand LIKE '%".$key."%' OR categories.name LIKE '%". $key ."%' OR sub_categories.name LIKE '%".$key."%' GROUP BY products.id";
        $data = $this->query($query);
        return $data;
    }
}