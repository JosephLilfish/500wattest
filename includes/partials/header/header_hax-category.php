<?php

$args = array(
    'orderby'    => 'menu_order',
    'order'      => 'ASC',
    'hide_empty' =>1,
    'parent'    => 0,
);
$categories = get_terms( 'product_cat', $args);
$term_id_body = get_queried_object()->term_id;
?>
<ul class="head_cat_main_ul">

    <?php
        foreach ($categories as $cat){
    ?>
            <?php
                $term_id = $cat -> term_id;
                $link = get_term_link( $cat->term_id, 'product_cat' );

                if ($term_id_body == $term_id){?>
                    <li class="main_li_uh active_cat">     
                <?php } else {?>
                    <li class="main_li_uh">
                <?php } ?>
            
            
                    <a href="<?php echo $link; ?>"><?php echo $cat -> name ?> </a>
                <?php  

                        $args_sub = array(
                            'orderby'    => 'menu_order',
                            'order'      => 'ASC',
                            'hide_empty' => 1,
                            'parent'    => $term_id,
                        );
                        $sub_categories = get_terms( 'product_cat', $args_sub);
                    ?>
                    <ul class="low_ul_uh <?php echo $cat -> slug ?>">
                        <?php foreach ($sub_categories as $sub_cat){ 
                            $sub_link = get_term_link( $sub_cat->term_id, 'product_cat' );
                        ?>
                        <?php
                            $term_id_v3 = $sub_cat -> term_id;
                            $link_v3 = get_term_link( $sub_cat->term_id_v3, 'product_cat' );

                            if ($term_id_body == $term_id_v3){?>
                                <li class="low_li_uh active_cat">     
                            <?php } else {?>
                                <li class="low_li_uh">
                            <?php } ?>
                        
                        
                            <a href="<?php echo $sub_link; ?>"><?php echo $sub_cat -> name ?> </a>
                            <?php
                                $args_sub_v3 = array(
                                    'orderby'    => 'menu_order',
                                    'order'      => 'ASC',
                                    'hide_empty' => 1,
                                    'parent'    => $term_id_v3,
                                );
                                $sub_categories_v3 = get_terms( 'product_cat', $args_sub_v3);
                               
                            ?>
                            <ul class="ul_v3">
                                <?php foreach ($sub_categories_v3 as $sub_cat_v3){ 
                                    $term_id_v4 = $sub_cat_v3 -> term_id;
                                    $sub_link_v3 = get_term_link( $sub_cat_v3->term_id, 'product_cat' );

                                    if ($term_id_body == $term_id_v4){?>
                                        <li class="li_v3 active_cat">     
                                    <?php } else {?>
                                        <li class="li_v3">
                                    <?php } 
                                    ?>
                                            
                                    <a href="<?php echo $sub_link_v3; ?>"><?php echo $sub_cat_v3 -> name ?> </a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php } ?>
                    </ul>
            </li>
        <?php } ?>
</ul>