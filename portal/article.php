<?php

include './header.php';

if (isset($_GET['create'])) {
	$hForm -> articleForm();
}

if (isset($_GET['delete'])) {
	mysqli_query($GLOBALS['conn'], "DELETE FROM harticles WHERE id=".$_GET['delete']."");
	$hArticle -> getArticles();
}

if(isset($_GET['view'])){
	if ($_GET['view'] == "list") {
		if(isset($_GET['type'])) {
			$hArticle -> getArticlesType($_GET['type']);
		} else {
			$hArticle -> getArticles();
		}
	} else {
		$hArticle -> getArticleCode($_GET['view']);
	}

}

if (isset($_POST['create'])) {
	$date = date("YmdHms");
    if (isset($_SESSION['myEmail'])) {
      $email = $_SESSION['myEmail'];
    } else {
      $email = hEMAIL;
    }

    $h_alias = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_alias']); 
    $h_author = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_author']); 
    $h_avatar = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_avatar']); 
    $h_category = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_category']); 
    $h_center = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_center']);
    $h_key = str_shuffle(md5($email.$date));
    $h_code = substr($h_key, rand(0, 15), 16); 
    $h_created = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_created']); 
    $h_custom = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_custom']); 
    $h_desc = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_desc']); 
    $h_email = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_email']); 
    $h_fav = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_fav']); 
    $h_level = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_level']); 
    $h_link = hPORTAL."article?view=$h_key&action=view"; 
    $h_location = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_location']); 
    $h_notes = substr($h_desc, 250); 
    $h_phone = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_phone']); 
    $h_reading = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_reading']); 
    $h_status = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_status']); 
    $h_style = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_style']); 
    $h_subtitle = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_subtitle']); 
    $h_tags = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_tags']); 
    $h_type = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_type']); 

    $createArticle = "INSERT INTO harticles (h_alias, h_author, h_avatar, h_category, h_center, h_code, h_created, h_custom, h_description, h_email, h_fav, h_key, h_level, h_link, h_location, h_notes, h_phone, h_reading, h_status, h_style, h_subtitle, h_tags, h_text, h_type) 
      VALUES ('".$h_alias."', '".$h_author."', '".$h_avatar."', '".$h_category."', '".$h_center."', '".$h_code."', '".$h_created."', '".$h_custom."', '".$h_desc."', '".$h_email."', '".$h_fav."', '".$h_key."', '".$h_level."', '".$h_link."', '".$h_location."', '".$h_notes."', '".$h_phone."', '".$h_reading."', '".$h_status."', '".$h_style."', '".$h_subtitle."', '".$h_tags."', '".$h_type."')";
    if ( mysqli_query( $GLOBALS['conn'], $createArticle ) ) {
      echo "<script type = \"text/javascript\">
                      alert(\"Article Created Successfully!\");
                  </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['update'])) {
	$hArticle -> loginArticle();
}

if (isset($_POST['confirm'])) {
	$hArticle -> confirmArticle();
} 
if (isset($_POST['logout'])) {
	$hArticle -> logoutArticle();
}

if (isset($_POST['forgot'])) {
	$hArticle -> forgotPass();
} 

if (isset($_POST['reset'])) {
	$hArticle -> resetPass();
}
?>
<div class="card__share">
    <div class="card__social ">  
        <a class="share-icon email" href="#"><i class="mdi mdi-account-plus"></i></a>

        <a class="share-icon email" href="#"><i class="mdi mdi-city"></i></a>

        <a class="share-icon email" href="mailto:sample@email.com" data-rel="external"><i class="mdi mdi-eye"></i></a>
    </div>

    <a id="share" class="addfab share-toggle share-icon mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" href="#"><i class="material-icons">add</i></a>
</div>

<?php
include './footer.php';
