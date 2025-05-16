<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body class="font-sans antialiased bg-gray-100">

    <!-- ✅ Navbar -->
    @auth
   <nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
        
        <!-- 👤 اسم المستخدم في اليسار -->
        <div class="flex items-center gap-2 text-gray-700 text-sm">
            <i class="fas fa-user-circle text-blue-500"></i>
            <span>{{ Auth::user()->fullname ?? Auth::user()->name }}</span>
        </div>

        <!-- 🔓 زر تسجيل الخروج في اليمين -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium flex items-center">
                <i class="fas fa-sign-out-alt mr-1"></i> خروج
            </button>
        </form>
        
    </div>
</nav>

    @endauth

    @yield('content')

</body>
</html>
