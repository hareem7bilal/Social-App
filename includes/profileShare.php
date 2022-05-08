<?php include("functions/profile_createPost.php"); ?>
<style>
    <?php include("style/share.css"); ?>
</style>

<form class="share" method="post" enctype="multipart/form-data" style="height:150px">
    <div class="shareWrapper">
        <div class="shareTop">
            <a href='profile.php'><img src=<?php echo "'$profile_pic'" ?> alt="profile pic" class="shareProfileImg" /></a>
            <div id="shareInput">
                <textarea style="display:none;" class="sharetextarea" id="sharearea" placeholder="What's on your mind, <?php echo "$first_name" ?>?" name="postText"></textarea>
            </div>
        </div>
        <hr class="shareLine" />


        <script>
            $(document).ready(function() {
                $('#sharearea').emojioneArea({
                    pickerPosition: "bottom"
                });

            });

            var loadFile = function(event) {
                $(".shareLine").after(" <div class='shareImgContainer'><img id='preview' class='shareImg' /><i class='bi bi-x-circle-fill' id='cancelImg' onclick='cancel(event)'></i></div>");
                var previewImg = document.getElementById('preview');
                previewImg.src = URL.createObjectURL(event.target.files[0]);
                $(".share").height("675px");
            };
            var cancel = function(event) {
                var previewImg = document.getElementById('preview');
                URL.revokeObjectURL(previewImg.src);
                $(".shareImgContainer").remove();
                $(".share").height("150px");
            };
        </script>

        <div class="shareBottom">
            <div class="shareOptions">
                <label htmlFor="file" class="shareOption">
                    <i class="bi bi-image" style="color:tomato" id="shareIcon"></i>
                    <span class="shareOptionText">Photo/Video</span>
                    <input type="file" onchange="loadFile(event)" style='display:none' id="file" accept=".png,.jpeg,jpg" size="30" name="postImg" />
                </label>
                <div class="shareOption">
                    <i class="bi bi-tag-fill" style="color:DodgerBlue" id="shareIcon"></i>
                    <span class="shareOptionText">Tag</span>
                </div>
                <div class="shareOption">
                    <i class="bi bi-geo-alt-fill" style="color:green" id="shareIcon"></i>
                    <span class="shareOptionText">Location</span>
                </div>
                <div class="shareOption">
                    <i class="bi bi-emoji-smile-fill" style="color:goldenrod" id="shareIcon"></i>
                    <span class="shareOptionText">Feelings</span>
                </div>
            </div>
            <button class="btn btn-success" id="shareButton" type="submit" name="share" onclick="cancel(event)">Share</button>
        </div>
    </div>
</form>
<?php
if (isset($_POST['share'])) {
    profile_createPost();
}

?>