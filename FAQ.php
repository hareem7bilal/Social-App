<html>

<?php
session_start();
include("includes/topbar.php");
if (!isset($_SESSION['email'])) {
    header("location:index.php");
}
?>

<head>

    <title>Utopia FAQ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/FAQ.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".faq-page").click(function() {
                $(this).siblings().slideToggle("slow");
            })
        });
    </script>
</head>

<body>



    <main>
        <div style="flex:6; padding:30px;">
            <h2 class="faq-heading">Commonly Asked Questions</h2>
            <section class="faq-container">
                <div class="faq-one">
                    <h1 class="faq-page">How to share a post?</h1>
                    <div class="faq-body">
                        <p><b>Step 1:</b> Type your post (up to 500 characters) into the compose box at the top of your Home timeline.
                            <br><b>Step 2:</b> You can include photos or a video in your post.
                            <br><b>Step 3:</b> Click the Share button to post to your profile.
                        </p>
                    </div>
                </div>
                <hr class="hr-line">
                <div class="faq-one">
                    <h1 class="faq-page">How to delete a post?</h1>
                    <div class="faq-body">
                        <p><b>Step 1:</b> Visit your <b>Profile</b> page.
                            <br><b>Step 2:</b> Locate the post you want to delete.
                            <br><b>Step 3:</b> Click the drop down menu icon on the top left of the post.
                            <br><b>Step 4:</b> Click delete.
                        </p>
                    </div>
                </div>
                <hr class="hr-line">
                <div class="faq-one">
                    <h1 class="faq-page">What happens to posts I delete?</h1>
                    <div class="faq-body">
                        <p>When you delete a post,
                            it is removed from your account, the timeline of any accounts that follow you, and from Utopia search results.
                            <br>Comments on the posts will also be deleted in the same way.
                        </p>
                    </div>
                </div>
                <div class="faq-one">
                    <h1 class="faq-page">How do I chat with friends?</h1>
                    <div class="faq-body">
                        <p><b>Step 1:</b> Visit your <b>Chat</b> page from the left menu on <b>Home</b> or from the chat icon on the top bar.
                            <br><b>Step 2:</b> Click on the profile of the friend you wish to chat with.
                            <br><b>Step 3:</b> Enter your message in the text box below.
                            <br><b>Step 4:</b> Click send!
                        </p>
                    </div>
                </div>
                <div class="faq-one">
                    <h1 class="faq-page">How do I delete my account?</h1>
                    <div class="faq-body">
                        <p><b>Step 1:</b> Visit the <b>Edit Account</b> page from <b>More</b> in the top bar.
                            <br><b>Step 2:</b> Click on the <b>Delete Account</b> button.
                        </p>
                    </div>
                </div>
            </section>
        </div>
        <div style="flex:6;padding:30px 100px;">
            <h2 class="faq-heading">Ask Us a Question!</h2>
            <form action="mailto:hareem7bilal@gmail.com" method="post" enctype="text/plain">
                <textarea name="question" rows="100">Type your query...</textarea><br><br>
                <input type="submit" value="Send">
                <input type="reset" value="Reset">
            </form>
        </div>
    </main>
</body>


</html>