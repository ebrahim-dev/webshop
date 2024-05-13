<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        p {
            margin-bottom: 10px;
        }
        .total {
            font-weight: bold;
            font-size: 18px;
        }
        .note {
            background-color: #e6f7ff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .thank-you {
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Order Confirmation</h2>
        <p>Dear Customer,</p>
        <p>We're delighted to confirm your recent order with us. Below are the details:</p>

        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetails as $detail)
                <tr>
                    <td> <img height="100px" src="https://sermani.de/assets/img/{{ basename(str_replace('\\', '/', $detail->product->imagepath)) }}" ></td>
                    <td>
                        <a href="https://sermani.de/single-product/{{ $detail->product->id }}">
                            {{ $detail->product->name }}
                        </a>
                    </td>
                    <td>${{ $detail->product->price }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>${{ $detail->product->price * $detail->quantity }}</td>
                </tr>
                @endforeach
                <tr class="total">
                    <td colspan="3">Total Amount:</td>
                    <td>${{ $totalAmount }}</td>
                </tr>
            </tbody>
        </table>

        <div class="note">
            <p>{{ $mailMessage }}</p>
            <p><strong>Subject:</strong> {{ $subject }}</p>
            <p><strong>Goal:</strong> {{ $goal }}</p>
        </div>

        <p>If you have any questions or concerns regarding your order, feel free to reach out to us at {{ config('mail.from.address') }}.</p>

        <p class="thank-you">Thank you for choosing us!</p>
        <p class="footer">Sincerely, <br>Ebrahim Sermani</p>
    </div>
</body>
</html>
