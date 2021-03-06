<?php wp_enqueue_script( 'wp-classified-manager-ajax-filters' ); ?>

<?php do_action( 'classified_manager_classified_filters_before', $atts ); ?>

<form class="classified_filters">
	<?php do_action( 'classified_manager_classified_filters_start', $atts ); ?>

	<div class="search_classifieds">
		<?php do_action( 'classified_manager_classified_filters_search_classifieds_start', $atts ); ?>

		<div class="search_keywords">
			<label for="search_keywords"><?php _e( 'Keywords', 'classifieds-wp' ); ?></label>
			<input type="text" name="search_keywords" id="search_keywords" placeholder="<?php esc_attr_e( 'Keywords', 'classifieds-wp' ); ?>" value="<?php echo esc_attr( $keywords ); ?>" />
		</div>

		<div class="search_location">
			<label for="search_location"><?php _e( 'Location', 'classifieds-wp' ); ?></label>
			<input type="text" name="search_location" id="search_location" placeholder="<?php esc_attr_e( 'Location', 'classifieds-wp' ); ?>" value="<?php echo esc_attr( $location ); ?>" />
		</div>

		<?php if ( $categories ) : ?>
			<?php foreach ( $categories as $category ) : ?>
				<input type="hidden" name="search_categories[]" value="<?php echo sanitize_title( $category ); ?>" />
			<?php endforeach; ?>
		<?php elseif ( $show_categories && ! is_tax( 'classified_listing_category' ) && get_terms( 'classified_listing_category' ) ) : ?>
			<div class="search_categories">
				<label for="search_categories"><?php _e( 'Category', 'classifieds-wp' ); ?></label>
				<?php if ( $show_category_multiselect ) : ?>
					<?php classified_manager_dropdown_categories( array( 'taxonomy' => 'classified_listing_category', 'hierarchical' => 1, 'name' => 'search_categories', 'orderby' => 'name', 'selected' => $selected_category, 'hide_empty' => false ) ); ?>
				<?php else : ?>
					<?php classified_manager_dropdown_categories( array( 'taxonomy' => 'classified_listing_category', 'hierarchical' => 1, 'show_option_all' => __( 'Any category', 'classifieds-wp' ), 'name' => 'search_categories', 'orderby' => 'name', 'selected' => $selected_category, 'multiple' => false ) ); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php do_action( 'classified_manager_classified_filters_search_classifieds_end', $atts ); ?>
	</div>

	<?php do_action( 'classified_manager_classified_filters_end', $atts ); ?>
</form>

<?php do_action( 'classified_manager_classified_filters_after', $atts ); ?>

<noscript><?php _e( 'Your browser does not support JavaScript, or it is disabled. JavaScript must be enabled in order to view listings.', 'classifieds-wp' ); ?></noscript>