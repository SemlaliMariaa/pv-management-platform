@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8" dir="rtl">
    <!-- En-tête amélioré -->
    <div class="relative p-8 bg-gradient-to-r from-blue-700 to-indigo-800 rounded-2xl shadow-xl overflow-hidden mb-8">
        <!-- Motif décoratif subtil -->
        <div class="absolute inset-0 bg-gradient-to-br from-white/5 to-white/10"></div>
        
        <!-- Contenu principal -->
        <div class="relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white">قائمة المشاركين</h1>
                    <p class="text-blue-100 mt-2 text-lg">إدارة المشاركين في الاجتماعات والجمعيات</p>
                </div>
                
                <!-- Statistiques -->
                <div class="mt-4 md:mt-0 bg-white/20 backdrop-blur-sm p-4 rounded-xl shadow-sm flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <div>
                        <p class="text-xs text-blue-100">إجمالي المشاركين</p>
                        <p class="font-bold text-2xl text-white">{{ $members->total() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Carte principale -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <!-- Tableau -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-8 py-4 text-right text-sm font-semibold text-gray-700 uppercase tracking-wider">#</th>
                        <th scope="col" class="px-8 py-4 text-right text-sm font-semibold text-gray-700 uppercase tracking-wider">الاسم الكامل</th>
                        <th scope="col" class="px-8 py-4 text-right text-sm font-semibold text-gray-700 uppercase tracking-wider">الدور</th>
                        <th scope="col" class="px-8 py-4 text-right text-sm font-semibold text-gray-700 uppercase tracking-wider">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($members as $member)
                    <tr class="hover:bg-blue-50/50 transition-colors duration-150">
                        <td class="px-8 py-5 whitespace-nowrap text-sm font-medium text-gray-500">#{{ $member->id }}</td>
                        <td class="px-8 py-5 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center shadow-inner">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="mr-4">
                                    <div class="font-medium text-gray-900">{{ $member->fullname }}</div>
                                    @if($member->email)
                                    <div class="text-gray-500 text-sm mt-1">{{ $member->email }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5 whitespace-nowrap">
                            <span class="px-3 py-1.5 inline-flex text-sm leading-5 font-semibold rounded-full 
                                @if($member->role === 'رئيس(ة) الجمعية') bg-purple-100 text-purple-800
                                @elseif($member->role === 'كاتب(ة) الجمعية') bg-blue-100 text-blue-800
                                @elseif($member->role === 'أمين(ة) الجمعية') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $member->role }}
                            </span>
                        </td>
                        
                        <td class="px-8 py-5 whitespace-nowrap text-sm font-medium">
                            <div class="flex justify-end space-x-3 space-x-reverse">
                                <a href="{{ route('meeting-members.edit', $member->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 transition-colors p-2 rounded-lg hover:bg-blue-100/50"
                                   title="تعديل">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </a>
                                <form action="{{ route('meeting-members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذا المشارك؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800 transition-colors p-2 rounded-lg hover:bg-red-100/50" 
                                            title="حذف">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="max-w-md mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="mt-4 text-lg font-medium text-gray-700">لا يوجد مشاركون مسجلون</h3>
                                <p class="mt-1 text-gray-500">يمكنك إضافة مشاركين جديدين بالنقر على الزر أدناه</p>
                                <div class="mt-6">
                                    <a href="{{ route('meeting-members.create') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                                        إضافة مشارك جديد
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination améliorée -->
        <div class="px-8 py-4 border-t border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row justify-between items-center">
            <div class="mb-3 sm:mb-0">
                <p class="text-sm text-gray-700">
                    عرض
                    <span class="font-medium">{{ $members->firstItem() }}</span>
                    إلى
                    <span class="font-medium">{{ $members->lastItem() }}</span>
                    من
                    <span class="font-medium">{{ $members->total() }}</span>
                    نتائج
                </p>
            </div>
            <div class="flex items-center">
                {{ $members->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</div>
@endsection