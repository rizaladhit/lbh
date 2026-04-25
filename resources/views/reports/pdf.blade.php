<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reports Export</title>
    <style>
        body { font-family: sans-serif; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f4f4f4; color: #333; }
        h1 { text-align: center; color: #333; font-size: 16px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>LBH Legal Service Reports</h1>
    <table>
        <thead>
            <tr>
                <th>Report ID</th>
                <th>Category</th>
                <th>Date</th>
                <th>Client Name</th>
                <th>Case Title</th>
                <th>Status</th>
                <th>User</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->report_id }}</td>
                    <td>{{ $report->category->name ?? 'N/A' }}</td>
                    <td>{{ $report->date }}</td>
                    <td>{{ $report->client_name }}</td>
                    <td>{{ $report->case_title }}</td>
                    <td>{{ $report->status }}</td>
                    <td>{{ $report->user->name ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
