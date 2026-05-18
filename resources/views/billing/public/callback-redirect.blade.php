<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Processing payment…</title>
    <style>
        body {
            font-family: system-ui, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            background: #faf9f6;
            color: #1a4d3a;
        }
        p { font-size: 0.95rem; }
    </style>
</head>
<body>
    <p>Processing your payment…</p>
    <script>
        window.top.location.href = @json($redirectUrl);
    </script>
</body>
</html>
