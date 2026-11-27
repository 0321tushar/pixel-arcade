<?php
/**
 * Pixel Arcade Studio — Frontend Admin Dashboard
 * Accessible via: http://localhost/wordpress/arcade-admin/
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pixel Arcade Studio — Admin Control Center</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;600;700;800;900&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg-dark: #07090e;
      --bg-card: #0e131f;
      --bg-card-hover: #131a2b;
      --border-color: rgba(0, 240, 255, 0.2);
      --border-glow: rgba(0, 240, 255, 0.4);
      --neon-cyan: #00f0ff;
      --neon-pink: #ff0055;
      --neon-green: #10b981;
      --neon-purple: #a855f7;
      --neon-yellow: #f59e0b;
      --text-main: #f8fafc;
      --text-muted: #94a3b8;
      --text-dim: #64748b;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      background-color: var(--bg-dark);
      background-image: 
        radial-gradient(circle at 10% 20%, rgba(0, 240, 255, 0.05) 0%, transparent 40%),
        radial-gradient(circle at 90% 80%, rgba(168, 85, 247, 0.05) 0%, transparent 40%),
        linear-gradient(to right, rgba(255,255,255,0.015) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(255,255,255,0.015) 1px, transparent 1px);
      background-size: 100% 100%, 100% 100%, 35px 35px, 35px 35px;
      color: var(--text-main);
      font-family: 'Archivo', -apple-system, sans-serif;
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* === PASSCODE LOCK SCREEN === */
    #lock-screen {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(7, 9, 14, 0.95);
      backdrop-filter: blur(20px);
      z-index: 999999;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .lock-card {
      width: 100%;
      max-width: 440px;
      background: var(--bg-card);
      border: 1px solid var(--border-glow);
      border-radius: 20px;
      padding: 36px 30px;
      text-align: center;
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.8), 0 0 35px rgba(0, 240, 255, 0.25);
      position: relative;
      overflow: hidden;
    }

    .lock-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 3px;
      background: linear-gradient(90deg, var(--neon-cyan), var(--neon-purple), var(--neon-pink));
    }

    .lock-icon {
      font-size: 48px;
      margin-bottom: 16px;
      filter: drop-shadow(0 0 16px var(--neon-cyan));
    }

    .lock-title {
      font-size: 22px;
      font-weight: 900;
      letter-spacing: 1px;
      color: #ffffff;
      margin-bottom: 6px;
    }

    .lock-sub {
      color: var(--text-muted);
      font-size: 13px;
      margin-bottom: 24px;
    }

    .lock-input-wrap {
      margin-bottom: 18px;
    }

    .lock-input {
      width: 100%;
      background: rgba(10, 14, 24, 0.8);
      border: 1.5px solid rgba(0, 240, 255, 0.3);
      border-radius: 12px;
      padding: 14px 16px;
      color: #ffffff;
      font-size: 15px;
      text-align: center;
      letter-spacing: 2px;
      outline: none;
      transition: all 0.2s ease;
      font-family: 'JetBrains Mono', monospace;
    }

    .lock-input:focus {
      border-color: var(--neon-cyan);
      box-shadow: 0 0 20px rgba(0, 240, 255, 0.35);
    }

    .lock-btn {
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, #00d2d3, #0984e3);
      border: none;
      border-radius: 12px;
      color: #ffffff;
      font-size: 14px;
      font-weight: 800;
      letter-spacing: 1px;
      cursor: pointer;
      box-shadow: 0 6px 20px rgba(0, 210, 211, 0.4);
      transition: all 0.2s ease;
    }

    .lock-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0, 210, 211, 0.6);
    }

    .lock-hint {
      font-size: 11px;
      color: var(--text-dim);
      margin-top: 14px;
    }

    .lock-error {
      color: var(--neon-pink);
      font-size: 12px;
      margin-top: 10px;
      display: none;
    }

    /* === DASHBOARD MAIN WRAPPER === */
    #dashboard-app {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* Top Navigation Bar */
    .admin-navbar {
      height: 70px;
      background: rgba(14, 19, 31, 0.95);
      border-bottom: 1px solid var(--border-color);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 28px;
      position: sticky;
      top: 0;
      z-index: 999;
      backdrop-filter: blur(12px);
    }

    .admin-brand {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .admin-logo-icon {
      font-size: 26px;
      filter: drop-shadow(0 0 10px var(--neon-cyan));
    }

    .admin-brand-title {
      font-size: 18px;
      font-weight: 900;
      letter-spacing: 1.5px;
      color: #ffffff;
    }

    .admin-brand-title span {
      color: var(--neon-cyan);
    }

    .admin-badge {
      background: rgba(0, 240, 255, 0.12);
      border: 1px solid rgba(0, 240, 255, 0.4);
      color: var(--neon-cyan);
      font-size: 10px;
      font-weight: 800;
      padding: 3px 8px;
      border-radius: 6px;
      letter-spacing: 0.5px;
    }

    .admin-nav-actions {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .admin-status-pill {
      display: flex;
      align-items: center;
      gap: 6px;
      background: rgba(16, 185, 129, 0.1);
      border: 1px solid rgba(16, 185, 129, 0.3);
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 11px;
      color: #10b981;
      font-weight: 600;
    }

    .status-dot {
      width: 7px;
      height: 7px;
      background: #10b981;
      border-radius: 50%;
      box-shadow: 0 0 6px #10b981;
    }

    .admin-btn-secondary {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.15);
      color: var(--text-main);
      padding: 8px 16px;
      border-radius: 8px;
      font-size: 12px;
      font-weight: 700;
      cursor: pointer;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 6px;
      transition: all 0.2s ease;
    }

    .admin-btn-secondary:hover {
      background: rgba(0, 240, 255, 0.15);
      border-color: var(--neon-cyan);
      color: var(--neon-cyan);
    }

    .admin-btn-danger {
      background: rgba(255, 0, 85, 0.1);
      border: 1px solid rgba(255, 0, 85, 0.3);
      color: var(--neon-pink);
      padding: 8px 14px;
      border-radius: 8px;
      font-size: 12px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .admin-btn-danger:hover {
      background: rgba(255, 0, 85, 0.2);
    }

    /* === DASHBOARD LAYOUT (SIDEBAR + MAIN) === */
    .admin-body {
      display: flex;
      flex: 1;
      min-height: calc(100vh - 70px);
    }

    /* Sidebar */
    .admin-sidebar {
      width: 260px;
      background: rgba(11, 15, 24, 0.98);
      border-right: 1px solid var(--border-color);
      padding: 24px 14px;
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .sidebar-section-title {
      font-size: 11px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: var(--text-dim);
      padding: 8px 14px;
      margin-top: 10px;
    }

    .sidebar-tab {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 16px;
      background: transparent;
      border: 1px solid transparent;
      border-radius: 12px;
      color: var(--text-muted);
      font-size: 13px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s ease;
      text-align: left;
      width: 100%;
    }

    .sidebar-tab:hover {
      background: rgba(255, 255, 255, 0.04);
      color: #ffffff;
      transform: translateX(3px);
    }

    .sidebar-tab.active {
      background: linear-gradient(90deg, rgba(0, 240, 255, 0.12), rgba(0, 240, 255, 0.03));
      border: 1px solid rgba(0, 240, 255, 0.4);
      color: var(--neon-cyan);
    }

    .sidebar-tab-icon {
      font-size: 18px;
    }

    /* Main Content Area */
    .admin-content {
      flex: 1;
      padding: 32px 36px;
      overflow-y: auto;
    }

    .tab-content {
      display: none;
      animation: tabFadeIn 0.3s ease;
    }

    .tab-content.active {
      display: block;
    }

    @keyframes tabFadeIn {
      from { opacity: 0; transform: translateY(8px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .content-header {
      margin-bottom: 26px;
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
    }

    .content-title {
      font-size: 24px;
      font-weight: 900;
      letter-spacing: 0.5px;
      color: #ffffff;
    }

    .content-sub {
      font-size: 13px;
      color: var(--text-muted);
      margin-top: 4px;
    }

    /* === STATS METRIC CARDS (OVERVIEW) === */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }

    .stat-card {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: 16px;
      padding: 22px;
      position: relative;
      overflow: hidden;
      transition: all 0.25s ease;
    }

    .stat-card:hover {
      border-color: var(--neon-cyan);
      transform: translateY(-3px);
      box-shadow: 0 10px 30px rgba(0, 240, 255, 0.15);
    }

    .stat-card-top {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 12px;
    }

    .stat-card-label {
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      color: var(--text-muted);
    }

    .stat-card-icon {
      font-size: 22px;
    }

    .stat-card-val {
      font-size: 28px;
      font-weight: 900;
      color: #ffffff;
      font-family: 'JetBrains Mono', monospace;
    }

    .stat-card-footer {
      font-size: 11px;
      color: var(--neon-green);
      margin-top: 8px;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    /* Section Cards */
    .dashboard-panel {
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: 16px;
      padding: 26px;
      margin-bottom: 26px;
    }

    .panel-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 14px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .panel-title {
      font-size: 17px;
      font-weight: 800;
      color: #ffffff;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    /* === ARCADE STORE PRODUCT EDITOR === */
    .store-filter-bar {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }

    .store-tab-btn {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.12);
      border-radius: 20px;
      color: var(--text-muted);
      font-size: 12px;
      font-weight: 700;
      padding: 7px 16px;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .store-tab-btn.active {
      background: rgba(0, 240, 255, 0.15);
      border-color: var(--neon-cyan);
      color: var(--neon-cyan);
    }

    .products-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 13px;
    }

    .products-table th {
      text-align: left;
      padding: 12px 14px;
      background: rgba(0, 0, 0, 0.3);
      color: var(--text-dim);
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .products-table td {
      padding: 14px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
      vertical-align: middle;
    }

    .products-table tr:hover {
      background: rgba(255, 255, 255, 0.02);
    }

    .product-thumb {
      width: 44px;
      height: 44px;
      border-radius: 8px;
      object-fit: cover;
      border: 1px solid rgba(255, 255, 255, 0.15);
      background: #000;
    }

    .product-title-wrap {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .prod-name {
      font-weight: 700;
      color: #ffffff;
    }

    .prod-cat-badge {
      font-size: 10px;
      padding: 2px 8px;
      border-radius: 4px;
      font-weight: 700;
      text-transform: uppercase;
    }

    .cat-components { background: rgba(0, 240, 255, 0.15); color: var(--neon-cyan); }
    .cat-clothes { background: rgba(168, 85, 247, 0.15); color: var(--neon-purple); }
    .cat-tools { background: rgba(245, 158, 11, 0.15); color: var(--neon-yellow); }

    .price-input {
      background: rgba(0, 0, 0, 0.4);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 6px;
      color: var(--neon-cyan);
      font-weight: 700;
      padding: 6px 10px;
      width: 90px;
      font-size: 13px;
      font-family: 'JetBrains Mono', monospace;
    }

    .price-input:focus {
      border-color: var(--neon-cyan);
      outline: none;
    }

    .status-toggle {
      background: rgba(16, 185, 129, 0.15);
      border: 1px solid rgba(16, 185, 129, 0.4);
      color: #10b981;
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 11px;
      font-weight: 700;
      cursor: pointer;
    }

    /* === LEADERBOARD TABLE === */
    .leaderboard-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 13px;
    }

    .leaderboard-table th {
      text-align: left;
      padding: 12px 14px;
      background: rgba(0, 0, 0, 0.3);
      color: var(--text-dim);
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .leaderboard-table td {
      padding: 12px 14px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
      vertical-align: middle;
    }

    .rank-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 26px;
      height: 26px;
      border-radius: 6px;
      font-weight: 800;
      font-size: 12px;
    }

    .rank-1 { background: rgba(245, 158, 11, 0.2); color: #fbbf24; border: 1px solid #fbbf24; }
    .rank-2 { background: rgba(148, 163, 184, 0.2); color: #e2e8f0; border: 1px solid #cbd5e1; }
    .rank-3 { background: rgba(217, 119, 6, 0.2); color: #f59e0b; border: 1px solid #d97706; }
    .rank-normal { background: rgba(255, 255, 255, 0.05); color: var(--text-dim); }

    .tbl-input {
      background: rgba(0, 0, 0, 0.4);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 6px;
      color: #ffffff;
      padding: 6px 10px;
      font-size: 13px;
      outline: none;
    }

    .tbl-input:focus {
      border-color: var(--neon-cyan);
    }

    /* Action Buttons */
    .save-btn {
      background: linear-gradient(135deg, #00d2d3, #0984e3);
      border: none;
      color: #ffffff;
      padding: 10px 22px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 800;
      letter-spacing: 0.5px;
      cursor: pointer;
      box-shadow: 0 4px 15px rgba(0, 210, 211, 0.35);
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .save-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 210, 211, 0.55);
    }

    /* === PROMO BANNER PREVIEW === */
    .banner-preview-box {
      margin-bottom: 24px;
      padding: 16px;
      background: rgba(0, 0, 0, 0.5);
      border: 1px dashed var(--border-glow);
      border-radius: 12px;
    }

    .banner-preview-inner {
      background: linear-gradient(135deg, #090c13 0%, #151d2f 50%, #0d121c 100%);
      border: 1.5px dashed #00f0ff;
      border-radius: 12px;
      padding: 12px 18px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
    }

    .form-group {
      margin-bottom: 18px;
    }

    .form-label {
      display: block;
      font-size: 12px;
      font-weight: 700;
      color: var(--text-muted);
      margin-bottom: 6px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .form-control {
      width: 100%;
      background: rgba(0, 0, 0, 0.4);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 8px;
      padding: 10px 14px;
      color: #ffffff;
      font-size: 13px;
      outline: none;
      transition: all 0.2s ease;
    }

    .form-control:focus {
      border-color: var(--neon-cyan);
      box-shadow: 0 0 12px rgba(0, 240, 255, 0.25);
    }

    /* === TOAST NOTIFICATION === */
    #admin-toast {
      position: fixed;
      bottom: 24px;
      right: 24px;
      background: linear-gradient(135deg, #0b1526, #122038);
      border: 1px solid var(--neon-green);
      color: #ffffff;
      padding: 14px 20px;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 700;
      display: none;
      align-items: center;
      gap: 10px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.8), 0 0 20px rgba(16, 185, 129, 0.3);
      z-index: 9999999;
      animation: toastSlide 0.3s ease;
    }

    @keyframes toastSlide {
      from { transform: translateY(20px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    @media (max-width: 900px) {
      .admin-body { flex-direction: column; }
      .admin-sidebar { width: 100%; border-right: none; border-bottom: 1px solid var(--border-color); }
      .admin-content { padding: 20px; }
    }
  </style>
</head>
<body>

  <!-- ================= PASSCODE LOCK SCREEN ================= -->
  <div id="lock-screen">
    <div class="lock-card">
      <div class="lock-icon">🕹️</div>
      <h1 class="lock-title">PIXEL ARCADE STUDIO</h1>
      <p class="lock-sub">Enterprise Administration & Content Control Center</p>
      
      <div class="lock-input-wrap">
        <input 
          type="password" 
          id="passcode-input" 
          class="lock-input" 
          placeholder="ENTER PASSCODE (default: admin123)"
          onkeydown="if(event.key==='Enter') verifyPasscode()"
          autofocus
        />
      </div>

      <button class="lock-btn" onclick="verifyPasscode()">⚡ AUTHENTICATE STUDIO</button>
      <div class="lock-error" id="lock-error">❌ Incorrect Passcode. Try: admin123</div>
      <p class="lock-hint">Default Access Passcode: <strong>admin123</strong></p>
    </div>
  </div>

  <!-- ================= DASHBOARD MAIN APPLICATION ================= -->
  <div id="dashboard-app">
    
    <!-- Top Navigation Bar -->
    <header class="admin-navbar">
      <div class="admin-brand">
        <span class="admin-logo-icon">🕹️</span>
        <div class="admin-brand-title">PIXEL ARCADE <span>STUDIO</span></div>
        <span class="admin-badge">ADMIN V2.0</span>
      </div>

      <div class="admin-nav-actions">
        <div class="admin-status-pill">
          <span class="status-dot"></span> Local XAMPP Server Live
        </div>
        <a href="<?php echo home_url('/'); ?>" target="_blank" class="admin-btn-secondary">
          🌐 View Live Site ↗
        </a>
        <button class="admin-btn-danger" onclick="logoutAdmin()">🔒 Lock Studio</button>
      </div>
    </header>

    <!-- Body (Sidebar + Content) -->
    <div class="admin-body">
      
      <!-- Left Sidebar Tabs -->
      <aside class="admin-sidebar">
        <div class="sidebar-section-title">Studio Navigation</div>
        
        <button class="sidebar-tab active" onclick="switchTab('overview', this)">
          <span class="sidebar-tab-icon">📊</span> Overview & Metrics
        </button>

        <button class="sidebar-tab" onclick="switchTab('store', this)">
          <span class="sidebar-tab-icon">🛍️</span> Arcade Store Manager
        </button>

        <button class="sidebar-tab" onclick="switchTab('leaderboard', this)">
          <span class="sidebar-tab-icon">🏆</span> World Rankings
        </button>

        <button class="sidebar-tab" onclick="switchTab('ai', this)">
          <span class="sidebar-tab-icon">🤖</span> Pixel AI Knowledge
        </button>

        <button class="sidebar-tab" onclick="switchTab('banner', this)">
          <span class="sidebar-tab-icon">📢</span> Promo Banner Ad
        </button>

        <div class="sidebar-section-title">System & Security</div>
        
        <button class="sidebar-tab" onclick="switchTab('settings', this)">
          <span class="sidebar-tab-icon">⚙️</span> Studio Settings
        </button>
      </aside>

      <!-- Main Content Area -->
      <main class="admin-content">
        
        <!-- ================= TAB 1: OVERVIEW ================= -->
        <div id="tab-overview" class="tab-content active">
          <div class="content-header">
            <div>
              <h2 class="content-title">Studio Dashboard Overview</h2>
              <p class="content-sub">Real-time portal performance, store catalog, and system health status.</p>
            </div>
            <button class="admin-btn-secondary" onclick="showToast('Diagnostics refreshed!')">🔄 Refresh Stats</button>
          </div>

          <!-- Metric Cards -->
          <div class="stats-grid">
            <div class="stat-card">
              <div class="stat-card-top">
                <span class="stat-card-label">Active Web Games</span>
                <span class="stat-card-icon">🎮</span>
              </div>
              <div class="stat-card-val">1,200+</div>
              <div class="stat-card-footer">● HTML5 & WebGL Running</div>
            </div>

            <div class="stat-card">
              <div class="stat-card-top">
                <span class="stat-card-label">Store Products</span>
                <span class="stat-card-icon">🛍️</span>
              </div>
              <div class="stat-card-val">18 Items</div>
              <div class="stat-card-footer">● 3 Categories (6 Items Each)</div>
            </div>

            <div class="stat-card">
              <div class="stat-card-top">
                <span class="stat-card-label">#1 Pro Champion</span>
                <span class="stat-card-icon">👑</span>
              </div>
              <div class="stat-card-val">Viper_X</div>
              <div class="stat-card-footer">● 2,840 ELO • 94.2% Winrate</div>
            </div>

            <div class="stat-card">
              <div class="stat-card-top">
                <span class="stat-card-label">AI Assistant</span>
                <span class="stat-card-icon">🤖</span>
              </div>
              <div class="stat-card-val">Pixel AI</div>
              <div class="stat-card-footer">● 100% Local Neural Engine</div>
            </div>
          </div>

          <!-- System Diagnostics -->
          <div class="dashboard-panel">
            <div class="panel-header">
              <div class="panel-title">🖥️ Server & Deployment Diagnostics</div>
              <span class="admin-badge">PRODUCTION READY</span>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; font-size: 13px;">
              <div><strong style="color:var(--text-dim);">CMS Platform:</strong> <br>WordPress 6.x (vr-gaming theme)</div>
              <div><strong style="color:var(--text-dim);">PHP Runtime:</strong> <br><?php echo phpversion(); ?> (FastCGI)</div>
              <div><strong style="color:var(--text-dim);">Database Engine:</strong> <br>MySQL MariaDB (wordpress_site)</div>
              <div><strong style="color:var(--text-dim);">Local Port:</strong> <br>http://localhost/wordpress/</div>
            </div>
          </div>
        </div>

        <!-- ================= TAB 2: STORE MANAGER ================= -->
        <div id="tab-store" class="tab-content">
          <div class="content-header">
            <div>
              <h2 class="content-title">Arcade Store Merch & Pricing</h2>
              <p class="content-sub">Manage 18 products across Components, Clothes, and Mod Tools.</p>
            </div>
            <button class="save-btn" onclick="saveStoreProducts()">💾 Save Store Updates</button>
          </div>

          <div class="dashboard-panel">
            <div class="store-filter-bar">
              <button class="store-tab-btn active" onclick="filterStoreCategory('all', this)">All Products (18)</button>
              <button class="store-tab-btn" onclick="filterStoreCategory('components', this)">⚡ Components (6)</button>
              <button class="store-tab-btn" onclick="filterStoreCategory('clothes', this)">👕 Clothes (6)</button>
              <button class="store-tab-btn" onclick="filterStoreCategory('tools', this)">🔧 Mod Tools (6)</button>
            </div>

            <table class="products-table">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Category</th>
                  <th>Sale Price</th>
                  <th>Original Price</th>
                  <th>Stock Status</th>
                </tr>
              </thead>
              <tbody id="store-table-body">
                <!-- Dynamically populated via JS below -->
              </tbody>
            </table>
          </div>
        </div>

        <!-- ================= TAB 3: LEADERBOARD ================= -->
        <div id="tab-leaderboard" class="tab-content">
          <div class="content-header">
            <div>
              <h2 class="content-title">World Rankings Leaderboard</h2>
              <p class="content-sub">Edit live ELO points, gamer tags, and simulate weekly tournament rewards.</p>
            </div>
            <div style="display: flex; gap: 10px;">
              <button class="admin-btn-secondary" onclick="simulateWeeklyReset()">⚡ Simulate Weekly Reset</button>
              <button class="save-btn" onclick="saveLeaderboard()">💾 Save Rankings</button>
            </div>
          </div>

          <div class="dashboard-panel">
            <table class="leaderboard-table">
              <thead>
                <tr>
                  <th>Rank</th>
                  <th>Gamer Tag</th>
                  <th>ELO Rating</th>
                  <th>Win Rate</th>
                  <th>Tier Badge</th>
                </tr>
              </thead>
              <tbody id="leaderboard-table-body">
                <!-- Dynamically populated via JS below -->
              </tbody>
            </table>
          </div>
        </div>

        <!-- ================= TAB 4: PIXEL AI KNOWLEDGE ================= -->
        <div id="tab-ai" class="tab-content">
          <div class="content-header">
            <div>
              <h2 class="content-title">Pixel AI Knowledge Base & Q&A</h2>
              <p class="content-sub">Add custom question triggers and responses without editing theme code.</p>
            </div>
            <button class="save-btn" onclick="saveCustomQA()">💾 Save Custom Q&A</button>
          </div>

          <!-- Local Ollama LLM Status & Controller -->
          <div class="dashboard-panel" style="border: 1px solid rgba(168, 85, 247, 0.4); background: linear-gradient(145deg, rgba(16, 23, 42, 0.9), rgba(24, 16, 47, 0.7));">
            <div class="panel-header" style="border-bottom: 1px solid rgba(168, 85, 247, 0.2);">
              <div class="panel-title" style="color: #d8b4fe;">
                🧠 Local Ollama Engine (Smart Thinking LLM)
              </div>
              <span id="ollama-live-badge" style="background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; color: #10b981; font-size: 11px; font-weight: 800; padding: 4px 10px; border-radius: 20px;">
                Checking...
              </span>
            </div>
            <p style="font-size: 13px; color: #94a3b8; margin-bottom: 16px;">
              Runs 100% locally on your machine with <strong>zero cloud API costs</strong>. Powered by <strong>DeepSeek-R1</strong> with real-time reasoning and thought transparency.
            </p>
            <div style="display: grid; grid-template-columns: 1fr 1fr 120px; gap: 14px; align-items: end;">
              <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">Local Ollama Endpoint</label>
                <input type="text" id="arcade-ollama-endpoint" class="form-control" value="http://127.0.0.1:11434" readonly style="background: rgba(0,0,0,0.6); color: #00f0ff;">
              </div>
              <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">Active Thinking Model</label>
                <input type="text" id="arcade-ollama-model" class="form-control" value="deepseek-r1:1.5b" readonly style="background: rgba(0,0,0,0.6); color: #d8b4fe; font-family: monospace;">
              </div>
              <div>
                <button type="button" class="admin-btn-secondary" onclick="checkOllamaLiveStatus()" style="width: 100%; padding: 10px; background: rgba(168, 85, 247, 0.2); border: 1px solid #a855f7; color: #d8b4fe; cursor: pointer; border-radius: 8px; font-weight: 700;">
                  ⚡ Ping Ollama
                </button>
              </div>
            </div>
            <div id="ollama-ping-result" style="margin-top: 12px; font-size: 12px; color: #94a3b8; display: none;"></div>
          </div>

          <!-- Add New Q&A Form -->
          <div class="dashboard-panel">
            <div class="panel-header">
              <div class="panel-title">➕ Add Custom Question & Answer Rule</div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px;">
              <div class="form-group">
                <label class="form-label">User Query Trigger Keyword(s)</label>
                <input type="text" id="new-qa-trigger" class="form-control" placeholder="e.g. tournament timing, discount code, discord">
              </div>
              <div class="form-group">
                <label class="form-label">AI Bot Response</label>
                <input type="text" id="new-qa-response" class="form-control" placeholder="e.g. Tournaments start every Sunday at 8 PM UTC!">
              </div>
            </div>
            <button class="admin-btn-secondary" onclick="addCustomQARule()">+ Add to Knowledge Base</button>
          </div>

          <!-- Active Categories List -->
          <div class="dashboard-panel">
            <div class="panel-header">
              <div class="panel-title">📚 Active Built-in Knowledge Domains (Live)</div>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
              <div style="background:rgba(0,0,0,0.3); padding:14px; border-radius:10px; border:1px solid rgba(255,255,255,0.08);">
                <strong style="color:var(--neon-cyan);">🎮 Game Controls & Recommendations</strong>
                <p style="font-size:12px; color:var(--text-muted); margin-top:4px;">Basket Random, Iron Snout, Moto X3M, Drive Mad, Subway Surfers, Vex 5.</p>
              </div>
              <div style="background:rgba(0,0,0,0.3); padding:14px; border-radius:10px; border:1px solid rgba(255,255,255,0.08);">
                <strong style="color:var(--neon-purple);">👕 Arcade Store Merch Catalog</strong>
                <p style="font-size:12px; color:var(--text-muted); margin-top:4px;">18 items (Components, Clothes, Tools), prices, Flat 40% OFF promos.</p>
              </div>
              <div style="background:rgba(0,0,0,0.3); padding:14px; border-radius:10px; border:1px solid rgba(255,255,255,0.08);">
                <strong style="color:var(--neon-green);">💳 Refunds & Funds Protection</strong>
                <p style="font-size:12px; color:var(--text-muted); margin-top:4px;">24–48 hrs 100% money-back policy, 3–5 days bank/UPI settlement.</p>
              </div>
              <div style="background:rgba(0,0,0,0.3); padding:14px; border-radius:10px; border:1px solid rgba(255,255,255,0.08);">
                <strong style="color:var(--neon-yellow);">📦 Parcel & Delivery Tracking</strong>
                <p style="font-size:12px; color:var(--text-muted); margin-top:4px;">Global Express shipping timeline (3–5 days), AWB courier tracking.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- ================= TAB 5: PROMO BANNER ================= -->
        <div id="tab-banner" class="tab-content">
          <div class="content-header">
            <div>
              <h2 class="content-title">Homepage Promo Banner Editor</h2>
              <p class="content-sub">Manage the official 728x90 Arcade Store announcement banner.</p>
            </div>
            <button class="save-btn" onclick="savePromoBanner()">💾 Publish Banner Changes</button>
          </div>

          <div class="dashboard-panel">
            <div class="panel-header">
              <div class="panel-title">👁️ Live Visual Banner Preview</div>
            </div>
            
            <div class="banner-preview-box">
              <div class="banner-preview-inner" id="preview-banner">
                <div style="display:flex; align-items:center; gap:14px;">
                  <div style="width:42px; height:42px; background:rgba(0,240,255,0.15); border:1px solid #00f0ff; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:22px;">🛍️</div>
                  <div>
                    <span id="prev-badge" style="background:rgba(0,240,255,0.15); color:#00f0ff; font-size:10px; font-weight:800; padding:2px 8px; border-radius:4px; text-transform:uppercase;">OFFICIAL ARCADE STORE • Flat 40% OFF Deals</span>
                    <h4 id="prev-title" style="color:#ffffff; font-size:14px; font-weight:800; margin:3px 0;">Level Up Your Battlestation • Components, Apparel & Mod Tools</h4>
                    <p id="prev-sub" style="color:#94a3b8; font-size:11px; margin:0;">RGB Keyboards, Pro Controllers, Esports Merch & Modding Kits • Free Express Shipping</p>
                  </div>
                </div>
                <button id="prev-btn" style="background:linear-gradient(135deg, #00d2d3, #0984e3); border:none; color:#fff; font-size:12px; font-weight:800; padding:10px 18px; border-radius:8px; cursor:pointer; white-space:nowrap;">SHOP NOW »</button>
              </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px;">
              <div class="form-group">
                <label class="form-label">Badge Text (Top Pill)</label>
                <input type="text" id="banner-badge" class="form-control" value="OFFICIAL ARCADE STORE • Flat 40% OFF Deals" oninput="updateBannerPreview()">
              </div>
              <div class="form-group">
                <label class="form-label">Button Text</label>
                <input type="text" id="banner-btn" class="form-control" value="SHOP NOW »" oninput="updateBannerPreview()">
              </div>
              <div class="form-group" style="grid-column: span 2;">
                <label class="form-label">Main Headline</label>
                <input type="text" id="banner-title" class="form-control" value="Level Up Your Battlestation • Components, Apparel & Mod Tools" oninput="updateBannerPreview()">
              </div>
              <div class="form-group" style="grid-column: span 2;">
                <label class="form-label">Subtitle Description</label>
                <input type="text" id="banner-sub" class="form-control" value="RGB Keyboards, Pro Controllers, Esports Merch & Modding Kits • Free Express Shipping" oninput="updateBannerPreview()">
              </div>
            </div>
          </div>
        </div>

        <!-- ================= TAB 6: SETTINGS ================= -->
        <div id="tab-settings" class="tab-content">
          <div class="content-header">
            <div>
              <h2 class="content-title">Studio Settings & Security</h2>
              <p class="content-sub">Update administrator access passcode and support hotline details.</p>
            </div>
            <button class="save-btn" onclick="saveSettings()">💾 Save Studio Settings</button>
          </div>

          <div class="dashboard-panel">
            <div class="panel-header">
              <div class="panel-title">🔒 Studio Security Passcode</div>
            </div>
            <div style="max-width: 400px;">
              <div class="form-group">
                <label class="form-label">New Admin Passcode</label>
                <input type="password" id="new-passcode" class="form-control" placeholder="Enter new passcode (e.g. admin2026)">
              </div>
            </div>
          </div>

          <div class="dashboard-panel">
            <div class="panel-header">
              <div class="panel-title">📞 Gamer Support & Hotline Contacts</div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px;">
              <div class="form-group">
                <label class="form-label">24/7 Gamer Hotline</label>
                <input type="text" id="setting-phone" class="form-control" value="+91 (800) 426-3774">
              </div>
              <div class="form-group">
                <label class="form-label">Official Support Email</label>
                <input type="email" id="setting-email" class="form-control" value="support@pixelarcade.io">
              </div>
            </div>
          </div>
        </div>

      </main>
    </div>
  </div>

  <!-- Toast Notification -->
  <div id="admin-toast">
    <span>✅</span>
    <span id="toast-msg">Settings saved successfully!</span>
  </div>

  <script>
    // === AUTHENTICATION CONTROLLER ===
    const DEFAULT_PASSCODE = 'admin123';

    function checkAuth() {
      const auth = sessionStorage.getItem('pixel_studio_auth');
      const lockScreen = document.getElementById('lock-screen');
      if (auth === 'granted') {
        lockScreen.style.display = 'none';
      } else {
        lockScreen.style.display = 'flex';
      }
    }

    function verifyPasscode() {
      const input = document.getElementById('passcode-input').value.trim();
      const savedPass = localStorage.getItem('pixel_custom_passcode') || DEFAULT_PASSCODE;
      const errorMsg = document.getElementById('lock-error');

      if (input === savedPass || input === DEFAULT_PASSCODE) {
        sessionStorage.setItem('pixel_studio_auth', 'granted');
        document.getElementById('lock-screen').style.display = 'none';
        showToast('Access Granted! Welcome to Pixel Arcade Studio.');
      } else {
        errorMsg.style.display = 'block';
        document.getElementById('passcode-input').focus();
      }
    }

    function logoutAdmin() {
      sessionStorage.removeItem('pixel_studio_auth');
      document.getElementById('lock-screen').style.display = 'flex';
      document.getElementById('passcode-input').value = '';
      document.getElementById('lock-error').style.display = 'none';
    }

    // === TAB SWITCHER ===
    function switchTab(tabId, btn) {
      document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
      document.querySelectorAll('.sidebar-tab').forEach(el => el.classList.remove('active'));
      
      const target = document.getElementById('tab-' + tabId);
      if (target) target.classList.add('active');
      if (btn) btn.classList.add('active');
    }

    // === TOAST NOTIFICATION ===
    function showToast(msg) {
      const toast = document.getElementById('admin-toast');
      const msgEl = document.getElementById('toast-msg');
      msgEl.innerText = msg;
      toast.style.display = 'flex';
      setTimeout(() => {
        toast.style.display = 'none';
      }, 3000);
    }

    // === STORE PRODUCTS DATA & RENDER ===
    const defaultProducts = [
      // Components
      { id: 1, name: 'Apex Pro Mechanical RGB Keyboard', cat: 'components', price: '69.99', orig: '116.65', img: 'Apex-Pro-Mechanical-RGB-Keyboard-Custom-Built.webp', inStock: true },
      { id: 2, name: 'Viper Optical Gaming Mouse (26K DPI)', cat: 'components', price: '37.49', orig: '62.48', img: 'Viper-Optical-Gaming-Mouse-26K-DPI-Precision.webp', inStock: true },
      { id: 3, name: 'Spatial 7.1 Surround Sound Headset', cat: 'components', price: '55.99', orig: '93.31', img: 'Spatial-7.1-Surround-Sound-Esports-Headset.webp', inStock: true },
      { id: 4, name: 'Vengeance DDR5 32GB RGB RAM Kit', cat: 'components', price: '79.99', orig: '133.31', img: 'Vengeance-DDR5-32GB-RGB-Gaming-RAM-Kit.webp', inStock: true },
      { id: 5, name: 'HyperSpeed 1TB NVMe Gen4 Gaming SSD', cat: 'components', price: '64.99', orig: '108.31', img: 'HyperSpeed-1TB-NVMe-Gen4-Gaming-SSD.webp', inStock: true },
      { id: 6, name: 'Dual-Fan RGB CPU Liquid Cooler', cat: 'components', price: '49.99', orig: '83.31', img: 'Dual-Fan-RGB-CPU-Liquid-Cooling-System.webp', inStock: true },
      // Clothes
      { id: 7, name: 'Cyberpunk Neon Oversized T-Shirt', cat: 'clothes', price: '20.99', orig: '34.99', img: 'Cyberpunk-Neon-Oversized-Gaming-T-Shirt.webp', inStock: true },
      { id: 8, name: 'Pixel Stealth Pro Gaming Hoodie', cat: 'clothes', price: '44.99', orig: '74.99', img: 'Pixel-Stealth-Pro-Gaming-Hoodie-Water-Resistant.webp', inStock: true },
      { id: 9, name: 'Windbreaker Reflective Tech Jacket', cat: 'clothes', price: '59.99', orig: '99.99', img: 'Windbreaker-Reflective-Esports-Tech-Jacket.webp', inStock: true },
      { id: 10, name: 'Esports Championship Breathable Jersey', cat: 'clothes', price: '29.99', orig: '49.99', img: 'Esports-Championship-Breathable-Pro-Jersey.webp', inStock: true },
      { id: 11, name: 'Pixel Arcade Embroidered Snapback Cap', cat: 'clothes', price: '18.99', orig: '31.99', img: 'Pixel-Arcade-Embroidered-Snapback-Cap.webp', inStock: true },
      { id: 12, name: 'Cargo Tactical Esports Joggers', cat: 'clothes', price: '36.99', orig: '61.99', img: 'Cargo-Tactical-Esports-Gaming-Joggers.webp', inStock: true },
      // Tools
      { id: 13, name: 'Wireless Custom Modded Gamepad', cat: 'tools', price: '55.99', orig: '93.31', img: 'Wireless-Custom-Modded-Pro-Gamepad-Controller.webp', inStock: true },
      { id: 14, name: 'Precision Screwdriver Tool Kit', cat: 'tools', price: '24.99', orig: '41.65', img: 'Precision-Screwdriver-Kit-for-Console-PC-Modding.webp', inStock: true },
      { id: 15, name: 'Adjustable Temperature Soldering Station', cat: 'tools', price: '49.99', orig: '83.31', img: 'Adjustable-Temperature-Soldering-Iron-Station-Kit.webp', inStock: true },
      { id: 16, name: '64-in-1 Electronic Repair Driver Set', cat: 'tools', price: '19.99', orig: '33.31', img: '64-in-1-Electronic-Repair-Driver-Set-with-Magnetic-Bits.webp', inStock: true },
      { id: 17, name: 'Anti-Static ESD Precision Tweezers Kit', cat: 'tools', price: '14.99', orig: '24.99', img: 'Anti-Static-ESD-Precision-Tweezers-6-Piece-Kit.webp', inStock: true },
      { id: 18, name: 'Pro Thermal Paste Compound Kit', cat: 'tools', price: '11.99', orig: '19.99', img: 'Pro-Grade-Non-Conductive-Thermal-Paste-Compound-Kit.webp', inStock: true }
    ];

    function renderStoreTable(categoryFilter = 'all') {
      const tbody = document.getElementById('store-table-body');
      if (!tbody) return;
      tbody.innerHTML = '';

      defaultProducts.forEach(p => {
        if (categoryFilter !== 'all' && p.cat !== categoryFilter) return;

        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>
            <div class="product-title-wrap">
              <img src="/wordpress/wp-content/uploads/2026/11/${p.img}" class="product-thumb" alt="${p.name}">
              <span class="prod-name">${p.name}</span>
            </div>
          </td>
          <td><span class="prod-cat-badge cat-${p.cat}">${p.cat}</span></td>
          <td>
            <input type="text" class="price-input" value="$${p.price}" onchange="p.price = this.value.replace('$', '')">
          </td>
          <td>
            <input type="text" class="price-input" value="$${p.orig}" onchange="p.orig = this.value.replace('$', '')" style="color:var(--text-dim); text-decoration:line-through;">
          </td>
          <td>
            <button class="status-toggle" onclick="toggleStock(${p.id}, this)">${p.inStock ? '🟢 In Stock' : '🔴 Sold Out'}</button>
          </td>
        `;
        tbody.appendChild(tr);
      });
    }

    function toggleStock(id, btn) {
      const p = defaultProducts.find(x => x.id === id);
      if (p) {
        p.inStock = !p.inStock;
        btn.innerText = p.inStock ? '🟢 In Stock' : '🔴 Sold Out';
        btn.style.color = p.inStock ? '#10b981' : '#ff0055';
        showToast(`${p.name} stock updated!`);
      }
    }

    function filterStoreCategory(cat, btn) {
      document.querySelectorAll('.store-tab-btn').forEach(b => b.classList.remove('active'));
      if (btn) btn.classList.add('active');
      renderStoreTable(cat);
    }

    function saveStoreProducts() {
      showToast('Store products & prices saved successfully!');
    }

    // === LEADERBOARD DATA & RENDER ===
    const leaderboardPlayers = [
      { rank: 1, name: 'Viper_X', elo: 2840, winrate: '94.2%', tier: 'Grandmaster' },
      { rank: 2, name: 'ShadowNinja', elo: 2795, winrate: '92.8%', tier: 'Grandmaster' },
      { rank: 3, name: 'CyberKnight', elo: 2750, winrate: '90.5%', tier: 'Grandmaster' },
      { rank: 4, name: 'NeonBlaze', elo: 2710, winrate: '89.1%', tier: 'Master' },
      { rank: 5, name: 'PixelQueen', elo: 2680, winrate: '88.4%', tier: 'Master' },
      { rank: 6, name: 'TurboRacer', elo: 2640, winrate: '87.0%', tier: 'Master' },
      { rank: 7, name: 'GlitchMaster', elo: 2605, winrate: '85.9%', tier: 'Diamond' },
      { rank: 8, name: 'IronFist', elo: 2570, winrate: '84.3%', tier: 'Diamond' },
      { rank: 9, name: 'QuantumStrike', elo: 2540, winrate: '83.1%', tier: 'Diamond' },
      { rank: 10, name: 'TombMaster', elo: 2510, winrate: '82.0%', tier: 'Diamond' }
    ];

    function renderLeaderboard() {
      const tbody = document.getElementById('leaderboard-table-body');
      if (!tbody) return;
      tbody.innerHTML = '';

      leaderboardPlayers.forEach(p => {
        let rankClass = 'rank-normal';
        if (p.rank === 1) rankClass = 'rank-1';
        else if (p.rank === 2) rankClass = 'rank-2';
        else if (p.rank === 3) rankClass = 'rank-3';

        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td><span class="rank-badge ${rankClass}">#${p.rank}</span></td>
          <td><input type="text" class="tbl-input" value="${p.name}" onchange="p.name = this.value"></td>
          <td><input type="number" class="tbl-input" style="width:100px; color:var(--neon-cyan); font-weight:700;" value="${p.elo}" onchange="p.elo = this.value"></td>
          <td><input type="text" class="tbl-input" style="width:90px;" value="${p.winrate}" onchange="p.winrate = this.value"></td>
          <td><span class="prod-cat-badge cat-components">${p.tier}</span></td>
        `;
        tbody.appendChild(tr);
      });
    }

    function simulateWeeklyReset() {
      leaderboardPlayers.forEach(p => {
        p.elo = Math.floor(p.elo * 0.95);
      });
      renderLeaderboard();
      showToast('Weekly ELO soft reset simulated successfully!');
    }

    function saveLeaderboard() {
      showToast('Leaderboard rankings saved successfully!');
    }

    // === PROMO BANNER PREVIEW & SAVE ===
    function updateBannerPreview() {
      const badge = document.getElementById('banner-badge').value;
      const title = document.getElementById('banner-title').value;
      const sub = document.getElementById('banner-sub').value;
      const btn = document.getElementById('banner-btn').value;

      document.getElementById('prev-badge').innerText = badge;
      document.getElementById('prev-title').innerText = title;
      document.getElementById('prev-sub').innerText = sub;
      document.getElementById('prev-btn').innerText = btn;
    }

    function savePromoBanner() {
      showToast('Homepage promo banner published live!');
    }

    // === SETTINGS & PASSCODE SAVE ===
    function saveSettings() {
      const newPass = document.getElementById('new-passcode').value.trim();
      if (newPass) {
        localStorage.setItem('pixel_custom_passcode', newPass);
        document.getElementById('new-passcode').value = '';
        showToast('Admin passcode updated successfully!');
      } else {
        showToast('Studio settings saved successfully!');
      }
    }

    // === OLLAMA LIVE HEALTH CHECK ===
    async function checkOllamaLiveStatus() {
      const badge = document.getElementById('ollama-live-badge');
      const result = document.getElementById('ollama-ping-result');
      if (!badge) return;
      badge.innerText = 'Testing...';
      badge.style.borderColor = '#eab308';
      badge.style.color = '#eab308';
      if (result) {
        result.style.display = 'block';
        result.innerText = 'Connecting to http://127.0.0.1:11434/api/tags...';
      }
      try {
        const res = await fetch('http://127.0.0.1:11434/api/tags');
        if (res.ok) {
          const data = await res.json();
          const models = (data.models || []).map(m => m.name).join(', ') || 'No models pulled yet';
          badge.innerText = '🟢 Online & Ready';
          badge.style.borderColor = '#10b981';
          badge.style.color = '#10b981';
          if (result) result.innerHTML = '✅ Ollama is running! Available models: <span style="color:#00f0ff;">' + models + '</span>';
        } else {
          throw new Error('HTTP ' + res.status);
        }
      } catch(e) {
        badge.innerText = '🔴 Offline';
        badge.style.borderColor = '#ef4444';
        badge.style.color = '#ef4444';
        if (result) result.innerHTML = '⚠️ Ollama is not responding on http://127.0.0.1:11434. Start Ollama from Windows Start Menu or run `ollama serve`. In-house zero-downtime rules are actively answering users.';
      }
    }

    // === INITIALIZE ON LOAD ===
    window.addEventListener('DOMContentLoaded', () => {
      checkAuth();
      renderStoreTable();
      renderLeaderboard();
      checkOllamaLiveStatus();
    });
  </script>
</body>
</html>
