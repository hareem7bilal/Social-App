<style>
  <?php include("style/leftbar.css"); ?>
</style>

<?php include("functions/get_friends.php"); ?>
<?php include("functions/get_birthdays.php"); ?>

<div class="leftbar">
  <div class="leftbarWrapper">
    <ul class="leftbarList">

      <a href='messages.php?user_id=new'>
        <li class="leftbarListItem">
          <i class="bi bi-chat-left-dots-fill" style="font-size:23px"></i>&nbsp;&nbsp;&nbsp;
          <span class="leftbarListItemText">Chat</span>
        </li>
      </a>

      <a href='about_us.php'>
        <li class="leftbarListItem">
          <i class="bi bi-info-circle-fill" style="font-size:23px"></i>&nbsp;&nbsp;&nbsp;
          <span class="leftbarListItemText">About Us</span>
        </li>
      </a>

      <a href='about_us.php'>
        <li class="leftbarListItem">
          <i class="bi bi-question-octagon" style="font-size:23px"></i>&nbsp;&nbsp;&nbsp;
          <span class="leftbarListItemText">FAQ</span>
        </li>
      </a>
      
    </ul>

    <hr class="leftbarLine" />

    <div class="birthdayContainer">
      <img src="images/gift.png" alt="bday pic" class="birthdayImg" />
      <?php get_birthdays() ?>
     
    </div>
    <hr class="leftbarLine" />
    <h4 class="leftbarTitle">Friends</h4>
    <ul class="leftbarFriendList">
    <?php get_current_user_friends() ?>
    </ul>
  </div>
</div>