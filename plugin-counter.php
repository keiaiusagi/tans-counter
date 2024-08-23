<?php
/*
Plugin Name: たんすのカウンター
Plugin URI: https://tansunohazama.sakura.ne.jp/
Description: ページ内カウンターを実装します
Version: 0.1
Author: kirabbit
Author URI: https://tansunohazama.sakura.ne.jp/
*/

// 直接呼出しの禁止
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// プラグインのディレクトリパス
define('PAGE_COUNTER_DIR', plugin_dir_path(__FILE__));
define('PAGE_COUNTER_URL', plugin_dir_url(__FILE__));

// インクルードファイル
require_once PAGE_COUNTER_DIR . 'includes/admin-settings.php';
require_once PAGE_COUNTER_DIR . 'includes/counter-functions.php';
require_once PAGE_COUNTER_DIR . 'includes/display-functions.php';

// hook 必要なディレクトリを作成
function create_counter_directory() {
	// カウンタの計算ファイル置き場
    $counter_dir = PAGE_COUNTER_DIR . 'counters/';
    if (!file_exists($counter_dir)) {
        mkdir($counter_dir, 0755, true);
    }
	
	//カウンタ用の画像置き場
    $images_dir = PAGE_COUNTER_DIR . 'images/';
    if (!file_exists($images_dir)) {
        mkdir($images_dir, 0755, true);
    }
}

//アクティベート時に実行される
register_activation_hook(__FILE__, 'create_counter_directory');

?>
