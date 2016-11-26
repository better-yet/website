<?php
/**
 * Template Name: Sidebar Page
 *
 * @package WordPress
 * @subpackage better-yet
 */
 	
get_header();
the_post();

$attachments = new Attachments('attachments');
?>

<main class="container">
	
	<div class="row">
		<?php if ($attachments->exist()) {?>
		<div class="col-md-8 content">
			<?php the_content()?>
		</div>
		<div class="col-md-4 side">
			<?php
			while ($attachments->get()) {
				if ($link = $attachments->field('link')) {
					echo '<a href="' . $link . '"><img src="' . $attachments->src('one-third') . '" alt="' . $attachments->field('title') . '" class="img-responsive"></a>';
				} else {
					echo '<img src="' . $attachments->src('one-third') . '" alt="' . $attachments->field('title') . '" class="img-responsive">';
				}
			}
			?>
		</div>
		<?php } else {?>
		<div class="col-md-8 col-md-offset-2 content">
			<?php the_content()?>
		</div>
		<?php }?>
	</div>
		
</main>

<?php get_footer()?>
