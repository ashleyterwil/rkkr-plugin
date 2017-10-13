<?php
/**
 * The template for displaying all single cats
 *
 */

get_header(); ?>

	<div class="wrap">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php
				/* Start the Loop */
				while ( have_posts() ) {
					the_post();

					/*
					 * The custom post type is rkkr-cat
					 *
					 * Custom taxonomies:
					 * rkkr_cat_breeds
					 * rkkr_cat_colours
					 * rkkr_cat_genders
					 * rkkr_cat_ages
					 *
					 * Postmeta:
					 * pictures
					 * .. is an array of media IDs
					 *
					 *
					 */

					$post_id          = get_the_ID();
					$gallery_pictures = get_post_meta( $post_id, 'pictures', true );

					?>
					<div class="cat-container">
						<h1 class="cat-name entry-title"><?php the_title(); ?></h1>

						<div class="cat-meta">
							<div class="cat-meta-row cat-meta-breed">
								<span class="cat-meta-label"><?php _e( 'Breed:', 'rkkr-plugin' ); ?></span>
								<span class="cat-meta-value"><?php the_terms( $post_id, 'rkkr_cat_breeds' ); ?></span>
							</div>

							<div class="cat-meta-row cat-meta-colour">
								<span class="cat-meta-label"><?php _e( 'Colour:', 'rkkr-plugin' ); ?></span>
								<span class="cat-meta-value"><?php the_terms( $post_id, 'rkkr_cat_colours' ); ?></span>
							</div>

							<div class="cat-meta-row cat-meta-gender">
								<span class="cat-meta-label"><?php _e( 'Gender:', 'rkkr-plugin' ); ?></span>
								<span class="cat-meta-value"><?php the_terms( $post_id, 'rkkr_cat_genders' ); ?></span>
							</div>

							<div class="cat-meta-row cat-meta-age">
								<span class="cat-meta-label"><?php _e( 'Age:', 'rkkr-plugin' ); ?></span>
								<span class="cat-meta-value"><?php the_terms( $post_id, 'rkkr_cat_ages' ); ?></span>
							</div>
						</div>

						<div class="cat-description">
							<?php the_content(); ?>
						</div>


						<div class="cat-gallery">
							<?php
							if ( empty( $gallery_pictures ) || count( $gallery_pictures ) < 1 ) {
								_e( 'There are no pictures for this kitty yet.' );
							} else {


								foreach ( $gallery_pictures as $gallery_picture_id ) {
									$full_url  = wp_get_attachment_url( $gallery_picture_id );
									$thumbnail = wp_get_attachment_image( $gallery_picture_id, 'thumbnail', false, array(
										'data-full-url' => $full_url,
									) );

									echo $thumbnail;
								}

							}
							?>
						</div>
					</div>
					<?php

				}

				?>

			</main><!-- #main -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div><!-- .wrap -->

<?php get_footer();
