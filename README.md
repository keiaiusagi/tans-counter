# tans-counter
WordPressにページカウンタを追加するプラグインです

●配置方法
　WordPressのpluginsフォルダ下に、
     tans-counter
フォルダを作成し、すべてのファイルを配置してください。
　phpファイルのパーミッションは755を想定しています。

●使い方
記事の作成画面上で、ショートコードを使って
　　[page_counter]
と入力すると、カウンタが表示されるようになります。
ページ毎に値を保持します。
最後に訪れたユーザが画面更新を行っても値は増えません。

●管理画面
プラグインを有効にすると、WPの設定メニュー内に
　　タンスのカウンタ設定
が表示されます。
　画像フォルダパスと、画像ファイルの大きさを変更できます。
　現在はPNGファイルに対応しています。
　画像フォルダパスに、0~9の数字が書かれたPNGファイルを配置してください。
