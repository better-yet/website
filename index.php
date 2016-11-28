<?php get_header()?>


<main class="container">
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2 content">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
				?>
				<article id="post-<?php the_ID()?>" <?php post_class()?>>
				
					<?php
					the_title( '<h1><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a><small>' . get_the_date() . '</small></h1>' );

					the_excerpt();
				
					the_tags('<footer>', '', '</footer>' );
					?>
					
				</article>

				<?php
				endwhile;

			else :
				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' );

			endif;
			?>
		</div>
	</div>
		
</main>


<?php get_footer()?>