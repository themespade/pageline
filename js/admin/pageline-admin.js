/**
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
jQuery(document).ready(function() {
	jQuery('.controls#pageline-img-container li img').click(function(){
		jQuery('.controls#pageline-img-container li').each(function(){
			jQuery(this).find('img').removeClass ('pageline-radio-img-selected') ;
		});
		jQuery(this).addClass ('pageline-radio-img-selected') ;
	});
});
