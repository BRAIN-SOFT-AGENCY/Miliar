<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bienvenue</title>
</head>

<body style="font-family: Arial; direction: rtl;">

    <h2>مرحبا {{ $name }}</h2>

    <p>لقد تم إنشاء حسابك في منصة الترجمة.</p>

    <p><strong>Email :</strong> {{ $email }}</p>

    <p><strong>Mot de passe :</strong> {{ $password }}</p>

    <p>
        يمكنك تسجيل الدخول من هنا:
        <a href="{{ $link }}">{{ $link }}</a>
    </p>

    <p>
        بعد تسجيل الدخول يمكنك تغيير كلمة المرور من إعدادات حسابك.
    </p>

    <br>

    <p>شكراً لك</p>

</body>

</html>