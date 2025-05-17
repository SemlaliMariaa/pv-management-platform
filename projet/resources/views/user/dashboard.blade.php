

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>محضر تحديد الحاجيات</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
    @extends('layouts.app')
    
    @section('content')
    <div class="p-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-700 to-indigo-800 px-10 py-8 text-white text-center">
                <h1 class="text-3xl font-bold">جمعية دعم مدرسة {{$user->name_assotiation}}</h1>
                <p class="mt-2">العنوان: {{$user->address}} | الهاتف: {{$user->telephone}}</p>
            </div>

            <!-- Meeting Title -->
            <div class="px-10 py-10 text-right">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-extrabold text-indigo-700 underline">محضر تحديد الحاجيات</h2>
                    <p class="text-gray-500 mt-2">تاريخ الاجتماع: {{ now()->locale('ar')->isoFormat('D MMMM YYYY') }}</p>
                </div>

                <!-- Meeting Description -->
                <div class="bg-gray-50 p-6 rounded-lg border-l-4 border-indigo-500 text-lg text-gray-700 mb-10">
                    <p class="mb-4">
                        في يوم <span class="text-indigo-600 font-semibold">{{ now()->locale('ar')->isoFormat('D MMMM YYYY') }}</span>، اجتمعت أعضاء الجمعية
                        <span class="text-indigo-600 font-semibold">جمعية دعم {{$user->name_assotiation}}</span>
                        مع إدارة المؤسسة التعليمية لتحديد الأهداف ودراسة الحاجيات.
                    </p>
                    <p>وقد تم التداول في الوضع الراهن للمؤسسة واقتراح الحلول الملائمة.</p>
                </div>

                <!-- Participants Form -->
                <form method="POST" action="{{ route('meeting-members.store') }}">
                    @csrf
                    <div class="bg-gray-50 rounded-xl border p-6 mb-10">
                        <h3 class="text-xl font-bold text-gray-700 mb-6"><i class="fas fa-users text-indigo-600"></i> المشاركون:</h3>

                        @if (session('success'))
                            <div class="mb-6 p-4 bg-green-50 text-green-800 border border-green-200 rounded-md">
                                {{ session('success') }}
                            </div>
                        @endif

                        @error('members')
                            <div class="mb-6 p-4 bg-red-50 text-red-800 border border-red-200 rounded-md">
                                {{ $message }}
                            </div>
                        @enderror

                        @for ($i = 0; $i < 3; $i++)
                            <div class="grid md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">الاسم الكامل:</label>
                                    <input type="text" name="members[{{ $i }}][fullname]" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-300" value="{{ old("members.$i.fullname") }}">
                                    @error("members.$i.fullname")
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">الدور:</label>
                                    <select name="members[{{ $i }}][role]" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-300">
                                        <option value="">-- اختر الدور --</option>
                                        <option value="رئيس(ة) الجمعية">رئيس(ة) الجمعية</option>
                                        <option value="كاتب(ة) الجمعية">كاتب(ة) الجمعية</option>
                                        <option value="أمين(ة) الجمعية">أمين(ة) الجمعية</option>
                                        <option value="عضو الجمعية">عضو الجمعية</option>
                                    </select>
                                    @error("members.$i.role")
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        @endfor
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">حفظ المشاركين</button>
                    </div>
                </form>

                <!-- Needs Table -->
                <div>
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-700"><i class="fas fa-clipboard-list text-indigo-600"></i> قائمة الحاجيات</h3>
                        <button id="addNeedBtn" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">إضافة حاجة جديدة</button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full bg-white rounded-xl shadow border text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2">الإجراءات</th>
                                    <th class="px-4 py-2">الكمية</th>
                                    <th class="px-4 py-2">الوصف</th>
                                    <th class="px-4 py-2">رقم</th>
                                </tr>
                            </thead>
                            <tbody id="needsTableBody">
                                <!-- Rows added dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addBtn = document.getElementById('addNeedBtn');
            const tbody = document.getElementById('needsTableBody');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            function showToast(type, message) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: type,
                    title: message,
                    showConfirmButton: false,
                    timer: 3000
                });
            }

            function addRow() {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="px-4 py-2">
                        <button class="saveBtn bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700">حفظ</button>
                        <button class="deleteBtn bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 ml-2">حذف</button>
                    </td>
                    <td class="px-4 py-2"><input type="number" class="w-full border rounded px-2 py-1" placeholder="الكمية"></td>
                    <td class="px-4 py-2"><input type="text" class="w-full border rounded px-2 py-1" placeholder="الوصف"></td>
                    <td class="px-4 py-2 font-semibold text-indigo-700">${tbody.children.length + 1}</td>
                `;

                row.querySelector('.saveBtn').addEventListener('click', () => {
                    const quantity = row.querySelector('input[type="number"]').value;
                    const description = row.querySelector('input[type="text"]').value;

                    fetch('{{ url('/needs') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken, // ضروري
        'Accept': 'application/json' 
                        },
                        body: JSON.stringify({ quantity_required: quantity, description })
                    }).then(res => res.json()).then(data => {
                        if (data.success) {
                            showToast('success', 'تمت الإضافة بنجاح');
                        } else {
                            showToast('error', 'حدث خطأ');
                        }
                    });
                });

                row.querySelector('.deleteBtn').addEventListener('click', () => {
                    row.remove();
                });

                tbody.appendChild(row);
            }

            addBtn.addEventListener('click', addRow);
        });
    </script>
    @endsection
</body>
</html>

