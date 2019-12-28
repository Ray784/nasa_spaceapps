<?php
    if(isset($_SESSION['nasa']))
    {
        $userLoggedIn=$_SESSION['nasa'];
        $misc_details_query = mysqli_query($connection, "SELECT value FROM `checklist` WHERE type='misc'");
        $user_details_query = mysqli_query($connection, "SELECT value FROM `checklist` WHERE type='$userLoggedIn'");
        $user = mysqli_fetch_array($user_details_query);
        $user=explode(',',$user['value']);
        $misc = mysqli_fetch_array($misc_details_query);
        $misc=explode(',',$misc['value']);
        $checklist = array_merge($user,$misc);
     }
     else
     {
         header("location:login.php");
     }
?>
<div class="col-md-8 col-xs-8 col-sm-8 col-lg-8">
    <form>
    <?php
    for($x=1;$x<count($checklist);$x++){
    ?>
            <label><input type="checkbox" value=""><?php echo $checklist[$x].'<br>'."\t\t\t"?></label>
  <?php
    }
    ?>
    </form>
</div>