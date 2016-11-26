<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <title><?php 
			if (is_home()) {
				echo get_bloginfo('name');
			} elseif (is_archive()) {
				echo post_type_archive_title();
			} else {
				echo get_the_title();
			}
        ?></title>
        <meta name="description" content="<?php bloginfo('description'); ?>">
		<link href='https://fonts.googleapis.com/css?family=Roboto+Mono:700' rel='stylesheet' type='text/css'>
        <?php if (is_page() || is_home()) {?>
			<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-red.ico">
		<?php } elseif (is_archive()) {?>
			<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-green.ico">
		<?php } else {?>
			<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-purple.ico">
		<?php }?>
		<?php wp_head()?>
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body <?php body_class()?>>
		<header>
			<div class="container">
				<?php
				
				# Main Nav
				wp_nav_menu([
					'menu' => 'header-menu',
					'container' => 'nav',
					'container_class' => 'header',
				]);
				
				# Sub Nav
				if (is_page() || is_home() || is_singular('post')) {
					//page
					wp_nav_menu([
						'menu' => 'about-menu',
						'container' => 'nav',
						'container_class' => 'sub',
					]);
				} else {
					//projects or project
					$prepend = is_single() ? '/projects/#' : '#';
					if ($types = get_terms(['taxonomy' => 'type'])) {?>
					<nav class="sub">
						<ul>
							<li><a href="<?php echo $prepend?>">All</a></li>
							<?php foreach ($types as $type) {?>
								<li><a href="<?php echo $prepend . $type->slug?>"><?php echo $type->name?></a></li>
							<?php }?>
						</ul>
					</nav>
					<?php }
				}
				?>
			</div>
		</header>