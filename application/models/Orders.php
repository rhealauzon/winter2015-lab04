<?php

/**
 * Data access wrapper for "orders" table.
 *
 * @author jim
 */
class Orders extends MY_Model {

    // constructor
    function __construct() {
        parent::__construct('orders', 'num');
    }

    // add an item to an order
    function add_item($num, $code) 
    {
        
    }

    // calculate the total for an order
    function total($num)
    {        
        //retrieve the order
        $CI = &get_instance();
        $CI->load->model('orderitems');
        $CI->load->model('menu');
        
        //get the order
        $orderItems = $this->orderitems->some('order', $num);
        
        $total;
        //calculate the total some
        foreach( $orderItems as $item )
        {
           $total += ( $item->quantity * $this->menu->get($item->item )->price );
        }
        
        return $total;
    }

    // retrieve the details for an order
    function details($num) {
        
    }

    // cancel an order
    function flush($num) {
        
    }

    // validate an order
    // it must have at least one item from each category
    function validate($num) {
        return false;
    }

}
