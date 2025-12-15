<?php
/**
 * Tùy chỉnh các trường mặc định của form bình luận.
 * @param array $fields Mảng các trường mặc định.
 * @return array Mảng các trường đã được tùy chỉnh.
 */
function residence_custom_comment_form_fields(array $fields): array
{
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');

    $custom_fields = array(
        'author' => '<div class="col-12 col-sm-6 col-md-6"><div class="form-comment-item"><input id="author" placeholder="' . esc_html__('Họ và tên', 'residence') . '" class="form-control" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></div></div>',
        'email'  => '<div class="col-12 col-sm-6 col-md-6"><div class="form-comment-item"><input id="email" placeholder="' . esc_html__('Email', 'residence') . '" class="form-control" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></div></div>',
        'url'    => '<div class="col-12"><div class="form-comment-item"><input id="url" placeholder="' . esc_html__('Website', 'residence') . '" class="form-control" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></div></div>',
    );

    // Tạo một mảng mới để bọc các trường
    $new_fields = array();
    $new_fields['fields_wrap_start'] = '<div class="comment-fields-row order-1"><div class="row">';
    $new_fields += $custom_fields; // Thêm các trường tùy chỉnh vào mảng mới
    $new_fields['fields_wrap_end'] = '</div></div>';

    return $new_fields;
}

add_filter('comment_form_fields', 'residence_custom_comment_form_fields');