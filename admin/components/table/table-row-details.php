<?php

function booking_details($id) {
    $subscription = $this->get_subscription($id);
    
    $datetime_array = datetime_array($created_at);
    $date = $datetime_array['date'];
    $time = $datetime_array['time'];

    $subscStr = "
    <div class='card flex-fill'>
        <ul class ='list-group subscription'>
            <li class ='li-group-item'>
                <div><strong>Id</strong></div>
                <div>{$subscription_id}</div>
            </li>
            <li class ='li-group-item'>
                <div><strong>Name</strong></div>
                <div>{$customer_firstname} {$customer_lastname}</div>
            </li>
        </ul>
    </div>";
    echo $subscStr;
}

function booking_details_2($id) {
    $booking = $this->get_booking($id)[0];

    $services_adons = $this->get_services_by_booking($id);

    $list = "";
    
    $total = 0;

    // Payment
    $payment = $this->get_payment_by_booking_id($id);
    $payment_list = "";
    if(count($payment) > 0) {
        $payment = $payment[0];
        // var_dump($payment);
        $amount = $payment['amount'] / 100;
        $created = unix_to_datetime($payment['created']);
        $payment_list .= "<ul class='product-primary details-list-50'>
            <li class='li-group-item'>
                <div><strong>Id</strong></div>
                <div>{$payment['id']}</div>
            </li>
            <li class='li-group-item'>
                <div><strong>Status</strong></div>
                <div>{$payment['status']}</div>
            </li>
            <li class='li-group-item'>
                <div><strong>Amount</strong></div>
                <div>{$amount} {$payment['currency']}</div>
            </li>
            <li class='li-group-item'>
                <div><strong>Created</strong></div>
                <div>{$created}</div>
            </li>
        </ul>";
    }
    // $payment['payment_intent_id']}

    // Tips
    $tips = $this->get_tips_by_booking_id($id);

    $tip_str = "";
    if(count($tips) > 0) {
        $tip_str .= "<div class='details-column details-column-100'>      
            <div class='card flex-fill'>
                <div class='card-header'>
                    <div class='card-title'>
                        Tip
                    </div>
                </div>";
        foreach ($tips as $tip) {
            $tip_amount = $tip['amount'] / 100;
            $tip_str .= "<ul class='product-primary details-list-50'>
                <li class='li-group-item'>
                    <div><strong>Id</strong></div>
                    <div>{$tip['id']}</div>
                </li>
                <li class='li-group-item'>
                    <div><strong>Status</strong></div>
                    <div>{$tip['status']}</div>
                </li>
                <li class='li-group-item'>
                    <div><strong>Amount</strong></div>
                    <div>{$tip_amount} {$tip['currency']}</div>
                </li>
                <li class='li-group-item'>
                    <div><strong>Created</strong></div>
                    <div>{$created}</div>
                </li>
            </ul>";
        }
        $tip_str .= "</div>
        </div>";
    }

    
                

    
    foreach($services_adons as $service) {
        // Product price
        $total += number_format($service['price'], 2);


        $list .= "<div class='product-group' style='margin-bottom: 30px;'>";

        $list .= "<ul class ='product-primary details-list-50'>
            <li class ='li-group-item'>
                <div><strong>Service</strong></div>
                <div>{$service['name']}</div>
            </li>
            <li class ='li-group-item'>
                <div><strong>Price</strong></div>
                <div>{$service['price']}</div>
            </li>
        </ul>";

        $list .= "<ul class='product-secondary details-list-50'>";
        
        foreach($service['adons'] as $adon) {
            // Add on price
            $total += number_format($adon['price'], 2) * $adon['qty'];

            $list .= "<li class ='li-group-item'>
                <div><strong>Add On</strong></div>
                <div>{$adon['name']}</div>
            </li>
            <li class ='li-group-item'>
                <div><strong>Price</strong></div>
                <div>{$adon['price']}</div>
            </li>
            <li class ='li-group-item'>
                <div><strong>Quantity</strong></div>
                <div>{$adon['qty']}</div>
            </li>";
        }
        
        $list .=  "</ul>
        </div>";
    }
    
    $datetime_array = datetime_array($booking['created_at']);
    $date = $datetime_array['date'];
    $time = $datetime_array['time'];


    $datetime_array2 = datetime_array($booking['booking_datetime']);
    $booking_date = $datetime_array2['date'];
    $booking_time = $datetime_array2['time'];

    $subscStr = "<div class='details-wrapper' id='{$booking['booking_id']}'>
        <div class='details-row' id='{$booking['booking_id']}'>
            <div class='details-column'>
                <div class='card flex-fill'>
                    <div class='card-header'>
                        <div class='card-title'>
                            Booking Details
                        </div>
                    </div>
                    <ul class ='list-group details-list'>
                        <li class ='li-group-item'>
                            <div><strong>Name</strong></div>
                            <div>{$booking['firstname']} {$booking['lastname']}</div>
                        </li>
                        <li class ='li-group-item'>
                            <div><strong>Email</strong></div>
                            <div>{$booking['email']}</div>
                        </li>
                        <li class ='li-group-item'>
                            <div><strong>Phone</strong></div>
                            <div>{$booking['phone']}</div>
                        </li>
                        <li class ='li-group-item'>
                            <div><strong>Date</strong></div>
                            <div>{$booking_date}</div>
                        </li>
                        <li class ='li-group-item'>
                            <div><strong>Time</strong></div>
                            <div>{$booking_time}</div>
                        </li>
                        <li class ='li-group-item'>
                            <div><strong>Status</strong></div>
                            <div>{$booking['booking_status']}</div>
                        </li>
                        <li class ='li-group-item'>
                            <div><strong>Booking Code</strong></div>
                            <div>{$booking['booking_code']}</div>
                        </li>
                        <li class ='li-group-item'>
                            <div><strong>Marketing</strong></div>
                            <div>{$booking['recieve_marketing']}</div>
                        </li>
                        <li class ='li-group-item'>
                            <div><strong>Created</strong></div>
                            <div>{$date} {$time}</div>
                        </li>
                        <li class ='li-group-item'>
                            <div><strong>Total</strong></div>
                            <div>{$total} GBP</div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class='details-column'>
                <div class='card flex-fill'>
                    <div class='card-header'>
                        <div class='card-title'>
                            Address
                        </div>
                    </div>
                    <ul class ='list-group details-list'>
                        <li class ='li-group-item'>
                            <div><strong>Line 1</strong></div>
                            <div>{$booking['addrs']}</div>
                        </li>
                        <li class ='li-group-item'>
                            <div><strong>Line 2</strong></div>
                            <div>{$booking['address_details']}</div>
                        </li>
                        <li class ='li-group-item'>
                            <div><strong>Postal Code</strong></div>
                            <div>{$booking['postcode']}</div>
                        </li>
                        
                    </ul>
                </div>
            </div>


            <div class='details-column details-column-100'>
                
                <div class='card flex-fill'>
                    <div class='card-header'>
                        <div class='card-title'>
                            Services & Add Ons
                        </div>
                    </div>
                    $list
                </div>

            </div>

            <div class='details-column details-column-100'>
                
                <div class='card flex-fill'>
                    <div class='card-header'>
                        <div class='card-title'>
                            Payment
                        </div>
                    </div>
                    $payment_list
                </div>

            </div>

            $tip_str



        </div>
    </div>";
    echo $subscStr;
}


?>