<?php
/**
 * Template Name: Archives Page
 */
?>
<?php get_header(); ?>

<?php
  $content_css = '';
  $sidebar_css = '';
  $sidebar_exists = true;
  $sidebar_left = '';
  $double_sidebars = false;

  $sidebar_1 = get_post_meta( $post->ID, 'sbg_selected_sidebar_replacement', true );
  $sidebar_2 = get_post_meta( $post->ID, 'sbg_selected_sidebar_2_replacement', true );

  if( $smof_data['pages_global_sidebar']  || ( class_exists( 'TribeEvents' ) &&  is_events_archive() ) ) {
    if( $smof_data['pages_sidebar'] != 'None' ) {
      $sidebar_1 = array( $smof_data['pages_sidebar'] );
    } else {
      $sidebar_1 = '';
    }

    if( $smof_data['pages_sidebar_2'] != 'None' ) {
      $sidebar_2 = array( $smof_data['pages_sidebar_2'] );
    } else {
      $sidebar_2 = '';
    }
  }

  if( ( is_array( $sidebar_1 ) && ( $sidebar_1[0] || $sidebar_1[0] === '0' ) ) && ( is_array( $sidebar_2 ) && ( $sidebar_2[0] || $sidebar_2[0] === '0' ) ) ) {
    $double_sidebars = true;
  }

  if( is_array( $sidebar_1 ) &&
    ( $sidebar_1[0] || $sidebar_1[0] === '0' )
  ) {
    $sidebar_exists = true;
  } else {
    $sidebar_exists = false;
  }

  if( ! $sidebar_exists ) {
    $content_css = 'width:100%';
    $sidebar_css = 'display:none';
    $sidebar_exists = false;
  } elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'left') {
    $content_css = 'float:right;';
    $sidebar_css = 'float:left;';
    $sidebar_left = 1;
  } elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'right') {
    $content_css = 'float:left;';
    $sidebar_css = 'float:right;';
  } elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'default' || ! metadata_exists( 'post', $post->ID, 'pyre_sidebar_position' )) {
    if($smof_data['default_sidebar_pos'] == 'Left') {
      $content_css = 'float:right;';
      $sidebar_css = 'float:left;';
      $sidebar_left = 1;
    } elseif($smof_data['default_sidebar_pos'] == 'Right') {
      $content_css = 'float:left;';
      $sidebar_css = 'float:right;';
      $sidebar_left = 2;
    }
  }

  if(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'right') {
    $sidebar_left = 2;
  }

  if( $smof_data['pages_global_sidebar']  || ( class_exists( 'TribeEvents' ) &&  is_events_archive() ) ) {
    if( $smof_data['pages_sidebar'] != 'None' ) {
      $sidebar_1 = $smof_data['pages_sidebar'];

      if( $smof_data['default_sidebar_pos'] == 'Right' ) {
        $content_css = 'float:left;';
        $sidebar_css = 'float:right;';
        $sidebar_left = 2;
      } else {
        $content_css = 'float:right;';
        $sidebar_css = 'float:left;';
        $sidebar_left = 1;
      }
    }

    if( $smof_data['pages_sidebar_2'] != 'None' ) {
      $sidebar_2 = $smof_data['pages_sidebar_2'];
    }

    if( $smof_data['pages_sidebar'] != 'None' && $smof_data['pages_sidebar_2'] != 'None' ) {
      $double_sidebars = true;
    }
  } else {
    $sidebar_1 = '0';
    $sidebar_2 = '0';
  }

  if($double_sidebars == true) {
    $content_css = 'float:left;';
    $sidebar_css = 'float:left;';
    $sidebar_2_css = 'float:left;';
  } else {
    $sidebar_left = 1;
  }

  if(class_exists('WooCommerce')) {
    if(is_cart() || is_checkout() || is_account_page() || (get_option('woocommerce_thanks_page_id') && is_page(get_option('woocommerce_thanks_page_id')))) {
      $content_css = 'width:100%';
      $sidebar_css = 'display:none';
      $sidebar_exists = false;
    }
  }
  ?>
<div id="content" style="<?php echo $content_css; ?>">

  <div <?php post_class(); ?>>

          <?php
          global $wpdb;
          $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE  post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC");

          foreach($years as $year) : 
    //$year_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' AND YEAR(post_date) = '".$year."' ");

            $listPostY = array(
              'post_type' => 'post',
              'post_status' => 'publish',
              'posts_per_page' => -1,
              'date_query' => array(
                array(
                  'year' => $year,
                  'compare' => '=',
                  ),
                ),
              );
          $yearPost = new wp_query($listPostY);
          $countyearPost = $yearPost->found_posts;
          ?>
          <?php if ($countyearPost > 0) { ?>
          <div class="year">
            <h3 class="title-year"><a href="<?php echo get_year_link($year); ?>"><?php echo $year." (". $countyearPost ." )"; ?></a></h3> 
            <ul class="content-year">
              <?php $months = $wpdb->get_col("SELECT DISTINCT MONTH(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' AND YEAR(post_date) = '".$year."' ORDER BY post_date DESC"); 

              foreach($months as $month) : 
                //$theid_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' AND MONTH(post_date)= '".$month."' AND YEAR(post_date) = '".$year."' ");
                $listPostM = array(
                  'post_type' => 'post',
                  'post_status' => 'publish',
                  'posts_per_page' => -1,
                  'date_query' => array(
                    array(
                      'year' => $year,
                      'compare' => '=',
                      ),
                    array(
                      'month' => $month,
                      'compare' => '=',
                      ),
                    ),
                  );
              $monthPost = new wp_query($listPostM);
              $countmonthPost = $monthPost->found_posts;
              ?>
              <?php if($countmonthPost > 0){ ?>
              <li>
                <a href="<?php echo get_month_link($year, $month); ?>" class="open-month"><?php echo date( 'F', mktime(0, 0, 0, $month) ) ." ".$year . " (".$countmonthPost.") "; ?></a>

                <div class="box-expand">
                  <ul> 
                    <?php  while ($monthPost->have_posts()) : $monthPost->the_post(); ?>
                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                  <?php endwhile; wp_reset_query(); ?>
                </ul>
              </div>  

            </li>
            <?php } ?>

          <?php endforeach;?>
        </ul>
      </div>
      <?php }; endforeach; wp_reset_query(); ?>

    </div>
  </div>

  <?php if( $sidebar_exists == true ): ?>
  <div id="sidebar" class="sidebar" style="<?php echo $sidebar_css; ?>">
    <?php
    if($sidebar_left == 1) {
      generated_dynamic_sidebar($sidebar_1);
    }
    if($sidebar_left == 2) {
      generated_dynamic_sidebar_2($sidebar_2);
    }
    ?>
  </div>

  <?php if( $double_sidebars == true ): ?>
  <div id="sidebar-2" class="sidebar" style="<?php echo $sidebar_2_css; ?>">
    <?php
    if($sidebar_left == 1) {
      generated_dynamic_sidebar_2($sidebar_2);
    }
    if($sidebar_left == 2) {
      generated_dynamic_sidebar($sidebar_1);
    }
    ?>
  </div>
  <?php endif; ?>
  <?php endif; ?>
<?php get_footer();