<?php
require_once("layout/header.php");
?>
        <ul>
<?php
foreach ($categories as $category) {
    echo '<li><a href="' . ROOT . '/subcategories/' . $category['category_id'] . '">' . $category['name'] . '</a></li>';
}
?>
        </ul>
        <?php
require_once("layout/footer.php");
?>   