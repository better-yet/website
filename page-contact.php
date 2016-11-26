<?php
get_header();
the_post();

# Get Users
$users = get_users([
	'orderby' => 'last_name',
]);

# Order users by last name (strange WP can't do this)
usort($users, function($a, $b) {
	return strnatcasecmp($a->last_name, $b->last_name);
});

# Generic now datetime object that we'll use for each user below
$dateTime = new DateTime(); 
?>
<main class="container">
	
	<div class="row">
		<div class="col-md-4 col-xs-12 content">
			<?php the_content()?>
		</div>
		<?php foreach ($users as $user) {?>
		<div class="col-md-4 col-xs-6">
			<figure>
				<?php echo get_avatar($user->ID, 512, '', get_the_author_meta('display_name', $user->ID), ['class'=>'img-responsive'])?>
				<figcaption>
					<?php echo get_the_author_meta('display_name', $user->ID)?>, 
					<?php echo get_the_author_meta('title', $user->ID)?>
				</figcaption>
			</figure>
			<?php
			if ($location = get_the_author_meta('location', $user->ID)) {
				echo '<p>';
				if ($timezone = get_the_author_meta('timezone', $user->ID)) {
					$dateTime->setTimeZone(new DateTimeZone($timezone)); 
					echo 'It is ' . $dateTime->format('g:ia T') . ' in ' . $location . '. ';
				}
				if ($weather = get_the_author_meta('weather', $user->ID)) {
					echo 'The weather is ' . $weather . '.';
				}
				echo '</p>';
			}
			?>
			<p><a href="mailto:<?php echo antispambot($user->data->user_email)?>">Email me!</a></p>
		</div>
		<?php }?>
	</div>
		
</main>

<?php get_footer()?>