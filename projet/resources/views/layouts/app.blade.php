<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --secondary-color: #f9fafb;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --sidebar-width: 5rem;
            --sidebar-expanded: 17rem;
        }
        
        .sidebar {
            position: fixed;
            right: 0;
            top: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: white;
            box-shadow: -2px 0 15px rgba(0,0,0,0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            border-left: 1px solid #e5e7eb;
        }
        
        .sidebar:hover {
            width: var(--sidebar-expanded);
        }
        
        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 0.5rem;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem;
            border-radius: 0.5rem;
        }
        
        .logo-icon {
            min-width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(79, 70, 229, 0.1);
            border-radius: 0.5rem;
            color: var(--primary-color);
            font-size: 1.25rem;
        }
        
        .logo-text {
            font-weight: 600;
            color: var(--text-primary);
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        
        .sidebar:hover .logo-text {
            opacity: 1;
        }
        
        .nav-menu {
            flex: 1;
            overflow-y: auto;
            padding: 0.5rem;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            margin-bottom: 0.25rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
            color: var(--text-secondary);
            text-decoration: none;
        }
        
        .nav-item:hover {
            background: #f3f4f6;
            color: var(--primary-color);
        }
        
        .nav-item.active {
            background: rgba(79, 70, 229, 0.1);
            color: var(--primary-color);
        }
        
        .nav-item i {
            min-width: 2.5rem;
            text-align: center;
            font-size: 1.1rem;
            transition: transform 0.2s;
        }
        
        .nav-item:hover i {
            transform: scale(1.1);
        }
        
        .nav-text {
            white-space: nowrap;
            font-weight: 500;
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        
        .sidebar:hover .nav-text {
            opacity: 1;
        }
        
        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid #e5e7eb;
            margin-top: auto;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem;
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
        }
        
        .user-avatar {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-primary);
            font-weight: 600;
        }
        
        .user-name {
            font-weight: 500;
            color: var(--text-primary);
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        
        .sidebar:hover .user-name {
            opacity: 1;
        }
        
        .main-content {
            margin-right: var(--sidebar-width);
            transition: margin 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .sidebar:hover ~ .main-content {
            margin-right: var(--sidebar-expanded);
        }
        
        /* Scrollbar styling */
        .nav-menu::-webkit-scrollbar {
            width: 4px;
        }
        
        .nav-menu::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        .nav-menu::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }
        
        .nav-menu::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
        
        /* Animation for sidebar expansion */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(10px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .sidebar:hover .nav-text,
        .sidebar:hover .user-name,
        .sidebar:hover .logo-text {
            animation: fadeIn 0.2s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    @auth
    <nav class="sidebar">
        <div class="sidebar-header">
            <div class="logo-container">
                <div class="logo-icon">
                    <i class="fas fa-building"></i>
                </div>
                <span class="logo-text">جمعيتي</span>
            </div>
        </div>

        <div class="nav-menu">
            @if(Auth::user()->role === 'user')
                <!-- روابط المستخدم -->
                <a href="{{ route('user.dashboard') }}" class="nav-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">الرئيسية</span>
                </a>

                <a href="{{ route('meetings.index') }}" class="nav-item {{ request()->routeIs('meetings.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span class="nav-text">الأعضاء</span>
                </a>
            @elseif(Auth::user()->role === 'admin')
                <!-- روابط المشرف -->
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">الرئيسية</span>
                </a>

                <a href="{{ route('admin.pendingUsers') }}" class="nav-item {{ request()->routeIs('admin.pendingUsers') ? 'active' : '' }}">
                    <i class="fas fa-user-clock"></i>
                    <span class="nav-text">طلبات الانضمام</span>
                </a>
                
                <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="fas fa-user-cog"></i>
                    <span class="nav-text">إدارة الأعضاء</span>
                </a>
            @endif
        </div>

        <div class="sidebar-footer">
            <div class="user-profile">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <span class="user-name">{{ Auth::user()->name }}</span>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-item w-full text-right hover:bg-red-50 hover:text-red-600">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-text">تسجيل الخروج</span>
                </button>
            </form>
        </div>
    </nav>
    @endauth

    <div class="main-content min-h-screen">
        <div class="container mx-auto px-4 py-6">
            @yield('content')
        </div>
    </div>
    
    <script>
        // Ajoute une classe active basée sur l'URL actuelle
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-item').forEach(item => {
                if (item.getAttribute('href') === currentPath) {
                    item.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>