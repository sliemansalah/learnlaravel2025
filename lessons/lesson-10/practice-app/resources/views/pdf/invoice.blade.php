<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-info {
            margin-bottom: 30px;
        }
        .invoice-info p {
            margin: 5px 0;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background-color: #3498db;
            color: white;
            padding: 12px;
            text-align: left;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .total-row {
            font-weight: bold;
            font-size: 18px;
            background-color: #ecf0f1 !important;
        }
        .total-row td {
            padding: 15px 10px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            color: #999;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>

    <div class="invoice-info">
        <p><strong>Invoice Date:</strong> {{ $date }}</p>
        <p><strong>Invoice Number:</strong> #INV-{{ rand(1000, 9999) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th style="text-align: right;">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td style="text-align: right;">${{ number_format($item['price'], 2) }}</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td>TOTAL</td>
                <td style="text-align: right;">${{ number_format($total, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Thank you for your business!</p>
        <p>This is a computer-generated invoice</p>
    </div>
</body>
</html>
