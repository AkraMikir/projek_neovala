<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon - Neovala Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <style>
        .coming-soon {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 60vh;
            text-align: center;
        }
        .coming-soon-content {
            max-width: 500px;
        }
        .coming-soon-content i {
            font-size: 5rem;
            color: var(--primary);
            margin-bottom: 2rem;
            opacity: 0.3;
        }
        .coming-soon-content h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }
        .coming-soon-content p {
            color: var(--text-secondary);
            margin-bottom: 2rem;
        }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: var(--transition);
        }
        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }
    </style>
</head>
<body>
    @include('admin.partials.sidebar')

    <div class="main-wrapper">
        <div class="main-content">
            <div class="coming-soon">
                <div class="coming-soon-content">
                    <i class="fas fa-tools"></i>
                    <h1>{{ $message ?? 'Module Coming Soon' }}</h1>
                    <p>This module is currently under development. It will be available in the next phase of the admin panel refactoring.</p>
                    <p style="font-size: 0.875rem; color: var(--text-muted);">
                        For now, please use the original admin panel at 
                        <a href="/admin/dashboard" style="color: var(--primary);">/admin/dashboard</a>
                    </p>
                    <a href="{{ route('admin.dashboard1') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i>
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
</body>
</html>
