@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4" id="printable-content">
    <div class="max-w-5xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <!-- العنوان الرئيسي -->
        <div class="bg-blue-800 text-white p-6 text-center">
            <h1 class="text-3xl font-bold mb-2">محضر تحديد الحاجيات</h1>
            <div class="flex flex-col md:flex-row justify-between items-center mt-4 text-sm">
                <div class="mb-2 md:mb-0">
                    <p class="font-medium">مؤسسة: {{ $user->name_assotiation }}</p>
                    <p class="font-medium">العنوان: {{ $user->address }}</p>
                    <p class="font-medium">الهاتف: {{ $user->telephone }}</p>
                </div>
                <div>
                    <p class="font-medium">تاريخ: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>

        <!-- تفاصيل الاجتماع -->
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-blue-200 pb-2">تفاصيل الاجتماع</h2>
            <p class="text-gray-700 leading-relaxed">
                اجتمع أعضاء جمعية دعم مدرسة {{ $user->name_assotiation }} بتاريخ {{ \Carbon\Carbon::now()->format('d/m/Y') }} 
                بمقر الجمعية، حيث تم مناقشة الحاجيات الضرورية للمؤسسة التعليمية وتحديد الأولويات حسب الحاجة الملحة.
            </p>
        </div>

        <!-- الحاضرون -->
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-blue-200 pb-2">الحاضرون</h2>
            <div class="space-y-4">
                @foreach($members as $member)
                <div class="flex items-center gap-3 bg-gray-50 p-3 rounded-lg">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <p class="font-medium">{{ $member->fullname }}</p>
                        <p class="text-sm text-blue-600">{{ $member->role }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- الحاجيات المحددة -->
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-blue-200 pb-2">الحاجيات المحددة</h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border text-right font-bold">الرقم الترتيبي</th>
                            <th class="p-3 border text-right font-bold">الوصف</th>
                            <th class="p-3 border text-right font-bold">الكمية المطلوبة</th>
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
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-blue-200 pb-2">التوصيات والقرارات</h2>
            <div class="space-y-3 text-gray-700">
                <p>1. رفع هذا المحضر إلى الجهات المختصة في الجمعية قصد اتخاذ الإجراءات اللازمة لاقتناء الحاجيات.</p>
                <p>2. تحديد ميزانية تقريبية لكل بند من الحاجيات.</p>
                <p>3. البحث عن ممولين أو شركاء للمساهمة في تلبية هذه المتطلبات.</p>
                <p>4. التنسيق مع المؤسسة التعليمية لضمان التنفيذ وفق الأولويات.</p>
            </div>
        </div>

        <!-- توقيعات الأعضاء الحاضرين -->
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-blue-200 pb-2">توقيعات الأعضاء الحاضرين</h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border text-right font-bold">الاسم</th>
                            <th class="p-3 border text-right font-bold">الصفة</th>
                            <th class="p-3 border text-right font-bold">التوقيع</th>
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

        <!-- التذييل -->
        <div class="bg-gray-100 p-4 text-left">
            <p>حرر ب{{ $user->city }} بتاريخ {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>
    </div>

    <!-- زر الطباعة -->
    <div class="mt-4 text-center no-print">
    <a href="{{ route('pdf') }}" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 flex items-center gap-2 mx-auto inline-block">
        <i class="fas fa-file-pdf"></i>
        <span>تحميل PDF</span>
    </a>
</div>
</div>

<script>
    function printDocument() {
        window.print();
    }
</script>

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
            display: none;
        }
    }
</style>
@endsection