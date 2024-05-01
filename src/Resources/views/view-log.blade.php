<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Log Viewer</title>
    <style>
        pre {
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <h1>{{ $filename ? 'View Log: '.$filename : 'File Not Found' }}</h1>

    @if (!empty($log))
        <div>
            <pre>{{ $log }}</pre>
        </div>
    @endif
</body>
</html>