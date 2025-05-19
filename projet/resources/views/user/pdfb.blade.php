<!DOCTYPE html>
<html dir="rtl"  lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title }}</title>
    <style>
        /* Définition des polices */
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
        
        /* Styles généraux */
        body {
            font-family: 'Amiri', serif;
            line-height: 1.8;
            direction: rtl;
            color: #333;
             text-align: right; 
               unicode-bidi: bidi-override;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .content {
            text-align: right;
            font-size: 14pt;
            margin: 20px 0;
        }
        
        .footer {
            text-align: left;
            font-size: 10pt;
            color: #666;
            margin-top: 30px;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>
<body >
    <div class="header">
        <h1>{{ $title }}</h1>
    </div>
    
    <div class="content">
        <p>{{ $content }}</p>
        
        <p>هذا النص هو مجرد مثال لتوضيح كيفية عمل المكتبة مع اللغة العربية. يمكنك استبداله بأي محتوى تريده.</p>
    </div>
    
    <div class="footer">
        <p>تم الإنشاء في: {{ $date }}</p>
        mmmmmmmmmmmmmmmmmmmmmmmmmmmmm
    </div>
</body>
</html>


