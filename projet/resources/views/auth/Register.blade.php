@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            {{ __('التسجيل') }}
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form class="space-y-6" method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Fullname -->
                <div>
                    <label for="fullname" class="block text-sm font-medium text-gray-700">
                        الاسم الكامل
                    </label>
                    <div class="mt-1">
                        <input id="fullname" name="fullname" type="text" autocomplete="name" required
                               value="{{ old('fullname') }}"
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('fullname') border-red-500 @enderror">
                        @error('fullname')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        البريد الإلكتروني
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                               value="{{ old('email') }}"
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        كلمة المرور
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password-confirm" class="block text-sm font-medium text-gray-700">
                        تأكيد كلمة المرور
                    </label>
                    <div class="mt-1">
                        <input id="password-confirm" name="password_confirmation" type="password" autocomplete="new-password" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                </div>

                <!-- Telephone -->
                <div>
                    <label for="telephone" class="block text-sm font-medium text-gray-700">
                        رقم الهاتف
                    </label>
                    <div class="mt-1">
                        <input id="telephone" name="telephone" type="text" required
                               value="{{ old('telephone') }}"
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('telephone') border-red-500 @enderror">
                        @error('telephone')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">
                        العنوان
                    </label>
                    <div class="mt-1">
                        <input id="address" name="address" type="text" required
                               value="{{ old('address') }}"
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('address') border-red-500 @enderror">
                        @error('address')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Association Name -->
                <div>
                    <label for="name_assotiation" class="block text-sm font-medium text-gray-700">
                        اسم الجمعية
                    </label>
                    <div class="mt-1">
                        <input id="name_assotiation" name="name_assotiation" type="text" required
                               value="{{ old('name_assotiation') }}"
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('name_assotiation') border-red-500 @enderror">
                        @error('name_assotiation')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Role in Association -->
                <div>
                    <label for="roleuser" class="block text-sm font-medium text-gray-700">
                        الدور في الجمعية
                    </label>
                    <div class="mt-1">
                        <select id="roleuser" name="roleuser"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('roleuser') border-red-500 @enderror">
                            <option value="">-- اختر الدور --</option>
                            <option value="رئيس(ة) الجمعية">رئيس(ة) الجمعية</option>
                            <option value="كاتب(ة) الجمعية">كاتب(ة) الجمعية</option>
                            <option value="أمين(ة) الجمعية">أمين(ة) الجمعية</option>
                            <option value="عضو الجمعية">عضو الجمعية</option>
                        </select>
                        @error('roleuser')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        تسجيل
                    </button>
                </div>
                  @if (session('message'))
        <div class="mb-4 text-sm text-red-600 bg-red-100 border border-red-400 rounded px-4 py-3">
            {{ session('message') }}
        </div>
    @endif
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('loginform') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    هل لديك حساب؟ قم بتسجيل الدخول
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
