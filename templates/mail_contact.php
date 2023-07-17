<?php
/**
 * @var array $data
 */

?>



<head>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        p {
            line-height: inherit;
        }

        .photo {
            padding: 0;
            margin: 0;
            width: clamp(150px, 60vw, 300px);
            height: clamp(150px, 60vw, 300px);
            border-radius: 50%;
        }

        @media (max-width:720px) {
            .row-content {
                width: 100% !important;
            }

            table {
                table-layout: fixed !important;
            }

            .stack .column {
                width: 100%;
                display: block;
            }
        }
    </style>
</head>

<!-- Body (table) -->
<body style="background-color: #FFFFFF; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF;" width="100%">
    <tbody>
    <tr>
        <td>

            <!-- Header (logo) -->
            <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;margin-top: 30px;" width="100%">
                <tr>
                    <td style="padding-left:15px;padding-right:15px;width:100%;padding-bottom:5px;" align="center">
                        <div style="line-height:10px">
                            <a href="" style="outline:none" target="_blank">
                                <img class="photo" alt="Blog Logo" src="/assets/img/otter.png" title="OtterBlog" width="123px"/>
                            </a>
                        </div>
                    </td>
                </tr>
            </table>

            <!-- Main Content -->
            <table border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                <tr>
                    <td>
                        <div style="margin: 0; margin-top: 25px; color: #2b2d2d; font-weight: normal; letter-spacing: normal; line-height: 120%;" align="center">
                            <h1>
                                <strong>Message reçu de <?= $data['email'] ?> !</strong>
                            </h1>
                            <h3>( <?= $data['message'] ?>)</h3>
                        </div>
                    </td>
                </tr>
            </table>

            <table border="0" cellpadding="15" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                <tr>
                    <td>
                        <div align="left">
                            <div style="font-family: sans-serif">
                                <div style="font-size: 14px; mso-line-height-alt: 21px; color: #6f7077; line-height: 1.5; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">

                                    <p style="margin: 0; font-size: 14px; margin-bottom:40px;">
                                        <?= $data['message']?>
                                    </p>

                                </div>
                            </div>

                        </div>
                    </td>
                </tr>
            </table>

            <!-- Page Footer -->
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-10" role="presentation" style="margin-top:35px;mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #090660;" width="100%">
                <tbody>
                <tr>
                    <td>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; background-color: #090660; width: 700px;" width="700">
                            <tbody>
                            <tr>
                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                    <table border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                        <tr>
                                            <td>

                                                {# FOOTER : SOCIALS #}
                                                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="144px">
                                                    <tr>
                                                        <td style="padding:0 2px 0 2px;"><a href="https://www.twitter.com/"><img alt="Twitter" height="32" src="/assets/img/twitter2x.png" style="display: block; height: auto; border: 0;" title="twitter" width="32"/></a></td>
                                                        <td style="padding:0 2px 0 2px;"><a href="https://www.facebook.com/"><img alt="Facebook" height="32" src="/assets/img/facebook2x.png" style="display: block; height: auto; border: 0;" title="facebook" width="32"/></a></td>
                                                        <td style="padding:0 2px 0 2px;"><a href=""><img alt="GitHub" height="32" src="/assets/img/gh-white-icon.png" style="display: block; height: auto; border: 0;" title="github" width="32"/></a></td>
                                                    </tr>
                                                </table>

                                            </td>
                                        </tr>
                                    </table>

                                    {# FOOTER : COPYRIGHT #}
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                        <tr>
                                            <td style="padding-bottom:10px;padding-left:50px;padding-right:50px;padding-top:10px;">
                                                <div style="font-family: sans-serif">
                                                    <div style="font-size: 14px; mso-line-height-alt: 21px; color: #6f7077; line-height: 1.5; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
                                                        <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 15px;">
                                                            Copyright &copy; IMAMOS95
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
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
</body>
