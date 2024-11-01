
<style>
.show_id_list_title.head,
.show_id_list_data.head {
	font-weight: 700;
}
.show_id_list_title {
	float: left;
}
.show_id_list_data {
	margin-left: 5em;
	height: 1.1em;
}
.show_id_list_child {
	text-indent: 1em;
}
</style>
<div>

	<h1><?php _e('ID List', 'wp-show-id-list') ?></h1>

	<?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'show_id_posts'; ?>

	<h2 class="nav-tab-wrapper">
		<a href="?page=show_id_list&tab=show_id_posts" class="nav-tab <?php echo 'show_id_posts' === $active_tab ? 'nav-tab-active' : ''; ?>"><?php _e('Posts List', 'wp-show-id-list') ?></a>
		<a href="?page=show_id_list&tab=show_id_pages" class="nav-tab <?php echo 'show_id_pages' === $active_tab ? 'nav-tab-active' : ''; ?>"><?php _e('Pages List', 'wp-show-id-list') ?></a>
		<a href="?page=show_id_list&tab=show_id_categories" class="nav-tab <?php echo 'show_id_categories' === $active_tab ? 'nav-tab-active' : ''; ?>"><?php _e('Categories List', 'wp-show-id-list') ?></a>
	</h2>

	<div class="nav-tab-body">
		<?php if ( 'show_id_posts' === $active_tab ) : ?>
			<div id="js-show_id_posts" class="show_id_posts">
				<h3 class="show_id_title"><?php _e('Posts List', 'wp-show-id-list') ?></h3>
				<dl class="show_id_list">
					<dt class="show_id_list_title head">ID</dt><dd class="show_id_list_data head"><?php _e('Post Title', 'wp-show-id-list') ?></dd>
				<?php global $post;
					$posts_args = array(
						'orderby' => 'ID',
						'order' => 'asc',
						'numberposts' => -1,
					);
					$posts = get_posts( $posts_args );
					foreach ( $posts as $post ) : setup_postdata( $post );
				?>
				<dt class="show_id_list_title"><?php echo esc_html( $post->ID ) ?></dt><dd class="show_id_list_data"><?php the_title() ?></dd>
				<?php endforeach; ?>
				</dl>
			</div>
		<?php elseif ( 'show_id_pages' === $active_tab ) : ?>
			<div id="js-show_id_pages" class="show_id_pages">
				<h3 class="show_id_title"><?php _e('Pages List', 'wp-show-id-list') ?></h3>
				<dl class="show_id_list">
					<dt class="show_id_list_title head">ID</dt><dd class="show_id_list_data head"><?php _e('Page Title', 'wp-show-id-list') ?></dd>
				<?php global $post;
					$pages_args = array(
						'orderby' => 'ID',
						'order' => 'asc',
						'numberposts' => -1,
						'post_type' => 'page',
					);
					$posts = get_posts( $pages_args );
					foreach ( $posts as $post ) :  setup_postdata( $post );
				?>
				<dt class="show_id_list_title"><?php echo esc_html( $post->ID ) ?></dt><dd class="show_id_list_data"><?php the_title() ?></dd>
				<?php endforeach; ?>
				</dl>
			</div>
		<?php else : ?>
			<div id="js-show_id_categories" class="show_id_categories">
				<h3 class="show_id_title"><?php _e('Categories List', 'wp-show-id-list') ?></h3>
				<dl class="show_id_list">
					<dt class="show_id_list_title head">ID</dt><dd class="show_id_list_data head"><?php _e('Category Name', 'wp-show-id-list') ?></dd>
				<?php
					$category_age = array(
						'orderby' => 'ID',
						'order' => 'asc',
						'parent' => 0,
						'hide_empty' => 0,
					);
					$categories = get_categories( $category_age );
					foreach ( $categories as $category ) :
				?>
					<dt class="show_id_list_title"><?php echo esc_html( $category->cat_ID ) ?></dt><dd class="show_id_list_data"><?php echo esc_html( $category->name ) ?></dd>
				<?php
					$child_num = count( get_term_children( $category->cat_ID, 'category' ) );
					if ( $child_num > 0 ) :
				?>
				<dl class="show_id_list_child">
					<?php
						$child_category_age = array(
							'orderby' => 'ID',
							'order' => 'asc',
							'parent' => $category->cat_ID,
							'hide_empty' => 0,
						);
						$child_categories = get_categories( $child_category_age );

						foreach ( $child_categories as $child_category ) :
					?>
					<dt class="show_id_list_title"><?php echo esc_html( $child_category->cat_ID ) ?></dt><dd class="show_id_list_data"><?php echo esc_html( $child_category->name ) ?></dd>
					<?php endforeach; ?>
				</dl>
				<?php endif; ?>
				<?php endforeach; ?>
				</dl>
			</div>
		<?php endif; ?>
	</div>

</div>
<script>
jQuery(function() {
	jQuery('#js-show_id_tab').tabs({});
});
</script>
