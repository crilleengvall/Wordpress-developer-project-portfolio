<div class="dpp-projects">
 <?php foreach ($projects as $key => $project) { ?>
   <article class="project">
     <figure>
       <a href="<?php echo get_post_permalink($project->ID)?>">
         <?php  echo wp_get_attachment_image( get_post_thumbnail_id( $project->ID ), 'single-post-thumbnail' ); ?>
       </a>
       <figcaption class="dpp-project-short-description">	<?php echo $project->post_title .' - ' . dpp_project_information_get_meta( 'project_information_short_description', $project->ID ); ?> </figcaption>
     </figure>
   </article>
 <?php } ?>
 <div class="clear"></div>
 </div>
