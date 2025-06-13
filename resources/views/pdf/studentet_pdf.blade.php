<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista e studentve</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        .header {
            background-color: #1e293b; /* Tailwind's slate-900 */
            color: white;
            padding: 10px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #333;
        }
        th {
            background-color: #ffffff; /* Tailwind's white */
            color: black;
        }
        tr:nth-child(even) {
            background-color: #94a3b8; /* Tailwind's slate-500 */
        }
    </style>
</head>
<body>
    <div class="header">
        <span class="logo-light">Al-Kurra | Lista e perdoruesve</span>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Emri dhe Mbiemri</th>
                <th>Emaili</th>
                <th>Telefoni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone ?? 'Nuk ka numer te telefonit' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>