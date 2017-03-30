<?php
 /*Template Name: Home Template
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
<div class="container text-center">
  <p>Focus your mind on a question </p>
   
  <a href="/crystalball/fortunes/"><button type="button" class="btn btn-default btn-round-lg btn-lg">Ask the Crystal Ball</button></a>
</div>



<?php get_footer(); ?>