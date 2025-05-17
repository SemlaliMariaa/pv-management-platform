@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8" dir="rtl">
    <div class="max-w-5xl mx-auto">
        <!-- Header Card -->
        <div class="bg-white rounded-xl shadow-xl overflow-hidden mb-8 border border-gray-200">
            <div class="p-6 sm:p-8 bg-gradient-to-r from-blue-600 to-blue-800">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-white">تعديل بيانات المشارك</h1>
                    <a href="{{ route('meetings.index') }}" class="text-white hover:text-blue-200 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>
                <p class="mt-2 text-blue-100">يمكنك هنا تعديل معلومات المشارك في الاجتماع</p>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-200">
            <form method="POST" action="{{ route('meeting-members.update', $meetingMember->id) }}">
                @csrf
                @method('PATCH')

                <div class="p-8 space-y-8">
                    <!-- Personal Info Section -->
                    <div class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 border-gray-200">المعلومات الشخصية</h2>
                        
                        <!-- Fullname Input -->
                        <div class="space-y-3">
                            <label for="fullname" class="block text-sm font-medium text-gray-700">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    الاسم الكامل
                                </span>
                                <span class="text-red-500 text-xs">* مطلوب</span>
                            </label>
                            <div class="relative">
                                <input type="text" id="fullname" name="fullname" value="{{ old('fullname', $meetingMember->fullname) }}" 
                                       class="w-full px-5 py-3 text-base leading-6 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 outline-none shadow-sm text-right"
                                       placeholder="أدخل الاسم الكامل"
                                       required>
                                @error('fullname')
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @enderror
                            </div>
                            @error('fullname')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Role and Association Section -->
                    <div class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 border-gray-200">المعلومات الوظيفية</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Role Select -->
                            <div class="space-y-3">
                                <label for="role" class="block text-sm font-medium text-gray-700">
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v1h-3zM4.75 12.094A5.973 5.973 0 004 15v1H1v-1a3 3 0 013.75-2.906z" />
                                        </svg>
                                        الدور
                                    </span>
                                    <span class="text-red-500 text-xs">* مطلوب</span>
                                </label>
                                <div class="relative">
                                    <select name="role" id="role" 
                                            class="w-full px-5 py-3 text-base leading-6 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 outline-none shadow-sm appearance-none bg-white bg-[url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e")] bg-no-repeat bg-[left_0.75rem_center] bg-[length:1.5em_1.5em] text-right"
                                            required>
                                        <option value="">-- اختر الدور --</option>
                                        <option value="رئيس(ة) الجمعية" @selected(old('role', $meetingMember->role) == 'رئيس(ة) الجمعية')>رئيس(ة) الجمعية</option>
                                        <option value="كاتب(ة) الجمعية" @selected(old('role', $meetingMember->role) == 'كاتب(ة) الجمعية')>كاتب(ة) الجمعية</option>
                                        <option value="أمين(ة) الجمعية" @selected(old('role', $meetingMember->role) == 'أمين(ة) الجمعية')>أمين(ة) الجمعية</option>
                                        <option value="عضو الجمعية" @selected(old('role', $meetingMember->role) == 'عضو الجمعية')>عضو الجمعية</option>
                                    </select>
                                    @error('role')
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    @enderror
                                </div>
                                @error('role')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Association Input -->
                            <div class="space-y-3">
                                <label for="association_name" class="block text-sm font-medium text-gray-700">
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
                                        </svg>
                                        الجمعية
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="text" id="association_name" name="association_name" 
                                           value="{{ old('association_name', $meetingMember->association_name) }}"
                                           class="w-full px-5 py-3 text-base leading-6 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 outline-none shadow-sm text-right"
                                           placeholder="أدخل اسم الجمعية">
                                    @error('association_name')
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    @enderror
                                </div>
                                @error('association_name')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 flex justify-start space-x-4 space-x-reverse">
                    <button type="submit" class="px-8 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition-colors duration-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        حفظ التعديلات
                    </button>
                    <a href="{{ route('meetings.index') }}" class="px-8 py-3 border border-gray-300 rounded-lg shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 transition-colors duration-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection