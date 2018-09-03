<?php
include_once "header.php";
include_once 'classes/database.php';
include_once 'classes/feed.php';
include_once 'dbconnection.php';
?>

<div class='right-button-margin'>
    <a href='index.php' class='btn btn-info pull-right'>Feed list</a>
</div>

<?php
$id = isset($_GET['id']) ? $_GET['id'] : die('ID not found!');


$feed = new Feed($db);
$feed->id = $id;
$feed->getFeed();


if($_POST) {

    $feed->url = htmlentities(trim($_POST['url']));

    if($feed->update()) { ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Success! Feed is edited.
        </div>
    <?php
    }
    else { ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Error! Unable to edit feed.
        </div>
    <?php
    }
}
?>

<form action='edit.php?id=<?php echo $id;?>' method='post'>
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>URL</td>
            <td><input type='text' name='url' value='<?php echo $feed->url;?>' class='form-control' placeholder="Enter the feed URL" required></td>
        </tr>

        <tr>
            <td>&nbsp;</td>
            <td>
                <button type="submit" class="btn btn-success">Update</button>
            </td>
        </tr>

    </table>
</form>

<?php
include_once "footer.php";
?>
