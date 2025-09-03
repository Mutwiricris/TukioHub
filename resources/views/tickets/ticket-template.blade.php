<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Ticket</title>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #111827;
            color: white;
            min-height: 100vh;
            padding: 20px;
        }
        
        .ticket-container {
            max-width: 600px;
            margin: 0 auto;
            background: #1f2937;
            border: 2px dashed rgba(75, 85, 99, 0.5);
            border-radius: 20px;
            padding: 30px;
            position: relative;
        }
        
        .success-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .success-title {
            font-size: 32px;
            font-weight: bold;
            color: white;
            margin-bottom: 10px;
        }
        
        .success-subtitle {
            color: #9ca3af;
            font-size: 16px;
            margin-bottom: 20px;
        }
        
        .payment-reference {
            color: #9ca3af;
            font-size: 14px;
        }
        
        .ticket-content {
            display: flex;
            gap: 30px;
            margin: 30px 0;
        }
        
        .qr-section {
            flex-shrink: 0;
            text-align: center;
            border-right: 2px dashed rgba(75, 85, 99, 0.5);
            padding-right: 30px;
        }
        
        .qr-label {
            color: #10b981;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .qr-code {
            width: 160px;
            height: 160px;
            background: white;
            border-radius: 12px;
            padding: 10px;
            margin: 0 auto;
        }
        
        .qr-code img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        
        .event-details {
            flex: 1;
        }
        
        .event-details h3 {
            color: white;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        .detail-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }
        
        .detail-icon {
            width: 20px;
            height: 20px;
            color: #9ca3af;
        }
        
        .detail-content {
            flex: 1;
        }
        
        .detail-label {
            color: #9ca3af;
            font-size: 12px;
            font-weight: 500;
        }
        
        .detail-value {
            color: white;
            font-size: 14px;
            font-weight: 500;
        }
        
        .tickets-section {
            background: rgba(75, 85, 99, 0.2);
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
        }
        
        .tickets-label {
            color: #9ca3af;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        
        .ticket-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 5px;
        }
        
        .ticket-price {
            color: #10b981;
        }
        
        .total-section {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
        
        .total-label {
            color: #9ca3af;
            font-size: 12px;
            font-weight: 500;
        }
        
        .total-amount {
            color: #10b981;
            font-size: 18px;
            font-weight: bold;
        }
        
        .barcode-section {
            text-align: center;
            margin-top: 30px;
        }
        
        .barcode-label {
            color: #9ca3af;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 10px;
        }
        
        .barcode {
            background: white;
            border-radius: 8px;
            padding: 10px;
            margin: 0 auto;
            width: fit-content;
        }
        
        .barcode-number {
            color: #374151;
            font-size: 12px;
            font-weight: 500;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="success-header">
            <h1 class="success-title">Payment Successful!</h1>
            <p class="success-subtitle">Your tickets are confirmed. See you at the festival!</p>
            <p class="payment-reference">Payment Reference: {{ $reference }}</p>
        </div>
        
        <div class="ticket-content">
            <div class="qr-section">
                <div class="qr-label">Scan at Entry</div>
                <div class="qr-code">
                    <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code">
                </div>
            </div>
            
            <div class="event-details">
                <h3>Event Details</h3>
                
                <div class="detail-item">
                    <svg class="detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <div class="detail-content">
                        <div class="detail-label">Event Date</div>
                        <div class="detail-value">{{ $event->date ? \Carbon\Carbon::parse($event->date)->format('M j, Y') : 'TBA' }}</div>
                    </div>
                </div>
                
                <div class="detail-item">
                    <svg class="detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="detail-content">
                        <div class="detail-label">Event Time</div>
                        <div class="detail-value">{{ $event->date ? \Carbon\Carbon::parse($event->date)->format('g:i A') : 'TBA' }}</div>
                    </div>
                </div>
                
                <div class="detail-item">
                    <svg class="detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <div class="detail-content">
                        <div class="detail-label">Venue</div>
                        <div class="detail-value">{{ $event->venue->name ?? 'Venue TBA' }}</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="tickets-section">
            <div class="tickets-label">Tickets Purchased:</div>
            <div class="ticket-item">
                <span>1 × {{ $ticketType }}</span>
                <span class="ticket-price">KES {{ number_format($amount, 0) }}</span>
            </div>
        </div>
        
        <div class="total-section">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span class="total-label">Total Amount:</span>
                <span class="total-amount">KES {{ number_format($amount, 0) }}</span>
            </div>
        </div>
        
        <div class="barcode-section">
            <div class="barcode-label">Ticket Barcode</div>
            <div class="barcode">
                <canvas id="barcode"></canvas>
                <div class="barcode-number">{{ $reference }}</div>
            </div>
        </div>
    </div>
    
    <script>
        // Generate barcode
        const barcodeNumber = '{{ $reference }}'.replace(/[^0-9]/g, '').padEnd(12, '0').slice(0, 12);
        JsBarcode("#barcode", barcodeNumber, {
            format: "CODE128",
            width: 2,
            height: 60,
            displayValue: false,
            background: "transparent",
            lineColor: "#000"
        });
    </script>
</body>
</html>
