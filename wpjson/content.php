{
			"the_ID":"<?php the_ID(); ?>",
<?php 
if ( is_sticky() && is_home() && ! is_paged() ) {?>
			"featured_post":"<?php _e( 'Featured post', 'twentytwelve' ); ?>",<?php 
}
?>
			"the_post_thumbnail":<?php print(json_encode(get_the_post_thumbnail())); ?>,
			"the_post_type":"<?php echo(get_post_type()) ?>",
			"the_title":<?php print(json_encode(get_the_title())); ?>,
			"the_permalink":<?php print(json_encode(get_permalink())); ?>,
			"the_excerpt":<?php print(json_encode(get_the_excerpt())); ?>,
<?php
if(!$_GET['content']=='true'){
?>
			"the_content":<?php print(json_encode(get_the_content())); ?>,
<?php
}
?>
			"the_time":<?php print(json_encode(get_the_time())); ?>,
			"the_date":<?php print(json_encode(get_the_date())); ?>,<?php 
if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ){ ?>

			"the_author":{
				"avatar":"<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 68 ) ); ?>",
				"name":<?php print(json_encode(get_the_author())); ?>,
				"description":<?php print(json_encode(the_author_meta( 'description' ))); ?>,
				"posts_url":<?php print(json_encode(get_author_posts_url( get_the_author_meta( 'ID' )))); ?>
			},<?php 
} 

if(!$_GET['comments']){
	$cn = get_comments_number();
?>

			"comments":{
				"comments_open":"<?php echo(comments_open());?>",
				"comments_number":"<?php echo($cn);?>",
				"comment_pages_count":"<?php echo(get_comment_pages_count());?>",
				"previous_comments_link":"<?php previous_comments_link(); ?>",
				"next_comments_link":"<?php next_comments_link(); ?>"<?php ?>,
				"comments":[<?php 
	if ($cn>0) {
		$sc = false;
		foreach(get_comments() as $comment){
			if ($sc) echo(',');?>
					
					<?php
			print(json_encode($comment));
			$sc=true;
		}
	}
?>

				]
<?php
?>

			},<?php
}
if(!$_GET['attachments']){
?>

			"post_attachments":[<?php
				$sc = false;
				$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' =>'any', 'post_parent' => $post->ID ); 
				$attachments = get_posts($args);
				if ($attachments) {
					foreach ( $attachments as $attachment ) {
						if ($sc) echo(',');?>

				<?php 
						print(json_encode($attachment));
						$sc=true;
					}
				}
				?>
				
			],<?php
}
if (!$_GET['custom_fields']){
	$cf = get_post_custom();
	unset($cf['_edit_lock']);
	unset($cf['_edit_last']);
?>

			"custom_fields":<?php print(json_encode($cf)); ?>,
<?php
}
?>
			
			"categories":[<?php
$sc = false;
$categories = get_the_category();
if($categories){
	foreach($categories as $category) {
		if ($sc) echo(',');?>
				
				<?php
				print(json_encode($category));
		$sc=true;
	}
}
?>

			],
			"tags":[<?php
$sc = false;
$categories = get_the_tags();
if($categories){
	foreach($categories as $category) {
		if ($sc) echo(',');?>
				
				<?php
				print(json_encode($category));
		$sc=true;
	}
}
?>

			]
		}