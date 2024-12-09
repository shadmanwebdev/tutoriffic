<style>
    .card {
        max-width: 900px;
        box-shadow: none;
        padding: 50px;
        margin: 50px auto;
    }
    .card-header {
        padding: 10px 0;
    }
    .card-title {
        font-size: 16px;
        margin-bottom: 20px;
    }
    ul.subscription {
        width: 100%;
        list-style: none;
    }
    ul.subscription li {
        font-size: 16px;
        margin-bottom: 25px;
    }
    ul.subscription li div:first-child {
        margin-bottom: 5px;
    }
    @media screen and (max-width: 900px) {
        .card {
            max-width: 95%;
            box-shadow: none;
            padding: 30px;
            margin: 30px auto;
        }
    }
</style>


<div class='card flex-fill'>
    <ul class ='list-group subscription'>
        <li class ='list-group-item'>
            <div><strong>Id</strong></div>
            <div>{$subscription_id}</div>
        </li>
        <li class ='list-group-item'>
            <div><strong>Name</strong></div>
            <div>{$customer_firstname} {$customer_lastname}</div>
        </li>
        <li class ='list-group-item'>
            <div><strong>Email</strong></div>
            <div>{$customer_email}</div>
        </li>
        <li class ='list-group-item'>
            <div><strong>Reference Id</strong></div>
            <div>{$refId}</div>
        </li>
        <li class ='list-group-item'>
            <div><strong>Name</strong></div>
            <div>{$payment_name}</div>
        </li>
        <li class ='list-group-item'>
            <div><strong>Description</strong></div>
            <div>{$payment_description}</div>
        </li>
        <li class ='list-group-item'>
            <div><strong>Amount</strong></div>
            <div>{$payment_amount}</div>
        </li>
        <li class ='list-group-item'>
            <div><strong>Duration</strong></div>
            <div>{$payment_length} {$payment_unit}</div>
        </li>
        <li class ='list-group-item'>
            <div><strong>Status</strong></div>
            <div>{$payment_status}</div>
        </li>
        <li class ='list-group-item'>
            <div><strong>User Id</strong></div>
            <div>{$payer_uid}</div>
        </li>
        <li class ='list-group-item'>
            <div><strong>Created</strong></div>
            <div>{$date} {$time}</div>
        </li>
    </ul>
</div>