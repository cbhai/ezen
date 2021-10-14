<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $invoice->name }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style type="text/css" media="screen">
        html {
            font-family: sans-serif;
            line-height: 1.15;
            margin: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
            font-size: 10px;
            margin: 16pt;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;
            color: #777;

            /* position: fixed;
            bottom: 0cm;
            width: 100%;
            text-align: center;
            color: #777; */
            /* border-top: 1px solid #aaa;
            padding: 8px 0 */
        }

        h4 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        strong {
            font-weight: bolder;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        table {
            border-collapse: collapse;
        }

        th {
            text-align: inherit;
        }

        h4,
        .h4 {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        h4,
        .h4 {
            font-size: 1.5rem;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        /* .main-td {
                vertical-align: top;
                border-top: 1px solid #dee2e6;
            } */

        .head-table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .room-table {
            width: 70%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .main-table th,
        .main-table td {
            padding: 0.75rem;
            vertical-align: top;
            /* border-top: 1px solid #dee2e6; */
        }

        .table thead th {
            vertical-align: bottom;
            /* border-bottom: 2px solid #dee2e6; */
            border-bottom: 1px solid #0d6efd
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .mt-5 {
            margin-top: 3rem !important;
        }

        .pr-0,
        .px-0 {
            padding-right: 0 !important;
        }

        .pl-0,
        .px-0 {
            padding-left: 0 !important;
        }

        .text-right {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-uppercase {
            text-transform: uppercase !important;
        }

        * {
            font-family: "DejaVu Sans";
        }

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        table,
        th,
        tr,
        td,
        p,
        div {
            line-height: 1.1;
        }

        .party-header {
            font-size: 1.5rem;
            font-weight: 400;
        }

        .total-amount {
            font-size: 12px;
            font-weight: 700;
        }

        .border-0 {
            border: none !important;
        }

        .page-break {
            page-break-after: always;
        }


        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #0d6efd
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #0d6efd
        }

        .invoice .room-name {
            margin-top: 0;
            color: #0d6efd
        }

        .invoice .estimate-title {
            margin-top: 0;
            color: #0d6efd
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice .thanks {
            margin-top: 50px;
            font-size: 2em;
            /* margin-bottom: 50px */
        }

        .invoice .notices {
            padding-left: 6px;
            border-left: 6px solid #0d6efd;
            background: #e7f2ff;
            padding: 10px;
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }


        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        .invoice table td,
        .invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #0d6efd;
            font-size: 1.2em
        }

        .invoice table .workitem {
            width: 60%;

        }

        .invoice table .qty,
        .invoice table .rate,
        .invoice table .total,
        .invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #0d6efd
        }

        .invoice table .rate {
            background: #ddd
        }

        .invoice table .total {
            background: #0d6efd;
            color: #fff
        }

        .invoice table tbody tr:last-child td {
            border: none
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }

        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0px solid rgba(0, 0, 0, 0);
            border-radius: .25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
        }

        .invoice table tfoot tr:last-child td {
            color: #0d6efd;
            font-size: 1.4em;
            border-top: 1px solid #0d6efd
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }

    </style>
</head>

<body>
    {{-- First Page Header --}}
    <table class="head-table">
        <tbody>
            <tr>
                <td class="pl-0 border-0" width="70%">
                    @if ($invoice->logo)
                        <img src="{{ $invoice->getLogoFileNow() }}" alt="logo" height="100">
                    @endif
                </td>
                <td class="pl-0 border-0">
                    <h4 class="text-uppercase">
                        <strong>{{ $invoice->name }}</strong>
                    </h4>
                    {{-- <p>{{ __('invoices::estimate.date') }}: <strong>{{ $invoice->getDate() }}</strong></p> --}}
                    <p>{{ __('invoices::estimate.date') }}:
                        <strong>{{ $invoice->estimateItem->estimate_date }}</strong>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table mt-1">
        <tbody>
            <tr>
                <td class="pl-0 border-0" width="70%">
                    <h2>{{ $invoice->buyer->name }}</h2>
                    {{ $invoice->buyer->address }}<br>
                    {{ $invoice->buyer->city . ', ' . $invoice->buyer->state }}<br>
                    <strong>Phone: </strong>{{ $invoice->buyer->phone }}<br>
                    <strong>Email: </strong>{{ $invoice->buyer->email }}
                    <div class="invoice">
                        <div class="estimate-title">
                            <h2>{{ $invoice->estimateItem->estimate_title }}</h2>
                        </div>
                    </div>
                </td>
                <td class="pl-0 border-0">
                    <p><strong>{{ $invoice->seller->business_name }}</strong></p>
                    <p><strong>{{ $invoice->seller->name }}</strong></p>
                    <p>{{ $invoice->seller->address }}<br>
                        {{ $invoice->seller->city . ', ' . $invoice->seller->state }}<br>
                        <strong>Phone: </strong>{{ $invoice->seller->phone }}<br>
                        <strong>Email: </strong>{{ $invoice->seller->email }}
                    </p>
                </td>
            </tr>
        </tbody>
    </table>


    <div class="invoice">
        {{-- Starts Room Table --}}
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th class="text-left">ROOM DESCRIPTION</th>
                    <th class="text-right">SUB TOTAL</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($invoice->rooms as $key => $room)
                    <tr>
                        <td class="no">{{ $key + 1 }}</td>
                        <td class="text-left">
                            <h3>{{ $room->room_title }}</h3>
                        </td>
                        <td class="total">{{ $room->room_total }}</td>
                    </tr>
                @endforeach
            <tfoot>
                <tr>
                    <td></td>
                    <td>GRAND TOTAL</td>
                    <td>{{ 'Rs ' . $invoice->estimateItem->estimate_total }}</td>
                </tr>
            </tfoot>
            </tbody>
        </table>
        {{-- End Room Table --}}
    </div>

    <br><br><br>
    <div class="invoice">
        <div class="notices">
            <div>TERMS:</div>
            <div class="notice">{!! $invoice->estimateItem->estimate_terms !!}</div>
        </div>
    </div>

    <br><br><br>
    <p>If you have any questions, please contact - {{ $invoice->seller->name }} - {{ $invoice->seller->phone }}
    </p>


    {{-- This page break kept here to make sure Header & footer dont come on first page --}}
    {{-- Individual Room Itemised Estimate starts here --}}
    {{-- Start first room detail page --}}
    <div class="page-break"></div>

    <header>
        @if ($invoice->estimateItem->estimate_add_header)
            <table>
                <tr>
                    <td>{{ $invoice->estimateItem->estimate_header }}</td>
                </tr>
            </table>
        @endif
    </header>

    <footer>
        @if ($invoice->estimateItem->estimate_add_footer)
            <table>
                <tr>
                    <td>{{ $invoice->estimateItem->estimate_footer }}</td>
                </tr>
            </table>
        @endif
    </footer>


    @foreach ($invoice->rooms as $key => $room)
        {{-- To avoid page break on first room detail page --}}
        @if ($key > 0)
            <div class="page-break"></div>
        @endif

    <div class="invoice">
        <div class="room-name">
            <h1>ROOM: {{ $room->room_title }}</h1>
        </div>
        <div class="text-gray-light"><h2>Itemised Costs</h2></div>
    </div>


        <div class="invoice">



            {{-- Table --}}
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-left">DESCRIPTION</th>
                        <th class="text-right">RATE</th>
                        <th class="text-left">UNIT</th>
                        <th class="text-right">QUANTITY</th>
                        <th class="text-right">SUB TOTAL</th>
                    </tr>
                </thead>
                @foreach ($room->workitems as $key => $i){
                    @foreach ($i as $a){
                        <tr>
                            <td class="no">{{ $key + 1 }}</td>
                            <td class="workitem">
                                <h3>{{ $a->workitemName }}</h3>{{ $a->workitemDescription }}
                            </td>
                            <td class="rate">{{ $a->workitemRate }}</td>
                            <td class="unit">{{ $a->workitemUnit }}</td>
                            <td class="qty">{{ $a->workitemQuantity }}</td>
                            <td class="total">{{ $a->workitemTotal }}</td>

                        </tr>

                    @endforeach
                @endforeach
                <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">ROOM TOTAL</td>
                        <td colspan="2">{{ 'Rs ' . $room->room_total }}</td>
                    </tr>
                </tfoot>
            </table>


    @endforeach


    <br><br><br>

    <div class="thanks">Thank you!</div>
    </div>

        {{-- {{ trans('invoices::invoice.amount_in_words') }}: {{ $invoice->getTotalAmountInWords() }} --}}
        {{-- {{ trans('invoices::invoice.pay_until') }}: {{ $invoice->getPayUntilDate() }} --}}

    <script type="text/php">
        if (isset($pdf) && $PAGE_COUNT > 1) {
                        $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
                        $size = 10;
                        $font = $fontMetrics->getFont("Verdana");
                        $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                        $x = ($pdf->get_width() - $width);
                        $y = $pdf->get_height() - 15;
                        $pdf->page_text($x, $y, $text, $font, $size);
                    }
                </script>
</body>

</html>
