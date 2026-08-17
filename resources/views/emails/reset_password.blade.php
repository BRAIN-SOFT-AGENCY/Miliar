<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
</head>

<body>

    <h2>السلام عليكم {{ $name }}</h2>

    <p>

        لقد تلقينا طلبًا لإعادة تعيين كلمة المرور الخاصة بحسابك في منصة <b>Miliar</b>.

    </p>

    <p>

        اضغط على الزر التالي:

    </p>

    <p>

        <a href="{{ $link }}"
            style="background:#0c1730;color:white;padding:15px 30px;text-decoration:none;border-radius:5px;">
            إعادة تعيين كلمة المرور
        </a>

    </p>

    <p>

        إذا لم تطلب ذلك، يمكنك تجاهل هذه الرسالة.

    </p>

</body>

</html>