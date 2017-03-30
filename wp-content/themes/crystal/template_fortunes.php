<?php
 /*Template Name: Fortunes Template
 */

 get_header();
 ?>

<body>

<!-- First Container  -->
<div class="container">    
  <div class="row">
    <div class="col-sm-7">
	<h1 class="crystal_header">Online Crystal Ball !!</h1>
      <p>
		<br>
		<?php	   
			while ( have_posts() ) : the_post(); 			
			the_content(); 
		?>
	  </p>
    </div>
    <div class="col-sm-5"> 
        <?php the_post_thumbnail('large','style=max-width:100%;height:auto;');
		endwhile; 
			wp_reset_query();
		?>
    </div>
    
  </div>
</div>
<hr>
<!-- Second Container -->
<div class="container div2 text-center">
  <p> The Great Crystal Ball Has Answered : </p>
  
			
		
  <p>
	<?php
        global $wpdb;
        $table_name = $wpdb->prefix . "crystal_ball";

        $rows = $wpdb->get_results("SELECT id,fortunes from $table_name ORDER BY RAND() LIMIT 1");
		foreach ($rows as $row) {
	?>		
		<b class="answer"> <?php echo $row->fortunes; ?> </b> 
	<?php	
		}	
    ?>
  </p>
  <br>
  <a href="/crystalball">Back</a>
</div>



<?php get_footer(); ?>
