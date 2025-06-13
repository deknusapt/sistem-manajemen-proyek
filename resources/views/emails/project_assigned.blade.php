<!DOCTYPE html>
<html>
<head>
    <title>New Project Assigned</title>
</head>
<body>
    <h1>New Project Assigned to You</h1>
    <p>Dear {{ $project->user->fullname }},</p>
    <p>You have been assigned as the PIC (Engineer) for the following project:</p>
    <ul>
        <li><strong>Project Name:</strong> {{ $project->project_name }}</li>
        <li><strong>Client:</strong> {{ $project->client->client_fullname }}</li>
        <li><strong>Start Date:</strong> {{ $project->start_date }}</li>
        <li><strong>End Date:</strong> {{ $project->end_date }}</li>
        <li><strong>Complexity:</strong> {{ ucfirst($project->complexity) }}</li>
        <li><strong>Status:</strong> {{ ucfirst($project->status) }}</li>
        <li><strong>Cost:</strong> Rp {{ number_format($project->cost, 0, ',', '.') }}</li>
    </ul>
    <p>Please check the project details in the system.</p>
    <p>Thank you,</p>
    <p>Project Management System</p>
</body>
</html>