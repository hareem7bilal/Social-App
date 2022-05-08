<style>
    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
    }

    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }
</style>



<?php
$query = "select * from posts";
$result = mysqli_query($con, $query);
$total_posts = mysqli_num_rows($result);
$total_pages = ceil($total_posts / $per_page);
echo "<center><div class='pagination'>";

for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='home.php?page=$i'>$i</a>";
}

echo "</div></center>";
?>