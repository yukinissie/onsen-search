# onsen search
福岡市の温泉を検索できるよ。

PHPとSQLの復習のためのリポジトリだよ。

Laravelは超初心者だよ。

## インストール

### 環境
- PHP 8.0.9
- composer 2.1.9

### 概要

```
# 1. LaravelなどのPHPパッケージをインストール
comoposer install
# 2.環境変数を設定
echo .env.example > .env
# 3. .envにローカルのMySQLへの接続用情報を書く
# 4. セキュリティキーを発行
php artisan key:generate
# 5. onsen_searchデータベースを作成する
# 6. データベースを適応
php artisan migrate
```

#### 7. 初期データを追加
`/admin/onsen`にアクセス。

[このサイト](https://ckan.open-governmentdata.org/dataset/401307_kousyuyokujo_eigyoukyoka/resource/bddf3e5d-d604-401f-b21b-717f62561337)のCSVダウンロードして送信。
