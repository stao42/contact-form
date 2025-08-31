<div class="modal-details">
    <div class="detail-grid">
        <div class="detail-item">
            <label>お名前</label>
            <span>{{ $contact->name }}</span>
        </div>
        <div class="detail-item">
            <label>性別</label>
            <span>
                @if($contact->gender == 'male')
                    男性 (Male)
                @elseif($contact->gender == 'female')
                    女性 (Female)
                @else
                    その他 (Other)
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
    </div>

    <div class="modal-actions">
        <button class="btn btn-danger" onclick="deleteContact({{ $contact->id }})">削除</button>
    </div>
</div>
