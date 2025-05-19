<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <title>محضر تحديد الحاجيات</title>
    <style>

          @font-face {
            font-family: 'Amiri';
            src: url("{{ storage_path('fonts/Amiri-Regular.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        
        @font-face {
            font-family: 'Amiri';
            src: url("{{ storage_path('fonts/Amiri-Bold.ttf') }}") format('truetype');
            font-weight: bold;
            font-style: normal;
        }


         body {
            font-family: 'Amiri', serif;
            line-height: 1.8;
            direction: rtl;
            color: #333;
             text-align: right; 
               unicode-bidi: bidi-override;
        }


        .header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .section-title {
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        th {
            background-color: #f2f2f2;
            text-align: right;
            padding: 8px;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: right;
        }

        .signature-table td {
            height: 50px;
        }

        .footer {
            margin-top: 30px;
            text-align: left;
            font-size: 0.9em;
        }
    </style>
</head>

<body>
    <!-- نفس محتوى ملف blade السابق مع تعديلات بسيطة للطباعة -->
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
                اجتمع أعضاء جمعية دعم مدرسة {{ $user->name_assotiation }} بتاريخ
                {{ \Carbon\Carbon::now()->format('d/m/Y') }}
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
            <h2 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-blue-200 pb-2">توقيعات الأعضاء الحاضرين
            </h2>
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
</body>

</html>