<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * メニューにカウンタ設定メニューを追加する
 * 
 */
function page_counter_settings_menu() {
    add_options_page(
        'タンスのカウンタ設定',
        'タンスのカウンタ設定',
        'manage_options',
        'page-counter-settings',
        'page_counter_settings_page'
    );
}
add_action('admin_menu', 'page_counter_settings_menu');

/**
 * カウンタ設定ページの作成
 * 
 */
function page_counter_settings_page() {
    ?>
    <div class="wrap">
        <h1>タンスのカウンタ設定</h1>
        <form method="post" action="options.php">
            <?php settings_fields('page_counter_settings_group'); ?>
            <?php do_settings_sections('page-counter-settings'); ?>
            <?php submit_button(); ?>
        </form>
        ※[0.png] ～[9.png]を画像フォルダパスに配置してください。<br>
        <hr>
        <h2>サンプルカウンタ</h2>
        <div>
            <?php echo page_counter_sample_display(); ?>
        </div>
        <h2>使用方法</h2>
        　カウンタを入れたい場所に、ショートコードを使って<br>
        　　　　[page_counter]<br>
        と入力してください。<br>
        　閲覧したユーザが変わるたびにカウントされます。<br>
    </div>
    <?php
}

// カウンタ設定オプションを登録
function page_counter_settings_init() {
    register_setting('page_counter_settings_group', 'page_counter_image_path');
    register_setting('page_counter_settings_group', 'page_counter_image_size');

    add_settings_section(
        'page_counter_settings_section',
        'カウンタ画像設定',
        null,
        'page-counter-settings'
    );

    add_settings_field(
        'page_counter_image_path',
        '画像フォルダパス',
        'page_counter_image_path_callback',
        'page-counter-settings',
        'page_counter_settings_section'
    );

    add_settings_field(
        'page_counter_image_size',
        '画像一枚毎のサイズ（px）',
        'page_counter_image_size_callback',
        'page-counter-settings',
        'page_counter_settings_section'
    );
}
add_action('admin_init', 'page_counter_settings_init');

function page_counter_image_path_callback() {
    $image_path = get_option('page_counter_image_path', PAGE_COUNTER_URL . 'images/');
    echo '<input type="text" name="page_counter_image_path" value="' . esc_attr($image_path) . '" size="50">';
}

function page_counter_image_size_callback() {
    $image_size = get_option('page_counter_image_size', 100);
    echo '<input type="number" name="page_counter_image_size" value="' . esc_attr($image_size) . '" min="10" max="500">';
}