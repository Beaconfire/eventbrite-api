<?php

class Eventbrite_Ticket_Class
{

    public $name;

    public $description;

    public $quantity_total;

    public $cost;

    public $donation;

    public $free;

    public $include_fee;

    public $split_fee;

    public $hide_description;

    public $sales_channels;

    public $sales_start;

    public $sales_end;

    public $sales_start_after;

    public $minimum_quantity;

    public $maximum_quantity;

    public $auto_hide;

    public $auto_hide_before;

    public $auto_hide_after;

    public $hidden;

    public $order_confirmation_message;

    function __construct($params = array())
    {
        if(!empty($params)){
            foreach($params as $key => $val){
                if(property_exists($this, $key)){
                    $this->{$key} = $val;
                }
            }
        }
    }

    /**
     * create array to pass to EventBrite.
     *
     * @access public
     *
     * @return array.
     */
    public function createRequestFormat(){
        $aryReturn = [];
        foreach(get_object_vars($this) as $key => $val){
            $aryReturn['ticket_class.'.$key] = $val;
        }
        return $aryReturn;
    }

}