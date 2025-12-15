<?php
defined('ABSPATH') || exit;

// If the post is password protected, don't load the comments.
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            printf(
                _nx(
                    'Một bình luận trên &ldquo;%2$s&rdquo;',
                    '%1$s bình luận trên &ldquo;%2$s&rdquo;',
                    get_comments_number(),
                    'comments title',
                    'residence'
                ),
                number_format_i18n( get_comments_number() ),
                get_the_title()
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 42,
            ) );
            ?>
        </ol>
    <?php
        the_comments_navigation();
    endif;

    // Hiển thị form bình luận
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="no-comments"><?php esc_html_e( 'Bình luận đã đóng.', 'residence' ); ?></p>
    <?php
    endif;

    // Tùy chỉnh các tham số cho form bình luận
    $comments_args = array(
        'title_reply' => '<span>' . esc_html__('Để lại bình luận', 'residence') . '</span>',
        'comment_field' => '<div class="form-comment-item form-comment-field order-3"><textarea rows="7" id="comment" placeholder="' . esc_html__('Bình luận', 'residence') . '" name="comment" class="form-control"></textarea></div>',
    );

    comment_form($comments_args);
    ?>
</div>
