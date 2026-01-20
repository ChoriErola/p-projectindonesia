<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pesanan</title>

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

        /* ===== SERVICE DETAIL TABLE ===== */
        .service-row td {
            background: #f3f4f6 !important;
            padding: 4px !important;
        }

        .service-table {
            width: 100%;
            border-collapse: collapse;
            margin: 3px 0;
        }

        .service-table td {
            padding: 4px !important;
            border: 0.5px solid #ddd !important;
            font-size: 10px;
        }

        .service-table td:last-child {
            text-align: right;
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

        /* ===== FOOTER ===== */
        .footer {
            text-align: center;
            font-size: 10px;
            color: #999;
            margin-top: 30px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
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

        .custom-label {
            color: #999;
            font-size: 9px;
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header">
        <div class="company">
            <h2>LAPORAN PESANAN</h2>
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
                        Semua Data Pesanan
                    @break
                    @case('by_customer')
                        Customer
                    @break
                    @case('by_service')
                        Package/Service
                    @break
                    @case('by_status')
                        Status
                    @break
                @endswitch
            </div>
        </div>
    </div>

    {{-- SUMMARY STATISTICS (Only for 'all' export type) --}}
    @if($export_type === 'all')
    <div style="margin-bottom: 10px;">
        <div class="summary-box">
            <div class="summary-box-label">Total Pesanan</div>
            <div class="summary-box-value">{{ $summary['total_orders'] }}</div>
        </div>
        <div class="summary-box">
            <div class="summary-box-label">Total Revenue</div>
            <div class="summary-box-value">Rp {{ number_format($summary['total_revenue'], 0, ',', '.') }}</div>
        </div>
        <div class="summary-box">
            <div class="summary-box-label">Sudah Lunas</div>
            <div class="summary-box-value">Rp {{ number_format($summary['paid_completed'], 0, ',', '.') }}</div>
        </div>
        <div class="summary-box">
            <div class="summary-box-label">Belum Lunas</div>
            <div class="summary-box-value">Rp {{ number_format($summary['unpaid'] + $summary['paid_in_progress'], 0, ',', '.') }}</div>
        </div>
    </div>
    @endif

    {{-- ALL DATA --}}
    @if($export_type === 'all')
        @if(empty($orders))
            <div style="text-align: center; padding: 40px; color: #0f4c63; font-size: 14px;">
                <p>Tidak Ada Data</p>
            </div>
        @else
        <div class="section-title">Detail Pesanan</div>
        <table>
            <thead>
                <tr>
                    <th class="text-left">Kode Pesanan</th>
                    <th class="text-left">Customer</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-left">Package</th>
                    <th class="text-right">Total Harga</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td class="text-left">{{ $order->order_code }}</td>
                        <td class="text-left">{{ $order->customer->name ?? '-' }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($order->event_date)->format('d-m-Y') }}</td>
                        <td class="text-left">{{ $order->package->name ?? '-' }}</td>
                        <td class="text-right">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="text-center">
                            @switch($order->status)
                                @case('paid completed')
                                    Lunas
                                @break
                                @case('paid in progress')
                                    Proses
                                @break
                                @case('confirmed')
                                    Belum Bayar
                                @break
                                @case('completed')
                                    Selesai
                                @break
                                @case('cancelled')
                                    Dibatalkan
                                @break
                                @default
                                    {{ ucfirst($order->status) }}
                            @endswitch
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @php
            $hasServices = collect($orders)->some(fn($o) => $o->services && $o->services->count() > 0);
        @endphp
        @if($hasServices)
            <div class="section-title mt-15">Detail Layanan/Service</div>
            @foreach($orders as $order)
                @if($order->services && $order->services->count() > 0)
                    {{-- <div class="subsection-title">
                        {{ $order->order_code }} - {{ $order->customer->name ?? '-' }}
                    </div> --}}
                    <table>
                        <thead>
                            <tr>
                                <th class="text-left">Nama Layanan</th>
                                <th class="text-right">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->services as $service)
                                <tr>
                                    <td class="text-left">
                                        {{ $service->service_name }}
                                        @if($service->is_custom)
                                            <span class="custom-label">(Custom)</span>
                                        @endif
                                    </td>
                                    <td class="text-right">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <tr class="subtotal-row">
                                <td class="text-left">Subtotal</td>
                                <td class="text-right">Rp {{ number_format($order->services->sum('price'), 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mb-5"></div>
                @endif
            @endforeach
        @endif
        @endif

    {{-- BY CUSTOMER --}}
    @elseif($export_type === 'by_customer')
        @if(empty($report_data))
            <div style="text-align: center; padding: 40px; color: #0f4c63; font-size: 14px;">
                <p>Tidak Ada Data</p>
            </div>
        @else
        <div class="section-title">Customer</div>
        @foreach($report_data as $customer_summary)
            <div class="subsection-title">
                {{ $customer_summary['customer_name'] }}
                @if($customer_summary['customer_phone'] !== '-')
                    <span style="font-size: 10px; font-weight: normal;">({{ $customer_summary['customer_phone'] }})</span>
                @endif
            </div>
            <table>
                <thead>
                    <tr>
                        <th class="text-left">Kode Pesanan</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-left">Package</th>
                        <th class="text-right">Harga</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customer_summary['orders'] as $order)
                        <tr>
                            <td class="text-left">{{ $order->order_code }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($order->event_date)->format('d-m-Y') }}</td>
                            <td class="text-left">{{ $order->package->name ?? '-' }}</td>
                            <td class="text-right">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @switch($order->status)
                                    @case('paid completed')
                                        Lunas
                                    @break
                                    @case('paid in progress')
                                        Proses
                                    @break
                                    @case('confirmed')
                                        Belum Bayar
                                    @break
                                    @default
                                        {{ ucfirst($order->status) }}
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                    <tr class="subtotal-row">
                        <td colspan="3" class="text-left">Subtotal</td>
                        <td class="text-right">Rp {{ number_format($customer_summary['total_amount'], 0, ',', '.') }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            {{-- SERVICES FOR THIS CUSTOMER --}}
            {{-- @php
                $customerHasServices = collect($customer_summary['orders'])->some(fn($o) => $o->services && $o->services->count() > 0);
            @endphp
            @if($customerHasServices)
                <div style="margin-top: 10px; font-size: 10px; color: #666; margin-bottom: 5px;">Layanan/Service:</div>
                @foreach($customer_summary['orders'] as $order)
                    @if($order->services && $order->services->count() > 0)
                        <table style="margin-bottom: 8px;">
                            <thead>
                                <tr style="background: #e8ecf1;">
                                    <td style="padding: 6px; border: 1px solid #ddd; font-weight: bold; font-size: 10px;">{{ $order->order_code }}</td>
                                    <td style="padding: 6px; border: 1px solid #ddd; font-weight: bold; font-size: 10px; width: 60%;"></td>
                                    <td style="padding: 6px; border: 1px solid #ddd; font-weight: bold; font-size: 10px; text-align: right; width: 40%;"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->services as $service)
                                    <tr>
                                        <td style="padding: 4px; border: 1px solid #ddd; font-size: 10px;"></td>
                                        <td style="padding: 4px; border: 1px solid #ddd; font-size: 10px;">
                                            {{ $service->service_name }}
                                            @if($service->is_custom)
                                                <span class="custom-label">(Custom)</span>
                                            @endif
                                        </td>
                                        <td style="padding: 4px; border: 1px solid #ddd; font-size: 10px; text-align: right;">
                                            Rp {{ number_format($service->price, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                @endforeach
            @endif --}}

        @endforeach
        @endif

    {{-- BY SERVICE --}}
    @elseif($export_type === 'by_service')
        @if(empty($report_data))
            <div style="text-align: center; padding: 40px; color: #0f4c63; font-size: 14px;">
                <p>Tidak Ada Data</p>
            </div>
        @else
        @if(!empty($selected_customers))
            <div style="background: #e8ecf1; padding: 10px 12px; margin-bottom: 15px; border-left: 3px solid #0f4c63; font-size: 11px;">
                <strong>Filter Pelanggan:</strong> {{ implode(', ', $selected_customers) }}
            </div>
        @endif
        <div class="section-title">Package/Service</div>
        @foreach($report_data as $service_summary)
            <div class="subsection-title">
                {{ $service_summary['package_name'] }} 
                <span style="font-weight: normal; font-size: 10px; color: #0f4c63;">
                    (Rp {{ number_format($service_summary['total_amount'], 0, ',', '.') }})
                </span>
            </div>
            {{-- <table>
                <thead>
                    <tr>
                        <th class="text-left">Kode Pesanan</th>
                        <th class="text-left">Customer</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-right">Harga</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($service_summary['orders'] as $order)
                        <tr>
                            <td class="text-left">{{ $order->order_code }}</td>
                            <td class="text-left">{{ $order->customer->name ?? '-' }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($order->event_date)->format('d-m-Y') }}</td>
                            <td class="text-right">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @switch($order->status)
                                    @case('paid completed')
                                        Lunas
                                    @break
                                    @case('paid in progress')
                                        Proses
                                    @break
                                    @case('confirmed')
                                        Belum Bayar
                                    @break
                                    @default
                                        {{ ucfirst($order->status) }}
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                    <tr class="subtotal-row">
                        <td colspan="3" class="text-left">Subtotal</td>
                        <td class="text-right">Rp {{ number_format($service_summary['total_amount'], 0, ',', '.') }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table> --}}

            {{-- SERVICES FOR THIS PACKAGE --}}
            @php
                $packageHasServices = collect($service_summary['orders'])->some(fn($o) => $o->services && $o->services->count() > 0);
            @endphp
            @if($packageHasServices)
                <div style="margin-top: 10px; font-size: 10px; color: #666; margin-bottom: 5px;">Layanan/Service Detail:</div>
                @foreach($service_summary['orders'] as $order)
                    @if($order->services && $order->services->count() > 0)
                        <table style="margin-bottom: 8px;">
                            {{-- <thead>
                                <tr style="background: #e8ecf1;">
                                    <td style="padding: 6px; border: 1px solid #ddd; font-weight: bold; font-size: 10px;">{{ $order->order_code }} - {{ $order->customer->name ?? '-' }}</td>
                                    <td style="padding: 6px; border: 1px solid #ddd; font-weight: bold; font-size: 10px; width: 60%;"></td>
                                    <td style="padding: 6px; border: 1px solid #ddd; font-weight: bold; font-size: 10px; text-align: right; width: 40%;"></td>
                                </tr>
                            </thead> --}}
                            <tbody>
                                @foreach($order->services as $service)
                                    <tr>
                                        {{-- <td style="padding: 4px; border: 1px solid #ddd; font-size: 10px;"></td> --}}
                                        <td style="padding: 4px; border: 1px solid #ddd; font-size: 10px;">
                                            {{ $service->service_name }}
                                            @if($service->is_custom)
                                                <span class="custom-label">(Custom)</span>
                                            @endif
                                        </td>
                                        <td style="padding: 4px; border: 1px solid #ddd; font-size: 10px; text-align: right;">
                                            Rp {{ number_format($service->price, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                @endforeach
            @endif
        @endforeach
        @endif

    {{-- BY STATUS --}}
    @elseif($export_type === 'by_status')
        @if(empty($report_data))
            <div style="text-align: center; padding: 40px; color: #0f4c63; font-size: 14px;">
                <p>Tidak Ada Data</p>
            </div>
        @else
        @if(!empty($selected_customers))
            <div style="background: #e8ecf1; padding: 10px 12px; margin-bottom: 15px; border-left: 3px solid #0f4c63; font-size: 11px;">
                <strong>Filter Pelanggan:</strong> {{ implode(', ', $selected_customers) }}
            </div>
        @endif
        <div class="section-title">Status Pembayaran</div>
        @foreach($report_data as $status_summary)
            <div class="subsection-title">
                {{ $status_summary['status'] }} ({{ $status_summary['count'] }} pesanan)
                <span style="font-weight: normal; font-size: 10px; color: #0f4c63;">
                    - Rp {{ number_format($status_summary['total_amount'], 0, ',', '.') }}
                </span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th class="text-left">Kode Pesanan</th>
                        <th class="text-left">Customer</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-left">Package</th>
                        <th class="text-right">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($status_summary['orders'] as $order)
                        <tr>
                            <td class="text-left">{{ $order->order_code }}</td>
                            <td class="text-left">{{ $order->customer->name ?? '-' }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($order->event_date)->format('d-m-Y') }}</td>
                            <td class="text-left">{{ $order->package->name ?? '-' }}</td>
                            <td class="text-right">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="subtotal-row">
                        <td colspan="4" class="text-left">Subtotal</td>
                        <td class="text-right">Rp {{ number_format($status_summary['total_amount'], 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>

            {{-- SERVICES FOR THIS STATUS --}}
            @php
                $statusHasServices = collect($status_summary['orders'])->some(fn($o) => $o->services && $o->services->count() > 0);
            @endphp
            @if($statusHasServices)
                <div style="margin-top: 10px; font-size: 10px; color: #666; margin-bottom: 5px;">Layanan/Service Detail:</div>
                @foreach($status_summary['orders'] as $order)
                    @if($order->services && $order->services->count() > 0)
                        <table style="margin-bottom: 8px;">
                            {{-- <thead>
                                <tr style="background: #e8ecf1;">
                                    <td style="padding: 6px; border: 1px solid #ddd; font-weight: bold; font-size: 10px;">{{ $order->order_code }} - {{ $order->customer->name ?? '-' }}</td>
                                    <td style="padding: 6px; border: 1px solid #ddd; font-weight: bold; font-size: 10px; width: 60%;"></td>
                                    <td style="padding: 6px; border: 1px solid #ddd; font-weight: bold; font-size: 10px; text-align: right; width: 40%;"></td>
                                </tr>
                            </thead> --}}
                            <tbody>
                                @foreach($order->services as $service)
                                    <tr>
                                        {{-- <td style="padding: 4px; border: 1px solid #ddd; font-size: 10px;"></td> --}}
                                        <td style="padding: 4px; border: 1px solid #ddd; font-size: 10px;">
                                            {{ $service->service_name }}
                                            @if($service->is_custom)
                                                <span class="custom-label">(Custom)</span>
                                            @endif
                                        </td>
                                        <td style="padding: 4px; border: 1px solid #ddd; font-size: 10px; text-align: right;">
                                            Rp {{ number_format($service->price, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                @endforeach
            @endif
        @endforeach
        @endif
    @endif

</body>
</html>
