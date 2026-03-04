<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #4A90E2; padding-bottom: 10px; }
        .match-badge { background: #28a745; color: white; padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: bold; }
        .section-title { color: #4A90E2; border-left: 4px solid #4A90E2; padding-left: 10px; margin: 20px 0 10px 0; font-size: 14px; text-transform: uppercase; }
        .info-table { width: 100%; border-collapse: collapse; }
        .info-table td { padding: 8px; border-bottom: 1px solid #eee; }
        .label { font-weight: bold; width: 30%; color: #666; }
        .footer { margin-top: 50px; font-size: 10px; text-align: center; color: #aaa; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="margin-bottom: 5px;">LOST & FOUND SYSTEM</h2>
        <span class="match-badge">SERIAL NUMBER VERIFIED MATCH</span>
    </div>

    <div class="section-title">Item Information</div>
    <table class="info-table">
        <tr><td class="label">Item Name</td><td>{{ $item->item_name }}</td></tr>
        <tr><td class="label">Category</td><td>{{ $item->category }}</td></tr>
        <tr><td class="label">Serial Number</td><td><strong>{{ $item->serial_number }}</strong></td></tr>
        <tr><td class="label">Location Found</td><td>{{ $item->location_found }}</td></tr>
        <tr><td class="label">Date Reported</td><td>{{ \Carbon\Carbon::parse($item->date_found)->format('d M Y') }}</td></tr>
    </table>

    <div class="section-title">Finder Contact Information</div>
    <table class="info-table">
        <tr><td class="label">Contact Number</td><td>{{ $item->finder_contact }}</td></tr>
    </table>

    <div class="footer">
        <p>This report was generated on {{ $date }}.<br>Please bring this slip and your Identification Card (IC) for verification during collection.</p>
    </div>
</body>
</html>