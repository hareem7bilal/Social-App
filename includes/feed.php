<?php include("functions/getPosts.php");?>
<style>
    <?php include("style/feed.css");?>
</style>

<div class="feed">
    <div class="feedWrapper">
        <?php include("share.php");getPosts();?>
    </div>
</div>
