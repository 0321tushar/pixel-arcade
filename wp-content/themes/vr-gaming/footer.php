<footer style="background-color: #07080c; border-top: 1px solid #1b202e; padding: 35px 0 25px 0; margin-top: 60px;">
  <div class="container" style="text-align: center;">
    <div style="margin-bottom: 14px;">
      <span style="font-size: 22px; font-weight: 800; color: #00d2d3; letter-spacing: 1.5px; font-family: sans-serif;">PIXEL ARCADE</span>
      <p style="color: #747d8c; font-size: 14px; margin: 6px 0 16px 0; font-family: sans-serif;">Play 100% Free HTML5 Games & Action Arcades Online.</p>
    </div>
    <div style="margin-bottom: 16px; font-family: sans-serif;">
      <a href="<?php echo esc_url(home_url('/')); ?>" style="color: #a4b0be; margin: 0 12px; text-decoration: none; font-size: 13px;">Home</a>
      <a href="#" style="color: #a4b0be; margin: 0 12px; text-decoration: none; font-size: 13px;">Privacy Policy</a>
      <a href="#" style="color: #a4b0be; margin: 0 12px; text-decoration: none; font-size: 13px;">Terms of Service</a>
      <a href="#" style="color: #a4b0be; margin: 0 12px; text-decoration: none; font-size: 13px;">Contact</a>
    </div>
    <p style="color: #57606f; font-size: 12px; margin: 0; font-family: sans-serif;">&copy; <?php echo date('Y'); ?> Pixel Arcade. All Rights Reserved.</p>
  </div>
</footer>

<?php 
if (file_exists(get_template_directory() . '/ai-assistant.php')) {
    include get_template_directory() . '/ai-assistant.php';
}
?>

<?php wp_footer(); ?>

</body>
</html>