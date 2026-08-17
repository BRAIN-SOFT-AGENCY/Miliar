<style>
    body {

        font-family: 'Cairo', sans-serif;
        background: #f8f9fa;
        margin: 0;

    }

    /* topbar */

    .topbar {

        display: flex;
        justify-content: space-between;
        align-items: center;

        background: #0B5ED7;
        color: white;

        padding: 15px 30px;

    }

    .logo {

        font-size: 22px;
        font-weight: bold;

    }

    .logout button {

        background: #D4AF37;
        border: none;
        padding: 8px 20px;
        color: white;
        border-radius: 6px;
        cursor: pointer;

    }

    /* layout */

    .main {

        display: flex;

    }

    /* sidebar */

    .sidebar {

        width: 250px;
        background: white;
        border-left: 3px solid #D4AF37;
        height: 100vh;

    }

    .sidebar ul {

        list-style: none;
        padding: 0;

    }

    .sidebar li {

        padding: 15px;
        cursor: pointer;
        border-bottom: 1px solid #eee;

    }

    .sidebar li:hover {

        background: #E7F1FF;

    }

    /* content */

    .content {

        flex: 1;
        padding: 30px;

    }

    /* table */

    table {

        width: 100%;
        border-collapse: collapse;
        background: white;

    }

    th {

        background: #0B5ED7;
        color: white;
        padding: 12px;

    }

    td {

        padding: 10px;
        border-bottom: 1px solid #eee;

    }

    .book-img {

        width: 60px;

    }

    /* actions */

    .edit {

        background: #0B5ED7;
        color: white;
        border: none;
        padding: 5px 10px;
    }

    .delete {

        background: red;
        color: white;
        border: none;
        padding: 5px 10px;
    }

    @media(max-width:768px) {

        .sidebar {

            position: fixed;
            right: -250px;

        }

        .main {

            flex-direction: column;

        }

        table {

            font-size: 12px;

        }

    }
</style>

<body dir="rtl">

    <div class="dashboard">

        <!-- TOPBAR -->

        <header class="topbar">

            <div class="logo">
                📚 MyLibrary
            </div>

            <div class="welcome">
                مرحبا : <strong>Fatma Charfeddine</strong>
            </div>

            <div class="logout">
                <button>Logout</button>
            </div>

        </header>


        <div class="main">
            <!-- SIDEBAR RIGHT -->

            <aside class="sidebar">

                <ul>

                    <li>📚 الكتب</li>
                    <li>➕ إضافة كتاب</li>
                    <li>📑 كتبي</li>
                    <li>📊 الإحصائيات</li>
                    <li>⚙️ الإعدادات</li>

                </ul>

            </aside>

            <!-- CONTENT -->

            <section class="content">

                <h2>قائمة الكتب</h2>

                <table>

                    <thead>

                        <tr>
                            <th>الصورة</th>
                            <th>اسم الكتاب</th>
                            <th>ملخص</th>
                            <th>نوع الكتاب</th>
                            <th>نسخة الكتاب</th>
                            <th>دار النشر</th>
                            <th>الطباعة</th>
                            <th>إجراءات</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td><img src="book.jpg" class="book-img"></td>
                            <td>كتاب التفسير</td>
                            <td>ملخص قصير</td>
                            <td>كتاب كامل</td>
                            <td>PDF</td>
                            <td>دار الحكمة</td>
                            <td>الثانية</td>

                            <td>

                                <button class="edit">✏️</button>
                                <button class="delete">🗑</button>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </section>



        </div>

    </div>

</body>