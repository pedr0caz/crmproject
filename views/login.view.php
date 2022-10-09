<?php
require_once("layout/header.php");
?>
<h1><?= $title; ?></h1>
<?php
if (isset($error_message)) {
    echo '<p role="alert">' . $error_message . '</p>';
}

?>

<p>Se ainda não tiver conta <a href="<?= ROOT; ?>/register">clique aqui</a></p>
<form action="<?= ROOT; ?>/login" method="post">
    <div>
        <label for="">
            Email
            <input type="email" name="email" required>
        </label>
        
    </div>
    <div>
        <label for="">
            Password
            <input type="password" name="password" required>
        </label>
      
    </div>
    <button type="submit" name="send">Login</button>
</form>
<?php
require_once("layout/footer.php");
?>   