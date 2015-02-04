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
        
        //load the models
        $CI = &get_instance();
        $CI->load->model('orderitems');
        $CI->load->model('menu');
    }

    // add an item to an order
    function add_item($num, $code) 
    {
        
        //get the items on the order
        //
        //if it already exists just increment
        if ( ($item = $this->orderitems->get($num, $code))  != null )
        {
            $item->quantity += 1;
            $this->orderitems->update($item);
        }
        //create a new one if it does not
        else
        {
            $item = $this->orderitems->create();
            $item->quantity = 1;
            $item->order = $num;
            $item->item = $code;
            $this->orderitems->add($item);
        }

        
    }

    // calculate the total for an order
    function total($num)
    {        
        
        //get the order
        $orderItems = $this->orderitems->some('order', $num);
        
        $total = 0.0;
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
