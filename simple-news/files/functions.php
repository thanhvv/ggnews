<?php
function simple_news_loop($limitWordTitle, $limitWordContent, $formatDate, $imgtype) {
	$img_options = get_option( 'simple_news_settings' );

echo '<div id="post-id-' .get_the_ID() . '" class="simple-news-item">';

if ( has_post_thumbnail() ) :
	echo '<div class="simple-news-img-con">';
	echo '<a class="simple-news-item-link" href="' . get_the_permalink() . '">';
	echo '<img src="' .get_the_post_thumbnail_url(get_the_ID(), $imgtype). '">';
	echo '</a>';
	echo '</div>';
endif;

echo '<div class="simple-news-text-con">';
echo '<h4 class="simple-news-title"><a class="simple-news-item-link" href="' . get_the_permalink() . '">' . wp_trim_words(get_the_title(), $limitWordTitle) . '</a></h4>';
echo '<div class="simple-news-date">' . get_the_date($formatDate) . '</div>';
echo '<div class="simple-news-excerpt">' . wp_trim_words(get_the_excerpt(), $limitWordContent) . '</div>';
echo '</div>';
echo '</div>';

}