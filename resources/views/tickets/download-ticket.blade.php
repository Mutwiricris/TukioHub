<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Ticket</title>
    <script>
        // Force download to Downloads folder
        function downloadTicket(url, filename) {
            const link = document.createElement('a');
            link.href = url;
            link.download = filename;
            link.style.display = 'none';
            
            // Add to body, click, and remove
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
        
        // Auto-trigger download when page loads
        window.onload = function() {
            const url = '{{ $downloadUrl }}';
            const filename = '{{ $filename }}';
            downloadTicket(url, filename);
            
            // Redirect back after short delay
            setTimeout(function() {
                window.history.back();
            }, 1000);
        };
    </script>
</head>
<body>
    <div style="text-align: center; padding: 50px; font-family: Arial, sans-serif;">
        <h2>Downloading your ticket...</h2>
        <p>Your ticket download should start automatically.</p>
        <p>If it doesn't start, <a href="{{ $downloadUrl }}" download="{{ $filename }}">click here</a>.</p>
    </div>
</body>
</html>
