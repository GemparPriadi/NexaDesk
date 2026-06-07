<!DOCTYPE html>
<html>

<head>

    <title>Ticket Report</title>

    <style>

        body {
            font-family: sans-serif;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 10px;
            font-size: 12px;
        }

        table th {
            background: #f2f2f2;
        }

    </style>

</head>

<body>

    <h1>Ticket Report</h1>

    <table>

        <thead>

            <tr>

                <th>No</th>
                <th>User</th>
                <th>Title</th>
                <th>Category</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Date</th>

            </tr>

        </thead>

        <tbody>

            @foreach($tickets as $ticket)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $ticket->user->name }}</td>

                    <td>{{ $ticket->title }}</td>

                    <td>{{ $ticket->category }}</td>

                    <td>{{ $ticket->priority }}</td>

                    <td>{{ $ticket->status }}</td>

                    <td>{{ $ticket->created_at->format('d M Y') }}</td>

                </tr>

            @endforeach

        </tbody>

    </table>

</body>

</html>