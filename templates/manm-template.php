<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php if ( ! current_theme_supports( 'title-tag' ) ) : ?>
		<title><?php echo wp_get_document_title(); ?></title>
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body>

	<?php
		wp_body_open();
	?>

	<header class="mdc-top-app-bar app-bar" id="app-bar">
		
	</header>
	<div>
		<main class="main-content" id="main-content">
			<?php
				the_content();
			?>
		</main>
	</div>
    <?php
		wp_footer();
	?>
	</body>
</html>
