<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * カウンタ表示
 * 表示用HTML生成部(PNG)
 */
function display_page_counter_with_png() {
    if (is_singular()) {
        $post_id = get_the_ID();
        $counter_file = PAGE_COUNTER_DIR . 'counters/' . $post_id . '.txt';

        // 管理画面から取得した画像フォルダパスとサイズ設定を取得
        $image_path = get_option('page_counter_image_path', PAGE_COUNTER_URL . 'images/');
        $image_size = get_option('page_counter_image_size', 100);

        if (file_exists($counter_file)) {
            // ファイルからカウント数を取得
            list($count) = explode("\t", file_get_contents($counter_file));

            // カウント数を6桁のゼロパディングにする
            $counter = str_pad($count, 6, '0', STR_PAD_LEFT);
            $counter_digits = str_split($counter);
            $output = '<div style="display: inline-block;">';

            foreach ($counter_digits as $digit) {
                $png_url = $image_path . $digit . '.png';
                $output .= '<img src="' . esc_url($png_url) . '" alt="' . esc_attr($digit) . '" style="width: ' . intval($image_size) . 'px; height: auto; vertical-align: middle;">';
            }

            $output .= '</div>';
            return $output;
        } else {
            return '初めての訪問者です。';
        }
    }
}
add_shortcode('page_counter', 'display_page_counter_with_png');

/**
 * カウンタ表示
 * メニュー画面用　サンプルカウンタ
 */
function page_counter_sample_display() {
    $image_path = get_option('page_counter_image_path', PAGE_COUNTER_URL . 'images/');
    $image_size = get_option('page_counter_image_size', 100);

    // サンプル表示用の数字を作成（例: "000123"）
    $sample_number = '000123';
    $sample_digits = str_split($sample_number);
    $output = '<div style="display: inline-block;">';

    foreach ($sample_digits as $digit) {
        $png_url = $image_path . $digit . '.png';
        $output .= '<img src="' . esc_url($png_url) . '" alt="' . esc_attr($digit) . '" style="width: ' . intval($image_size) . 'px; height: auto; vertical-align: middle;">';
    }

    $output .= '</div>';
    return $output;
}
