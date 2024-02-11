<?php 
get_header(); 
$post_date = get_the_date(); // Get the post date

// Convert the post date into a DateTime object
$post_date_obj = date_create($post_date);

// Format the month and date separately
$month = date_format($post_date_obj, 'M'); // Full month name
$day = date_format($post_date_obj, 'd');   // Day without leading zeros

// Output the formatted date


?>


<style>
	.post-thumbnail img{
		width: 100%;
		height: auto;
	}
	.reed-more {
		background-color: #F6F6F6;
		border: 1px solid #f0f0f0;
		display: table;
		margin-top: 20px;
		padding: 5px 15px;
		border-radius: 3px;
		text-decoration: none !important;
		font-weight: 500;
	}
	.reed-more:hover {
		background-color: #184675;
		color: #fff;
	}
	.post-content{
		padding: 30px 20px;
	} 

	@media (max-width: 767px) {
		.post-thumbnail img{
			width: 100%;
			height: auto;
		}

		
		.soc-category .flex h2 {
			font-size: 20px;
			line-height: 1.1;
		}
		.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
			padding-right: 0;
		}
	}
	@media (max-width: 320px) {
		.post-content{
			padding: 20px 10px;
		} 
		.post-thumbnail img{
			width: 100%;
			height: auto;
		}
		.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
			padding-right: 0;
		}
		.soc-category .flex h2 {
			font-size: 16px;
			line-height: 1.1;
		}
	}
</style>

<section class="soc-category" id="content">
    
    <?php get_template_part('template-parts/admin', 'breadcrumb'); ?>

    <div class="container">
        <div class="flex">
		<div id="main-content" class="site-content" style="transform: none;">
				<div class="container" style="transform: none;">		
					<div class="row" style="transform: none;">
		<div class="content-area col-xs-12 col-sm-8 col-md-9" style="padding-left: 0;">
			<div class="blog-posts">
							
							
												
					<div class="blog-posts post_large_image">
		
					<?php while(have_posts()) : the_post();?>
					<article class="post-23147 post type-post status-publish format-standard has-post-thumbnail hentry category-blog" style="background-color: #fff; margin-bottom: 20px;">

						<div class="entry-thumbnail">
							<a class="post-thumbnail" href="<?php the_permalink();?>">
								<?php the_post_thumbnail();?>
							</a>
						</div>

							
						<div class="post-content">
							<div class="post-heading" style="display: flex; ">
								<div class="psot-date">
									<span style="display: block; padding: 5px; background-color: #f7f7f7; align-items: center; text-align: center; margin-right: 8px; font-width: 500;"><?php echo $day;?></span>
									<span style="display: block; padding: 3px 5px; background-color: #337ab7; align-items: center; text-align: center; margin-right: 8px; color: #fff;"><?php echo $month;?></span>
								</div>
							
								<header class="entry-header" style="background-color: #fff;">
								
								<h2 class="entry-title" style="background-color: #fff; margin: 6px 0;"><a href="<?php the_permalink( );?>"><?php the_title();?></a></h2>
								<div class="comments-count">
									<span class="comments-link"><a href="<?PHP the_permalink();?>/#respond">Leave a comment<span class="screen-reader-text"> on How Trustpilot Reviews Affect Consumer Behavior?</span></a></span>
								</div>	
								</header><!-- .entry-header -->
							</div>
								
							
							<div class="entry-content"  style="padding-top: 5px;">
								<?php echo wp_trim_words( get_the_content(), 52, false ) . " ...";?>		
							</div>
							<a href="<?php the_permalink(  );?>" class="reed-more">Read more</a>
						</div>
						
					</article><!-- #post-## -->
					<?php endwhile;?>
					
					<div class="pagination-bar" style="text-align: center !important;"></div>
					<?php 
						if (function_exists('the_posts_pagination')) {
							the_posts_pagination(array(
								'screen_reader_text'  => __(' ', 'bcmarket'),
								'prev_text'           => __('<span aria-hidden="true"><Perv</span>', 'bcmarket'),
								'next_text'           => __('<span aria-hidden="true">Next></span>', 'bcmarket'),
							));
						} ?>
					</div>
		</div>
			
				
				<div id="sidebar" class="sidebar col-xs-12 col-sm-4 col-md-3 " style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
					<!-- .secondary -->
				<div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; top: 30px; left: 1067.1px;"><div id="secondary" class="secondary">

						
					</div></div></div>
				</div>
			</div><!-- .content-area -->
		</div>
		</div>
    </div>
</section>

<?php get_footer() ?>