    </main><!-- close main.main-content -->

    <?php
    if ( !is_404() ) :
        get_template_part('template-parts/components/inc', 'recruitment');
    ?>
        <footer class="footer" id="id-lienhe">
            <div class="container">
                <div class="item-inner">
                    <?php
                    get_template_part('template-parts/footer/inc', 'logo-brand');
                    get_template_part('template-parts/footer/inc', 'info-brand');
                    ?>
                </div>
            </div>
        </footer>
    <?php
     endif;
     ?>
</div> <!-- close div.page-wrapper -->

<?php wp_footer(); ?>
</body>
</html>