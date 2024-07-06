<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Qoute</title>
    <style>
        body {
            position: relative;
            color: #555555;
            background: #FFFFFF;
            font-size: 14px;
            margin: 10;
            padding: 10;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 960px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #0087C3;
            text-decoration: none;
        }



        header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #AAAAAA;
        }

        #logo {
            float: left;
            margin-top: 8px;
        }

        #logo img {
            height: 70px;
        }

        #company {
            float: right;
            text-align: right;
        }


        #details {
            margin-bottom: 50px;
        }

        #client {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
            float: left;
        }

        #client .to {
            color: #777777;
        }

        h2.name {
            font-size: 1.4em;
            font-weight: normal;
            margin: 0;
        }

        #invoice {
            float: right;
            text-align: right;
        }

        #invoice h1 {
            color: #0087C3;
            font-size: 2.4em;
            line-height: 1em;
            font-weight: normal;
            margin: 0 0 10px 0;
        }

        #invoice .date {
            font-size: 1.1em;
            color: #777777;
        }

        table {
            width: 100%;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 20px;
            background: #EEEEEE;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
        }

        table th {
            white-space: nowrap;
            font-weight: normal;
        }

        table td {
            text-align: right;
        }

        table td h3 {
            color: #57B223;
            font-size: 1.2em;
            font-weight: normal;
            margin: 0 0 0.2em 0;
        }

        table .no {
            color: #FFFFFF;
            font-size: 1.6em;
            background: #57B223;
        }

        table .desc {
            text-align: left;
        }

        table .unit {
            background: #DDDDDD;
        }

        table .qty {}

        table .total {
            background: #57B223;
            color: #FFFFFF;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table tbody tr:last-child td {
            border: none;
        }

        table tfoot td {
            padding: 10px 20px;
            background: #FFFFFF;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-top: 1px solid #AAAAAA;
        }

        table tfoot tr:first-child td {
            border-top: none;
        }

        table tfoot tr:last-child td {
            color: #57B223;
            font-size: 1.4em;
            border-top: 1px solid #57B223;

        }

        table tfoot tr td:first-child {
            border: none;
        }

        #thanks {
            font-size: 2em;
            margin-bottom: 50px;
        }

        #notices {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
        }

        #notices .notice {
            font-size: 1.2em;
        }

        footer {
            color: #777777;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #AAAAAA;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container pdf-load">
        <header class="clearfix">
            <div id="logo">
                <img src="{{ public_path('storage/'.$company->logo) }}" alt="Company Logo">
            </div>
            <div id="company">
                <h2 class="name">{{$company->name ?? ''}}</h2>
                <div>{{$company->address ?? ''}}</div>
                <div>{{$company->phone ?? ''}}</div>
                <div><a href="mailto:{{$company->email ?? ''}}">{{$company->email ?? ''}}</a></div>
            </div>
        </header>
        <main>
            <div id="details" class="clearfix">
                <div id="client">
                    <div class="to">INVOICE TO:</div>
                    <h2 class="name">{{$qoute['client_name'] ?? ''}}</h2>
                    <div class="address">{{$qoute['client_address'] ?? ''}}</div>
                    <div class="email"><a href="mailto:{{$qoute['client_email'] ?? ''}}">{{$qoute['client_email'] ?? ''}}</a></div>
                </div>
                <div id="invoice">
                    <h1>INVOICE</h1>
                    <div class="date">Date of Invoice: {{$qoute['inv_date'] ?? ''}}</div>
                    <div class="date">Due Date: {{$qoute['due_date'] ?? ''}}</div>
                </div>
            </div>
            <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="no" style="width: 10%;">#</th>
                        <th class="desc" style="width: 60%;">SERVICE DETAILS</th>
                        <th class="total" style="width: 30%;"> SERVICE PRICE</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_amount = 0;
                    @endphp

                    @foreach($qoute['service_id'] ?? [] as $key => $sevcie)

                    @php

                    $total_amount += $qoute['s_amount'][$key];
                    @endphp

                    <tr>
                        <td class="no">{{ $key}}</td>
                        <td class="desc">
                            <h3>{{$sevcie ?? ''}}</h3>{{ $qoute['s_desc'][$key]}}
                        </td>
                        <td class="total">${{ $qoute['s_amount'][$key]}}</td>
                    </tr>

                    @endforeach
                </tbody>
                <tfoot>
                    @php
                    $discount_percentage = floatval($qoute['discount']);
                    $discount_amount = ($total_amount * $discount_percentage) / 100;
                    $final_amount = $total_amount - $discount_amount;
                    @endphp
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">SUBTOTAL</td>
                        <td>${{ $total_amount ?? ''}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">Discount {{$discount_percentage ?? '0'}}%</td>
                        <td>${{$discount_amount ?? '' }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">GRAND TOTAL</td>
                        <td>${{ $final_amount ?? ''}}</td>
                    </tr>
                </tfoot>
            </table>
            <div id="thanks">Thank you!</div>
            <div id="notices">
                <div>NOTICE:</div>
                <div class="notice"> {{$qoute['template_body'] ?? ''}}</div>
            </div>
        </main>
        <footer>
            Invoice was created on a computer and is valid without the signature and seal.
        </footer>
    </div>
</body>

</html>