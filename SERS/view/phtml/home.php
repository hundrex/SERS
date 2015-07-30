<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/UserDAL.php');
?>

<?php if (isset($_SESSION['user']) && $_SESSION['user'] !== false): ?>
    <?php
    $error = filter_input(INPUT_GET, 'error', FILTER_SANITIZE_NUMBER_INT);
    ?>

    <?php if ($error !== null && $error === "403"): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> You have not the necessary rights to access this page.
        </div>
    <?php endif; ?>
    <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Info</strong> You have to pay your retry fees! <a href="#">GO</a>
    </div>

    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Warning!</strong> Your email is not activated! <a href="#">Do it</a>
    </div>

    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Warning!</strong> You only have 2 days to pay your fees <a href="#">GO</a>
    </div>
<?php else: ?>
    <?php if (isset($_SESSION['user']) && $_SESSION['user'] === false): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> Your username or your password is invalid.
        </div> 
    <?php endif; ?>
    <div class="col-lg-4 col-md-3"></div>
    <div class="col-lg-4 col-md-6">
        <form method=POST action="./">
            <div class="form-group">
                <label for="pseudo">Pseudo</label>
                <input type="text" class="form-control" id="authentification-pseudo" name="pseudo" required>
            </div>
            <div class="form-group">
                <label for="firstName">Password</label>
                <input type="password" class="form-control" id="authentification-password" name="password" required>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
    <div class="col-lg-4 col-md-3"></div>
<?php
endif;
