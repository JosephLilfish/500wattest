<?php
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Category product',
    'id' => 'category-product',
    'before_widget' => '<div class="widget-area category_widget">',
    'after_widget' => '</div>',
    'before_title' => '<strong>',
    'after_title' => '</strong>',
  )
);


