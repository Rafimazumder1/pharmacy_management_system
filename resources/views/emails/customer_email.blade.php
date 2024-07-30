<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $data['subject'] }}</title>
    <style>
        body, body * {
            font-family: "Montserrat", Helvetica, Arial, serif;
            font-size: 14px;
            line-height: 1.6em;
            margin: 0;
            padding: 0;
        }

        /* Responsive styles */
        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
            }
        }
    </style>
</head>
<body>
<table class="container" cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse:collapse;">
    <tr>
        <td align="center" valign="top">
            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse:collapse;">
                <tr>
                    <td>
                        <img src="{{ $data['logo'] }}" alt="{{ $data['site_name'] }}" width="150" height="auto" style="display:block; margin:20px auto;">
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse:collapse; background-color:#f2f2f2; border-radius:6px; margin-top:20px;">
                <tr>
                    <td align="left" valign="top" style="padding:40px;">
                        <p style="color:#666; font-size:16px; line-height:1.6em;">
                            Subject: {{ $data['subject'] }}
                        </p>
                        <p style="color:#666; font-size:16px; line-height:1.6em;">
                            Dear {{ $data['customer_name'] }}
                        </p>
                        <p style="color:#666; font-size:16px; line-height:1.6em;">
                            {{ $data['body'] }}
                        </p>
                        <br>
                        <p style="color:#666; font-size:16px; line-height:1.6em;">
                            Best regards,<br>
                            {{ $data['company_owner'] }}<br>
                            {{ $data['site_name'] }}<br>
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
