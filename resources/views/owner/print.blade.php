<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report - {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #16A34A; /* Emerald 600 */
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #e5e7eb; /* Gray 200 */
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f9fafb; /* Gray 50 */
            font-weight: bold;
            color: #4B5563; /* Gray 700 */
            text-transform: uppercase;
            font-size: 0.75rem;
        }
        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .status-selesai { background-color: #D1FAE5; color: #065F46; } /* Green 100 / Green 800 */
        .status-proses { background-color: #FFFBEB; color: #92400E; } /* Amber 100 / Amber 800 */
        .status-pending { background-color: #F3F4F6; color: #4B5563; } /* Gray 100 / Gray 800 */
        .summary-box {
            background-color: #ECFDF5; /* Emerald 50 */
            border: 1px solid #A7F3D0; /* Emerald 200 */
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
        .summary-box strong {
            color: #059669; /* Emerald 600 */
            font-size: 1.5rem;
        }
        .footer {
            text-align: right;
            margin-top: 30px;
            font-size: 0.875rem;
            color: #6B7280; /* Gray 500 */
        }
        .logo {
            max-height: 60px;
            margin-bottom: 20px;
        }

        @media print {
            body {
                background-color: #fff;
            }
            .container {
                box-shadow: none;
                border: none;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <div class="text-center">
            @if(file_exists($logoPath))
                <img src="{{ asset('assets/images/logo-your-company.png') }}" alt="Company Logo" class="logo mx-auto">
            @endif
            <h1 class="text-3xl font-extrabold">Sales Report</h1>
            <p class="text-gray-600">Generated on: {{ $reportDate }}</p>
        </div>

        <div class="summary-box mt-8">
            <p class="text-lg text-emerald-700">Total Revenue (This Month): <strong>IDR {{ number_format($monthlyRevenue, 0, ',', '.') }}</strong></p>
        </div>

        <h2 class="text-xl font-bold mt-8 mb-4">All Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Items</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'Guest User' }}</td>
                        <td>IDR {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td>
                            <span class="status-badge
                                @if($order->status == 'selesai') status-selesai
                                @elseif($order->status == 'proses') status-proses
                                @else status-pending @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y H:i') }}</td>
                        <td>
                            <ul class="list-disc pl-5">
                                @foreach($order->items as $item)
                                    <li>{{ $item->product->name }} ({{ $item->quantity }} x IDR {{ number_format($item->price, 0, ',', '.') }})</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500">No orders found for this report.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Your Company') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>