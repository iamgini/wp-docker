<?php

/**
 * Displays latest or category wised posts list.
 *
 */

class Bam_Sidebar_Posts extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'sidebar_posts', // Base ID
			esc_html__( 'Bam: Sidebar Posts', 'bam' ), // Name
			array( 'description' => esc_html__( 'Displays latest posts or posts from a choosen category.Use this widget in the main sidebars.', 'bam' ), ) // Args
		);
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */

	public function form( $instance ) {
		$defaults = array(
			'title'		=>	esc_html__( 'Latest Posts', 'bam' ),
			'category'	=>	'all',
			'number_posts'	=> 5,
			'sticky_posts' => true,
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'bam' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"/>
		</p>
		<p>
			<label><?php esc_html_e( 'Select a post category', 'bam' ); ?></label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name('category'), 'selected' => $instance['category'], 'show_option_all' => 'Show all posts' ) ); ?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number_posts' ); ?>"><?php esc_html_e( 'Number of posts:', 'bam' ); ?></label>
			<input type="number" id="<?php echo $this->get_field_id( 'number_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_posts' );?>" value="<?php echo absint( $instance['number_posts'] ) ?>" size="3"/> 
		</p>
		<p>
			<input type="checkbox" <?php checked( $instance['sticky_posts'], true ) ?> class="checkbox" id="<?php echo $this->get_field_id('sticky_posts'); ?>" name="<?php echo $this->get_field_name('sticky_posts'); ?>" />
			<label for="<?php echo $this->get_field_id('sticky_posts'); ?>"><?php esc_html_e( 'Ignore sticky posts.', 'bam' ); ?></label>
		</p>

	<?php

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );	
		$instance[ 'category' ]	= absint( $new_instance[ 'category' ] );
		$instance[ 'number_posts' ] = (int)$new_instance[ 'number_posts' ];
		$instance[ 'sticky_posts' ] = isset( $new_instance['sticky_posts'] ) ? (bool) $new_instance['sticky_posts'] : false;
		return $instance;
	}


	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	
	public function widget( $args, $instance ) {
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';	
        $title = apply_filters( 'widget_title', $title , $instance, $this->id_base );
		$category = ( ! empty( $instance['category'] ) ) ? absint( $instance['category'] ) : 0;
		$number_posts = ( ! empty( $instance['number_posts'] ) ) ? absint( $instance['number_posts'] ) : 5; 
		$sticky_posts = ( isset( $instance['sticky_posts'] ) ) ? $instance['sticky_posts'] : true;

		// Latest Posts
		$latest_posts = new WP_Query( 
			array(
				'cat' 					=>	$category,
				'posts_per_page' 		=>	$number_posts,
				'no_found_rows' 		=>  true,
				'ignore_sticky_posts' 	=>  $sticky_posts
			)
		);	

		echo $before_widget; ?>
		<div class="bam-category-posts">
		<?php
			if ( $title ) {
				echo $before_title . $title . $after_title;
			}
		?>

		
		<?php if( $latest_posts -> have_posts() ) : ?>	
			<?php while ( $latest_posts -> have_posts() ) : $latest_posts -> the_post(); ?>
					<div class="bms-post clearfix">
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="bms-thumb">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">	
									<?php the_post_thumbnail( 'bam-small' ); ?>
								</a>
							</div>
						<?php } ?>
						<div class="bms-details">
							<?php the_title( sprintf( '<h3 class="bms-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
							<div class="entry-meta"><?php bam_posted_on(); ?></div>
						</div>
					</div><!-- .bms-post -->
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
        
        </div><!-- .bam-category-posts -->


	<?php
		echo $after_widget;
	}

}

// Register single category posts widget
function bam_register_sidebar_posts() {
    register_widget( 'Bam_Sidebar_Posts' );
}
add_action( 'widgets_init', 'bam_register_sidebar_posts' );