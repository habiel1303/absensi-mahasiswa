<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Sistem Absensi Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: #1a3a6b;
        }

        .bg-animated {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1a3a6b 0%, #1e40af 50%, #2563eb 100%);
            z-index: 0;
        }

        .bg-animated::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(96, 165, 250, 0.15);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .bg-animated::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -80px;
            left: -80px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
            padding: 44px 40px;
            width: 100%;
        }

        .login-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .logo-wrap {
            width: 76px;
            height: 76px;
            background: linear-gradient(135deg, #1d4ed8, #60a5fa);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.4);
        }

        .logo-wrap i {
            font-size: 34px;
            color: #fff;
        }

        .login-header h1 {
            font-size: 19px;
            font-weight: 700;
            color: #1e3a5f;
            margin-bottom: 6px;
            line-height: 1.3;
        }

        .login-header p {
            font-size: 12.5px;
            color: #6b7280;
            line-height: 1.5;
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 500;
            padding: 5px 14px;
            border-radius: 20px;
            margin-bottom: 22px;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 18px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .alert-error i {
            color: #ef4444;
            font-size: 14px;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .alert-error ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .alert-error ul li {
            font-size: 12.5px;
            color: #dc2626;
            line-height: 1.6;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success i {
            color: #22c55e;
            font-size: 14px;
        }

        .alert-success span {
            font-size: 12.5px;
            color: #15803d;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 7px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 14px;
            pointer-events: none;
        }

        .input-wrap input {
            width: 100%;
            padding: 12px 44px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 13.5px;
            font-family: 'Poppins', sans-serif;
            color: #111827;
            background: #f9fafb;
            transition: all 0.2s;
            outline: none;
        }

        .input-wrap input::placeholder {
            color: #9ca3af;
            font-size: 13px;
        }

        .input-wrap input:focus {
            border-color: #3b82f6;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
        }

        .input-wrap input.is-invalid {
            border-color: #ef4444;
            background: #fff5f5;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            cursor: pointer;
            font-size: 14px;
            background: none;
            border: none;
            padding: 0;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: #3b82f6;
        }

        .invalid-msg {
            font-size: 12px;
            color: #ef4444;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #1d4ed8, #3b82f6);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14.5px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.25s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 6px;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.35);
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #1e40af, #2563eb);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.45);
            transform: translateY(-1px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login:disabled {
            opacity: 0.75;
            cursor: not-allowed;
            transform: none;
        }

        .spinner {
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            display: none;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .login-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid #f3f4f6;
        }

        .login-footer p {
            font-size: 12px;
            color: #9ca3af;
        }

        .login-footer strong {
            color: #6b7280;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 32px 24px;
            }

            .login-header h1 {
                font-size: 17px;
            }
        }
    </style>
</head>

<body>

    <div class="bg-animated"></div>

    <div class="login-wrapper">
        <div class="login-card">

            <div class="login-header">
                <div class="logo-wrap">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h1>Sistem Absensi Mahasiswa</h1>
                <p>Silakan masuk untuk melanjutkan ke dashboard.</p>
            </div>

            <div class="text-center" style="text-align:center">
                <span class="role-badge">
                    <i class="fas fa-chalkboard-teacher"></i>
                    Portal Dosen
                </span>
            </div>

            @if ($errors->any())
                <div class="alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
                <div class="alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" id="loginForm">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrap">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Masukkan email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                            autocomplete="email" required>
                    </div>
                    @error('email')
                        <div class="invalid-msg">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" name="password" placeholder="Masukkan password"
                            class="{{ $errors->has('password') ? 'is-invalid' : '' }}" autocomplete="current-password"
                            required>
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-msg">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn-login" id="btnLogin">
                    <div class="spinner" id="spinner"></div>
                    <i class="fas fa-sign-in-alt" id="btnIcon"></i>
                    <span id="btnText">Masuk</span>
                </button>

            </form>

            <div class="login-footer">
                <p>&copy; {{ date('Y') }} <strong>Sistem Absensi Mahasiswa</strong></p>
                <p style="margin-top:4px">Hak akses khusus untuk <strong>Dosen</strong></p>
            </div>

        </div>
    </div>

    <script>
        function togglePassword() {
            var input = document.getElementById('password');
            var eyeIcon = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.className = 'fas fa-eye-slash';
            } else {
                input.type = 'password';
                eyeIcon.className = 'fas fa-eye';
            }
        }

        document.getElementById('loginForm').addEventListener('submit', function() {
            var btn = document.getElementById('btnLogin');
            var spinner = document.getElementById('spinner');
            var icon = document.getElementById('btnIcon');
            var text = document.getElementById('btnText');
            btn.disabled = true;
            spinner.style.display = 'block';
            icon.style.display = 'none';
            text.textContent = 'Memproses...';
        });
    </script>

</body>

</html>
