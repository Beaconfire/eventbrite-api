<?php

class Eventbrite_Webhook
{

    public $endpoint_url;

    public $actions;

    public $event_id;

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

    function addAllActions(){
        $actions = [
            'attendee.checked_in', //Triggered when an attendee’s barcode is scanned in.
            'attendee.checked_out', //Triggered when an attendee’s barcode is scanned out.
            'attendee.updated', //Triggered when attendee data is updated.
            'event.created', //Triggered when an event is initially created.
            'event.published', //Triggered when an event is published and made live.
            'event.updated', //Triggered when event data is updated.
            'event.unpublished', //Triggered when an event is unpublished.
            'order.placed', //Triggers when an order is placed for an event. Generated Webhook’s API endpoint is to the Order endpoint.
            'order.refunded', //Triggers when an order is refunded for an event.
            'order.updated', //Triggers when order data is updated for an event.
            'organizer.updated', //Triggers when organizer data is updated.
            'ticket_class.created', //Triggers when a ticket class is created.
            'ticket_class.deleted', //Triggers when a ticket class is deleted.
            'ticket_class.updated', //Triggers when a ticket class is updated.
            'venue.updated', //Triggers when venue data is updated.
        ];
        $this->actions = implode(',', $actions);
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
            $aryReturn[$key] = $val;
        }
        return $aryReturn;
    }

}