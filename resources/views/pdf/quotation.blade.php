<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Quotation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Lexend", sans-serif;
            /* font-optical-sizing: auto; */
            margin: 0;
            padding: 0;
            background: #fff;
            color: #333;
            font-size: 14px;
        }

        .container {
            width: 95%;
            height: 95%;
            margin: 0 auto;
            padding: 20px;
            bquotation: 1px solid rgb(5, 2, 8);
            bquotation-radius: 5px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header img {
            margin: 0;
            margin-bottom: 15px;
            width: 60px;
        }

        .header p {
            margin: 5px 0;
            font-size: 14px;
        }

        .details {
            display: flex;
            width: 100% justify-content: space-between;
            margin-bottom: 30px;
        }

        .details div {
            width: 45%;
            margin-bottom: 40px
        }

        .details h3 {
            margin: 0 0 10px;
            font-size: 16px;
            color: #555;
        }

        .details p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            bquotation-collapse: collapse;
            margin-bottom: 30px;
        }

        table th,
        table td {
            bquotation: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background: #f4f4f4;
            font-weight: bold;
        }

        .total {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('EgoEntlogo/company-logo.jpg') }}" alt="Ego ENT">
            <h1>Quotation</h1>
            <p><strong>Quotation Date:</strong> {{ Carbon\Carbon::parse($quotation->quotation_date)->format('D jS F, Y') }}</p>
            <p><strong>Quotation Number:</strong> #{{ sprintf('%04d', $quotation->id) }}</p>
        </div>

        <div class="details">
            <div>
                <h3>Client Details</h3>
                <p><strong>Name:</strong> {{ $quotation->client->name }}</p>
                <p><strong>Address:</strong> {{ $quotation->client->address }}</p>
                <p><strong>Email:</strong> {{ $quotation->client->email }}</p>
                <p><strong>Phone:</strong> {{ $quotation->client->phone_number }}</p>
            </div>

            <div style="margin-left:auto">
                <h3>Saler Details</h3>
                <p><strong>Name:</strong> {{ env('COMPANY_NAME') }}</p>
                <p><strong>Address:</strong> {{ env('COMPANY_ADDRESS') }}</p>
                <p><strong>Email:</strong> {{ env('COMPANY_EMAIL') }}</p>
                <p><strong>Phone:</strong> {{ env('COMPANY_PHONE') }}</p>
            </div>
        </div>

        <table> 
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price <p style="font-size:10px;font:bold">PISO</p>
                    </th>
                    <th>Total<p style="font-size:10px;font:bold">PISO</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quotation->products as $key => $product)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <h3><strong>{{ $product->name }}</strong></h3>
                            <p style="font-size:12px">
                                {{ $product->description }}
                            </p>
                        </td>
                        <td>{{ $product->pivot->quantity . $product->unit->name }}(s)</td>
                        <td> {{ number_format($product->pivot->unit_price, 2) }}
                        </td>
                        <td>{{ number_format($product->pivot->unit_price * $product->pivot->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">Grand Total: <span style="font-size:10px">PISO </span>
            {{ number_format($quotation->total_amount, 2) }}</p>

        <div class="footer">
            <p>Thank you for your business!</p>
            <p>This document was generated electronically and does not require a signature.</p>
        </div>
    </div>
</body>

</html>