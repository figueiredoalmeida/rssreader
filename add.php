<?php
include_once "header.php";
include_once 'classes/database.php';
include_once 'dbconnection.php';
?>

<div class='right-button-margin'>
    <a href='index.php' class='btn btn-info pull-right'>Feed list</a>
</div>

<?php
if ($_POST){
    include_once 'classes/feed.php';
    $feed = new Feed($db);

    $feed->url = htmlentities(trim($_POST['url']));

    if($feed->add()){ ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Success! Feed is created.
        </div>

    <?php
    }
    else { ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Error! Unable to create feed.
        </div>

    <?php
    }
}
?>

<form action='add.php' role="form" method='post'>
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>URL</td>
            <td><input type='text' name='url'  class='form-control' placeholder="Enter the feed URL" required></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>

    </table>
</form>

<?php
include_once "footer.php";
?>

