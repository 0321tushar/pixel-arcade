# 🕹️ Pixel Arcade (ArcadeEngine) — Interactive WebGL Platform & AI Telemetry Studio

[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net/)
[![WordPress](https://img.shields.io/badge/WordPress-Theme-21759B?style=flat&logo=wordpress&logoColor=white)](https://wordpress.org/)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=flat&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![WebGL](https://img.shields.io/badge/WebGL-HTML5%20Canvas-990000?style=flat&logo=webgl&logoColor=white)](https://www.khronos.org/webgl/)
[![License](https://img.shields.io/badge/License-GPL--3.0-blue.svg)](LICENSE)

An interactive, high-performance WebGL gaming portal and virtual arcade studio engineered as an enterprise-grade custom WordPress theme. Designed for instant browser-based gaming with zero downloads, featuring a client-side NLP support bot, live studio telemetry, and a cyberpunk gamer authentication system.

---

## 🌟 Key Architecture & Highlights

### 1. 🎮 WebGL & HTML5 Gaming Portal (`frontpage.php`)
- Hosts **8+ high-performance HTML5/WebGL games** with zero-download execution.
- Features immersive **Full-Screen Theater Modes**, dynamic category filters, and responsive canvas scaling for high refresh-rate monitors and mobile screens.

### 2. 🤖 Pixel AI Support Assistant (`ai-assistant.php`)
- An intelligent 24/7 client-side rule-based **NLP Support Assistant (PixelBot)**.
- Features **multi-intent classification** for game recommendations, order/peripherals tracking, store discount lookups, and human support escalation.
- Includes quick-suggestion chips, chat state persistence, and instant response rendering with custom animated cyberpunk avatars.

### 3. 📊 Studio Admin Control Center (`arcade-admin.php`)
- Passcode-secured frontend **Admin Dashboard** designed for real-time arcade management.
- Features live **telemetry analytics** (total players, server latency, active sessions), a dynamic merchandise inventory manager, and real-time leaderboard ELO ratings.

### 4. ⚡ Gamer Auth & Audio Synth Engine (`auth-modal.php`)
- Lightweight state management utilizing browser `localStorage` to preserve player rank, Level 1–10 badges, and active session tokens.
- Integrated **Web Audio API** synthesis generating custom arcade chimes for logins, level-ups, and notifications without heavy MP3 asset downloads.
- High-visibility cyber toast notifications with smooth cubic-bezier transitions.

### 5. 🛍️ E-Commerce & Peripherals Ready
- Integrated **WooCommerce** template overrides (`woocommerce/`) for virtual coin bundles, arcade passes, and physical VR gaming peripherals.

---

## 🛠️ Tech Stack & CS Fundamentals

* **Backend & CMS:** PHP 7.4 / 8.x, WordPress Theme API, MySQL, RESTful hooks
* **Frontend:** HTML5, CSS3, JavaScript (ES6+), Bootstrap, FontAwesome
* **Graphics & Audio:** WebGL, Canvas API, Web Audio API (Synthesizer Chimes)
* **NLP & State:** Client-Side Intent Pattern Matching, Browser LocalStorage state engines
* **Styling:** Cyberpunk Glassmorphism, CSS Custom Properties (Theme variables), Responsive Grid

---

## 🚀 Installation & Local Setup

### Prerequisites
* [XAMPP](https://www.apachefriends.org/), [LocalWP](https://localwp.com/), or any LAMP/WAMP stack with PHP 7.4+ and MySQL 5.7+.
* A standard WordPress installation (v5.8+).

### Step-by-Step Setup
1. **Clone the Repository into your WordPress themes folder:**
   ```bash
   cd C:/xampp/htdocs/wordpress/wp-content/themes/
   git clone https://github.com/0321tushar/pixel-arcade.git vr-gaming
   ```

2. **Activate the Theme:**
   - Log in to your WordPress Admin Dashboard (`http://localhost/wordpress/wp-admin/`).
   - Navigate to **Appearance > Themes**.
   - Locate **VR Gaming / Pixel Arcade** and click **Activate**.

3. **Access the Portal:**
   - **Arcade Portal:** `http://localhost/wordpress/`
   - **Admin Control Center:** `http://localhost/wordpress/arcade-admin/`
   - **Pixel AI Assistant:** Click the floating `🤖 Pixel AI` button on the bottom right of any page.

---

## 📂 Project Structure

```text
vr-gaming/
├── ai-assistant.php          # Pixel AI Rule-Based NLP Bot
├── arcade-admin.php          # Passcode-Secured Telemetry Admin Dashboard
├── auth-modal.php            # Gamer Authentication & Web Audio Synthesizer
├── frontpage.php             # Main Gaming Hub & Canvas Grid
├── functions.php             # WordPress Enqueues & Core Theme Setup
├── header.php / footer.php   # Cyberpunk Navigation & Sticky Audio Header
├── style.css                 # Master Stylesheet & Theme Metadata
├── assets/
│   └── images/               # Arcade Banners, Game Thumbnails & Favicons
├── css/                      # Bootstrap, FontAwesome, OwlCarousel, Animate.css
├── js/                       # Navigation, Custom Scripts & WOW Animations
└── woocommerce/              # Custom Shop & Merchandise Templates
```

---

## 👤 Author

**Tushar Gautam**  
* B.Tech Computer Science & Engineering — Chitkara University (2023–2027)  
* GitHub: [@0321tushar](https://github.com/0321tushar)  
* LinkedIn: [linkedin.com/in/tushar-gautam](https://www.linkedin.com/in/tushar-gautam-309192289)  

---

## 📄 License
This project is licensed under the GNU General Public License v3.0 (GPL-3.0).
