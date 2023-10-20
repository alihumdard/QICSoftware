<!DOCTYPE html>
<html>

<head>
    <title>Invoice Payment Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }

        h3 {
            color: #333333;
            margin-bottom: 20px;
        }

        h2 {
            color: #555555;
            margin-bottom: 20px;
        }

        .message {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
        }

        .logo {
            text-align: left;
        }

        .logo img {
            display: block;
            margin: 0;
            max-width: 200px;
            height: auto;
        }

        @media (max-width: 1100px) {
            .logo {
                margin-left: 39% !important;
            }
        }
    </style>
</head>

<body style="background-color: #f9f9f9;">
    <div class="container" style="text-align: center;">
        <div class="logo" style="margin-left: 42%;">
            <img src="{{ $message->embed(public_path('assets/images/Logo.png')) }}" alt="logo" />
        </div>
        <h3>Dear, {{ $emailData['name'] }}</h3>
        <div class="message">
            <div dir="ltr">We hope you're doing well.<br><br>We would like to bring to your attention the presence of an outstanding invoice from Tech Solutions Pro Ltd in your account. Kindly take a moment to review the details provided in the attached invoice and facilitate the payment at your earliest convenience.<br><br><b>Important Note:</b><br>Your cooperation in settling this matter promptly is highly appreciated.<br><br>If you have already settled this invoice, please accept our thanks. We kindly request you reply to this email and confirm the payment so we can mark this transaction as complete.<br><br>Should you have any queries or require further clarification, feel free to reply to this email<br><br>Thank you for your attention to this matter.<br><br><br><br>
                <font size="1">Terms and Conditions:<br>This communication, including any attachments, is strictly confidential and intended solely for the named recipient(s). If you are not the intended recipient, please notify us immediately and delete this email from your system. Any unauthorized use, disclosure, or copying of this message is strictly prohibited.</font><br clear="all">
                <div><br></div>
                <div dir="ltr" class="gmail_signature" data-smartmail="gmail_signature">
                    <div dir="ltr">
                        <div dir="ltr">
                            <font color="#222222">Regards,</font><br>
                            <div dir="ltr" style="color:rgb(34,34,34)">
                                <div dir="ltr">
                                    <table style="color:rgb(25,28,43);font-family:Mulish,sans-serif;font-size:16px;direction:ltr;border-collapse:collapse">
                                        <tbody>
                                            <tr>
                                                <td style="font-size:0px;height:12px;line-height:0px"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width:598px">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <table cellpadding="0" cellspacing="0" style="border-collapse:collapse;font-family:Arial;line-height:1.15;color:rgb(0,0,0)">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="vertical-align:top;padding:0.01px 14px 0.01px 1px;width:65px;text-align:center"><a href="http://www.techsolutionspro.co.uk/" rel="nofollow noreferrer" style="color:rgb(17,85,204);display:block" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://www.techsolutionspro.co.uk/&amp;source=gmail&amp;ust=1697920391052000&amp;usg=AOvVaw1rdNCrxlVEnDFnNau5Oo0T"><img src="https://ci3.googleusercontent.com/proxy/XIB4U9IxLHEb5EeXqFDD6VYIqUQrLbdSHLCbOrOq_zGrhATTxynmQKcokCINn2Ftmc4i7N21mTVHl3gOYNXFFZgb2GDwaFNNUtMz4V8LBCnae5zuGhdt_zvyBXAXGxLGaBC1hA=s0-d-e1-ft#https://d36urhup7zbd7q.cloudfront.net/a/5b404573-8907-4f2e-960e-0b48cb72afc8.jpeg" height="65" width="65" alt="photo" style="width:65px;vertical-align:middle;border-radius:0px;height:65px" class="CToWUd" data-bit="iit"></a></td>
                                                                                <td valign="top" style="padding:0.01px 0.01px 0.01px 14px;vertical-align:top;border-left:1px solid rgb(189,189,189)">
                                                                                    <table cellpadding="0" cellspacing="0" style="border-collapse:collapse">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td style="padding:0.01px">
                                                                                                    <p style="margin:0.1px;line-height:19.2px"><span style="text-transform:initial;font-weight:bold;color:rgb(100,100,100);letter-spacing:0px">Hamza Sharif</span><br><span style="text-transform:initial;font-weight:bold;color:rgb(100,100,100);font-size:13px">CEO,&nbsp;</span><span style="text-transform:initial;font-weight:bold;color:rgb(100,100,100);font-size:13px">Tech Solutions Pro</span></p>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <table cellpadding="0" cellspacing="0" style="border-collapse:collapse">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td nowrap="" width="315" style="padding-top:14px;width:315px">
                                                                                                                    <p style="margin:1px;line-height:10.89px;font-size:11px;color:rgb(33,33,33)"><a href="tel:01159902782" rel="nofollow noreferrer" style="color:rgb(17,85,204);text-decoration:unset" target="_blank"><span style="line-height:13.2px;color:rgb(33,33,33)">01159902782</span>&nbsp;</a>&nbsp;|&nbsp;&nbsp;<a href="https://www.techsolutionspro.co.uk/" rel="nofollow noreferrer" style="color:rgb(17,85,204);text-decoration:unset" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.techsolutionspro.co.uk/&amp;source=gmail&amp;ust=1697920391052000&amp;usg=AOvVaw0AOdnZi6qeUYXH6acYJPZZ"><span style="line-height:13.2px;color:rgb(33,33,33)">www.<wbr>techsolutionspro.co.uk</span></a></p>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td nowrap="" width="234" style="padding-top:7px;width:234px">
                                                                                                                    <p style="margin:1px;line-height:10.89px;font-size:11px;color:rgb(33,33,33)"><a href="mailto:hamza@techsolutionspro.co.uk" rel="nofollow noreferrer" style="color:rgb(17,85,204);text-decoration:unset" target="_blank"><span style="line-height:13.2px;color:rgb(33,33,33)">hamza@techsolutionspro.co.uk</span></a></p>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td nowrap="" width="623" style="padding-top:7px;width:623px">
                                                                                                                    <p style="margin:1px;line-height:10.89px;font-size:11px;color:rgb(33,33,33)"><a href="https://maps.google.com/?q=Unit%209,%20Lendal%20Court,%20Gamble%20St,%20Radford,%20Nottingham%20NG7%204EZ,%20United%20Kingdom" rel="nofollow noreferrer" style="color:rgb(17,85,204);text-decoration:unset" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://maps.google.com/?q%3DUnit%25209,%2520Lendal%2520Court,%2520Gamble%2520St,%2520Radford,%2520Nottingham%2520NG7%25204EZ,%2520United%2520Kingdom&amp;source=gmail&amp;ust=1697920391052000&amp;usg=AOvVaw14yH6C7unt0kvcpEyjPqUS"><span style="line-height:13.2px;color:rgb(33,33,33)">Unit 9, Lendal Court, Gamble St, Radford, Nottingham NG7 4EZ, United Kingdom</span></a></p>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td style="padding:14px 0.01px 0.01px">
                                                                                                    <table border="0" cellpadding="0" cellspacing="0">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td align="left" style="padding-right:6px;text-align:center;padding-top:0px">
                                                                                                                    <p style="margin:1px"><a href="https://www.facebook.com/techsoltionspro" rel="nofollow noreferrer" style="color:rgb(17,85,204)" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.facebook.com/techsoltionspro&amp;source=gmail&amp;ust=1697920391053000&amp;usg=AOvVaw1sTbt_FpwZV--mtQ20LgnH"><img width="24" height="24" src="https://ci3.googleusercontent.com/proxy/AY_DwkmUfVhEa9uVhUR1haTPS16PKx-WO_8cqsgun-_oKAc_vLGUz1KUI0fwtC-0_szF13duipuOPQpbxJ3o1HGl1esnwVnQ_1CuHWII9QIQ=s0-d-e1-ft#https://cdn.gifo.wisestamp.com/s/fb/3b5998/48/0/background.png" border="0" alt="facebook" style="float:left;border:none" class="CToWUd" data-bit="iit"></a></p>
                                                                                                                </td>
                                                                                                                <td align="left" style="padding-right:6px;text-align:center;padding-top:0px">
                                                                                                                    <p style="margin:1px"><a href="https://www.instagram.com/techsolutionspro/" rel="nofollow noreferrer" style="color:rgb(17,85,204)" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.instagram.com/techsolutionspro/&amp;source=gmail&amp;ust=1697920391053000&amp;usg=AOvVaw1YpQfxV7XeKrtoz0qoFVzQ"><img width="24" height="24" src="https://ci4.googleusercontent.com/proxy/it__7gvbkVE2SaYBV_v4PQIy12AAePLME9nz-M-9bqrlC1y3Yy42cBe7QDGkkQ8-i_7cHWlUJi2N883ArfFkt9rJo2pBcnbdgzahKtYvcBRJico=s0-d-e1-ft#https://cdn.gifo.wisestamp.com/s/inst/E4405F/48/0/background.png" border="0" alt="instagram" style="float:left;border:none" class="CToWUd" data-bit="iit"></a></p>
                                                                                                                </td>
                                                                                                                <td align="left" style="padding-right:6px;text-align:center;padding-top:0px">
                                                                                                                    <p style="margin:1px"><a href="https://www.linkedin.com/company/tech-solutions-pro/" rel="nofollow noreferrer" style="color:rgb(17,85,204)" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.linkedin.com/company/tech-solutions-pro/&amp;source=gmail&amp;ust=1697920391053000&amp;usg=AOvVaw3hN0xtP58vZj-HXsRO_EJ3"><img width="24" height="24" src="https://ci6.googleusercontent.com/proxy/Ou2wrROMDIdk_X0noymrKrqkpzrOi67jsXesYeTvMtPOS48It7bryWZA0tqNv0-JL1elGU8xeno6T9xX8Nx-cQgKSscvnCHBlIxXLPbFx3GG=s0-d-e1-ft#https://cdn.gifo.wisestamp.com/s/ld/0077b5/48/0/background.png" border="0" alt="linkedin" style="float:left;border:none" class="CToWUd" data-bit="iit"></a></p>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="yj6qo"></div>
                        <div dir="ltr" class="adL"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <p>
                Thank you for your continued partnership with TechSolution Pro.! We are excited to offer a wide range of services to meet your needs. Whether you're looking for web development, design, marketing, or more, our team is here to help. Discover all our services and explore how we can assist you by visiting our website.
            </p>
            <a href="https://techsolutionspro.co.uk/">
                <strong>Visit our website for more services</strong>
            </a>
        </div>
    </div>
</body>

</html>