<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Заявка на участие в олимпиаде</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.5;
            padding: 20px;
        }

        .text-center {
            text-align: center;
        }

        .text-16 {
            font-size: 16px;
        }

        .text-14 {
            font-size: 14px;
        }

        .mb-2 {
            margin-bottom: 8px;
        }

        .mb-4 {
            margin-bottom: 16px;
        }

        .mt-4 {
            margin-top: 16px;
        }

        .mt-5 {
            margin-top: 30px;
        }

        .form-table {
            width: 100%;
            border-collapse: collapse;
        }

        .form-table td {
            padding: 10px 0;
            vertical-align: top;
        }

        .label-cell {
            width: 45%;
            font-weight: normal;
        }

        .value-cell {
            width: 55%;
            text-align: right;
        }

        .signature-table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
            border: 0;
        }

        .signature-table td {
            padding: 8px 0;
        }

        .signature-label {
            width: 30%;
        }

        .signature-value {
            width: 70%;
            text-align: right;
        }

        .underline {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 120px;
        }

        .font-semibold {
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div>
        <div class="text-center text-16 mb-2 font-semibold">
            ЗАЯВКА НА УЧАСТИЕ
        </div>
        <div class="text-center text-14 mb-4 font-semibold">
            в областной олимпиаде по программированию для студентов,<br>
            обучающихся по специальностям и профессиям СПО укрупненной группы<br>
            09.00.00 «Информатика и вычислительная техника»
        </div>

        <table class="form-table">
            <tr>
                <td class="label-cell">ФИО участника (полностью)</td>
                <td class="value-cell">{{ $full_name ?? '____________________' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Дата рождения</td>
                <td class="value-cell">{{ $birth_date ?? '__.__.____' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Курс обучения</td>
                <td class="value-cell">{{ $cours_number ?? '___' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Специальность</td>
                <td class="value-cell">{{ $direction ?? '____________________' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Полное наименование ПОО (по Уставу)</td>
                <td class="value-cell">{{ $poo_name ?? '____________________' }}</td>
            </tr>
            <tr>
                <td class="label-cell">ФИО руководителей команды, контактный телефон (сотовый)</td>
                <td class="value-cell">{{ $manager_info ?? '____________________' }}</td>
            </tr>
        </table>

        <table class="signature-table">
            <tr>
                <td class="signature-label">Директор ОО</td>
                <td class="signature-value">
                    ____________________ <span class="underline">(подпись)</span>
                </td>
            </tr>
            <tr>
                <td class="signature-label"></td>
                <td class="signature-value">Фамилия И.О.</td>
            </tr>
        </table>
    </div>
</body>

</html>
