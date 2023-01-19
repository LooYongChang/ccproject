<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .invoice-box
    {
        max-width: 800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0,0,0,0.15);
        font-size:16px;
        line-height:24px;
    }

    .invoice-box table
    {
        width:100%;
        line-height:inherit;
        text-align:left;
    }

    .invoice-box table td
    {
        padding:5px;
        vertical-align:top;
    }

    .invoice-box table tr td:nth-child(2)
    {
        text-align:right;
    }

    .invoice-box table tr .top table td
    {
        padding-bottom:20px;
    }

    .invoice-box table tr .information table td
    {
        padding-bottom:40px;
    }

    .invoice-box table tr.heading td
    {
        background:#eee;
        border-bottom: 1px solid #ddd;
        font-weight:bold;

    }

    .invoice-box table tr.details td
    {
        padding-bottom:20px;
    }

    .invoice-box table tr.item td
    {
        border-bottom:1px solid #eee;
    }
    </style>
</head>
<body>
<div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    <h4>Aiture Furniture</h4>
                                </td>

                                <td>
                                    Invoice #: 123<br>
                                    Created: oct 17,2021<br>
                                </td>
                            </tr>
                        </table>
                            <!-- End the table -->
                    </td>
                </tr>

                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    jojo, johor<br>
                                    Phone: 0123456789<br>
                                </td>

                                <td>
                                    Main Admin : jojo<br>
                                    Staff: zzx<br>
                                    Email:aiture1232022@gmail.com<br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="heading">
                    <td>
                        Payment Method
                    </td>
                    <td>
                        Check #
                    </td>
                </tr>

                <tr class="details">
                    <td>Check</td>
                    <td>1000</td>
                </tr>

                <tr class="heading">
                    <td>Item</td>
                    <td>Price</td>
                </tr>

                <tr class="item">
                    <td>abctable</td>
                    <td>Rm 3213</td>
                </tr>
            </table>
        </div>
    
</body>
</html>