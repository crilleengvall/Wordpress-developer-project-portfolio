<?php
	get_header();
	the_post();

	$format = get_post_format();
?>

<article itemscope itemtype="http://schema.org/BlogPosting" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inner">

		<figure>
			<?php the_post_thumbnail('large'); ?>
		</figure>

		<section class="post-section post-body">
			<div class="wrapper post-wrapper">
				<?php
					the_title('<h2 itemprop="headline" class="post-title"><a itemprop="url" href="'. esc_url(get_permalink()) .'" title="'. esc_attr(get_the_title()) .'">', '</a></h2>');
					print dpp_project_information_get_meta( 'project_information_short_description' );
				?>
				<div class="description">
					<?php print get_the_content(); ?>
				</div>
			</div>

			<div class="wrapper post-wrapper">
				<div>
					<i class="fa fa-globe fa-2" aria-hidden="true"></i>
					<a href="<?php print dpp_project_information_get_meta( 'project_information_project_url' ) ?>"><?php print dpp_project_information_get_meta( 'project_information_project_url' ) ?></a>
				</div>
				<div>
					<i class="fa fa-code fa-2" aria-hidden="true"></i>
					<?php
						echo dpp_project_information_get_the_terms(get_the_ID(), 'dpp_languages');
					?>
				</div>
				<div>
					<i class="fa fa-terminal fa-2" aria-hidden="true"></i>
					<?php
						echo dpp_project_information_get_the_terms(get_the_ID(), 'dpp_tools');
					?>
				</div>
				<div>
					<i class="fa fa-laptop fa-2" aria-hidden="true"></i>
					<?php
						echo dpp_project_information_get_the_terms(get_the_ID(), 'dpp_platforms');
					?>
				</div>
			</div>
		</section>
	</div>
</article>

<?php
	get_footer();
