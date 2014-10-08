<?php
//of course you want this to be javascript in case you output JSONP
header("Content-type: text/javascript");
// if you get the callback parameter for JSONP output, then render it.
if ($_GET['callback']){
	echo($_GET['callback'].'('); 
}
?>{
<?php
// we show stuff by default and hide it just if we get the false parameter in the url

// the header gives us basic info about the blog/api
if(!$_GET['header']){
?>
	"header":{
		"title":"<?php wp_title( '|', true, 'right' ); ?>",
		"pingbackUrl":"<?php bloginfo( 'pingback_url' ); ?>",
		"homeUrl":"<?php echo esc_url( home_url( '/' ) ); ?>",
		"siteName":"<?php bloginfo( 'name' ); ?>",
		"siteDescription":"<?php bloginfo( 'description' ); ?>"<?php 
// if there is a header image then output it
$header_image = get_header_image();
if ( ! empty( $header_image ) ){ ?>,
		"headerImage":"<?php echo $header_image ; ?>",
		"headerImageWidth":"<?php echo get_custom_header()->width; ?>",
		"headerImageHeight":"<?php echo get_custom_header()->height; ?>"<?php 
}
?>

	},
<?php
}
//we show categories by default. if we get the false parameter then we dont
if(!$_GET['categories']){
	$ca = array(
	//'type'                     => 'post',
	//'child_of'                 => 0,
	//'parent'                   => '',
	//'orderby'                  => 'name',
	//'order'                    => 'ASC',
	//'hide_empty'               => 1,
	//'hierarchical'             => 1,
	'exclude'                  => ''
	//'include'                  => '',
	//'number'                   => '',
	//'taxonomy'                 => 'category',
	//'pad_counts'               => false
	);
?>
	"categories":[<?php
	$fp = 0;
	foreach(get_categories($ca) as $category){
		if($fp!=0) echo(',');?>
		
		<?php 
		print(json_encode($category));
		$fp = 1;
	}
?>

	],
<?php 
// we show the current query as a subobject, so you kinda know where you are, if you pass the query parameter as false, then we do not show it
}
if(!$_GET['query']){
?>
	"wp_query":{
		"query":<?php print(json_encode($wp_query->query)); ?>,
		"found_posts":"<?php echo($wp_query->found_posts); ?>",
		"post_count":"<?php echo($wp_query->post_count); ?>",
		"max_num_pages":"<?php echo($wp_query->max_num_pages); ?>"
	},<?php
}
	?>
	
	"posts":[
		<?php
// and of course the posts, which is the only thing we don't hide by parameter
if ( have_posts() ) {
	/* Start the Loop */
	$fp = 0;
	while ( have_posts() ) :
		if($fp!=0) echo(',');
		the_post(); get_template_part( 'content', get_post_format() );
		$fp = 1;
	endwhile;
}
?>

	]
}<?php
//close the callback function if we got the callback parameter
if ($_GET['callback']){
	echo(')');
}?>