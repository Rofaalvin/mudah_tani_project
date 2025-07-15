<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->kode_trx_jual }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #333;
            font-size: 14px;
            line-height: 1.6;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            color: #333;
            font-size: 24px;
        }

        .details {
            margin-bottom: 40px;
        }

        .details table {
            width: 100%;
        }

        .details .left {
            text-align: left;
        }

        .details .right {
            text-align: right;
        }

        .items-table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .items-table td,
        .items-table th {
            padding: 8px;
            vertical-align: top;
        }

        .items-table thead th {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .items-table .item td {
            border-bottom: 1px solid #eee;
        }

        .total-table {
            width: 100%;
            margin-top: 30px;
        }

        .total-table td {
            padding: 5px 0;
        }

        .total-table .label {
            font-weight: bold;
            text-align: right;
            width: 80%;
        }

        .total-table .amount {
            text-align: right;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            color: #777;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="header">
            <h1>INVOICE</h1>
        </div>

        <div class="details">
            <table>
                <tr>
                    <td class="left">
                        <strong>Ditagihkan Kepada:</strong><br>
                        {{ $order->user->name ?? 'Pelanggan' }}<br>
                        {{ $order->user->email ?? '' }}
                    </td>
                    <td class="right">
                        <strong>Invoice #:</strong> {{ $order->kode_trx_jual }}<br>
                        <strong>Tanggal Dibuat:</strong>
                        {{ \Carbon\Carbon::parse($order->tanggal)->format('d F Y') }}<br>
                        <strong>Status:</strong> <span style="text-transform: capitalize;">{{ $order->status }}</span>
                    </td>
                </tr>
            </table>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th style="text-align: center;">Jumlah</th>
                    <th style="text-align: right;">Harga Satuan</th>
                    <th style="text-align: right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr class="item">
                        <td>{{ $item->nama_produk }}</td>
                        <td style="text-align: center;">{{ $item->quantity }}</td>
                        <td style="text-align: right;">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td style="text-align: right;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="total-table">
            <tr>
                <td class="label">Subtotal:</td>
                <td class="amount">Rp {{ number_format($order->items->sum('subtotal'), 0, ',', '.') }}</td>
            </tr>
            @if ($order->shipping_cost > 0)
                <tr>
                    <td class="label">Ongkos Kirim:</td>
                    <td class="amount">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                </tr>
            @endif
            @if ($order->diskon > 0)
                <tr>
                    <td class="label">Diskon:</td>
                    <td class="amount">{{ $order->diskon }}%</td>
                </tr>
            @endif
            <tr style="font-size: 1.2em; border-top: 2px solid #eee;">
                <td class="label">Total:</td>
                <td class="amount">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="footer">
            Terima kasih telah berbelanja!
        </div>
    </div>
</body>

</html>
