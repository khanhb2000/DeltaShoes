<?php

class Order {
    use Model;
    protected $table = 'orderdetail';

    public function get() {
        return $this->select();
    }

    public function edit() {
        if (isset($_GET['id'])) {
            $orderdetail = $this->select(["id" => $_GET['id']])[0];
            $orderitems = $this->query('SELECT products_sku.id AS "id", products.name AS "name", products_sku.size AS "size", products_sku.color AS "color", orderitem.quantity AS "quantity", products_sku.discount_price AS "price", images.name AS "image" FROM orderitem, products_sku, products, images WHERE orderitem.order_id ='. $_GET["id"] .' AND products_sku.id = orderitem.item_id AND products.id = products_sku.product_id AND images.products_id = products.id GROUP BY orderitem.id');
            return ["orderdetail" => $orderdetail, "orderitems" => $orderitems];
        }
        return []; 
    }

    public function getOrderDetailsOfUser($userId) {
        return $this->select(["user_id" => $userId]);
    }

    public function getOrderById($id) {
        return $this->select(["id" => $id])[0];
    }
}