<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>管理画面 - FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <header class="admin-header">
        <div class="admin-header__inner">
            <div class="admin-header__logo">FashionablyLate</div>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="admin-header__logout">logout</button>
            </form>
        </div>
    </header>

    <main class="admin-main">
        <div class="admin-content">
            <h1 class="admin-title">Admin</h1>

            <!-- 検索・フィルター -->
            <div class="search-filters">
                <form method="GET" action="{{ route('admin.index') }}" class="search-form">
                    @csrf
                    <div class="search-row">
                        <div class="search-input-group">
                            <input type="text" name="search" placeholder="名前やメールアドレスを入力してください"
                                   value="{{ $searchParams['search'] ?? '' }}" class="search-input">
                        </div>

                        <div class="filter-group">
                            <select name="gender" class="filter-select">
                                <option value="">性別</option>
                                <option value="male" {{ ($searchParams['gender'] ?? '') == 'male' ? 'selected' : '' }}>男性</option>
                                <option value="female" {{ ($searchParams['gender'] ?? '') == 'female' ? 'selected' : '' }}>女性</option>
                                <option value="other" {{ ($searchParams['gender'] ?? '') == 'other' ? 'selected' : '' }}>その他</option>
                            </select>

                            <select name="inquiry_type" class="filter-select">
                                <option value="">お問い合わせの種類</option>
                                <option value="general" {{ ($searchParams['inquiry_type'] ?? '') == 'general' ? 'selected' : '' }}>一般的なお問い合わせ</option>
                                <option value="support" {{ ($searchParams['support'] ?? '') == 'support' ? 'selected' : '' }}>サポート</option>
                                <option value="business" {{ ($searchParams['business'] ?? '') == 'business' ? 'selected' : '' }}>ビジネス</option>
                                <option value="other" {{ ($searchParams['other'] ?? '') == 'other' ? 'selected' : '' }}>その他</option>
                            </select>

                            <input type="date" name="date" value="{{ $searchParams['date'] ?? '' }}" class="filter-date">
                        </div>

                        <div class="action-buttons">
                            <button type="submit" class="btn btn-primary">検索</button>
                            <a href="{{ route('admin.index') }}" class="btn btn-secondary">リセット</a>
                        </div>
                    </div>
                </form>

                <div class="export-section">
                    <form method="POST" action="{{ route('admin.contacts.export') }}" class="export-form">
                        @csrf
                        <!-- 検索条件を隠しフィールドで送信 -->
                        <input type="hidden" name="search" value="{{ $searchParams['search'] ?? '' }}">
                        <input type="hidden" name="gender" value="{{ $searchParams['gender'] ?? '' }}">
                        <input type="hidden" name="inquiry_type" value="{{ $searchParams['inquiry_type'] ?? '' }}">
                        <input type="hidden" name="date" value="{{ $searchParams['date'] ?? '' }}">
                        <button type="submit" class="btn btn-export">エクスポート</button>
                    </form>

                    <div class="pagination">
                        {{ $contacts->appends($searchParams)->links() }}
                    </div>
                </div>
            </div>

            <!-- データテーブル -->
            <div class="data-table">
                <table class="table">
                    <thead class="table-header">
                        <tr>
                            <th>お名前</th>
                            <th>性別</th>
                            <th>メールアドレス</th>
                            <th>お問い合わせの種類</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @foreach($contacts as $contact)
                        <tr class="table-row">
                            <td>{{ $contact->name }}</td>
                            <td>
                                @if($contact->gender == 'male')
                                    男性
                                @elseif($contact->gender == 'female')
                                    女性
                                @else
                                    その他
                                @endif
                            </td>
                            <td>{{ $contact->email }}</td>
                            <td>
                                @if($contact->inquiry_type == 'general')
                                    一般的なお問い合わせ
                                @elseif($contact->inquiry_type == 'support')
                                    サポート
                                @elseif($contact->inquiry_type == 'business')
                                    ビジネス
                                @else
                                    その他
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-details" onclick="openModal({{ $contact->id }})">詳細</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- モーダル -->
    <div id="contactModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>お問い合わせ詳細</h2>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- モーダルの内容はJavaScriptで動的に読み込む -->
            </div>
        </div>
    </div>

    <script>
        function openModal(contactId) {
            // モーダルを表示
            document.getElementById('contactModal').style.display = 'block';

            // 詳細データを取得
            fetch(`/admin/contacts/${contactId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modalBody').innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('modalBody').innerHTML = '<p>データの読み込みに失敗しました。</p>';
                });
        }

        function closeModal() {
            document.getElementById('contactModal').style.display = 'none';
        }

        function deleteContact(contactId) {
            if (confirm('このお問い合わせを削除しますか？')) {
                fetch(`/admin/contacts/${contactId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        closeModal();
                        location.reload(); // ページをリロードして一覧を更新
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('削除に失敗しました。');
                });
            }
        }

        // モーダルの外側をクリックしても閉じる
        window.onclick = function(event) {
            const modal = document.getElementById('contactModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>
