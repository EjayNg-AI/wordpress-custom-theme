<footer>
  <div class="footer-content">
    <p><?php echo esc_html( get_theme_mod( 'footer_text', '&copy; ' . date('Y') . ' Your Company Name. All Rights Reserved.' ) ); ?></p>
    <p>
      <?php
        printf(
          /* translators: %s: Contact email address */
          __( 'Contact us: <a href="mailto:%s">%s</a>', 'custom-landing-page' ),
          esc_attr( get_theme_mod( 'footer_contact_email', 'info@example.com' ) ),
          esc_html( get_theme_mod( 'footer_contact_email', 'info@example.com' ) )
        );
      ?>
    </p>
  </div>
  <?php wp_footer(); ?>
</footer>

</body>
</html>
