
<div class="container my-4">

    <!-- 戻るボタンとタイトル -->
    <div class="d-flex align-items-center mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-3">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h4 class="mb-0">お問い合わせ</h4>
    </div>

    <!-- よくある質問コーナー -->
    <div class="mb-4">
        <h5>よくある質問</h5>
        <ul class="list-group">
            <li class="list-group-item">Q. パスワードを忘れた場合は？</li>
            <li class="list-group-item">Q. 登録情報を変更したい場合は？</li>
            <li class="list-group-item">Q. 退会方法は？</li>
        </ul>
    </div>

    <!-- お問い合わせフォーム -->
    <div class="card p-4">
        <form action="{{ route('inquiry.send') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">お名前</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">タイトル</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">本文</label>
                <textarea name="message" id="message" rows="4" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">送信</button>
        </form>
    </div>
</div>