<?php
/**
 * Pixel Arcade - Gamer & Admin Authentication Modal
 */
?>
<!-- Custom Cyberpunk In-Page Popup Notification -->
<div id="arcade-gamer-toast" style="display: none; position: fixed; top: 28px; left: 50%; transform: translateX(-50%) translateY(-20px); background: linear-gradient(135deg, #0b1426 0%, #16223a 60%, #090e1b 100%); border: 1.5px solid #00f0ff; border-radius: 16px; padding: 14px 22px; box-shadow: 0 15px 45px rgba(0, 0, 0, 0.85), 0 0 25px rgba(0, 240, 255, 0.35); z-index: 100000000; align-items: center; gap: 14px; opacity: 0; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); pointer-events: none; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
  <div id="toast-avatar" style="font-size: 28px; filter: drop-shadow(0 0 8px #00f0ff);">🥷</div>
  <div>
    <div style="font-size: 13px; font-weight: 800; color: #ffffff; letter-spacing: 0.5px; display: flex; align-items: center; gap: 6px;">
      <span>PROFILE ACTIVATED</span>
      <span style="font-size: 9px; background: rgba(0,240,255,0.2); color: #00f0ff; border: 1px solid rgba(0,240,255,0.4); padding: 1px 6px; border-radius: 6px;">LEVEL 1</span>
    </div>
    <div id="toast-desc" style="font-size: 12px; color: #94a3b8; margin-top: 2px;">Welcome to Pixel Arcade!</div>
  </div>
</div>

<!-- Cyberpunk Auth Modal Overlay -->
<div id="arcade-auth-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(5, 7, 12, 0.88); backdrop-filter: blur(16px); z-index: 10000000; align-items: center; justify-content: center; padding: 20px;">
  
  <div class="auth-modal-box" style="width: 100%; max-width: 440px; background: linear-gradient(165deg, #0d121f 0%, #131a2c 60%, #0a0d16 100%); border: 1.5px solid rgba(0, 240, 255, 0.4); border-radius: 20px; padding: 28px 24px; box-shadow: 0 25px 70px rgba(0, 0, 0, 0.9), 0 0 40px rgba(0, 240, 255, 0.25); position: relative; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; animation: authFadeIn 0.25s ease;">
    
    <!-- Close Button -->
    <button onclick="closeArcadeAuthModal()" style="position: absolute; top: 16px; right: 16px; width: 32px; height: 32px; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 8px; color: #94a3b8; font-size: 14px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s ease;">✖</button>

    <!-- Header -->
    <div style="text-align: center; margin-bottom: 22px;">
      <div style="font-size: 32px; margin-bottom: 6px; filter: drop-shadow(0 0 12px #00f0ff);">⚡</div>
      <h3 style="color: #ffffff; font-size: 18px; font-weight: 900; letter-spacing: 1px; margin: 0;">ARCADE ACCESS PORTAL</h3>
      <p style="color: #94a3b8; font-size: 12px; margin-top: 4px;">Choose your clearance mode</p>
    </div>

    <!-- Mode Tabs -->
    <div style="display: flex; gap: 8px; background: rgba(0, 0, 0, 0.4); padding: 5px; border-radius: 12px; margin-bottom: 22px; border: 1px solid rgba(255, 255, 255, 0.08);">
      <button id="auth-tab-gamer" onclick="switchAuthTab('gamer')" style="flex: 1; padding: 10px; background: rgba(0, 240, 255, 0.15); border: 1px solid #00f0ff; border-radius: 8px; color: #00f0ff; font-weight: 800; font-size: 12px; cursor: pointer; letter-spacing: 0.5px; transition: all 0.2s ease;">🎮 Gamer Login</button>
      <button id="auth-tab-admin" onclick="switchAuthTab('admin')" style="flex: 1; padding: 10px; background: transparent; border: 1px solid transparent; border-radius: 8px; color: #94a3b8; font-weight: 800; font-size: 12px; cursor: pointer; letter-spacing: 0.5px; transition: all 0.2s ease;">🛡️ Studio Admin</button>
    </div>

    <!-- PANEL 1: GAMER LOGIN -->
    <div id="auth-panel-gamer" style="display: block;">
      <div style="margin-bottom: 16px;">
        <label style="display: block; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.5px;">Gamer Tag / Username</label>
        <input type="text" id="gamer-tag-input" placeholder="e.g. ShadowViper, CyberGhost..." maxlength="20" style="width: 100%; background: rgba(8, 12, 20, 0.8); border: 1px solid rgba(0, 240, 255, 0.3); border-radius: 10px; padding: 12px 14px; color: #ffffff; font-size: 14px; outline: none; font-weight: 600;">
      </div>

      <div style="margin-bottom: 20px;">
        <label style="display: block; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 8px; letter-spacing: 0.5px;">Select Avatar</label>
        <div style="display: grid; grid-template-columns: repeat(6, 1fr); gap: 8px;" id="avatar-picker-grid">
          <div class="avatar-option selected" onclick="selectAvatar(this, '🥷')" style="background: rgba(0,240,255,0.2); border: 1.5px solid #00f0ff; border-radius: 10px; padding: 8px; text-align: center; font-size: 20px; cursor: pointer;">🥷</div>
          <div class="avatar-option" onclick="selectAvatar(this, '🤖')" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 8px; text-align: center; font-size: 20px; cursor: pointer;">🤖</div>
          <div class="avatar-option" onclick="selectAvatar(this, '⚡')" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 8px; text-align: center; font-size: 20px; cursor: pointer;">⚡</div>
          <div class="avatar-option" onclick="selectAvatar(this, '👑')" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 8px; text-align: center; font-size: 20px; cursor: pointer;">👑</div>
          <div class="avatar-option" onclick="selectAvatar(this, '🐺')" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 8px; text-align: center; font-size: 20px; cursor: pointer;">🐺</div>
          <div class="avatar-option" onclick="selectAvatar(this, '🎮')" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 8px; text-align: center; font-size: 20px; cursor: pointer;">🎮</div>
        </div>
      </div>

      <button id="btn-submit-gamer" onclick="handleGamerLogin()" style="width: 100%; padding: 13px; background: linear-gradient(135deg, #00d2d3, #0984e3); border: none; border-radius: 10px; color: #ffffff; font-size: 13px; font-weight: 800; letter-spacing: 0.8px; cursor: pointer; box-shadow: 0 4px 18px rgba(0, 210, 211, 0.4); transition: 0.2s;">🚀 ENTER ARCADE LOUNGE</button>
      
      <!-- Logout Button (Shown when user is logged in) -->
      <div id="gamer-logout-wrap" style="display: none; margin-top: 10px;">
        <button onclick="handleGamerLogout()" style="width: 100%; padding: 11px; background: rgba(255, 0, 85, 0.12); border: 1px solid rgba(255, 0, 85, 0.35); border-radius: 10px; color: #ff0055; font-size: 12px; font-weight: 800; letter-spacing: 0.5px; cursor: pointer; transition: 0.2s;">🚪 LOGOUT GAMER PROFILE</button>
      </div>
    </div>

    <!-- PANEL 2: STUDIO ADMIN -->
    <div id="auth-panel-admin" style="display: none;">
      <div style="background: rgba(0, 240, 255, 0.08); border: 1px dashed rgba(0, 240, 255, 0.3); border-radius: 10px; padding: 12px; margin-bottom: 16px; font-size: 12px; color: #cbd5e1; text-align: center;">
        🔒 <strong>Studio Dashboard Access</strong><br>
        Direct access to edit Store products, Leaderboard rankings, and Pixel AI responses.
      </div>

      <div style="margin-bottom: 18px;">
        <label style="display: block; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.5px;">Admin Security Passcode</label>
        <input type="password" id="admin-passcode-field" placeholder="Enter Passcode (default: admin123)" style="width: 100%; background: rgba(8, 12, 20, 0.8); border: 1px solid rgba(0, 240, 255, 0.3); border-radius: 10px; padding: 12px 14px; color: #ffffff; font-size: 14px; outline: none; text-align: center; letter-spacing: 2px;" onkeydown="if(event.key==='Enter') handleAdminLogin()">
        <div id="admin-login-error" style="color: #ff0055; font-size: 11px; margin-top: 6px; text-align: center; display: none;">❌ Incorrect Passcode. Try: admin123</div>
      </div>

      <button onclick="handleAdminLogin()" style="width: 100%; padding: 13px; background: linear-gradient(135deg, #a855f7, #6366f1); border: none; border-radius: 10px; color: #ffffff; font-size: 13px; font-weight: 800; letter-spacing: 0.8px; cursor: pointer; box-shadow: 0 4px 18px rgba(168, 85, 247, 0.4); transition: 0.2s;">⚡ ACCESS ADMIN DASHBOARD</button>
      <p style="font-size: 11px; color: #64748b; text-align: center; margin-top: 10px;">Default Passcode: <strong>admin123</strong></p>
    </div>

  </div>
</div>

<style>
@keyframes authFadeIn {
  from { opacity: 0; transform: scale(0.95); }
  to { opacity: 1; transform: scale(1); }
}
</style>

<script>
(function() {
  let selectedAvatar = '🥷';

  window.openArcadeAuthModal = function(e) {
    if (e) e.preventDefault();
    const modal = document.getElementById('arcade-auth-modal');
    if (!modal) return;
    modal.style.display = 'flex';

    // If already logged in, check profile & show logout
    const profile = JSON.parse(localStorage.getItem('arcade_gamer_profile') || 'null');
    const logoutWrap = document.getElementById('gamer-logout-wrap');
    const submitBtn = document.getElementById('btn-submit-gamer');

    if (profile && profile.username) {
      document.getElementById('gamer-tag-input').value = profile.username;
      if (logoutWrap) logoutWrap.style.display = 'block';
      if (submitBtn) submitBtn.innerText = '💾 UPDATE GAMER PROFILE';
    } else {
      if (logoutWrap) logoutWrap.style.display = 'none';
      if (submitBtn) submitBtn.innerText = '🚀 ENTER ARCADE LOUNGE';
    }
  };

  window.handleGamerLogout = function() {
    localStorage.removeItem('arcade_gamer_profile');
    const btn = document.getElementById('nav-login-btn');
    if (btn) {
      btn.innerHTML = '👤 LOGIN';
      btn.style.borderColor = 'rgba(255, 255, 255, 0.25)';
    }
    document.getElementById('gamer-tag-input').value = '';
    closeArcadeAuthModal();

    showGamerPopup('Gamer', '👋');
    const desc = document.getElementById('toast-desc');
    if (desc) desc.innerHTML = 'Gamer profile logged out successfully. See you next time!';
  };

  window.closeArcadeAuthModal = function() {
    const modal = document.getElementById('arcade-auth-modal');
    if (modal) modal.style.display = 'none';
  };

  window.switchAuthTab = function(tab) {
    const tabGamer = document.getElementById('auth-tab-gamer');
    const tabAdmin = document.getElementById('auth-tab-admin');
    const panelGamer = document.getElementById('auth-panel-gamer');
    const panelAdmin = document.getElementById('auth-panel-admin');

    if (tab === 'gamer') {
      tabGamer.style.background = 'rgba(0, 240, 255, 0.15)';
      tabGamer.style.borderColor = '#00f0ff';
      tabGamer.style.color = '#00f0ff';

      tabAdmin.style.background = 'transparent';
      tabAdmin.style.borderColor = 'transparent';
      tabAdmin.style.color = '#94a3b8';

      panelGamer.style.display = 'block';
      panelAdmin.style.display = 'none';
    } else {
      tabAdmin.style.background = 'rgba(168, 85, 247, 0.15)';
      tabAdmin.style.borderColor = '#a855f7';
      tabAdmin.style.color = '#a855f7';

      tabGamer.style.background = 'transparent';
      tabGamer.style.borderColor = 'transparent';
      tabGamer.style.color = '#94a3b8';

      panelAdmin.style.display = 'block';
      panelGamer.style.display = 'none';
      setTimeout(() => document.getElementById('admin-passcode-field').focus(), 100);
    }
  };

  window.selectAvatar = function(el, icon) {
    selectedAvatar = icon;
    document.querySelectorAll('.avatar-option').forEach(opt => {
      opt.style.background = 'rgba(255,255,255,0.05)';
      opt.style.borderColor = 'rgba(255,255,255,0.1)';
    });
    el.style.background = 'rgba(0,240,255,0.2)';
    el.style.borderColor = '#00f0ff';
  };

  window.handleGamerLogin = function() {
    const input = document.getElementById('gamer-tag-input');
    const username = (input.value || '').trim() || 'ProGamer_' + Math.floor(Math.random() * 900 + 100);

    const profile = {
      username: username,
      avatar: selectedAvatar,
      level: 1,
      loginTime: new Date().toISOString()
    };

    localStorage.setItem('arcade_gamer_profile', JSON.stringify(profile));
    updateNavLoginButton(profile);
    closeArcadeAuthModal();

    // Show sleek in-page Cyberpunk Popup Notification
    showGamerPopup(username, selectedAvatar);
  };

  function showGamerPopup(username, avatar) {
    const toast = document.getElementById('arcade-gamer-toast');
    const avatarEl = document.getElementById('toast-avatar');
    const descEl = document.getElementById('toast-desc');

    if (!toast) return;
    avatarEl.innerText = avatar;
    descEl.innerHTML = `Welcome to Pixel Arcade, <strong style="color:#00f0ff;">${username}</strong>! Your profile is active.`;

    toast.style.display = 'flex';
    setTimeout(() => {
      toast.style.opacity = '1';
      toast.style.transform = 'translateX(-50%) translateY(0)';
    }, 10);

    // Subtle level-up synth chime
    try {
      const AudioContext = window.AudioContext || window.webkitAudioContext;
      if (AudioContext) {
        const ctx = new AudioContext();
        const osc = ctx.createOscillator();
        const gain = ctx.createGain();
        osc.connect(gain);
        gain.connect(ctx.destination);
        osc.frequency.setValueAtTime(523.25, ctx.currentTime);
        osc.frequency.setValueAtTime(659.25, ctx.currentTime + 0.08);
        osc.frequency.setValueAtTime(783.99, ctx.currentTime + 0.16);
        gain.gain.setValueAtTime(0.08, ctx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.28);
        osc.start();
        osc.stop(ctx.currentTime + 0.28);
      }
    } catch(e) {}

    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateX(-50%) translateY(-20px)';
      setTimeout(() => { toast.style.display = 'none'; }, 300);
    }, 3500);
  }

  window.handleAdminLogin = function() {
    const pass = document.getElementById('admin-passcode-field').value.trim();
    const savedPass = localStorage.getItem('pixel_custom_passcode') || 'admin123';
    const err = document.getElementById('admin-login-error');

    if (pass === savedPass || pass === 'admin123') {
      sessionStorage.setItem('pixel_studio_auth', 'granted');
      window.location.href = '<?php echo esc_url(home_url('/arcade-admin/')); ?>';
    } else {
      err.style.display = 'block';
    }
  };

  function updateNavLoginButton(profile) {
    const btn = document.getElementById('nav-login-btn');
    if (!btn) return;

    if (profile && profile.username) {
      btn.innerHTML = `
        <span style="display:flex; align-items:center; gap:6px;">
          <span style="font-size:14px;">${profile.avatar}</span>
          <span style="color:#00f0ff; font-weight:800;">${profile.username}</span>
          <span style="font-size:9px; background:rgba(0,240,255,0.2); color:#00f0ff; border:1px solid rgba(0,240,255,0.4); padding:1px 5px; border-radius:10px;">LVL 1</span>
        </span>
      `;
      btn.style.borderColor = '#00f0ff';
    }
  }

  // Check saved profile on page load
  window.addEventListener('DOMContentLoaded', function() {
    const profile = JSON.parse(localStorage.getItem('arcade_gamer_profile') || 'null');
    if (profile && profile.username) {
      updateNavLoginButton(profile);
    }
  });

})();
</script>
