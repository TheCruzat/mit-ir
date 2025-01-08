<?php
/**
 * Page Template
 *
 * @package mit-ir
 * @since 0.0.1
 */

namespace MITIR;

get_header();

$p404 = \get_field('404', 'Options');
?>
<main id="main" class="site-main page-404">
	<div id="content" <?php post_class('page-content page-content--full-width'); ?>>
		<div class="eyebrow">Page Not Found</div>
		<h1>404</h1>

		<h3><?php echo $p404['text_heading'] ?></h3>
		<p><?php ecn($p404['text']); ?></p>

		<?php if($p404['cta'] != null) :
			if($p404['cta']['target'] == '_blank') :
				$targ = ' target="_blank"';
			else :
				$targ = '';
			endif;
			?>
		<a href="<?= $p404['cta']['url'] ?>" class="button btn"<?= $targ ?>><?= $p404['cta']['title'] ?></a>
		<?php endif; ?>
	</div>
</main><!-- #main -->
<?php
get_footer();
