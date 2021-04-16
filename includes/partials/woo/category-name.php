<?php
$category_name = $wp_query->get_queried_object()->name;

if ($category_name == "product"){
    ?>
    <h2 class="category_name">Produkty</h2>
    <?php
}else{
    ?>
    <h3 class="size-x3 bold category_name"><?php echo $category_name; ?></h3>
    <?php
}

?>