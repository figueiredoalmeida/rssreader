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
$url = $feed->getFeed();

$entries = array();

$xml = simplexml_load_file($feed->url);
$entries = array_merge($entries, $xml->xpath("//item"));

//Sort feed entries by pubDate
usort($entries, function ($feed1, $feed2) {
    return strtotime($feed2->pubDate) - strtotime($feed1->pubDate);
});
?>

<ul>
    <?php
    foreach($entries as $entry){
        ?>
        <li><a href="<?= $entry->link ?>"><?= $entry->title ?></a> (<?= parse_url($entry->link)['host'] ?>)
        <p><?= strftime('%m/%d/%Y %I:%M %p', strtotime($entry->pubDate)) ?></p>
        <p><?= $entry->description ?></p></li>
        <?php
    } ?>
</ul>
