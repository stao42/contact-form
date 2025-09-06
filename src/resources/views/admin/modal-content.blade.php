<div class="modal-details">
    <div class="detail-grid">
        <div class="detail-item">
            <label>姓</label>
            <span>{{ $contact->last_name }}</span>
        </div>
        <div class="detail-item">
            <label>名</label>
            <span>{{ $contact->first_name }}</span>
        </div>
        <div class="detail-item">
            <label>性別</label>
            <span>{{ $contact->gender_text }}</span>
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
            <span>{{ $contact->category->content ?? '不明' }}</span>
        </div>
        <div class="detail-item">
            <label>お問い合わせ内容</label>
            <span>{{ $contact->detail }}</span>
        </div>
    </div>

    <div class="modal-actions">
        <button class="btn btn-danger" onclick="deleteContact({{ $contact->id }})">削除</button>
    </div>
</div>
