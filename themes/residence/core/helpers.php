<?php
defined('ABSPATH') || exit;

/**
 * @template T of object
 * @param class-string<T> $class
 * @return T|null
 */
function residence_get_opt(string $class)
{
    if (!class_exists($class)) {
        return null;
    }

    return new $class();
}

/**
 * Custom pagination for theme
 */
function residence_pagination_custom( $args = array() ): void
{
    global $wp_query;

    if ($wp_query->max_num_pages <= 1) {
        return;
    }

    $defaults = array(
        'type' => 'list',
        'mid_size' => 2,
        'prev_text' => esc_html__('Trước', 'residence'),
        'next_text' => esc_html__('Sau', 'residence'),
        'screen_reader_text' => '&nbsp;',
    );

    $final_args = wp_parse_args($args, $defaults);

    the_posts_pagination($final_args);
}

/**
 * Custom pagination for query
 */
function residence_pagination_query( $query, $args = array() ): void
{
    if (!$query instanceof WP_Query) {
        return;
    }

    // Đảm bảo chỉ phân trang khi có nhiều hơn 1 trang
    if ($query->max_num_pages <= 1) {
        return;
    }

    $defaults = array(
        'prev_text' => esc_html__('Trước', 'residence'),
        'next_text' => esc_html__('Sau', 'residence'),
        'current'   => max(1, get_query_var('paged')),
        'total'     => $query->max_num_pages,
        'type'      => 'list',
    );

    // Gộp các đối số mặc định với các đối số tùy chỉnh
    $final_args = wp_parse_args($args, $defaults);

    $paginate_links = paginate_links($final_args);

    if ($paginate_links) :
        ?>
        <nav class="pagination">
            <?php echo $paginate_links; ?>
        </nav>
    <?php
    endif;
}

// replace number
function residence_preg_replace_ony_number( $string ): string|null {
    $number = '';

    if ( ! empty( $string ) ) {
        $number = preg_replace( '/[^0-9]/', '', strip_tags( $string ) );
    }

    return $number;
}