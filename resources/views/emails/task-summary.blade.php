<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Task Summary</title>
</head>
<body>
<h1>Daily Task Summary</h1>
<p>Dear {{ $user['name'] }},</p>
<p>Here is the summary of your tasks:</p>
<ul>
    @foreach($tasks as $task)
        <li>
            <strong>{{ $task->title }}</strong>: {{ $task->description }}
            (Status: {{ $task->status }})
        </li>
    @endforeach
</ul>
<p>Thank you for using our application!</p>
</body>
</html>
