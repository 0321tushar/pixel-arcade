<?php get_header(); ?>

<div id="content">
  <!-- ⚡ LIVE TICKER BAR (Permanent, Zero-API, Self-Contained) -->
  <div style="background: #080a12; border-bottom: 1px solid #1a2035; padding: 9px 0; overflow: hidden; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
    <div class="container" style="max-width: 1260px; display: flex; align-items: center; gap: 15px;">
      <div style="background: linear-gradient(135deg, #ff007f, #7928ca); color: #fff; font-size: 11px; font-weight: 800; padding: 4px 10px; border-radius: 4px; text-transform: uppercase; white-space: nowrap; letter-spacing: 1px; display: flex; align-items: center; gap: 6px; box-shadow: 0 0 10px rgba(255, 0, 127, 0.4);">
        <span style="display: inline-block; width: 7px; height: 7px; background: #fff; border-radius: 50%; box-shadow: 0 0 6px #fff; animation: pulseRed 1.2s infinite;"></span>
        LIVE PULSE
      </div>
      <div style="overflow: hidden; white-space: nowrap; width: 100%; position: relative;">
        <div class="news-ticker-track" style="display: inline-block; animation: tickerScroll 40s linear infinite;">
          <span style="color: #a4b0be; font-size: 13px; margin-right: 35px;"><strong style="color: #00d2d3;">🔥 GTA VI:</strong> Rockstar reveals Vice City map is 2.5x larger than Los Santos with advanced physics.</span>
          <span style="color: #a4b0be; font-size: 13px; margin-right: 35px;"><strong style="color: #ff9ff3;">🏆 ESPORTS:</strong> NAVI takes down FaZe Clan 13-11 in historic CS2 Major Grand Championship!</span>
          <span style="color: #a4b0be; font-size: 13px; margin-right: 35px;"><strong style="color: #54a0ff;">🚀 STEAM:</strong> Valve shatters record with 38.5 Million concurrent online gamers.</span>
          <span style="color: #a4b0be; font-size: 13px; margin-right: 35px;"><strong style="color: #00d2d3;">👾 VALORANT:</strong> New Agent 'Vandalier' teased for Episode 9 Champions Launch.</span>
          <span style="color: #a4b0be; font-size: 13px; margin-right: 35px;"><strong style="color: #ff9ff3;">⚡ PS5 PRO:</strong> 120 FPS 4K Ray-Tracing upgrades roll out across top 50 blockbusters.</span>
          <span style="color: #a4b0be; font-size: 13px; margin-right: 35px;"><strong style="color: #54a0ff;">👑 ELDEN RING:</strong> FromSoftware confirms 25M copies sold, hints at multiplayer expansion.</span>
          <!-- Duplicate for seamless infinite loop -->
          <span style="color: #a4b0be; font-size: 13px; margin-right: 35px;"><strong style="color: #00d2d3;">🔥 GTA VI:</strong> Rockstar reveals Vice City map is 2.5x larger than Los Santos with advanced physics.</span>
          <span style="color: #a4b0be; font-size: 13px; margin-right: 35px;"><strong style="color: #ff9ff3;">🏆 ESPORTS:</strong> NAVI takes down FaZe Clan 13-11 in historic CS2 Major Grand Championship!</span>
          <span style="color: #a4b0be; font-size: 13px; margin-right: 35px;"><strong style="color: #54a0ff;">🚀 STEAM:</strong> Valve shatters record with 38.5 Million concurrent online gamers.</span>
          <span style="color: #a4b0be; font-size: 13px; margin-right: 35px;"><strong style="color: #00d2d3;">👾 VALORANT:</strong> New Agent 'Vandalier' teased for Episode 9 Champions Launch.</span>
          <span style="color: #a4b0be; font-size: 13px; margin-right: 35px;"><strong style="color: #ff9ff3;">⚡ PS5 PRO:</strong> 120 FPS 4K Ray-Tracing upgrades roll out across top 50 blockbusters.</span>
          <span style="color: #a4b0be; font-size: 13px; margin-right: 35px;"><strong style="color: #54a0ff;">👑 ELDEN RING:</strong> FromSoftware confirms 25M copies sold, hints at multiplayer expansion.</span>
        </div>
      </div>
    </div>
  </div>

  <style>
  @keyframes tickerScroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
  }
  @keyframes pulseRed {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.3; transform: scale(0.8); }
  }
  .news-ticker-track:hover {
    animation-play-state: paused;
  }
  .gaming-news-card {
    transition: all 0.25s ease;
  }
  .gaming-news-card:hover {
    transform: translateY(-2px);
    border-color: #00d2d3 !important;
    box-shadow: 0 6px 20px rgba(0, 210, 211, 0.15) !important;
  }
  </style>

  <div class="container" style="max-width: 1260px; margin-top: 25px;">
    <div class="row">

      <!-- LEFT: GAME PLAYER & CONTROLS (8 Cols) -->
      <div class="col-lg-8 col-xl-8">
        <?php
          while ( have_posts() ) :
            the_post();
        ?>

        <!-- 🎮 PRO ARCADE QUICK ACTION BAR (Fullscreen, Restart) -->
        <div id="game-arcade-toolbar" style="display: none; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; background: #0c0e18; border: 1px solid #1f253d; border-radius: 12px; padding: 10px 16px; margin: 15px auto 14px auto; max-width: 960px; box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; box-shadow: 0 4px 20px rgba(0,0,0,0.4);">
          <div style="display: flex; align-items: center; gap: 10px;">
            <span style="display: inline-flex; align-items: center; gap: 6px; background: rgba(0, 210, 211, 0.12); color: #00d2d3; border: 1px solid rgba(0, 210, 211, 0.35); font-size: 11px; font-weight: 800; padding: 4px 10px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.8px;">
              <span style="width: 7px; height: 7px; background: #00d2d3; border-radius: 50%; box-shadow: 0 0 8px #00d2d3; animation: pulseGlow 1.4s infinite;"></span>
              LIVE WEBGL
            </span>
            <span style="color: #ffffff; font-size: 14px; font-weight: 800; display: inline-block; max-width: 340px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
              <?php the_title(); ?>
            </span>
          </div>

          <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            <!-- 🔲 Fullscreen Button -->
            <button id="btn-arcade-fullscreen" type="button" style="cursor: pointer; display: inline-flex; align-items: center; gap: 7px; background: linear-gradient(135deg, #00d2d3, #0984e3); color: #080910; border: none; font-size: 12px; font-weight: 800; padding: 8px 16px; border-radius: 6px; transition: all 0.2s ease; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 4px 12px rgba(0, 210, 211, 0.35);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 18px rgba(0, 210, 211, 0.5)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 4px 12px rgba(0, 210, 211, 0.35);'">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/></svg>
              <span>Play Fullscreen</span>
            </button>

            <!-- 🔄 Restart Game Button -->
            <button id="btn-arcade-restart" type="button" style="cursor: pointer; display: inline-flex; align-items: center; gap: 6px; background: #131728; color: #c8d6e5; border: 1px solid #28314f; font-size: 12px; font-weight: 700; padding: 8px 14px; border-radius: 6px; transition: all 0.2s ease;" onmouseover="this.style.color='#fff'; this.style.borderColor='#00d2d3'; this.style.transform='translateY(-2px)';" onmouseout="this.style.color='#c8d6e5'; this.style.borderColor='#28314f'; this.style.transform='none';" title="Restart Game">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0 1 18.8-4.3M22 12.5a10 10 0 0 1-18.8 4.2"/></svg>
              <span>Restart</span>
            </button>
          </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
          const toolbar = document.getElementById('game-arcade-toolbar');
          const iframe = document.querySelector('.post-content iframe');
          if (!iframe || !toolbar) return;

          // Position toolbar right above the game iframe container
          const gameWrap = iframe.parentElement;
          if (gameWrap && gameWrap.parentNode) {
            gameWrap.parentNode.insertBefore(toolbar, gameWrap);
            toolbar.style.display = 'flex';
          }

          // Fullscreen Logic
          const fsBtn = document.getElementById('btn-arcade-fullscreen');
          if (fsBtn) {
            fsBtn.addEventListener('click', function() {
              const target = iframe;
              if (target.requestFullscreen) {
                target.requestFullscreen();
              } else if (target.webkitRequestFullscreen) {
                target.webkitRequestFullscreen();
              } else if (target.mozRequestFullScreen) {
                target.mozRequestFullScreen();
              } else if (target.msRequestFullscreen) {
                target.msRequestFullscreen();
              }
              setTimeout(function() {
                try {
                  iframe.focus();
                  if (iframe.contentWindow) iframe.contentWindow.focus();
                } catch(e) {}
              }, 150);
            });
          }

          // Restart Logic
          const restartBtn = document.getElementById('btn-arcade-restart');
          if (restartBtn) {
            restartBtn.addEventListener('click', function() {
              const orig = iframe.src;
              iframe.style.opacity = '0.3';
              iframe.style.transition = 'opacity 0.25s ease';
              iframe.src = orig;
              setTimeout(function() {
                iframe.style.opacity = '1';
              }, 350);
            });
          }

          // Prevent window scroll on arrow keys and space when playing
          window.addEventListener('keydown', function(e) {
            if (['ArrowUp', 'ArrowDown', 'Space'].includes(e.code) && (document.activeElement === iframe || document.activeElement.tagName === 'IFRAME')) {
              e.preventDefault();
            }
          }, { passive: false });
        });
        </script>
        <style>
        @keyframes pulseGlow {
          0%, 100% { opacity: 1; transform: scale(1); }
          50% { opacity: 0.35; transform: scale(0.85); }
        }
        </style>

        <?php
            get_template_part( 'template-parts/content', 'post');

            wp_link_pages(
              array(
                'before' => '<div class="vr-gaming-pagination">',
                'after' => '</div>',
                'link_before' => '<span>',
                'link_after' => '</span>'
              )
            );
          endwhile;
        ?>

        <!-- Clean Related Games Hub -->
        <div class="related-posts layout-img" style="margin-top: 40px; border-top: 1px solid #1a1e30; padding-top: 25px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
              <h3 style="color: #00d2d3; font-size: 21px; font-weight: 800; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; margin: 0; display: flex; align-items: center; gap: 8px;">
                🎮 Play More Free Games:
              </h3>
            </div>
            <div class="row">
                <?php
                $current_game_id = get_the_ID();
                $vr_gaming_related_args = array(
                    'posts_per_page' => 8,
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC'
                );
                
                $vr_gaming_related_query = new WP_Query($vr_gaming_related_args);
                
                if ($vr_gaming_related_query->have_posts()) {
                    while ($vr_gaming_related_query->have_posts()) {
                        $vr_gaming_related_query->the_post();
                        $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                        $is_current = (get_the_ID() === $current_game_id);
                ?>
                        <div class="col-lg-6 col-md-6 py-2">
                            <a href="<?php the_permalink(); ?>" style="text-decoration: none; display: flex; align-items: center; gap: 14px; background: <?php echo $is_current ? '#13192b' : '#0c0e18'; ?>; border: 1px solid <?php echo $is_current ? '#00d2d3' : '#1f253d'; ?>; border-radius: 12px; padding: 12px 14px; transition: all 0.2s ease; box-shadow: 0 4px 15px rgba(0,0,0,0.3);" onmouseover="this.style.borderColor='#00d2d3'; this.style.transform='translateY(-2px)';" onmouseout="this.style.borderColor='<?php echo $is_current ? '#00d2d3' : '#1f253d'; ?>'; this.style.transform='none';">
                              <div style="position: relative; width: 92px; height: 56px; border-radius: 8px; overflow: hidden; border: 1px solid #28314f; flex-shrink: 0; box-shadow: 0 4px 12px rgba(0,0,0,0.5); background: #131726;">
                                <?php if ($thumb_url): ?>
                                  <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>" style="width: 100%; height: 100%; object-fit: cover; display: block;" />
                                <?php else: ?>
                                  <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 22px;">🎮</div>
                                <?php endif; ?>
                                <span style="position: absolute; bottom: 3px; right: 3px; background: <?php echo $is_current ? 'rgba(0, 210, 211, 0.9)' : 'rgba(0,0,0,0.75)'; ?>; color: <?php echo $is_current ? '#080910' : '#00d2d3'; ?>; font-size: 8px; font-weight: 800; padding: 1px 4px; border-radius: 3px; letter-spacing: 0.5px;"><?php echo $is_current ? 'PLAYING' : 'LIVE'; ?></span>
                              </div>
                              <div style="flex-grow: 1; min-width: 0;">
                                <div style="color: #ffffff; font-weight: 800; font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
                                  <?php the_title(); ?>
                                </div>
                                <div style="display: flex; align-items: center; gap: 10px; margin-top: 4px;">
                                  <span style="color: #feca57; font-size: 11.5px; font-weight: 700;">⭐ 4.8+</span>
                                  <?php if ($is_current): ?>
                                    <span style="background: rgba(0, 210, 211, 0.25); color: #00d2d3; border: 1px solid #00d2d3; font-size: 10px; font-weight: 800; padding: 2px 8px; border-radius: 4px; text-transform: uppercase;">🎮 NOW PLAYING</span>
                                  <?php else: ?>
                                    <span style="background: rgba(0, 210, 211, 0.15); color: #00d2d3; border: 1px solid rgba(0, 210, 211, 0.4); font-size: 10px; font-weight: 800; padding: 2px 8px; border-radius: 4px; text-transform: uppercase;">▶ PLAY NOW</span>
                                  <?php endif; ?>
                                </div>
                              </div>
                            </a>
                        </div>
                    <?php }
                    wp_reset_postdata();
                }
                ?>
            </div>
        </div>
        <!-- End Related Games -->
      </div>

      <!-- RIGHT: WORLD GAMING NEWS SIDEBAR (4 Cols) -->
      <div class="col-lg-4 col-xl-4 mt-4 mt-lg-0">
        
        <div style="background: #0c0e17; border: 1px solid #1c2237; border-radius: 14px; padding: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; position: -webkit-sticky; position: sticky; top: 85px;">
          
          <!-- News Header -->
          <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #1b2136; padding-bottom: 12px; margin-bottom: 16px;">
            <div>
              <div style="font-size: 16px; font-weight: 800; color: #fff; letter-spacing: 0.5px; display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 18px;">⚡</span> NEWS
              </div>
              <div style="font-size: 11px; color: #718096; margin-top: 2px;">Live Global Esports & Industry Feed</div>
            </div>
            <div style="background: rgba(0, 210, 211, 0.1); border: 1px solid #00d2d3; color: #00d2d3; font-size: 10px; font-weight: 800; padding: 3px 8px; border-radius: 12px; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; gap: 4px;">
              <span style="width: 5px; height: 5px; background: #00d2d3; border-radius: 50%; box-shadow: 0 0 5px #00d2d3;"></span> LIVE
            </div>
          </div>

          <!-- News Cards List -->
          <div style="display: flex; flex-direction: column; gap: 11px;">

            <!-- Item 1 -->
            <div class="gaming-news-card" style="background: #111422; border: 1px solid #1f253d; border-radius: 10px; padding: 12px; text-align: left;">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                <span style="background: rgba(255, 0, 127, 0.2); color: #ff007f; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 4px; text-transform: uppercase;">🔥 BREAKING</span>
                <span style="color: #64748b; font-size: 11px;">12m ago</span>
              </div>
              <div style="color: #e2e8f0; font-size: 13px; font-weight: 700; line-height: 1.4; margin-bottom: 4px;">
                GTA VI: Rockstar Confirms Vice City Map 2.5x Larger than Los Santos
              </div>
              <div style="color: #718096; font-size: 11px;">Source: Rockstar Games Official</div>
            </div>

            <!-- Item 2 -->
            <div class="gaming-news-card" style="background: #111422; border: 1px solid #1f253d; border-radius: 10px; padding: 12px; text-align: left;">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                <span style="background: rgba(84, 160, 255, 0.2); color: #54a0ff; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 4px; text-transform: uppercase;">🏆 ESPORTS</span>
                <span style="color: #64748b; font-size: 11px;">45m ago</span>
              </div>
              <div style="color: #e2e8f0; font-size: 13px; font-weight: 700; line-height: 1.4; margin-bottom: 4px;">
                NAVI Clinches CS2 World Championship After 13-11 Overtime Thriller
              </div>
              <div style="color: #718096; font-size: 11px;">Source: PGL Major Arena</div>
            </div>

            <!-- Item 3 -->
            <div class="gaming-news-card" style="background: #111422; border: 1px solid #1f253d; border-radius: 10px; padding: 12px; text-align: left;">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                <span style="background: rgba(0, 210, 211, 0.2); color: #00d2d3; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 4px; text-transform: uppercase;">🚀 STEAM</span>
                <span style="color: #64748b; font-size: 11px;">2h ago</span>
              </div>
              <div style="color: #e2e8f0; font-size: 13px; font-weight: 700; line-height: 1.4; margin-bottom: 4px;">
                Steam Shatters World Record with 38.5 Million Peak Concurrent Players
              </div>
              <div style="color: #718096; font-size: 11px;">Source: Valve Analytics</div>
            </div>

            <!-- Item 4 -->
            <div class="gaming-news-card" style="background: #111422; border: 1px solid #1f253d; border-radius: 10px; padding: 12px; text-align: left;">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                <span style="background: rgba(255, 159, 243, 0.2); color: #ff9ff3; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 4px; text-transform: uppercase;">👾 VALORANT</span>
                <span style="color: #64748b; font-size: 11px;">4h ago</span>
              </div>
              <div style="color: #e2e8f0; font-size: 13px; font-weight: 700; line-height: 1.4; margin-bottom: 4px;">
                Riot Games Unveils New Duelist Agent 'Vandalier' for Champions Season
              </div>
              <div style="color: #718096; font-size: 11px;">Source: Riot VCT Tour</div>
            </div>

            <!-- Item 5 -->
            <div class="gaming-news-card" style="background: #111422; border: 1px solid #1f253d; border-radius: 10px; padding: 12px; text-align: left;">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                <span style="background: rgba(254, 202, 87, 0.2); color: #feca57; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 4px; text-transform: uppercase;">⚡ CONSOLE</span>
                <span style="color: #64748b; font-size: 11px;">6h ago</span>
              </div>
              <div style="color: #e2e8f0; font-size: 13px; font-weight: 700; line-height: 1.4; margin-bottom: 4px;">
                PS5 Pro: Sony Delivers 120 FPS 4K Ray-Tracing Upgrades for Top 50 Titles
              </div>
              <div style="color: #718096; font-size: 11px;">Source: PlayStation Blog</div>
            </div>

            <!-- Item 6 -->
            <div class="gaming-news-card" style="background: #111422; border: 1px solid #1f253d; border-radius: 10px; padding: 12px; text-align: left;">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                <span style="background: rgba(46, 213, 115, 0.2); color: #2ed573; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 4px; text-transform: uppercase;">🎮 NINTENDO</span>
                <span style="color: #64748b; font-size: 11px;">8h ago</span>
              </div>
              <div style="color: #e2e8f0; font-size: 13px; font-weight: 700; line-height: 1.4; margin-bottom: 4px;">
                Switch 2: NVIDIA Custom DLSS &amp; Full Backwards Compatibility Confirmed
              </div>
              <div style="color: #718096; font-size: 11px;">Source: Eurogamer Hardware</div>
            </div>

            <!-- Item 7 -->
            <div class="gaming-news-card" style="background: #111422; border: 1px solid #1f253d; border-radius: 10px; padding: 12px; text-align: left;">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                <span style="background: rgba(255, 107, 129, 0.2); color: #ff6b81; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 4px; text-transform: uppercase;">⛏️ MINECRAFT</span>
                <span style="color: #64748b; font-size: 11px;">10h ago</span>
              </div>
              <div style="color: #e2e8f0; font-size: 13px; font-weight: 700; line-height: 1.4; margin-bottom: 4px;">
                Mojang Teases Update 1.22: Mounts &amp; Ancient Weaponry Combat Overhaul
              </div>
              <div style="color: #718096; font-size: 11px;">Source: Minecraft Live</div>
            </div>

            <!-- Item 8 -->
            <div class="gaming-news-card" style="background: #111422; border: 1px solid #1f253d; border-radius: 10px; padding: 12px; text-align: left;">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                <span style="background: rgba(123, 237, 159, 0.2); color: #7bed9f; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 4px; text-transform: uppercase;">🔥 FORTNITE</span>
                <span style="color: #64748b; font-size: 11px;">14h ago</span>
              </div>
              <div style="color: #e2e8f0; font-size: 13px; font-weight: 700; line-height: 1.4; margin-bottom: 4px;">
                Chapter 6 Japanese Mythology Realm &amp; Katanas Break Active Player Records
              </div>
              <div style="color: #718096; font-size: 11px;">Source: Epic Games Wire</div>
            </div>

            <!-- Item 9 -->
            <div class="gaming-news-card" style="background: #111422; border: 1px solid #1f253d; border-radius: 10px; padding: 12px; text-align: left;">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                <span style="background: rgba(224, 86, 253, 0.2); color: #e056fd; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 4px; text-transform: uppercase;">👑 CYBERPUNK</span>
                <span style="color: #64748b; font-size: 11px;">18h ago</span>
              </div>
              <div style="color: #e2e8f0; font-size: 13px; font-weight: 700; line-height: 1.4; margin-bottom: 4px;">
                CD Projekt RED Enters Full Production on Project Orion (Cyberpunk Sequel)
              </div>
              <div style="color: #718096; font-size: 11px;">Source: CDPR Investor Brief</div>
            </div>

          </div>

          <!-- Live Top Arcade Champions Widget -->
          <div style="margin-top: 16px; background: #080a12; border: 1px solid #1c2237; border-radius: 10px; padding: 14px;">
            <div style="font-size: 12px; font-weight: 800; color: #feca57; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; display: flex; align-items: center; justify-content: space-between;">
              <span>🏆 Top Arcade Champions</span>
              <span style="font-size: 10px; color: #2ed573; font-weight: 700;">LIVE</span>
            </div>
            <div style="display: flex; flex-direction: column; gap: 8px; font-size: 12px;">
              <div style="display: flex; justify-content: space-between; align-items: center; background: #111422; padding: 6px 10px; border-radius: 6px;">
                <span style="color: #fff; font-weight: 700;">🥇 ShadowNinja 🇯🇵</span>
                <span style="color: #00d2d3; font-weight: 800;">98,420 pts</span>
              </div>
              <div style="display: flex; justify-content: space-between; align-items: center; background: #111422; padding: 6px 10px; border-radius: 6px;">
                <span style="color: #fff; font-weight: 700;">🥈 Viper_X 🇺🇸</span>
                <span style="color: #54a0ff; font-weight: 800;">84,110 pts</span>
              </div>
              <div style="display: flex; justify-content: space-between; align-items: center; background: #111422; padding: 6px 10px; border-radius: 6px;">
                <span style="color: #fff; font-weight: 700;">🥉 GhostRider_IN 🇮🇳</span>
                <span style="color: #feca57; font-weight: 800;">79,950 pts</span>
              </div>
            </div>
          </div>

          <!-- Official Arcade Store Promo Banner -->
          <div style="margin-top: 14px; background: linear-gradient(135deg, rgba(255,159,243,0.08) 0%, rgba(18,16,38,0.7) 100%); border: 1px dashed #ff9ff3; border-radius: 12px; padding: 14px; text-align: center; box-shadow: 0 4px 20px rgba(255,159,243,0.15);">
            <div style="font-size: 9.5px; font-weight: 800; color: #ff9ff3; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 4px;">🛍️ OFFICIAL ARCADE STORE</div>
            <div style="font-size: 13.5px; font-weight: 900; color: #ffffff;">Level Up Your Battlestation &bull; Flat 40% OFF</div>
            <div style="font-size: 11px; color: #a4b0be; margin: 4px 0 10px 0;">Mechanical Keyboards, Esports Merch & Mod Tools</div>
            <a href="<?php echo esc_url(home_url('/#store')); ?>" style="display: inline-block; background: linear-gradient(135deg, #ff4757, #ff6b81); color: #fff; font-size: 11px; font-weight: 800; text-decoration: none; padding: 6px 16px; border-radius: 6px; box-shadow: 0 3px 12px rgba(255, 71, 87, 0.4); text-transform: uppercase; letter-spacing: 0.5px;">VISIT STORE &raquo;</a>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>

<?php get_footer(); ?>