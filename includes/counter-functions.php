<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * カウンタの更新機能
 * インクリメントロジック部
 */
function update_page_counter() {
    if (is_singular()) {
        $post_id = get_the_ID();
        $counter_file = PAGE_COUNTER_DIR . 'counters/' . $post_id . '.txt';

        // クライアントのIPアドレスを取得
        #$client_ip = $_SERVER['REMOTE_ADDR']; // -- 最終訪問者のIPアドレス漏洩対策
		$client_ip = hash('sha256', $_SERVER['REMOTE_ADDR'] . "sio2g");

        if (!file_exists($counter_file)) {
            // ファイルが存在しない場合はカウントを0、IPを現在のIPで初期化
            file_put_contents($counter_file, "1\t$client_ip");
        } else {
            // ファイルからカウント数と最後のIPアドレスを読み取る
            list($count, $last_ip) = explode("\t", file_get_contents($counter_file));

            // 同じIPアドレスからの訪問でない場合のみカウントを増加
            if ($client_ip !== trim($last_ip)) {
                $count++;
                file_put_contents($counter_file, "$count\t$client_ip");
            }
        }
    }
}
add_action('wp', 'update_page_counter');
