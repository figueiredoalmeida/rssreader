<?php
include_once 'header.php';
include_once 'classes/database.php';
include_once 'classes/feed.php';
include_once 'dbconnection.php';
?>

<div class='right-button-margin'>
    <a href='index.php' class='btn btn-info pull-right'>Feed list</a>
</div>

<?php
$id = isset($_GET['id']) ? $_GET['id'] : die('ID not found!');

if ($id != 'deleted') {
    $feed = new Feed($db);
    $feed->delete($id);
    header('Location: delete.php?id=deleted');
}

if ($id = 'deleted') { ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Success! Feed is deleted.
    </div>

<?php
}

include_once 'footer.php';
