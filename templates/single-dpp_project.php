<?php
	get_header();
	the_post();
?>

<article itemscope itemtype="http://schema.org/BlogPosting" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inner">

		<figure>
			<?php the_post_thumbnail('full'); ?>
			<figcaption class="dpp-project-short-description">	<?php echo the_title('<h2 itemprop="headline" class="post-title">', '</h2>') . '<div> ' . dpp_project_information_get_meta( 'project_information_short_description' ) .'</div>' ?> </figcaption>
		</figure>

		<section class="post-section post-body">
			<div class="wrapper post-wrapper">
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
					<?php
						echo dpp_project_information_get_terms_and_icon(get_the_ID(), 'dpp_languages', 'code');
					?>
				</div>
				<div>
					<?php
						echo dpp_project_information_get_terms_and_icon(get_the_ID(), 'dpp_tools', 'terminal');
					?>
				</div>
				<div>
					<?php
						echo dpp_project_information_get_terms_and_icon(get_the_ID(), 'dpp_platforms', 'laptop');
					?>
				</div>
			</div>
		</section>
	</div>
</article>

<?php
	get_footer();
