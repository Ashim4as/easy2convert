<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML to Excel & Merge Tool</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(120deg, #e0e7ff 0%, #f8fafc 100%);
            font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif;
        }
        .main-card {
            background: #fff;
            border-radius: 2rem;
            box-shadow: 0 8px 32px rgba(79,140,255,0.08), 0 1.5px 4px rgba(0,0,0,0.03);
            padding: 2.5rem 2rem 2rem 2rem;
            margin-top: 3.5rem;
            margin-bottom: 2rem;
            max-width: 680px;
        }
        .header-premium {
            background: linear-gradient(90deg, #4f8cff 0%, #6fc3ff 100%);
            color: #fff;
            border-radius: 1.5rem 1.5rem 0 0;
            box-shadow: 0 2px 8px rgba(79,140,255,0.13);
            padding: 1.5rem 2rem 1rem 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .header-premium h1 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0;
            letter-spacing: 1px;
        }
        @media (max-width: 600px) {
            .main-card { padding: 1.2rem 0.5rem 1.5rem 0.5rem; }
            .header-premium { padding: 1rem 1rem 0.7rem 1rem; }
            .header-premium h1 { font-size: 1.3rem; }
        }
    </style>
</head>
<body>
    <div class="d-flex flex-column align-items-center min-vh-100">
        <div class="main-card w-100">
            <div class="header-premium mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
                  <path d="M6 12v-2h3v2H6z"/>
                  <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3-3V4a1 1 0 0 0 1 1h2v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h7z"/>
                </svg>
                <h1>XML & Excel File Converter</h1>
            </div>
            @yield('content')
        </div>
        <div class="text-muted small mb-3">&copy; {{ date('Y') }} XML to Excel & Merge Tool</div>
    </div>
</body>
</html>
