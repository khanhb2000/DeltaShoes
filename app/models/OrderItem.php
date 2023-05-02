<?php

class OrderItem {
    use Model;
    protected $table = 'orderitem';

    public function get() {
        return $this->select();
    }


    public function getOrderItemsByOrderId($orderId) {
       $sql = "SELECT products_sku.color, products.id as product_id, products.name, orderitem.order_id, orderitem.item_id, orderitem.quantity, orderitem.price_per_unit from orderitem inner join (products, products_sku) on orderitem.item_id=products_sku.id and products_sku.product_id = products.id where orderitem.order_id='$orderId'"; 
       return $this->query($sql);
    }
}