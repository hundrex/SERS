<?php if ((isset($_SESSION['user']) && isset($_SESSION['role'])) && $_SESSION['role'] > User::TYPE_USER_TEACHER): ?>
    <META HTTP-EQUIV="Refresh" Content="0; URL=./?error=403">
<?php else: ?>
<script type="text/javascript" src="./view/javascript/report_c.js"></script>

<div class="row filter-bar">
    <div class="col-lg-12">
        <button type="button" class="btn btn-default btn-right hidden"><span class="glyphicon glyphicon-print"></span></button>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Graph</h3>
    </div>
    <div class="panel-body">
        <div id="report_c-container" class="report-40">
            
        </div>
    </div>
</div>
<?php endif;?>