<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', '多分店會員管理系統') }} | 歡迎</title>

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    <style>
        /* 簡單的首頁高度佈局 */
        .hero-section {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
    </style>
</head>
<body class="bg-body text-body antialiased">

    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="bi bi-shop"></i> {{ config('app.name', '多分店會員管理系統') }}
            </a>

            <div class="d-flex">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/admin') }}" class="btn btn-primary">
                            <i class="bi bi-speedometer2"></i> 進入管理後台
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">
                            <i class="bi bi-box-arrow-in-right"></i> 系統登入
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <main class="hero-section">
        <div class="container">
            <i class="bi bi-people text-primary animate__animated animate__pulse animate__infinite" style="font-size: 5rem;"></i>
            <h1 class="display-4 fw-bold mt-3 animate__animated animate__fadeInUp">{{ config('app.name', '多分店會員管理系統') }}</h1>
            <p class="lead text-secondary mt-3 mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                專為多實體店面、跨據點打造的會員管理解決方案。<br>
                落實單一職責原則與嚴格的資料隔離，保障企業數據安全。
            </p>

            @if (Route::has('login'))
                @guest
                    <div class="animate__animated animate__fadeInUp animate__delay-2s">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm">
                            立即登入
                        </a>
                    </div>
                @endguest
            @endif
        </div>
    </main>

    <footer class="py-4 text-center text-secondary">
        <div class="container">
            <small>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</small>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 確認 Toast 已全域註冊後可直接呼叫
            if (typeof Toast !== 'undefined') {
                console.log('前端資源就緒：Alpine, Bootstrap, SweetAlert2 已成功載入！');
            }
        });
    </script>
</body>
</html>
