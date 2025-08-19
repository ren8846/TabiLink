<div class="container my-4">

    <!-- 戻るボタン＋中央タイトル -->
    <div class="d-flex align-items-center mb-4 position-relative">
        <!-- 左上 戻るボタン -->
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary position-absolute start-0">
            <i class="bi bi-arrow-left"></i>
        </a>
        <!-- 中央タイトル -->
        <h4 class="mx-auto">マイページ</h4>
    </div>

    <!-- メニュー項目 -->
    <div class="d-flex flex-column align-items-center gap-3">
        <a href="{{ route('mypage.profile.edit') }}" class="menu-btn">プロフィール</a>
        <a href="{{ route('mypage.password.edit') }}" class="menu-btn">パスワード</a>

        <!-- 通知設定 ON/OFF -->
        <a href="{{ route('mypage.notifications.edit') }}"
        class="menu-btn d-flex justify-content-between align-items-center">
        <span>通知設定</span>
        <span class="badge bg-secondary">
        {{ auth()->user()->notify_enabled ? 'ON' : 'OFF' }}
        </span>
        </a>


        <a href="{{ route('inquiry.create') }}" class="menu-btn">問い合わせ</a>
        <a href="{{ route('logout.confirm') }}" class="menu-btn text-danger">ログアウト</a>
    </div>
</div>

<style>
    .menu-btn {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 250px;
        padding: 12px 16px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 12px;
        text-decoration: none;
        font-weight: bold;
        color: #333;
        transition: all 0.2s;
    }
    .menu-btn:hover {
        background-color: #e2e6ea;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('notification-toggle');
    let isOn = false; // 初期状態 OFF

    toggleBtn.addEventListener('click', function (e) {
        e.preventDefault(); // ページ遷移防止
        isOn = !isOn;
        if (isOn) {
            toggleBtn.textContent = 'ON';
            toggleBtn.classList.remove('btn-secondary');
            toggleBtn.classList.add('btn-success');
        } else {
            toggleBtn.textContent = 'OFF';
            toggleBtn.classList.remove('btn-success');
            toggleBtn.classList.add('btn-secondary');
        }
    });
});
</script>