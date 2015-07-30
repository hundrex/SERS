<?php
$payment_verify = filter_input(INPUT_GET, 'payment_confirm', FILTER_SANITIZE_NUMBER_INT);
?>

<?php if ($payment_verify == 1) {
    ?>
    
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Your payment is confirmed.</strong> 
</div>

<?php } ?>
            
<div class="panel panel-default">
    <div class="panel-heading">Web development</div>
    <div class="panel-body">
        <ul class="list-unstyled">
            <li>
                <dl class="dl-horizontal">
                    <dt>Exam: </dt>
                    <dd class="panel-mark"> £ 10 </dd>
                </dl>
            </li>
        </ul>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Web Development Frameworks</div>
    <div class="panel-body">
        <ul class="list-unstyled">
            <li>
                <dl class="dl-horizontal">
                    <dt>Assignment: </dt>
                    <dd class="panel-mark"> £ 10 </dd>
                </dl>
            </li>
        </ul>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Total</div>
    <div class="panel-body">
        <ul class="list-unstyled">
            <li>
                <dl class="dl-horizontal">
                    <dt>Total price: </dt>
                    <dd class="panel-mark"> £ 20 </dd>
                </dl>
            </li>
            <li>
                <dl class="dl-horizontal">
                    <dt>VAT: </dt>
                    <dd class="panel-mark"> 20% </dd>
                </dl>
            </li>
            <li>
                <dl class="dl-horizontal">
                    <dt>Final price: </dt>
                    <dd class="panel-mark"> £ 24 </dd>
                </dl>
            </li>
        </ul>
    </div>
</div>

<form method=POST action="./?page=pay_fees&payment_confirm=1">
    <button type="submit" class="btn btn-default">Pay</button>
</form>