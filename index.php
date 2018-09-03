<?php
include_once "header.php";
include_once 'classes/database.php';
include_once 'classes/feed.php';
include_once 'dbconnection.php';
?>

<div class='right-button-margin'>
    <a href='add.php' class='btn btn-primary pull-right'>Add content</a>
</div>

<?php
$feed = new Feed($db);
$statement = $feed->getAllFeeds();
$num = $statement->rowCount();

// if any result, display it!
if($num > 0) { ?>

    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <th>Feeds</th>
            <th>Actions</th>
        </tr>

        <?php
        // displaying all results
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            extract($row); ?>

            <tr>
                <td><?=$row['url'];?></td>
                <td>
                    <a href='view.php?id=<?=$id?>' class='btn btn-info left-margin'>View</a>
                    <a href='edit.php?id=<?=$id?>' class='btn btn-warning left-margin'>Edit</a>
                    <a href='delete.php?id=<?=$id?>' class='btn btn-danger delete-object'>Delete</a>
                </td>
            </tr>

        <?php
        } ?>

    </table>

<?php
}

else {

    echo "<div>No feeds found.</div>";
}

include_once "footer.php";
