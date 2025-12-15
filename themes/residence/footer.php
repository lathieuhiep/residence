    </main><!-- close main.main-content -->

    <?php
    if ( !is_404() ) :
        get_template_part('components/footer/footer-main', 'layout');
     endif;
     ?>
</div> <!-- close div.page-wrapper -->

<?php wp_footer(); ?>
</body>
</html>