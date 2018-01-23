<?php

class Eventbrite_Webhook
{

    public $endpoint_url;

    private $actions = [];

    private $availableActions;

    public $event_id;

    // webhook events
    const EVENT_ATTENDEE_CHECKIN = 'attendee.checked_in';
    const EVENT_ATTENDEE_CHECKOUT = 'attendee.checked_out';
    const EVENT_ATTENDEE_UPDATED = 'attendee.updated';
    const EVENT_EVENT_CREATED = 'event.created';
    const EVENT_EVENT_PUBLISHED = 'event.published';
    const EVENT_EVENT_UPDATED = 'event.updated';
    const EVENT_EVENT_UNPUBLISHED = 'event.unpublished';
    const EVENT_ORDER_PLACED = 'order.placed';
    const EVENT_ORDER_REFUNDED = 'order.refunded';
    const EVENT_ORDER_UPDATED = 'order.updated';
    const EVENT_ORGANIZER_UPDATED = 'organizer.updated';
    const EVENT_TICKET_CLASS_CREATED = 'ticket_class.created';
    const EVENT_TICKET_CLASS_DELETED = 'ticket_class.deleted';
    const EVENT_TICKET_CLASS_UPDATED = 'ticket_class.updated';
    const EVENT_VENUE_UPDATED = 'venue.updated';

    function __construct($params = array())
    {
        $this->availableActions = [
            self::EVENT_ATTENDEE_CHECKIN, //Triggered when an attendee’s barcode is scanned in.
            self::EVENT_ATTENDEE_CHECKOUT, //Triggered when an attendee’s barcode is scanned out.
            self::EVENT_ATTENDEE_UPDATED, //Triggered when attendee data is updated.
            self::EVENT_EVENT_CREATED, //Triggered when an event is initially created.
            self::EVENT_EVENT_PUBLISHED, //Triggered when an event is published and made live.
            self::EVENT_EVENT_UPDATED, //Triggered when event data is updated.
            self::EVENT_EVENT_UNPUBLISHED, //Triggered when an event is unpublished.
            self::EVENT_ORDER_PLACED, //Triggers when an order is placed for an event. Generated Webhook’s API endpoint is to the Order endpoint.
            self::EVENT_ORDER_REFUNDED, //Triggers when an order is refunded for an event.
            self::EVENT_ORDER_UPDATED, //Triggers when order data is updated for an event.
            self::EVENT_ORGANIZER_UPDATED, //Triggers when organizer data is updated.
            self::EVENT_TICKET_CLASS_CREATED, //Triggers when a ticket class is created.
            self::EVENT_TICKET_CLASS_DELETED, //Triggers when a ticket class is deleted.
            self::EVENT_TICKET_CLASS_UPDATED, //Triggers when a ticket class is updated.
            self::EVENT_VENUE_UPDATED, //Triggers when venue data is updated.
        ];
        if(!empty($params)){
            foreach($params as $key => $val){
                if(property_exists($this, $key)){
                    $this->{$key} = $val;
                }
            }
        }
    }

    function addAction($action){
        if(in_array($this->availableActions, $action)){
            $this->actions[] = $action;
        }
    }

    function addActions(array $aryActions){
        foreach($aryActions as $action){
            $this->addAction($action);
        }
    }

    function addAllActions(){
        $this->actions = $this->availableActions;
    }

    /**
     * create array to pass to EventBrite.
     *
     * @access public
     *
     * @return array.
     */
    public function createRequestFormat(){;
        $aryReturn = [
            'endpoint_url' => $this->endpoint_url,
            'actions' => implode(',',$this->actions),
            'event_id' => $this->event_id
        ];
        return $aryReturn;
    }

}