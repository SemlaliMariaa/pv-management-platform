<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>محضر اجتماع {{ $mahdar->id }}</title>
    <style>
    /* Load Amiri from Google Fonts */
    @font-face {
        font-family: 'Amiri';
        src: url('https://fonts.googleapis.com/css2?family=Amiri&display=swap');
        font-display: swap;
    }
    
    /* Apply Amiri to the entire document */
    body {
        font-family: 'Amiri', serif;
        font-size: 14px;
        line-height: 1.6;
        margin: 20px;
        direction: rtl;
    }
    
    /* Rest of your styles */
    .header { text-align: center; margin-bottom: 30px; }
    th, td { border: 1px solid #ddd; padding: 10px; text-align: right; }
    /* ... */
</style>
</head>
<body>
    <div class="header">
        <h1>محضر اجتماع رقم {{ $mahdar->id }}</h1>
        <p>تاريخ: {{ $mahdar->created_at->format('Y/m/d') }}</p>
    </div>

    <h2>المشاركون</h2>
    <table>
        <thead>
            <tr>
                <th>الاسم</th>
                <th>الدور</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahdar->participants as $participant)
            <tr>
                <td>{{ $participant->fullname }}</td>
                <td>{{ $participant->role }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="margin-top: 30px;">الحاجيات</h2>
    <table>
        <thead>
            <tr>
                <th>الوصف</th>
                <th>الكمية المطلوبة</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahdar->needs as $need)
            <tr>
                <td>{{ $need->description }}</td>
                <td>{{ $need->quantity_required }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>