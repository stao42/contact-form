<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>詳細 - FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <header class="admin-header">
        <div class="admin-header__inner">
            <div class="admin-header__logo">FashionablyLate</div>
            <button class="admin-header__logout">logout</button>
        </div>
    </header>

    <main class="admin-main">
        <div class="admin-content">
            <div class="detail-header">
                <a href="{{ route('admin.index') }}" class="btn btn-secondary">← 一覧に戻る</a>
                <h1 class="admin-title">お問い合わせ詳細</h1>
            </div>

            <div class="detail-content">
                <div class="detail-section">
                    <h2>基本情報</h2>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <label>お名前</label>
                            <span>{{ $contact->name }}</span>
                        </div>
                        <div class="detail-item">
                            <label>性別</label>
                            <span>
                                @if($contact->gender == 'male')
                                    男性
                                @elseif($contact->gender == 'female')
                                    女性
                                @else
                                    その他
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <label>メールアドレス</label>
                            <span>{{ $contact->email }}</span>
                        </div>
                        <div class="detail-item">
                            <label>電話番号</label>
                            <span>{{ $contact->tel }}</span>
                        </div>
                        <div class="detail-item">
                            <label>住所</label>
                            <span>{{ $contact->address ?? '未入力' }}</span>
                        </div>
                        <div class="detail-item">
                            <label>建物名</label>
                            <span>{{ $contact->building ?? '未入力' }}</span>
                        </div>
                        <div class="detail-item">
                            <label>お問い合わせの種類</label>
                            <span>
                                @if($contact->inquiry_type == 'general')
                                    一般的なお問い合わせ
                                @elseif($contact->inquiry_type == 'support')
                                    サポート
                                @elseif($contact->inquiry_type == 'business')
                                    ビジネス
                                @else
                                    その他
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <label>お問い合わせ内容</label>
                            <span>{{ $contact->content }}</span>
                        </div>
                        <div class="detail-item">
                            <label>作成日時</label>
                            <span>{{ $contact->created_at->format('Y年m月d日 H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
