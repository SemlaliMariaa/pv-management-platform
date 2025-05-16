
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 py-12 px-4 sm:px-6 lg:px-8 flex justify-center" dir="rtl">
    <div class="w-full max-w-7xl bg-white rounded-3xl shadow-2xl overflow-hidden">

        <!-- Header Association -->
        <div class="bg-indigo-700 px-10 py-8 text-white text-center relative">
            <div class="absolute top-5 right-5">
                <img src="{{ asset('images/logo_association.png') }}" alt="شعار الجمعية" class="w-20 h-20 object-contain rounded-full border-4 border-white shadow-lg">
            </div>
            <h1 class="text-3xl font-bold tracking-wide">جمعية دعم مدرسة {{$user->name_assotiation}}</h1>
            <p class="mt-2 text-sm">العنوان: {{$user->address}}</p>
            <p class="text-sm">الهاتف: {{$user->telephone}}</p>
        </div>

        <!-- Body -->
        <div class="px-10 py-10 space-y-8 text-right">
            <!-- Title -->
            <div class="text-center">
                <h2 class="text-2xl font-extrabold text-indigo-700 underline decoration-wavy underline-offset-4">محضر تحديد الحاجيات</h2>
                <p class="text-gray-500 mt-2">تاريخ الاجتماع: {{ \Carbon\Carbon::now()->locale('ar')->isoFormat('D MMMM YYYY') }}</p>
            </div>

            <!-- Content -->
            <div class="text-gray-800 leading-loose text-lg">
                <p>
                    في يوم <span class="font-semibold text-indigo-600">{{ \Carbon\Carbon::now()->locale('ar')->isoFormat('D MMMM YYYY') }}</span>، اجتمعت أعضاء الجمعية 
                    <span class="font-semibold text-indigo-600">جمعية دعم {{$user->name_assotiation}}</span> 
                    مع إدارة المؤسسة التعليمية لتحديد الأهداف المسطرة في برنامج العمل السنوي، 
                    ودراسة الحاجيات الضرورية لتنفيذ المشاريع المسطرة.
                </p>
                <p class="mt-4">وقد تم التداول في الوضع الراهن للمؤسسة واقتراح الحلول الملائمة.</p>
            </div>

            <!-- Participants -->
            <div class="bg-gray-50 rounded-xl border border-gray-200 p-6">
                <h3 class="text-xl font-bold text-gray-700 mb-4 flex items-center gap-2">
                    <i class="fas fa-users text-indigo-600"></i>
                    المشاركون في الاجتماع:
                </h3>
                <ul class="space-y-3 text-gray-800 text-base">
                    <li class="flex items-start gap-3">
                        <span class="text-indigo-500 mt-1"><i class="fas fa-user-check"></i></span>
                        <span>السيد {{ $user->fullname }} – 
                            <span class="font-medium">{{ $user->roleuser }}</span>
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Table of Needs -->
            <form method="POST" action="{{ route('needs.store') }}">
    @csrf
    <div class="mt-10">
        <h1 class="text-2xl font-bold mb-4 text-indigo-700">الحاجيات المطلوبة</h1>

        <table id="needsTable" class="w-full text-right text-sm border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3 border-l">الكمية المطلوبة</th>
                    <th class="px-4 py-3 border-l">الوصف</th>
                    <th class="px-4 py-3">رقم</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <!-- الصفوف يتم إضافتها هنا بالجاڤاسكريبت -->
            </tbody>
        </table>

        <div class="mt-4 flex justify-between items-center">
            <button id="addRowBtn" type="button" class="text-blue-600 hover:underline flex items-center space-x-1">
                <span>+</span>
                <span>إضافة حاجة</span>
            </button>

            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                حفظ الحاجيات
            </button>
        </div>
    </div>
</form>

        </div>
    </div>
</div>

<!-- Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tableBody = document.querySelector('#needsTable tbody');
        const addRowBtn = document.getElementById('addRowBtn');

        function addRow() {
            const tr = document.createElement('tr');
            tr.classList.add('border-t');

            tr.innerHTML = `
                <td class="px-4 py-2 border-l">
                    <input type="number" name="quantity_required[]" required
                        class="w-full border border-gray-300 rounded px-3 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-300"
                        placeholder="الكمية المطلوبة">
                </td>
                <td class="px-4 py-2 border-l">
                    <input type="text" name="description[]" required
                        class="w-full border border-gray-300 rounded px-3 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-300"
                        placeholder="الوصف">
                </td>
                <td class="px-4 py-2 text-center">
                    <button type="button" class="deleteBtn text-red-600 hover:text-red-800">🗑️</button>
                </td>
            `;

            tableBody.appendChild(tr);

            tr.querySelector('.deleteBtn').addEventListener('click', function () {
                tr.remove();
            });
        }

        addRowBtn.addEventListener('click', addRow);
    });
</script>

@endsection
