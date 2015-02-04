<?php

/**
 * Order handler
 * 
 * Implement the different order handling usecases.
 * 
 * controllers/welcome.php
 *
 * ------------------------------------------------------------------------
 */
class Order extends Application {

    function __construct() {
        parent::__construct();
    }

    // start a new order
    function neworder() 
    {
        //get the next order number
        $order_num = $this->orders->highest() + 1;
        
        //create a new blank order
        $new_order = $this->orders->create();
        
        //update the properties
        $new_order->num = $order_num;
        $new_order->date = date( " F j, Y, g:i a");
        $new_order->status = 'a';
        
        $this->orders->add($new_order);
        

        redirect('/order/display_menu/' . $order_num);
    }

    // add to an order
    function display_menu($order_num = null) {
        if ($order_num == null)
        {
            redirect('/order/neworder');
        }

        $this->data['pagebody'] = 'show_menu';
        $this->data['order_num'] = $order_num;
        
        //Retrieve the order data
        $order = $this->orders->get($order_num);       

        $this->data['title'] = $order_num;
        
        
        
        // Make the columns
        $this->data['meals'] = $this->make_column('m');
        $this->data['drinks'] = $this->make_column('d');
        $this->data['sweets'] = $this->make_column('s');

        $this->render();
    }

    // make a menu ordering column
    function make_column($category)
    {
        $items = $this->menu->some('category', $category);        
        return $items;
    }

    // add an item to an order
    function add($order_num, $item) {
        //FIXME
        redirect('/order/display_menu/' . $order_num);
    }

    // checkout
    function checkout($order_num) {
        $this->data['title'] = 'Checking Out';
        $this->data['pagebody'] = 'show_order';
        $this->data['order_num'] = $order_num;
        //FIXME

        $this->render();
    }

    // proceed with checkout
    function proceed($order_num) {
        //FIXME
        redirect('/');
    }

    // cancel the order
    function cancel($order_num) {
        //FIXME
        redirect('/');
    }

}
