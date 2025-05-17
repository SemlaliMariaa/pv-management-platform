
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        .sidebar {
            position: fixed;
            right: 0;
            top: 0;
            height: 100vh;
            width: 4rem;
            padding: 1rem 0;
            background: white;
            box-shadow: -2px 0 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            z-index: 1000;
            overflow: hidden;
        }
        
        .sidebar:hover {
            width: 16rem;
        }
        
        .sidebar:hover .nav-text {
            display: inline-block;
            opacity: 1;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            margin: 0.25rem 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
            direction: rtl; /* Pour le texte arabe */
        }
        
        .nav-item:hover {
            background: #f3f4f6;
        }
        
        .nav-item i {
            min-width: 2rem;
            text-align: center;
            font-size: 1.25rem;
            color: #4b5563;
        }
        
        .nav-text {
            display: none;
            opacity: 0;
            white-space: nowrap;
            color: #1f2937;
            font-weight: 500;
            transition: opacity 0.3s ease;
            margin-right: 0.75rem;
        }
        
        .main-content {
            margin-right: 4rem;
            transition: margin 0.3s ease;
            direction: rtl; /* Pour le contenu arabe */
            text-align: right;
        }
        
        .sidebar:hover ~ .main-content {
            margin-right: 16rem;
        }
        
        /* Pour le contenu à gauche */
        .content-container {
            direction: ltr; /* Contenu à gauche */
        }
        .content-wrapper {
            direction: rtl; /* Texte arabe aligné à droite */
            text-align: right;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar à droite -->
    <!-- Navbar à droite -->
@auth
<nav class="sidebar">
    <div class="flex flex-col h-full">
        
        <!-- Logo -->
        <div class="px-4 py-2 mb-4">
            <div class="nav-item">
                <i class="fas fa-building text-blue-500"></i>
                <span class="nav-text">جمعيتي</span>
            </div>
        </div>

        <!-- Menu Items -->
        <div class="flex-1 overflow-y-auto">
            @if(Auth::user()->role === 'user')
                <!-- روابط المستخدم -->
                <a href="{{ route('user.dashboard') }}" class="nav-item">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">الرئيسية</span>
                </a>

                <a href="{{ route('meetings.index') }}" class="nav-item">
                    <i class="fas fa-users"></i>
                    <span class="nav-text">الأعضاء</span>
                </a>
            @elseif(Auth::user()->role === 'admin')
                <!-- روابط المشرف -->
                <a href="" class="nav-item">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">الرئيسية</span>
                </a>

                <a href="{{route('admin.pendingUsers')}}" class="nav-item">
                    <i class="fas fa-user-clock"></i>
                    <span class="nav-text">طلبات الانضمام</span>
                </a>
            @endif
        </div>

        <!-- User & Logout -->
        <div class="px-3 py-2 border-t">
            <div class="nav-item">
                <i class="fas fa-user-circle"></i>
                <span class="nav-text">{{ Auth::user()->name }}</span>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-item w-full text-right">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-text">تسجيل الخروج</span>
                </button>
            </form>
        </div>
    </div>
</nav>
@endauth


    <!-- Contenu principal à gauche -->
    <div class="main-content">
        <div class="content-container">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>