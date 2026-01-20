<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Riwayat Pesanan</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        /* ===== HEADER ===== */
        .header {
            margin-bottom: 30px;
            border-bottom: 3px solid #0f4c63;
            padding-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .company {
            flex: 1;
        }

        .company h2 {
            margin: 0;
            font-size: 16px;
            text-transform: uppercase;
        }

        .header-right {
            text-align: right;
        }

        .header-right h1 {
            margin: 0;
            font-size: 18px;
            color: #0f4c63;
            text-transform: uppercase;
        }

        .period-badge {
            background: #0f4c63;
            color: #fff;
            padding: 8px 12px;
            border-radius: 3px;
            font-size: 11px;
            margin-top: 5px;
            display: inline-block;
        }

        .report-type {
            margin-top: 8px;
            font-size: 11px;
            color: #666;
        }

        /* ===== SUMMARY CARDS ===== */
        .summary-box {
            display: inline-block;
            width: 23%;
            margin: 0.5%;
            padding: 12px;
            background: #f3f4f6;
            border-left: 3px solid #0f4c63;
            margin-bottom: 15px;
            vertical-align: top;
        }

        .summary-box-label {
            font-size: 10px;
            color: #666;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .summary-box-value {
            font-size: 14px;
            font-weight: bold;
            color: #0f4c63;
        }

        /* ===== TABLE ===== */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #0f4c63;
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
            color: #fff;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
        }

        td {
            padding: 8px 10px;
            border: 1px solid #ddd;
        }

        th.text-left, td.text-left {
            text-align: left;
        }

        th.text-right, td.text-right {
            text-align: right;
        }

        th.text-center, td.text-center {
            text-align: center;
        }

        tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        /* ===== SUBTOTAL ROW ===== */
        .subtotal-row td {
            background: #e8ecf1 !important;
            font-weight: bold;
            border-top: 2px solid #0f4c63 !important;
            border-bottom: 2px solid #0f4c63 !important;
        }

        /* ===== SECTION TITLE ===== */
        .section-title {
            background: #0f4c63;
            color: #fff;
            padding: 10px 12px;
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .subsection-title {
            background: #e8ecf1;
            color: #0f4c63;
            padding: 8px 10px;
            margin-top: 15px;
            margin-bottom: 8px;
            font-size: 11px;
            font-weight: bold;
            border-left: 3px solid #0f4c63;
        }

        /* ===== PAGE BREAK ===== */
        .page-break {
            page-break-after: always;
            margin: 30px 0;
        }

        /* ===== UTILITIES ===== */
        .mt-15 {
            margin-top: 15px;
        }

        .mb-5 {
            margin-bottom: 5px;
        }

        .inline-block {
            display: inline-block;
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header">
        <div class="company">
            <h2>LAPORAN RIWAYAT PESANAN</h2>
            <div>Wedding Organizer</div>
        </div>
        <div class="header-right">
            <h1>REPORT</h1>
            <div class="period-badge">
                {{ $start_date }} s/d {{ $end_date }}
            </div>
            <div class="report-type">
                @switch($export_type)
                    @case('all')
                        Semua Data Riwayat
                    @break
                    @case('by_order')
                        Berdasarkan Pesanan
                    @break
                    @case('by_status')
                        Berdasarkan Perubahan Status
                    @break
                    @case('by_user')
                        Berdasarkan Pelanggan
                    @break
                @endswitch
            </div>
        </div>
    </div>

    {{-- SUMMARY STATISTICS (Only for 'all' export type) --}}
    @if($export_type === 'all')
    <div style="margin-bottom: 10px;">
        <div class="summary-box">
            <div class="summary-box-label">Total Perubahan</div>
            <div class="summary-box-value">{{ $summary['total_changes'] }}</div>
        </div>
        <div class="summary-box">
            <div class="summary-box-label">Total Pesanan</div>
            <div class="summary-box-value">{{ $summary['total_orders_affected'] }}</div>
        </div>
        <div class="summary-box">
            <div class="summary-box-label">Perubahan ke Lunas</div>
            <div class="summary-box-value">{{ $summary['status_changes']['paid_completed'] }}</div>
        </div>
        <div class="summary-box">
            <div class="summary-box-label">Perubahan ke Selesai</div>
            <div class="summary-box-value">{{ $summary['status_changes']['completed'] }}</div>
        </div>
    </div>
    @endif

    {{-- ALL DATA --}}
    @if($export_type === 'all')
        @if(empty($histories))
            <div style="text-align: center; padding: 40px; color: #999; font-size: 14px;">
                <p>Tidak Ada Data</p>
            </div>
        @else
        <div class="section-title">Detail Riwayat</div>
        <table>
            <thead>
                <tr>
                    <th class="text-left">Tanggal</th>
                    <th class="text-left">Kode Pesanan</th>
                    <th class="text-left">Customer</th>
                    <th class="text-left">Status Lama</th>
                    <th class="text-left">Status Baru</th>
                    <th class="text-left">Diubah Oleh</th>
                    <th class="text-left">Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($histories as $history)
                    <tr>
                        <td class="text-left">{{ \Carbon\Carbon::parse($history->created_at)->format('d-m-Y H:i') }}</td>
                        <td class="text-left">{{ $history->order->order_code ?? '-' }}</td>
                        <td class="text-left">{{ $history->order->customer->name ?? '-' }}</td>
                        <td class="text-left">{{ $history->old_status ?? '-' }}</td>
                        <td class="text-left">{{ $history->new_status ?? '-' }}</td>
                        <td class="text-left">{{ $history->changer->name ?? '-' }}</td>
                        <td class="text-left">{{ $history->note ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif

    {{-- BY ORDER --}}
    @elseif($export_type === 'by_order')
        @if(empty($report_data))
            <div style="text-align: center; padding: 40px; color: #999; font-size: 14px;">
                <p>Tidak Ada Data</p>
            </div>
        @else
        <div class="section-title">Riwayat Berdasarkan Pesanan</div>
        @foreach($report_data as $order_summary)
            <div class="subsection-title">
                {{ $order_summary['order_code'] }} - {{ $order_summary['customer_name'] }}
                <span style="font-weight: normal; font-size: 10px; color: #666;">
                    ({{ $order_summary['total_changes'] }} perubahan)
                </span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th class="text-left">Tanggal</th>
                        <th class="text-left">Status Lama</th>
                        <th class="text-left">Status Baru</th>
                        <th class="text-left">Diubah Oleh</th>
                        <th class="text-left">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order_summary['histories'] as $history)
                        <tr>
                            <td class="text-left">{{ \Carbon\Carbon::parse($history->created_at)->format('d-m-Y H:i') }}</td>
                            <td class="text-left">{{ $history->old_status ?? '-' }}</td>
                            <td class="text-left">{{ $history->new_status ?? '-' }}</td>
                            <td class="text-left">{{ $history->changer->name ?? '-' }}</td>
                            <td class="text-left">{{ $history->note ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
        @endif

    {{-- BY STATUS --}}
    @elseif($export_type === 'by_status')
        @if(empty($report_data))
            <div style="text-align: center; padding: 40px; color: #999; font-size: 14px;">
                <p>Tidak Ada Data</p>
            </div>
        @else
        <div class="section-title">Riwayat Berdasarkan Perubahan Status</div>
        @foreach($report_data as $status_summary)
            {{-- <div class="subsection-title">
                {{ $status_summary['status'] }}
                <span style="font-weight: normal; font-size: 10px; color: #666;">
                    ({{ $status_summary['count'] }} perubahan)
                </span>
            </div> --}}
            <table>
                <thead>
                    <tr>
                        <th class="text-left">Tanggal</th>
                        <th class="text-left">Kode Pesanan</th>
                        <th class="text-left">Customer</th>
                        <th class="text-left">Diubah Oleh</th>
                        <th class="text-left">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($status_summary['histories'] as $history)
                        <tr>
                            <td class="text-left">{{ \Carbon\Carbon::parse($history->created_at)->format('d-m-Y H:i') }}</td>
                            <td class="text-left">{{ $history->order->order_code ?? '-' }}</td>
                            <td class="text-left">{{ $history->order->customer->name ?? '-' }}</td>
                            <td class="text-left">{{ $history->changer->name ?? '-' }}</td>
                            <td class="text-left">{{ $history->note ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
        @endif

    {{-- BY USER --}}
    @elseif($export_type === 'by_user')
        @if(empty($report_data))
            <div style="text-align: center; padding: 40px; color: #999; font-size: 14px;">
                <p>Tidak Ada Data</p>
            </div>
        @else
        <div class="section-title">Riwayat Berdasarkan Pelanggan</div>
        @foreach($report_data as $user_summary)
            {{-- <div class="subsection-title">
                {{ $user_summary['user_name'] }}
                <span style="font-weight: normal; font-size: 10px; color: #666;">
                    ({{ $user_summary['total_changes'] }} perubahan)
                </span>
            </div> --}}
            <table>
                <thead>
                    <tr>
                        <th class="text-left">Tanggal</th>
                        <th class="text-left">Kode Pesanan</th>
                        <th class="text-left">Status Lama</th>
                        <th class="text-left">Status Baru</th>
                        <th class="text-left">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user_summary['histories'] as $history)
                        <tr>
                            <td class="text-left">{{ \Carbon\Carbon::parse($history->created_at)->format('d-m-Y H:i') }}</td>
                            <td class="text-left">{{ $history->order->order_code ?? '-' }}</td>
                            <td class="text-left">{{ $history->old_status ?? '-' }}</td>
                            <td class="text-left">{{ $history->new_status ?? '-' }}</td>
                            <td class="text-left">{{ $history->note ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
        @endif
    @endif

</body>
</html>
