<div class="container my-4">
    <!-- 戻るボタンとタイトル -->
    <div class="d-flex align-items-center mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-3">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h4 class="mb-0">パスワード再設定</h4>
    </div>


    <!-- フォーム部分 -->
    <form action="{{ route('mypage.password.update') }}" method="POST">
        @csrf

        <!-- 新しいパスワード -->
        <div class="mb-3">
            <label for="new_password" class="form-label fw-bold">新しいパスワード</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>

        <!-- 新しいパスワード（確認） -->
        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label fw-bold">新しいパスワード（確認）</label>
            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>

        <!-- 完了ボタン -->
        <button type="submit" class="btn btn-primary w-100">完了</button>
    </form>
</div>
