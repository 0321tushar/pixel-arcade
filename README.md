# 🕹️ Pixel Arcade - Next-Gen Web Gaming & AI Platform

[![WordPress](https://img.shields.io/badge/WordPress-6.x-blue.svg)](https://wordpress.org)
[![PHP](https://img.shields.io/badge/PHP-7.4%20|%208.x-purple.svg)](https://php.net)
[![HTML5 Gaming](https://img.shields.io/badge/Games-HTML5%20%2F%20WebGL-orange.svg)](https://github.com/0321tushar/pixel-arcade)
[![License](https://img.shields.io/badge/License-GPL--2.0%2B-green.svg)](LICENSE)

A fully responsive, high-performance WordPress web arcade featuring pre-bundled HTML5/WebGL games, an interactive **Pixel AI Gaming Assistant**, a Gamification & Tournament Admin Dashboard, and a seamless gamer authentication system with dark cyberpunk styling.

---

## 📁 Repository Structure

```text
pixel-arcade/
├── database/
│   └── pixel_arcade.sql           # Complete MySQL database export (posts, games, config)
├── wp-content/
│   ├── games/                     # 9 Bundled HTML5/WebGL Arcade Games
│   │   ├── basket-random/         # Physics basketball game
│   │   ├── boxing-random/         # 2-player ragdoll boxing
│   │   ├── drive-mad/             # 3D stunt driving challenge
│   │   ├── iron-snout/            # Fast-paced action fighting game
│   │   ├── moto-x3m/              # Bike stunt racing classic
│   │   ├── soccer-random/         # Ragdoll soccer madness
│   │   ├── subway-surfers/        # Endless runner (Phaser 3 / WebGL)
│   │   ├── tomb-runner/           # 3D temple run adventure
│   │   └── vex-5/                 # Platformer obstacle puzzle
│   ├── themes/
│   │   └── vr-gaming/             # Custom Pixel Arcade Cyberpunk Theme
│   │       ├── assets/            # Theme icons, fonts, sound effects
│   │       ├── css/               # Modular styling sheets
│   │       ├── js/                # Game modals, tabs, Swiper & interactive logic
│   │       ├── template-parts/    # Reusable WordPress template components
│   │       ├── ai-assistant.php   # Pixel AI Game Recommender & Chatbot
│   │       ├── arcade-admin.php   # Game management, metrics & leaderboard control
│   │       ├── auth-modal.php     # Player sign-in & registration modal
│   │       ├── frontpage.php      # Main arcade portal, hero slider & game categories
│   │       ├── functions.php      # Custom post types, REST APIs & theme setup
│   │       ├── header.php         # Navigation bar & search drawer
│   │       ├── footer.php         # Footer with quick links & social hub
│   │       └── style.css          # Core cyberpunk arcade theme stylesheet
│   ├── fonts/                     # Custom typography
│   └── uploads/                   # Uploaded game covers, logos, and banners
├── wp-config-sample.php           # WordPress configuration template
├── index.php                      # Root WordPress bootstrap entry
├── .gitignore                     # Clean WP gitignore (excludes core & secrets)
└── README.md                      # Documentation
```

---

## 🚀 Key Features

- **🎮 9 Pre-Integrated HTML5 Games**: Instant in-browser play with responsive iframe wrappers and full-screen controls.
- **🤖 Pixel AI Gaming Assistant**: Smart conversational AI widget (`ai-assistant.php`) that recommends games based on player mood, genre preferences, and skill level.
- **🏆 Arcade Admin Dashboard**: Dedicated portal (`arcade-admin.php`) for monitoring active players, game plays, leaderboard rankings, and site health.
- **🔐 Gamer Authentication**: Custom login and signup modals (`auth-modal.php`) designed specifically for gamers.
- **📱 Fully Responsive Cyberpunk UI**: Neon glow aesthetics, custom animations, quick-filter game tags, and mobile-optimized layouts.

---

## 🛠️ Local Installation & Setup

### 1. Requirements
- Web Server: **Apache** or **Nginx** (e.g. via XAMPP, WAMP, or LocalWP)
- PHP: **7.4+** or **8.x**
- Database: **MySQL 5.7+** or **MariaDB 10.3+**

### 2. Setup Steps

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/0321tushar/pixel-arcade.git
   ```

2. **Place in Web Root**:
   - For XAMPP, place files in `C:\xampp\htdocs\wordpress\` (or any subfolder/virtual host).
   - Ensure WordPress core files (`wp-admin`, `wp-includes`, and core PHP files) are present.

3. **Import Database**:
   - Open phpMyAdmin (`http://localhost/phpmyadmin/`) or MySQL CLI.
   - Create a database:
     ```sql
     CREATE DATABASE wordpress_site CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
     ```
   - Import the database dump:
     ```bash
     mysql -u root wordpress_site < database/pixel_arcade.sql
     ```

4. **Configure `wp-config.php`**:
   - Copy `wp-config-sample.php` to `wp-config.php`:
     ```php
     define( 'DB_NAME', 'wordpress_site' );
     define( 'DB_USER', 'root' );
     define( 'DB_PASSWORD', '' );
     define( 'DB_HOST', 'localhost' );
     ```

5. **Activate Theme**:
   - Navigate to **WordPress Admin** -> **Appearance** -> **Themes**.
   - Activate **VR Gaming / Pixel Arcade**.

6. **Launch Arcade**:
   - Open your browser at `http://localhost/wordpress/`.

---

## 🕹️ Bundled Games Overview

| Game | Category | Engine / Format |
|---|---|---|
| **Subway Surfers** | Endless Runner | Phaser 3 / WebGL |
| **Drive Mad** | 3D Driving Challenge | WebGL / ThreeJS |
| **Moto X3M** | Bike Stunt Racing | HTML5 Canvas |
| **Vex 5** | Platformer / Parkour | HTML5 Canvas |
| **Basket Random** | Sports / Ragdoll Physics | HTML5 Canvas |
| **Boxing Random** | Fighting / 2-Player | HTML5 Canvas |
| **Soccer Random** | Sports / Physics | HTML5 Canvas |
| **Iron Snout** | Action / Beat 'em Up | HTML5 Canvas |
| **Tomb Runner** | 3D Adventure Runner | WebGL |

---

## 🛡️ Security & Best Practices

- `wp-config.php` containing local database credentials is kept out of Git.
- WordPress core directories (`wp-admin`, `wp-includes`) are excluded from tracking to keep the repository lightweight and adhere to standard WordPress version control architecture.

---

## 👨‍💻 Author

- **GitHub**: [@0321tushar](https://github.com/0321tushar)
- **Project**: Pixel Arcade
