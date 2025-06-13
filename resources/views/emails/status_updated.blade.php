<!DOCTYPE html>
<html>
<head>
    <title>Project Status Updated</title>
</head>
<body>
    <h1>Project Status Updated</h1>
    <p>Dear Project Manager,</p>
    <p>The status of the project <strong>{{ $project->project_name }}</strong> has been updated to <strong>{{ ucfirst($project->status) }}</strong> by the assigned Engineer.</p>
    <p>Please check the project details in the system.</p>
    <p>Thank you,</p>
    <p>Project Management System</p>
</body>
</html>