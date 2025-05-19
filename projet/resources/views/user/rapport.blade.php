@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8" id="printable-content">
    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <!-- En-tête sobre -->
        <div class="bg-indigo-700 text-white p-8">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold">محضر تحديد الحاجيات</h1>
                <p class="text-indigo-200 mt-2 text-sm">وثيقة رسمية - جمعية دعم المؤسسات التعليمية</p>
            </div>
            <div class="flex flex-col md:flex-row justify-between items-center text-sm">
                <div class="mb-4 md:mb-0">
                    <p class="font-medium">{{ $user->name_assotiation }}</p>
                    <p class="text-indigo-200">{{ $user->address }}</p>
                </div>
                <div class="bg-white/10 px-4 py-2 rounded">
                    <p class="font-medium">التاريخ: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
                    <p class="text-indigo-200">المرجع: PRC-{{ date('Y') }}-{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="divide-y divide-gray-200">
            <!-- تفاصيل الاجتماع -->
            <div class="p-8">
                <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200">تفاصيل الاجتماع</h2>
                <p class="text-gray-700 leading-relaxed">
                    اجتمع أعضاء جمعية دعم مدرسة {{ $user->name_assotiation }} 
                    بتاريخ {{ \Carbon\Carbon::now()->format('d/m/Y') }} بمقر الجمعية، 
                    حيث تم مناقشة الحاجيات الضرورية للمؤسسة التعليمية وتحديد الأولويات.
                </p>
            </div>

            <!-- الحاضرون -->
            <div class="p-8">
                <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200">الحاضرون</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach($members as $member)
                    <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                        <div class="ml-3">
                            <p class="font-medium text-gray-900">{{ $member->fullname }}</p>
                            <p class="text-sm text-indigo-600">{{ $member->role }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- الحاجيات المحددة -->
            <div class="p-8">
                <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200">الحاجيات المحددة</h2>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-right">
                                <th class="p-3 border font-medium text-gray-700">#</th>
                                <th class="p-3 border font-medium text-gray-700">الوصف</th>
                                <th class="p-3 border font-medium text-gray-700">الكمية</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($needs as $index => $need)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border text-center">{{ $index + 1 }}</td>
                                <td class="p-3 border">{{ $need->description }}</td>
                                <td class="p-3 border text-center">{{ $need->quantity_required }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- التوصيات والقرارات -->
            <div class="p-8">
                <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200">التوصيات والقرارات</h2>
                <div class="space-y-3 text-gray-700">
                    <p class="flex items-start">
                        <span class="inline-block w-5 h-5 bg-indigo-100 rounded-full mr-2 mt-1 flex-shrink-0"></span>
                        رفع هذا المحضر إلى الجهات المختصة في الجمعية قصد اتخاذ الإجراءات اللازمة لاقتناء الحاجيات.
                    </p>
                    <p class="flex items-start">
                        <span class="inline-block w-5 h-5 bg-indigo-100 rounded-full mr-2 mt-1 flex-shrink-0"></span>
                        تحديد ميزانية تقريبية لكل بند من الحاجيات حسب الأولوية.
                    </p>
                    <p class="flex items-start">
                        <span class="inline-block w-5 h-5 bg-indigo-100 rounded-full mr-2 mt-1 flex-shrink-0"></span>
                        البحث عن ممولين أو شركاء للمساهمة في تلبية هذه المتطلبات.
                    </p>
                    <p class="flex items-start">
                        <span class="inline-block w-5 h-5 bg-indigo-100 rounded-full mr-2 mt-1 flex-shrink-0"></span>
                        التنسيق مع المؤسسة التعليمية لضمان التنفيذ وفق الأولويات.
                    </p>
                </div>
            </div>

            <!-- توقيعات الأعضاء الحاضرين -->
            <div class="p-8">
                <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200">توقيعات الأعضاء الحاضرين</h2>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-right">
                                <th class="p-3 border font-medium text-gray-700">الاسم</th>
                                <th class="p-3 border font-medium text-gray-700">الصفة</th>
                                <th class="p-3 border font-medium text-gray-700">التوقيع</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($members as $member)
                            <tr>
                                <td class="p-3 border">{{ $member->fullname }}</td>
                                <td class="p-3 border">{{ $member->role }}</td>
                                <td class="p-3 border h-16"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pied de page sobre -->
        <div class="bg-gray-50 px-8 py-4 border-t border-gray-200 text-sm text-gray-600">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p>العنوان: {{ $user->address }} - الهاتف: {{ $user->telephone }}</p>
                <p>حرر ب{{ $user->city }} بتاريخ {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Bouton d'impression minimal -->
    <div class="mt-8 text-center no-print">
        <button onclick="window.print()" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition-colors">
            طباعة المحضر
        </button>
    </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printable-content, #printable-content * {
            visibility: visible;
        }
        #printable-content {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            margin: 0;
            padding: 0;
        }
        .no-print {
            display: none !important;
        }
        .bg-indigo-700 {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            background-color: #4f46e5 !important;
        }
    }
</style>
@endsection