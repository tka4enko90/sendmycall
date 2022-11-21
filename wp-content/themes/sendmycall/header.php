<?php
/**
 * @package WordPress
 * @subpackage labottiglia
 */
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php
	wp_head();
	?>
</head>

<body <?php body_class(); ?>>
<div class="wrapper">
	<header class="header">
		<?php do_action( 'header_image' ); ?>
		<div class="container">
			<div class="navbar">
				<a href="<?php echo home_url( '/' ); ?>" class="navbar-logo" aria-label="La Bottiglia">
				logo
				</a>


				<div class="navbar-cart">
					<a href="#" class="link-cart" aria-label="<?php _e( 'Warenkorb', 'labottiglia' ); ?>">
						<svg width="1em" height="1em">
							<use xlink:href="#icon-cart"></use>
						</svg>
					</a>
					<?php
//					echo get_template_part( '/template-parts/cart', 'aside' );
					?>
				</div>

				<?php
//				echo get_template_part( '/template-parts/login-registration' );
				?>

				<a href="#" class="navbar-toggler" role="button" aria-label="<?php _e( 'Toggle navigation', 'labottiglia' ); ?>">
					<span></span>
					<span></span>
					<span></span>
				</a>
			</div>
		</div>
	</header>
