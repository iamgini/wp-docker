<?php

/**
 * Displays popular posts, comments and tags in a tabbed pane.
 */
class Bam_Tabbed_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'bam_tabbed_widget', // Base ID
			esc_html__( 'Bam: Popular, Recent, Tags, Comments', 'bam' ), // Name
			array( 'description' => esc_html__( 'Displays popular posts, recent posts comments, tags in a tabbed pane.', 'bam' ), ) // Args
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
		$nop = ! empty( $instance['nop'] ) ? absint( $instance['nop'] ) : 5;
		$noc = ! empty( $instance['noc'] ) ? absint( $instance['noc'] ) : 5; ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'nop' ); ?>"><?php esc_html_e( 'Number of popular posts:', 'bam' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'nop' ); ?>" name="<?php echo $this->get_field_name( 'nop' ); ?>" type="text" value="<?php echo esc_attr( $nop ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'noc' ); ?>"><?php esc_html_e( 'Number of comments:', 'bam' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'noc' ); ?>" name="<?php echo $this->get_field_name( 'noc' ); ?>" type="text" value="<?php echo esc_attr( $noc ); ?>">
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
		$instance = array();
		$instance['nop'] = ( ! empty( $new_instance['nop'] ) ) ? (int)( $new_instance['nop'] ) : '';
		$instance['noc'] = ( ! empty( $new_instance['noc'] ) ) ? (int)( $new_instance['noc'] ) : '';

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
		$nop = ( ! empty( $instance['nop'] ) ) ? absint( $instance['nop'] ) : 5;
		$noc = ( ! empty( $instance['noc'] ) ) ? absint( $instance['noc'] ) : 5;

		echo $before_widget; ?>

		<div class="bm-tabs-wdt">

		<ul class="bm-tab-nav">
			<li class="bm-tab"><a class="bm-tab-anchor" href="#bam-popular"><i class="fa fa-fire"></i></a></li>
			<li class="bm-tab"><a class="bm-tab-anchor" href="#bam-recent"><i class="fa fa-clock-o"></i></a></li>
			<li class="bm-tab"><a class="bm-tab-anchor" href="#bam-comments"><i class="fa fa-comments-o"></i></a></li>
			<li class="bm-tab"><a class="bm-tab-anchor" href="#bam-tags"><i class="fa fa-tags"></i></a></li>
		</ul>

		<div class="tab-content clearfix">
			<div id="bam-popular">
				<?php 
					$args = array( 'ignore_sticky_posts' => 1, 'posts_per_page' => $nop, 'post_status' => 'publish', 'no_found_rows' => true, 'orderby' => 'comment_count', 'order' => 'desc' );
					$popular = new WP_Query( $args );

					if ( $popular->have_posts() ) :

					while( $popular-> have_posts() ) : $popular->the_post(); ?>
						<div class="bms-post clearfix">
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="bms-thumb">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'bam-small' ); ?></a>
								</div>
							<?php } ?>
							<div class="bms-details">
								<?php the_title( sprintf( '<h3 class="bms-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
								<div class="entry-meta"><?php bam_posted_on(); ?></div>
							</div>
						</div>
					<?php
					endwhile;
					endif;	
				?>
			</div><!-- .tab-pane #bam-popular -->

			<div id="bam-recent">
				<?php 
					$args = array( 'ignore_sticky_posts' => 1, 'posts_per_page' => $nop, 'no_found_rows' => true, 'post_status' => 'publish' );
					$popular = new WP_Query( $args );

					if ( $popular->have_posts() ) :

					while( $popular-> have_posts() ) : $popular->the_post(); ?>
						<div class="bms-post clearfix">
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="bms-thumb">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'bam-small' ); ?></a>
								</div>
							<?php } ?>
							<div class="bms-details">
								<?php the_title( sprintf( '<h3 class="bms-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
								<div class="entry-meta"><?php bam_posted_on(); ?></div>
							</div>
						</div>
					<?php
					endwhile;
					endif;	
				?>
			</div><!-- .tab-pane #bam-recent -->

			<div id="bam-comments">
				<?php

					$avatar_size = 50;
					$args = array(
						'number'    => $noc,
						'status'	=> 'approve'
					);
					$comments_query = new WP_Comment_Query;
					$comments = $comments_query->query( $args );	
				
					if ( $comments ) {
						foreach ( $comments as $comment ) { ?>
							<div class="bmw-comment">
								<figure class="bmw_avatar">
									<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
										<?php echo get_avatar( $comment->comment_author_email, $avatar_size ); ?>     
									</a>                               
								</figure> 
								<div class="bmw-comm-content">
									<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
										<span class="bmw-comment-author"><?php echo esc_html( get_comment_author( $comment->comment_ID ) ); ?> </span> - <span class="bam_comment_post"><?php echo esc_html( get_the_title($comment->comment_post_ID) ); ?></span>
									</a>
									<p class="bmw-comment">
										<?php comment_excerpt( $comment->comment_ID ); ?>
									</p>
								</div>
							</div>
						<?php }
					} else {
						esc_html_e( 'No comments found.', 'bam' );
					}
				?>
			</div><!-- .tab-pane #bam-comments -->

			<div id="bam-tags">
				<?php        
					$tags = get_tags();             
					if($tags) {               
						foreach ( $tags as $tag ): ?>    
							<span><a href="<?php echo esc_url( get_term_link( $tag ) ); ?>"><?php echo esc_attr( $tag->name ); ?></a></span>           
							<?php     
						endforeach;       
					} else {          
						esc_html_e( 'No tags created.', 'bam');           
					}            
				?>
			</div><!-- .tab-pane #bam-tags-->

		</div><!-- .tab-content -->		

		</div><!-- #tabs -->


		<?php echo $after_widget; ?>

		<?php wp_enqueue_script( 'jquery-ui-tabs' ); ?>

<?php

	}

}

//Registster bam tabbed widget.
function bam_register_tabbed_widget() {
    register_widget( 'Bam_Tabbed_Widget' );
}
add_action( 'widgets_init', 'bam_register_tabbed_widget' ); 