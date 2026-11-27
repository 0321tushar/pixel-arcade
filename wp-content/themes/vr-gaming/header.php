<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta http-equiv="Content-Type" content="<?php echo esc_attr(get_bloginfo('html_type')); ?>; charset=<?php echo esc_attr(get_bloginfo('charset')); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />

<!-- Pixel Arcade Custom Favicon & Theme Color -->
<link rel="icon" type="image/svg+xml" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/pixel_arcade_favicon.svg'); ?>" />
<link rel="alternate icon" href="<?php echo esc_url(home_url('/favicon.svg')); ?>" />
<meta name="theme-color" content="#080910" />

<?php
// Dynamic SEO Meta & OpenGraph
$seo_title = wp_get_document_title();
$seo_desc = 'Play free online HTML5 and WebGL games at Pixel Arcade. Instant play with zero downloads, high performance, and smooth gaming experience.';
$seo_url = home_url(add_query_arg(array(), $wp->request ?? ''));
$seo_image = get_template_directory_uri() . '/assets/images/banner.png';
$seo_type = 'website';

if (is_singular('post')) {
    global $post;
    $seo_title = get_the_title() . ' - Play Free Online | Pixel Arcade';
    $custom_desc = wp_strip_all_tags(get_the_excerpt());
    if (!$custom_desc) {
        $custom_desc = wp_strip_all_tags($post->post_content);
    }
    // Clean out any injected ad labels from SEO snippet
    $custom_desc = preg_replace('/.*?Shop Now.*?(&raquo;|»|;)?/si', '', $custom_desc);
    $custom_desc = preg_replace('/(⚡|SPONSORED).*$/si', '', $custom_desc);
    $custom_desc = trim(preg_replace('/^(&raquo;|»|\s)+/', '', $custom_desc));
    $custom_desc = trim(preg_replace('/\s+/', ' ', $custom_desc));
    if ($custom_desc) {
        $seo_desc = esc_attr(substr($custom_desc, 0, 155));
    }
    $seo_url = get_permalink();
    $seo_type = 'game';
    if (has_post_thumbnail()) {
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
        if ($thumb) $seo_image = $thumb[0];
    }
}
?>
<!-- Search Engine Optimization (SEO) Meta Tags -->
<meta name="description" content="<?php echo esc_attr($seo_desc); ?>" />
<meta name="keywords" content="free online games, html5 games, unblocked games, browser games, pixel arcade, play now, car games, sports games, 2 player games" />
<link rel="canonical" href="<?php echo esc_url($seo_url); ?>" />

<!-- Open Graph (Facebook, WhatsApp, Discord Previews) -->
<meta property="og:site_name" content="Pixel Arcade" />
<meta property="og:title" content="<?php echo esc_attr($seo_title); ?>" />
<meta property="og:description" content="<?php echo esc_attr($seo_desc); ?>" />
<meta property="og:url" content="<?php echo esc_url($seo_url); ?>" />
<meta property="og:type" content="<?php echo esc_attr($seo_type); ?>" />
<meta property="og:image" content="<?php echo esc_url($seo_image); ?>" />

<!-- Twitter Card Tags -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="<?php echo esc_attr($seo_title); ?>" />
<meta name="twitter:description" content="<?php echo esc_attr($seo_desc); ?>" />
<meta name="twitter:image" content="<?php echo esc_url($seo_image); ?>" />

<!-- Google Schema.org Structured Data (JSON-LD) -->
<?php if (is_singular('post')) : ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "VideoGame",
  "name": "<?php echo esc_js(get_the_title()); ?>",
  "description": "<?php echo esc_js($seo_desc); ?>",
  "url": "<?php echo esc_url($seo_url); ?>",
  "image": "<?php echo esc_url($seo_image); ?>",
  "operatingSystem": "Web Browser (HTML5 / WebGL)",
  "applicationCategory": "Game",
  "inLanguage": "en",
  "playMode": "SinglePlayer, MultiPlayer",
  "offers": {
    "@type": "Offer",
    "price": "0",
    "priceCurrency": "USD",
    "availability": "https://schema.org/InStock"
  }
}
</script>
<?php else : ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "Pixel Arcade",
  "url": "<?php echo esc_url(home_url('/')); ?>",
  "description": "Play Free Online HTML5 & WebGL Games with Zero Lag",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "<?php echo esc_url(home_url('/?s={search_term_string}')); ?>",
    "query-input": "required name=search_term_string"
  }
}
</script>
<?php endif; ?>

<script>
window.filterCategory = function(cat, triggerEl) {
  const pills = document.querySelectorAll('.cat-pill');
  pills.forEach(p => {
    p.style.background = '#131522';
    p.style.color = '#c8d6e5';
    p.style.borderColor = '#282d47';
  });
  if (triggerEl && triggerEl.classList && triggerEl.classList.contains('cat-pill')) {
    triggerEl.style.background = '#00d2d3';
    triggerEl.style.color = '#080910';
    triggerEl.style.borderColor = '#00d2d3';
  } else {
    const matchingPill = document.querySelector('.cat-pill[onclick*="' + cat + '"]');
    if (matchingPill) {
      matchingPill.style.background = '#00d2d3';
      matchingPill.style.color = '#080910';
      matchingPill.style.borderColor = '#00d2d3';
    }
  }

  const cards = document.querySelectorAll('.games-grid .g-card');
  cards.forEach(card => {
    const dataCat = card.getAttribute('data-cat') || '';
    if (cat === 'all' || dataCat.toLowerCase().includes(cat.toLowerCase())) {
      card.style.display = 'flex';
    } else {
      card.style.display = 'none';
    }
  });

  const catalogEl = document.getElementById('catalog');
  if (catalogEl && triggerEl && !triggerEl.classList.contains('cat-pill')) {
    catalogEl.scrollIntoView({ behavior: 'smooth' });
  }
};
</script>

<?php wp_head(); ?>

<style>
/* 3D Main Logo Animation & Interactive Hover */
@keyframes arcade3DLogoFloat {
  0% {
    transform: perspective(600px) rotateY(0deg) rotateX(0deg) translateZ(0);
    filter: drop-shadow(0 0 10px rgba(0, 210, 211, 0.7));
  }
  25% {
    transform: perspective(600px) rotateY(-12deg) rotateX(6deg) translateZ(8px);
    filter: drop-shadow(-4px 4px 14px rgba(0, 210, 211, 0.9));
  }
  50% {
    transform: perspective(600px) rotateY(0deg) rotateX(-5deg) translateZ(14px) scale(1.03);
    filter: drop-shadow(0 0 20px rgba(84, 160, 255, 1));
  }
  75% {
    transform: perspective(600px) rotateY(12deg) rotateX(6deg) translateZ(8px);
    filter: drop-shadow(4px 4px 14px rgba(255, 0, 127, 0.8));
  }
  100% {
    transform: perspective(600px) rotateY(0deg) rotateX(0deg) translateZ(0);
    filter: drop-shadow(0 0 10px rgba(0, 210, 211, 0.7));
  }
}

@keyframes logoEmblemSpin3D {
  0% {
    transform: perspective(400px) rotateY(0deg);
  }
  50% {
    transform: perspective(400px) rotateY(180deg) scale(1.1);
  }
  100% {
    transform: perspective(400px) rotateY(360deg);
  }
}

.logo-arcade-3d-wrap {
  display: flex !important;
  align-items: center !important;
  gap: 12px !important;
  text-decoration: none !important;
  transform-style: preserve-3d !important;
  animation: arcade3DLogoFloat 5s ease-in-out infinite !important;
  transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
}

.logo-arcade-3d-wrap:hover {
  transform: perspective(600px) scale(1.08) rotateY(-10deg) rotateX(8deg) !important;
  animation-play-state: paused !important;
}

.logo-arcade-3d-emblem {
  width: 44px !important;
  height: 44px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  transform-style: preserve-3d !important;
  transition: transform 0.5s ease !important;
}

.logo-arcade-3d-wrap:hover .logo-arcade-3d-emblem {
  animation: logoEmblemSpin3D 1.2s ease-in-out !important;
}

.logo-arcade-3d-text {
  font-size: 22px !important;
  font-weight: 900 !important;
  letter-spacing: 1.8px !important;
  line-height: 1 !important;
  background: linear-gradient(135deg, #ffffff 0%, #00d2d3 50%, #54a0ff 100%) !important;
  -webkit-background-clip: text !important;
  -webkit-text-fill-color: transparent !important;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
}

/* Sleek Compact Comment Box */
#respond {
  max-width: 600px !important;
  margin-top: 20px !important;
}
#reply-title {
  font-size: 18px !important;
  color: #00d2d3 !important;
  margin-bottom: 6px !important;
  font-family: sans-serif !important;
}
.comment-form .logged-in-as, 
.comment-form p.comment-notes {
  font-size: 12px !important;
  color: #718096 !important;
  margin-bottom: 8px !important;
}
.comment-form-comment label {
  font-size: 13px !important;
  color: #a4b0be !important;
  display: block !important;
  margin-bottom: 4px !important;
}
#comment {
  width: 100% !important;
  max-width: 520px !important;
  height: 65px !important;
  min-height: 65px !important;
  background: #111422 !important;
  color: #ffffff !important;
  border: 1px solid #282d47 !important;
  border-radius: 8px !important;
  padding: 8px 12px !important;
  font-size: 13px !important;
  resize: vertical !important;
  display: block !important;
}
#comment:focus {
  border-color: #00d2d3 !important;
  outline: none !important;
  box-shadow: 0 0 10px rgba(0,210,211,0.25) !important;
}
.comment-respond input#submit {
  padding: 7px 20px !important;
  font-size: 13px !important;
  font-weight: 700 !important;
  border-radius: 6px !important;
  background: linear-gradient(135deg, #ff007f, #7928ca) !important;
  color: #fff !important;
  border: none !important;
  cursor: pointer !important;
  margin-top: 6px !important;
}
</style>
</head>

<body <?php body_class(); ?>>

<?php
	if ( function_exists( 'wp_body_open' ) )
	{
		wp_body_open();
	}else{
		do_action('wp_body_open');
	}
?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'vr-gaming' ); ?></a>

<?php if(get_theme_mod('vr_gaming_site_loader',false)!= ''){ ?>
    <?php if(get_theme_mod( 'vr_gaming_preloader_type','four-way-loader') == 'four-way-loader'){ ?>
	    <div class="cssloader">
	    	<div class="sh1"></div>
	    	<div class="sh2"></div>
	    	<h1 class="lt"><?php esc_html_e( 'loading',  'vr-gaming' ); ?></h1>
	    </div>
    <?php }else if(get_theme_mod( 'vr_gaming_preloader_type') == 'cube-loader') {?>
		<div class="cssloader">
    		<div class="loader-main ">
				<div class="triangle35b"></div>
				<div class="triangle35b"></div>
				<div class="triangle35b"></div>
			</div>
    	</div>
    <?php }?>
<?php }?>

<div class="sticky-header main-menus" style="background: #080910; border-bottom: 2px solid #1a1e30; position: sticky; top: 0; z-index: 99999; box-shadow: 0 4px 25px rgba(0,0,0,0.7);">
	<header id="site-navigationn" style="padding: 12px 0;">
		<div class="container">
			<div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
				
				<!-- 1. 3D GLOWING ANIMATED LOGO -->
				<div>
					<a href="<?php echo esc_url(home_url('/')); ?>" class="logo-arcade-3d-wrap">
						<div class="logo-arcade-3d-emblem">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/pixel_arcade_favicon.svg'); ?>" alt="Pixel Arcade" style="width: 100%; height: 100%; object-fit: contain; filter: drop-shadow(0 0 10px rgba(0, 210, 211, 0.8));" />
						</div>
						<div style="display: flex; flex-direction: column; justify-content: center;">
							<span class="logo-arcade-3d-text">PIXEL ARCADE</span>
						</div>
					</a>
				</div>

				<!-- 2. PRO NAVIGATION LINKS -->
				<div style="display: flex; gap: 24px; align-items: center; flex-wrap: wrap; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
					<a href="<?php echo esc_url(home_url('/')); ?>" style="color: #00d2d3; font-weight: 800; font-size: 14px; text-decoration: none; transition: 0.2s;">🏠 Home</a>
					<a href="<?php echo esc_url(home_url('/basket-random-2-player-ragdoll/')); ?>" style="color: #c8d6e5; font-weight: 700; font-size: 14px; text-decoration: none; transition: 0.2s;">🔥 All Games</a>
					<a href="<?php echo esc_url(home_url('/#leaderboard')); ?>" style="color: #c8d6e5; font-weight: 700; font-size: 14px; text-decoration: none; transition: 0.2s;">🏆 Leaderboard</a>
					<a href="<?php echo esc_url(home_url('/#store')); ?>" style="color: #ff9ff3; font-weight: 800; font-size: 14px; text-decoration: none; transition: 0.2s;">🛒 Arcade Store</a>
					<a href="<?php echo esc_url(home_url('/#contact')); ?>" style="color: #c8d6e5; font-weight: 700; font-size: 14px; text-decoration: none; transition: 0.2s;">📞 Contact</a>
				</div>

				<!-- 3. ACTION BUTTONS (PLAY & LOGIN) -->
				<div style="display: flex; gap: 12px; align-items: center;">
					<a href="<?php echo esc_url(home_url('/basket-random-2-player-ragdoll/')); ?>" style="background: linear-gradient(135deg, #ff007f 0%, #7928ca 100%); color: #ffffff; font-weight: 900; font-size: 13px; padding: 8px 20px; border-radius: 20px; text-decoration: none; box-shadow: 0 4px 18px rgba(255, 0, 127, 0.45); letter-spacing: 0.8px; display: inline-flex; align-items: center; gap: 6px; text-shadow: 0 1px 3px rgba(0,0,0,0.5);">▶ PLAY NOW</a>
					<a href="javascript:void(0)" onclick="openArcadeAuthModal(event)" id="nav-login-btn" style="background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.25); color: #ffffff; font-weight: 700; font-size: 12px; padding: 7px 16px; border-radius: 20px; text-decoration: none; letter-spacing: 0.5px; cursor: pointer; transition: all 0.2s ease;">👤 LOGIN</a>
				</div>

			</div>
		</div>

		<?php 
		if (file_exists(get_template_directory() . '/auth-modal.php')) {
			include get_template_directory() . '/auth-modal.php';
		}
		?>
	</header>
</div>