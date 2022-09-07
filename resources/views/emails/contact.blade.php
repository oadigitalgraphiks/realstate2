<!DOCTYPE html>
<html>

<head>
    <meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
    <meta content='width=device-width, initial-scale=1.0' name='viewport'>
    <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible'>
    <meta content='telephone=no' name='format-detection'>
    <style type='text/css'>
        html {
            background-color: #E1E1E1;
            margin: 0;
            padding: 0;
        }

        body,
        #bodyTable,
        #bodyCell,
        #bodyCell {
            height: 100% !important;
            margin: 0;
            padding: 0;
            width: 100% !important;
            font-family: Helvetica, Arial, 'Lucida Grande', sans-serif;
        }

        table {
            border-collapse: collapse;
        }

        table[id=bodyTable] {
            width: 100% !important;
            margin: auto;
            max-width: 500px !important;
            color: #7A7A7A;
            font-weight: normal;
        }

        img,
        a img {
            border: 0;
            outline: none;
            text-decoration: none;
            height: auto;
            line-height: 100%;
        }

        a {
            text-decoration: none !important;
            border-bottom: 1px solid;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #2b9fd9;
            font-weight: normal;
            font-family: Helvetica;
            font-size: 20px;
            line-height: 125%;
            text-align: Left;
            letter-spacing: normal;
            margin-top: 0;
            margin-right: 0;
            margin-bottom: 10px;
            margin-left: 0;
            padding-top: 0;
            padding-bottom: 0;
            padding-left: 0;
            padding-right: 0;
        }

        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        #outlook a {
            padding: 0;
        }

        img {
            -ms-interpolation-mode: bicubic;
            display: block;
            outline: none;
            text-decoration: none;
        }

        body,
        table,
        td,
        p,
        a,
        li,
        blockquote {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            font-weight: normal !important;
        }

        .ExternalClass td[class='ecxflexibleContainerBox'] h3 {
            padding-top: 10px !important;
        }

        h1 {
            display: block;
            font-size: 26px;
            font-style: normal;
            font-weight: normal;
            line-height: 100%;
        }

        h2 {
            display: block;
            font-size: 20px;
            font-style: normal;
            font-weight: normal;
            line-height: 120%;
        }

        h3 {
            display: block;
            font-size: 17px;
            font-style: normal;
            font-weight: normal;
            line-height: 110%;
        }

        h4 {
            display: block;
            font-size: 18px;
            font-style: italic;
            font-weight: normal;
            line-height: 100%;
        }

        .flexibleImage {
            height: auto;
        }

        .linkRemoveBorder {
            border-bottom: 0 !important;
        }

        table[class=flexibleContainerCellDivider] {
            padding-bottom: 0 !important;
            padding-top: 0 !important;
        }

        body,
        #bodyTable {
            background-color: #E1E1E1;
        }

        #emailHeader {
            background-color: #E1E1E1;
        }

        #emailBody {
            background-color: #FFFFFF;
        }

        #emailFooter {
            background-color: #E1E1E1;
        }

        .nestedContainer {
            background-color: #F8F8F8;
            border: 1px solid #CCCCCC;
        }

        .emailButton {
            background-color: #205478;
            border-collapse: separate;
        }

        .buttonContent {
            color: #FFFFFF;
            font-family: Helvetica;
            font-size: 18px;
            font-weight: bold;
            line-height: 100%;
            padding: 15px;
            text-align: center;
        }

        .buttonContent a {
            color: #FFFFFF;
            display: block;
            text-decoration: none !important;
            border: 0 !important;
        }

        .emailCalendar {
            background-color: #FFFFFF;
            border: 1px solid #CCCCCC;
        }

        .emailCalendarMonth {
            background-color: #205478;
            color: #FFFFFF;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 16px;
            font-weight: bold;
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
        }

        .emailCalendarDay {
            color: #205478;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 60px;
            font-weight: bold;
            line-height: 100%;
            padding-top: 20px;
            padding-bottom: 20px;
            text-align: center;
        }

        .imageContentText {
            margin-top: 10px;
            line-height: 0;
        }

        .imageContentText a {
            line-height: 0;
        }

        #invisibleIntroduction {
            display: none !important;
        }

        span[class=ios-color-hack] a {
            color: #275100 !important;
            text-decoration: none !important;
        }

        span[class=ios-color-hack2] a {
            color: #205478 !important;
            text-decoration: none !important;
        }

        span[class=ios-color-hack3] a {
            color: #8B8B8B !important;
            text-decoration: none !important;
        }

        .a[href^='tel'],
        a[href^='sms'] {
            text-decoration: none !important;
            color: #606060 !important;
            pointer-events: none !important;
            cursor: default !important;
        }

        .mobile_link a[href^='tel'],
        .mobile_link a[href^='sms'] {
            text-decoration: none !important;
            color: #606060 !important;
            pointer-events: auto !important;
            cursor: default !important;
        }

        @media only screen and (max-width: 480px) {
            body {
                width: 100% !important;
                min-width: 100% !important;
            }

            table[id='emailHeader'],
            table[id='emailBody'],
            table[id='emailFooter'],
            table[class='flexibleContainer'],
            td[class='flexibleContainerCell'] {
                width: 100% !important;
            }

            td[class='flexibleContainerBox'],
            td[class='flexibleContainerBox'] table {
                display: block;
                width: 100%;
                text-align: left;
            }

            td[class='imageContent'] img {
                height: auto !important;
                width: 100% !important;
                max-width: 100% !important;
            }

            img[class='flexibleImage'] {
                height: auto !important;
                width: 100% !important;
                max-width: 100% !important;
            }

            img[class='flexibleImageSmall'] {
                height: auto !important;
                width: auto !important;
            }

            table[class='flexibleContainerBoxNext'] {
                padding-top: 10px !important;
            }

            table[class='emailButton'] {
                width: 100% !important;
            }

            td[class='buttonContent'] {
                padding: 0 !important;
            }

            td[class='buttonContent'] a {
                padding: 15px !important;
            }
        }

        @media only screen and (-webkit-device-pixel-ratio:.75) {}

        @media only screen and (-webkit-device-pixel-ratio:1) {}

        @media only screen and (-webkit-device-pixel-ratio:1.5) {}

        @media only screen and (min-device-width : 320px) and (max-device-width:568px) {}

    </style>
    <title></title>
</head>
<body bgcolor='#E1E1E1'>
    <center style='background-color:#E1E1E1;'>
        <table border='0' cellpadding='0' cellspacing='0' id='bodyTable'
            style='table-layout: fixed;max-width:100% !important;width: 100% !important;min-width: 100% !important;'
            width='100%'>
            <tr>
                <td align='center' id='bodyCell' valign='top'>
                    <table bgcolor='#FFFFFF' border='0' cellpadding='0' cellspacing='0' id='emailBody' width='500'>
                        <tr>
                            <td align='center' valign='top'>
                                <table bgcolor='#FFFFFF' border='0' cellpadding='0' cellspacing='0'
                                    style='color:#FFFFFF;' width='100%'>
                                    <tr>
                                        <td align='center' valign='top'>
                                            <table border='0' cellpadding='0' cellspacing='0' class='flexibleContainer'
                                                width='500'>
                                                <tr>
                                                    <td align='center' class='flexibleContainerCell' valign='top'
                                                        width='500'>
                                                        <table border='0' cellpadding='30' cellspacing='0' width='100%'>
                                                            <tr>
                                                                @php
                                                                    $logo = get_setting('email_logo');
                                                                @endphp
                                                                <td align='center' class='textContent' valign='top'>
                                                                    <h1
                                                                        style='color:#000;line-height:100%;font-family:Helvetica,Arial,sans-serif;font-size:35px;font-weight:normal;margin-bottom:5px;text-align:center;'>
                                                                        <img alt=''
                                                                            src='{{ uploaded_asset($logo) }}'
                                                                            width='200'></h1>
                                                                    <h1
                                                                        style='text-align:center;font-weight:normal;font-family:Helvetica,Arial,sans-serif;font-size:23px;margin-bottom:10px;color:#000000;line-height:135%;'>
                                                                        CONTACT US FORM
                                                                    </h1>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align='center' valign='top'>
                                <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                    <tr>
                                        <td align='center' valign='top'>
                                            <table border='0' cellpadding='30' cellspacing='0' class='flexibleContainer'
                                                width='500'>
                                                <tr>
                                                    <td class='flexibleContainerCell' valign='top' width='500'>
                                                        <table align='left' border='0' cellpadding='0' cellspacing='0'
                                                            width='100%'>
                                                            <tr>
                                                                <td align='left' class='flexibleContainerBox'
                                                                    valign='top'>
                                                                    <table border='0' cellpadding='0' cellspacing='0'
                                                                        style='max-width: 100%;' width='210'>
                                                                        <tr>
                                                                            <td align='left' class='textContent'>
                                                                                <h4
                                                                                    style='color:#000000;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;'>
                                                                                    Name: </h4>
                                                                                <div
                                                                                    style='text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#2b9fd9;line-height:135%;'>
                                                                                    {{$array['contact']->name}}
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <br>
                                                            <tr>
                                                                <td align='left' class='flexibleContainerBox'
                                                                    valign='middle'>
                                                                    <table border='0' cellpadding='0' cellspacing='0'
                                                                        class='flexibleContainerBoxNext'
                                                                        style='max-width: 100%;' width='210'>
                                                                        <tr>
                                                                            <td align='left' class='textContent'>
                                                                                <h4
                                                                                    style='color:#000000;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;'>
                                                                                    Phone: </h4>
                                                                                <div
                                                                                    style='text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#2b9fd9;line-height:135%;'>
                                                                                    {{$array['contact']->phone}}
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <br>
                                                            <tr>
                                                                <td align='left' class='flexibleContainerBox'
                                                                    valign='middle'>
                                                                    <table border='0' cellpadding='0' cellspacing='0'
                                                                        class='flexibleContainerBoxNext'
                                                                        style='max-width: 100%;' width='210'>
                                                                        <tr>
                                                                            <td align='left' class='textContent'>
                                                                                <h4
                                                                                    style='color:#000000;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;'>
                                                                                    Your Email</h4>
                                                                                <div
                                                                                    style='text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#2b9fd9;line-height:135%;'>
                                                                                    {{$array['contact']->email}}
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <br>
                                                            <tr>
                                                                <td align='left' class='flexibleContainerBox'
                                                                    valign='middle'>
                                                                    <table border='0' cellpadding='0' cellspacing='0'
                                                                        class='flexibleContainerBoxNext'
                                                                        style='max-width: 100%;' width='210'>
                                                                        <tr>
                                                                            <td align='left' class='textContent'>
                                                                                <h4
                                                                                    style='color:#000000;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;'>
                                                                                    Message: </h4>
                                                                                <div
                                                                                    style='text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#2b9fd9;line-height:135%;'>
                                                                                    {{$array['contact']->message}}
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>

                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align='center' valign='top'></td>
                        </tr>
                        <tr>
                            <td align='center' valign='top'></td>
                        </tr>
                        <tr>
                            <td align='center' valign='top'></td>
                        </tr>
                        <tr>
                            <td align='center' valign='top'></td>
                        </tr>
                        <tr>
                            <td align='center' valign='top'>
                                <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                    <tr>
                                        <td align='center' valign='top'>
                                            <table border='0' cellpadding='0' cellspacing='0' class='flexibleContainer'
                                                width='500'>
                                                <tr>
                                                    <td align='center' class='flexibleContainerCell' valign='top'
                                                        width='500'>
                                                        <table border='0' cellpadding='30' cellspacing='0'
                                                            class='flexibleContainerCellDivider' width='100%'>
                                                            <tr>
                                                                <td align='center'
                                                                    style='padding-top:0px;padding-bottom:0px;'
                                                                    valign='top'>
                                                                    <table border='0' cellpadding='0' cellspacing='0'
                                                                        width='100%'>
                                                                        <tr>
                                                                            <td align='center'
                                                                                style='border-top:1px solid #C8C8C8;'
                                                                                valign='top'></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align='center' valign='top'></td>
                        </tr>
                        <tr>
                            <td align='center' valign='top'>
                                <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                    <tr>
                                        <td align='center' valign='top'>
                                            <table border='0' cellpadding='0' cellspacing='0' class='flexibleContainer'
                                                width='500'>
                                                <tr>
                                                    <td align='center' class='flexibleContainerCell' valign='top'
                                                        width='500'>
                                                        <table border='0' cellpadding='30' cellspacing='0'
                                                            class='flexibleContainerCellDivider' width='100%'>
                                                            <tr>
                                                                <td align='center'
                                                                    style='padding-top:0px;padding-bottom:0px;'
                                                                    valign='top'>
                                                                    <table border='0' cellpadding='0' cellspacing='0'
                                                                        width='100%'>
                                                                        <tr>
                                                                            <td align='center'
                                                                                style='border-top:1px solid #C8C8C8;'
                                                                                valign='top'></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align='center' valign='top'></td>
                        </tr>
                        <tr>
                            <td align='center' valign='top'>
                                <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                    <tr>
                                        <td align='center' valign='top'>
                                            <table border='0' cellpadding='0' cellspacing='0' class='flexibleContainer'
                                                width='500'>
                                                <tr>
                                                    <td align='center' class='flexibleContainerCell' valign='top'
                                                        width='500'>
                                                        <table border='0' cellpadding='30' cellspacing='0'
                                                            class='flexibleContainerCellDivider' width='100%'>
                                                            <tr>
                                                                <td align='center'
                                                                    style='padding-top:0px;padding-bottom:0px;'
                                                                    valign='top'>
                                                                    <table border='0' cellpadding='0' cellspacing='0'
                                                                        width='100%'>
                                                                        <tr>
                                                                            <td align='center'
                                                                                style='border-top:1px solid #C8C8C8;'
                                                                                valign='top'></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align='center' valign='top'>
                                <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                    <tr>
                                        <td align='center' valign='top'></td>
                                    </tr>
                                </table>
                                <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                    <tr>
                                        <td align='center' valign='top'>
                                            <table border='0' cellpadding='0' cellspacing='0' class='flexibleContainer'
                                                width='500'>
                                                <tr>
                                                    <td align='center' class='flexibleContainerCell' valign='top'
                                                        width='500'>
                                                        <table border='0' cellpadding='30' cellspacing='0'
                                                            class='flexibleContainerCellDivider' width='100%'>
                                                            <tr>
                                                                <td align='center'
                                                                    style='padding-top:0px;padding-bottom:0px;'
                                                                    valign='top'>
                                                                    <table border='0' cellpadding='0' cellspacing='0'
                                                                        width='100%'>
                                                                        <tr>
                                                                            <td align='center'
                                                                                style='border-top:1px solid #C8C8C8;'
                                                                                valign='top'></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                    <tr>
                                        <td align='center' valign='top'>
                                            <table border='0' cellpadding='0' cellspacing='0' class='flexibleContainer'
                                                width='500'>
                                                <tr>
                                                    <td align='center' class='flexibleContainerCell' valign='top'
                                                        width='500'>
                                                        <table border='0' cellpadding='30' cellspacing='0'
                                                            class='flexibleContainerCellDivider' width='100%'>
                                                            <tr>
                                                                <td align='center'
                                                                    style='padding-top:0px;padding-bottom:0px;'
                                                                    valign='top'>
                                                                    <table border='0' cellpadding='0' cellspacing='0'
                                                                        width='100%'>
                                                                        <tr>
                                                                            <td align='center'
                                                                                style='border-top:1px solid #C8C8C8;'
                                                                                valign='top'></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table bgcolor='#E1E1E1' border='0' cellpadding='0' cellspacing='0' id='emailFooter' width='500'>
                        <tr>
                            <td align='center' valign='top'>
                                <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                    <tr>
                                        <td align='center' valign='top'>
                                            <table border='0' cellpadding='0' cellspacing='0' class='flexibleContainer'
                                                width='500'>
                                                <tr>
                                                    <td align='center' class='flexibleContainerCell' valign='top'
                                                        width='500'>
                                                        <table border='0' cellpadding='30' cellspacing='0' width='100%'>
                                                            <tr>
                                                                <td bgcolor='#E1E1E1' valign='top'>
                                                                    <div
                                                                        style='font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#828282;text-align:center;line-height:120%;'>
                                                                        <div>
                                                                            Biizel &#169; 2022
                                                                        </div>
                                                                        <div>
                                                                            FUELED BY <a
                                                                                href='http://www.digitalgraphiks.ae'
                                                                                target='_blank'>DIGITAL GRAPHIKS</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>
