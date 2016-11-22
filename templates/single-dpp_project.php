<?php
	get_header();
	the_post();

	$format = get_post_format();
?>

<article itemscope itemtype="http://schema.org/BlogPosting" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inner">

		<?php get_template_part('postformats/format', $format); ?>

		<section class="post-section post-body">
			<div class="wrapper post-wrapper">
				<?php
					the_title('<h2 itemprop="headline" class="post-title"><a itemprop="url" href="'. esc_url(get_permalink()) .'" title="'. esc_attr(get_the_title()) .'">', '</a></h2>');
					get_the_content();
				?>
			</div>
		</section>
	</div>
</article>

<?php
	get_footer();
