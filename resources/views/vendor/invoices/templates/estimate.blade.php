<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $invoice->name }}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

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
                height: 2cm;
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

            h4, .h4 {
                margin-bottom: 0.5rem;
                font-weight: 500;
                line-height: 1.2;
            }

            h4, .h4 {
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
                border-bottom: 2px solid #dee2e6;
            }

            .table tbody + tbody {
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
            body, h1, h2, h3, h4, h5, h6, table, th, tr, td, p, div {
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
        </style>
    </head>

    <body>

        {{-- First Page Header --}}
        <table class="head-table">
            <tbody>
                <tr>
                    <td class="pl-0 border-0" width="70%">
                        @if($invoice->logo)
                            <img src="{{ $invoice->getLogo() }}" alt="logo" height="100">
                        @endif
                    </td>
                    <td class="pl-0 border-0">
                        <h4 class="text-uppercase">
                            <strong>{{ $invoice->name }}</strong>
                        </h4>
                        {{-- <p>{{ __('invoices::estimate.date') }}: <strong>{{ $invoice->getDate() }}</strong></p> --}}
                        <p>{{ __('invoices::estimate.date') }}: <strong>{{ $invoice->estimateItem->estimate_date }}</strong></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table mt-1">
            <tbody>
                <tr>
                    <td class="pl-0 border-0" width="70%">
                        <p><strong>{{$invoice->estimateItem->estimate_title}}</strong></p>
                        <p>{{$invoice->buyer->name}}</p>
                        <p>{{$invoice->buyer->address}}<br>
                        {{$invoice->buyer->city . ', ' . $invoice->buyer->state}}<br>
                        {{$invoice->buyer->phone}}<br>
                        {{$invoice->buyer->email}}</p>
                    </td>
                    <td class="pl-0 border-0">
                        <p><strong>{{$invoice->seller->business_name}}</strong></p>
                        <p><strong>{{$invoice->seller->name}}</strong></p>
                        <p>{{$invoice->seller->address}}<br>
                        {{$invoice->seller->city . ', ' . $invoice->seller->state}}<br>
                        <strong>Phone: </strong>{{$invoice->seller->phone}}<br>
                        <strong>Email: </strong>{{$invoice->seller->email}}</p>
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- Room Table --}}
        <table class="room-table border-1">
            <thead>
                <tr>
                    <th scope="col"  width="20%" class="pl-0 text-center border-0 main-td">#</th>
                    <th scope="col"  width="50%" class="pl-0 text-center border-0 main-td">{{ __('invoices::invoice.room_description') }}</th>
                    <th scope="col" width="30%"  class="pl-0 text-center border-0 main-td">{{ __('invoices::invoice.sub_total') }}</th>
                </tr>
            </thead>
            <tbody>

                @foreach($invoice->rooms as $key => $room)
                <tr>
                    <td class="pl-0 text-center">{{$key + 1 }}</td>
                    <td class="pl-0 text-left">{{ $room->room_title }}</td>
                    <td class="pl-0 text-right">{{ $room->room_total }}</td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td class="pl-0 text-right">{{ __('invoices::invoice.total_amount') }}</td>
                    <td class="pr-0 text-right total-amount">
                        {{-- {{ $invoice->formatCurrency($invoice->estimateItem->estimate_total) }} --}}
                        {{ 'Rs ' . $invoice->estimateItem->estimate_total }}</td>
                </tr>
            </tbody>
        </table>
        <br><br><br>
        <p>{{ trans('invoices::estimate.terms') }}: {!! $invoice->estimateItem->estimate_terms !!}</p>
        <br><br><br>
        <p>If you have any questions, please contact - {{$invoice->seller->name}} - {{$invoice->seller->phone}}</p>


        @foreach($invoice->rooms as $room)
            <p>Page breaks here</p>
                <div class="page-break"></div>
            <p>Page starts here</p>

            <header>
                <table>
                    <tr>
                        <td>small logo</td>
                        <td>Company Name</td>
                    </tr>
                </table>
            </header>

            <footer>
                <table>
                    <tr>
                        <td>Phone</td>
                        <td>Email</td>
                    </tr>
                </table>
                {{-- <img src="footer.png" width="100%" height="100%"/> --}}
            </footer>
                    <h4>Room : {{$room->room_title}}</h4>
                    <p>Itemised Costs</p>
                    {{-- Table --}}
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"  width="20%" class="pl-0 text-center border-0">Workitem Name</th>
                                <th scope="col"  width="40%" class="pl-0 text-center border-0">Description</th>
                                <th scope="col" width="10%"  class="pl-0 text-center border-0">Rate</th>
                                <th scope="col"  width="5%" class="pl-0 text-center border-0">Unit</th>
                                <th scope="col"  width="10%" class="pl-0 text-center border-0">Quantity</th>
                                <th scope="col"  width="15%" class="pl-0 text-center border-0">Total</th>
                            </tr>
                        </thead>
                        @foreach($room->workitems as $i){
                            @foreach($i as $a){

                                <tr>
                                    <td class="pl-0">{{ $a->workitemName }}</td>
                                    <td class="pl-0">{{ $a->workitemDescription }}</td>
                                    <td class="pl-0">{{ $a->workitemRate }}</td>
                                    <td class="pl-0">{{ $a->workitemUnit }}</td>
                                    <td class="pl-0">{{ $a->workitemQuantity }}</td>
                                    <td class="pl-0">{{ $a->workitemTotal }}</td>

                                </tr>
                            @endforeach
                        @endforeach

                        <tr>
                            {{-- <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td> --}}
                            <td colspan="4" class="border-0"></td>
                            <td class="pl-0 text-right">{{ __('invoices::estimate.sub_total') }}</td>
                            <td class="pr-0 text-right total-amount">
                                {{-- {{ $invoice->formatCurrency($room->room_total)}} --}}
                                {{ "Rs " . $room->room_total}}
                            </td>
                        </tr>
                    </table>
            @endforeach



        <p>
            {{-- {{ trans('invoices::invoice.amount_in_words') }}: {{ $invoice->getTotalAmountInWords() }} --}}
        </p>
        <p>
            {{-- {{ trans('invoices::invoice.pay_until') }}: {{ $invoice->getPayUntilDate() }} --}}
        </p>

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
