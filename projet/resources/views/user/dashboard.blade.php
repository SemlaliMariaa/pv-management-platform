<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>محضر تحديد الحاجيات</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        }

        .header-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }

        .shadow-soft {
            box-shadow: 0 10px 30px -15px rgba(0, 0, 0, 0.1);
        }

        .border-soft {
            border-color: rgba(255, 255, 255, 0.2);
        }

        .animate-hover {
            transition: all 0.3s ease;
        }

        .animate-hover:hover {
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="gradient-bg">
    @extends('layouts.app')

    @section('content')
        <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 flex justify-center">
            <div class="w-full max-w-7xl bg-white rounded-2xl shadow-soft overflow-hidden animate-hover">

                <!-- Header Association - Version améliorée -->
                <div class="header-gradient px-10 py-8 text-white relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-white opacity-10 rounded-full"></div>
                    <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-white opacity-5 rounded-full"></div>

                    <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
                        <div class="text-center md:text-right">
                            <h1 class="text-3xl font-bold tracking-wide">جمعية دعم مدرسة {{$user->name_assotiation}}</h1>
                            <div class="mt-3 space-y-1 text-sm">
                                <p class="flex items-center justify-center md:justify-end gap-2">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>العنوان: {{$user->address}}</span>
                                </p>
                                <p class="flex items-center justify-center md:justify-end gap-2">
                                    <i class="fas fa-phone-alt"></i>
                                    <span>الهاتف: {{$user->telephone}}</span>
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 md:mt-0">
                            <div class="relative">
                                <div class="absolute inset-0 bg-white opacity-20 rounded-full blur-sm"></div>
                                <img src="{{ asset('images/logo_association.png') }}" alt="شعار الجمعية"
                                    class="relative w-24 h-24 object-contain rounded-full border-4 border-soft shadow-lg">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Body -->
                <div class="px-8 py-8 space-y-8 text-right">
                    <!-- Title Section - Version améliorée -->
                    <div class="text-center relative">
                        <div
                            class="absolute -left-10 top-1/2 transform -translate-y-1/2 w-16 h-1 bg-indigo-200 rounded-full hidden md:block">
                        </div>
                        <div
                            class="absolute -right-10 top-1/2 transform -translate-y-1/2 w-16 h-1 bg-indigo-200 rounded-full hidden md:block">
                        </div>

                        <h2 class="text-2xl font-extrabold text-indigo-700 relative inline-block">
                            <span class="relative z-10 px-4">محضر تحديد الحاجيات</span>
                            <span class="absolute bottom-0 left-0 w-full h-2 bg-indigo-100 opacity-60 -z-0"></span>
                        </h2>
                        <p class="text-gray-500 mt-3 flex items-center justify-center gap-2">
                            <i class="far fa-calendar-alt text-indigo-400"></i>
                            <span>تاريخ الاجتماع: {{ \Carbon\Carbon::now()->locale('ar')->isoFormat('D MMMM YYYY') }}</span>
                        </p>
                    </div>

                    <!-- Meeting Description - Version améliorée -->
                    <div
                        class="bg-gray-50 p-6 rounded-xl border-r-4 border-indigo-500 text-gray-700 mb-8 relative overflow-hidden">
                        <div class="absolute -right-2 -top-2 text-indigo-100 text-5xl z-0">
                            <i class="fas fa-quote-right"></i>
                        </div>
                        <div class="relative z-10">
                            <p class="mb-4 leading-relaxed">
                                في يوم <span
                                    class="text-indigo-600 font-semibold">{{ \Carbon\Carbon::now()->locale('ar')->isoFormat('D MMMM YYYY') }}</span>،
                                اجتمعت أعضاء الجمعية
                                <span class="text-indigo-600 font-semibold">جمعية دعم {{$user->name_assotiation}}</span>
                                مع إدارة المؤسسة التعليمية لتحديد الأهداف المسطرة في برنامج العمل السنوي،
                                ودراسة الحاجيات الضرورية لتنفيذ المشاريع المسطرة.
                            </p>
                            <p class="leading-relaxed">وقد تم التداول في الوضع الراهن للمؤسسة واقتراح الحلول الملائمة.</p>
                        </div>
                    </div>

                    <!-- Participants Form - Version améliorée -->
                    <form method="POST" action="{{ route('meeting-members.store') }}">
                        @csrf
                        <div class="bg-gray-50 rounded-xl border border-gray-200 p-6 mb-10 relative overflow-hidden">
                            <div class="absolute -right-4 -top-4 w-20 h-20 bg-indigo-500 opacity-5 rounded-full"></div>

                            <h3 class="text-xl font-bold text-gray-700 mb-6 flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600">
                                    <i class="fas fa-users"></i>
                                </div>
                                <span>المشاركون في الاجتماع:</span>
                            </h3>

                            <!-- Messages d'alerte améliorés -->
                            @if (session('success'))
                                <div
                                    class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-md flex items-start gap-3">
                                    <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                    <div>{{ session('success') }}</div>
                                </div>
                            @endif

                            @error('members'))
                                <div
                                    class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-md flex items-start gap-3">
                                    <i class="fas fa-exclamation-circle text-red-500 mt-1"></i>
                                    <div>{{ $message }}</div>
                                </div>
                            @enderror

                            <!-- Current User - Version améliorée -->
                            <div class="bg-white p-4 rounded-lg shadow-sm mb-6 border border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">السيد {{ $user->fullname }}</p>
                                        <p class="text-sm text-indigo-600">{{ $user->roleuser }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Members - Version améliorée -->
                            <div class="space-y-6">
                                @for ($i = 0; $i < 3; $i++)
                                    <div
                                        class="grid md:grid-cols-2 gap-6 bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                                <i class="fas fa-user-tag text-indigo-400 text-xs"></i>
                                                <span>الاسم الكامل:</span>
                                            </label>
                                            <div class="relative">
                                                <input type="hidden" name="mahdar_id" value="{{ $mahdar->id }}">
                                                <input type="text" name="members[{{ $i }}][fullname]"
                                                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300 pr-10"
                                                    value="{{ old("members.$i.fullname") }}">
                                                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            </div>
                                            @error("members.$i.fullname"))
                                                <p class="text-sm text-red-600 mt-1 flex items-center gap-1">
                                                    <i class="fas fa-exclamation-circle text-xs"></i>
                                                    <span>{{ $message }}</span>
                                                </p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                                <i class="fas fa-user-cog text-indigo-400 text-xs"></i>
                                                <span>الدور:</span>
                                            </label>
                                            <div class="relative">
                                                <select name="members[{{ $i }}][role]"
                                                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300 appearance-none pr-10">
                                                    <option value="">-- اختر الدور --</option>
                                                    <option value="رئيس(ة) الجمعية" {{ old("members.$i.role") == 'رئيس(ة) الجمعية' ? 'selected' : '' }}>رئيس(ة) الجمعية</option>
                                                    <option value="كاتب(ة) الجمعية" {{ old("members.$i.role") == 'كاتب(ة) الجمعية' ? 'selected' : '' }}>كاتب(ة) الجمعية</option>
                                                    <option value="أمين(ة) الجمعية" {{ old("members.$i.role") == 'أمين(ة) الجمعية' ? 'selected' : '' }}>أمين(ة) الجمعية</option>
                                                    <option value="عضو الجمعية" {{ old("members.$i.role") == 'عضو الجمعية' ? 'selected' : '' }}>عضو الجمعية</option>
                                                </select>
                                                <div
                                                    class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
                                                    <i class="fas fa-chevron-down"></i>
                                                </div>
                                            </div>
                                            @error("members.$i.role"))
                                                <p class="text-sm text-red-600 mt-1 flex items-center gap-1">
                                                    <i class="fas fa-exclamation-circle text-xs"></i>
                                                    <span>{{ $message }}</span>
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                @endfor
                            </div>

                            <button type="submit"
                                class="mt-6 bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 flex items-center gap-2 animate-hover shadow-md">
                                <i class="fas fa-save"></i>
                                <span>حفظ المشاركين</span>
                            </button>
                        </div>
                    </form>

                    <!-- Needs Table - Version améliorée -->
                    <form method="POST" action="{{ route('needs.store') }}">
                        @csrf
                        <div class="bg-gray-50 rounded-xl border border-gray-200 p-6 relative overflow-hidden">
                            <div class="absolute -left-4 -bottom-4 w-20 h-20 bg-indigo-500 opacity-5 rounded-full"></div>

                            <h3 class="text-xl font-bold text-gray-700 mb-6 flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                                <span>قائمة الحاجيات</span>
                            </h3>

                            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                                <table id="needsTable" class="w-full bg-white text-sm">
                                    <thead class="bg-gray-100 text-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 border-l border-gray-200 text-right">الإجراءات</th>
                                            <th class="px-6 py-3 border-l border-gray-200 text-right">الكمية المطلوبة</th>
                                            <th class="px-6 py-3 border-l border-gray-200 text-right">الوصف</th>
                                            <th class="px-6 py-3 text-right">رقم</th>
                                        </tr>
                                    </thead>
                                    <tbody id="needsTableBody" class="text-gray-700 divide-y divide-gray-200">
                                        <!-- Rows added dynamically -->
                                        <input type="hidden" name="mahdar_id" value="{{ $mahdar->id }}">

                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                                <button id="addRowBtn" type="button"
                                    class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 flex items-center gap-2 animate-hover shadow-md w-full sm:w-auto justify-center">
                                    <i class="fas fa-plus"></i>
                                    <span>إضافة حاجة جديدة</span>
                                </button>

                                <button type="submit"
                                    class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 flex items-center gap-2 animate-hover shadow-md w-full sm:w-auto justify-center">
                                    <i class="fas fa-save"></i>
                                    <span>حفظ الحاجيات</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Footer amélioré -->
                <div class="bg-gray-50 px-8 py-4 border-t border-gray-200 text-center text-sm text-gray-500">
                    <p>جميع الحقوق محفوظة &copy; جمعية دعم مدرسة {{$user->name_assotiation}} - {{ date('Y') }}</p>
                </div>
            </div>
            <div class="text-left mt-4">
                <!-- بعد نهاية form الحاجيات -->
                <div class="mt-8 text-center">
                    <a href="{{ route('meeting.report') }}"
                        class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 flex items-center gap-2 animate-hover shadow-md inline-flex justify-center">
                        <i class="fas fa-file-alt"></i>
                        <span>إنشاء المحضر النهائي</span>
                    </a>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const tableBody = document.querySelector('#needsTableBody');
                const addRowBtn = document.getElementById('addRowBtn');
                let rowCount = 0;

                function showToast(type, message) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: type,
                        title: message
                    })
                }

                function addRow() {
                    rowCount++;
                    const tr = document.createElement('tr');
                    tr.classList.add('hover:bg-gray-50', 'group');
                    tr.dataset.rowId = rowCount;

                    tr.innerHTML = `
                        <td class="px-6 py-4 border-l border-gray-200">
                            <div class="flex gap-2">
                                <button type="button" class="validateBtn bg-indigo-100 text-indigo-700 px-3 py-1 rounded-lg hover:bg-indigo-200 text-sm flex items-center gap-2 border border-indigo-200 animate-hover">
                                    <i class="fas fa-check text-xs"></i>
                                    <span>تأكيد</span>
                                </button>
                                <button type="button" class="deleteBtn bg-gray-100 text-gray-700 px-3 py-1 rounded-lg hover:bg-gray-200 text-sm flex items-center gap-2 border border-gray-200 animate-hover opacity-0 group-hover:opacity-100 transition-opacity">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                    <span>حذف</span>
                                </button>
                            </div>
                        </td>
                        <td class="px-6 py-4 border-l border-gray-200">
                            <div class="relative">
                                <input type="number" name="quantity_required[]" required
                                    class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300"
                                    placeholder="الكمية" id="quantity_${rowCount}">
                                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-hashtag text-xs"></i>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 border-l border-gray-200">
                            <div class="relative">
                                <input type="text" name="description[]" required
                                    class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300"
                                    placeholder="وصف الحاجة" id="description_${rowCount}">
                                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-align-right text-xs"></i>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center text-indigo-600 font-medium">
                            ${rowCount}
                        </td>
                    `;

                    tableBody.appendChild(tr);

                    // Événements pour les boutons
                    tr.querySelector('.deleteBtn').addEventListener('click', function () {
                        Swal.fire({
                            title: 'هل أنت متأكد؟',
                            text: "لن تتمكن من استعادة هذه البيانات!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#4f46e5',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'نعم، احذف!',
                            cancelButtonText: 'إلغاء'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                tr.remove();
                                updateRowNumbers();
                                showToast('success', 'تم الحذف بنجاح');
                            }
                        });
                    });

                    tr.querySelector('.validateBtn').addEventListener('click', function () {
                        const quantityInput = tr.querySelector('input[type="number"]');
                        const descriptionInput = tr.querySelector('input[type="text"]');

                        if (quantityInput.value && descriptionInput.value) {
                            // Style de validation
                            tr.classList.add('bg-indigo-50');
                            tr.classList.remove('hover:bg-gray-50');

                            // Désactiver les champs après validation
                            quantityInput.readOnly = true;
                            descriptionInput.readOnly = true;

                            // Changer le bouton de validation
                            this.innerHTML = `
                                <i class="fas fa-check-circle text-green-500"></i>
                                <span class="text-green-700">مؤكد</span>
                            `;
                            this.classList.remove('bg-indigo-100', 'hover:bg-indigo-200', 'text-indigo-700');
                            this.classList.add('bg-green-100', 'text-green-700', 'cursor-default', 'border-green-200');

                            showToast('success', 'تم تأكيد الحاجة بنجاح');
                        } else {
                            showToast('error', 'الرجاء ملء جميع الحقول قبل التأكيد');
                        }
                    });
                }

                function updateRowNumbers() {
                    const rows = tableBody.querySelectorAll('tr');
                    rows.forEach((row, index) => {
                        row.querySelector('td:last-child').textContent = index + 1;
                    });
                }

                addRowBtn.addEventListener('click', addRow);

                // Ajouter une première ligne par défaut
                addRow();
            });
        </script>
    @endsection
</body>

</html>