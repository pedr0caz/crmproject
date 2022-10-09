<?php
require_once("layout/header.php");
?>
<h1><?= $title; ?></h1>

<?php
if (isset($error_message)) {
    echo '<p role="alert">' . $error_message . '</p>';
}

?>
<p>Se já tiver conta <a href="<?= ROOT; ?>/login">clique aqui</a></p>
<form action="<?= ROOT; ?>/register" method="post">
    <div>
        <label>
            Nome Completo
            <input type="text" name="name" minlength="3" maxlength="64" required>
        </label>
    </div>
    <div>
        <label>
            Email
            <input type="text" name="email" required>
        </label>
        
    </div>
    <div>
        <label>
            Password
            <input type="password" name="password" minlength="8" maxlength="1000" required>
        </label>
      
    </div>
    <div>
        <label>
            Confirmar password
            <input type="password" name="password_repeated" minlength="8" maxlength="1000" required>
        </label>
      
    </div>
    <div>
        <label>
            Morada
            <input type="text" name="street" minlength="8" maxlength="120" required>
        </label>
        
    </div>
    <div>
        <label>
            Código Postal
            <input type="text" name="postal_code" minlength="4" maxlength="32" required>
        </label>
        
    </div>
    <div>
        <label>
            Cidade
            <input type="text" name="city" minlength="3" maxlength="32" required>
        </label>
        
    </div>
    <div>
        <label>
            País
            <select name="country">
                <?php foreach ($countries as $country) {
    echo ' <option value="' . $country["code"] . '">' . $country["name"] . '</option>';
}?>
            </select>
        </label>
        
    </div>
   
    <button type="submit" name="send">Registar</button>
</form>
<?php
require_once("layout/footer.php");
?>   