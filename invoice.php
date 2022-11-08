<?php
require_once "config/db.php";
require_once __DIR__ . '/vendor/autoload.php';

if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];

    $stmt = $conn->prepare("
    
    SELECT post.title, package.package_name,package.package_price, orders.order_id, orders.order_start, orders.order_end,
        (SELECT users.firstname FROM users WHERE users.user_id = orders.customer_id) AS fNameCus,
        (SELECT users.lastname FROM users WHERE users.user_id = orders.customer_id) AS lNameCus,
        (SELECT users.email FROM users WHERE users.user_id = orders.customer_id) AS emailCus,
        (SELECT users.phone FROM users WHERE users.user_id = orders.customer_id) AS telCus,
        (SELECT users.firstname FROM users WHERE users.user_id = orders.cleaner_id) AS fNameCln,
        (SELECT users.lastname FROM users WHERE users.user_id = orders.cleaner_id) AS lNameCln,
        (SELECT users.email FROM users WHERE users.user_id = orders.cleaner_id) AS emailCln,
        (SELECT users.phone FROM users WHERE users.user_id = orders.cleaner_id) AS telCln
    FROM orders,post,package
    WHERE orders.order_id =$order_id AND orders.post_id = post.post_id AND orders.package_id = package.package_id");

    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];
$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([

    'mode' => 'utf-8',
    'format' => [190,236],
    'orientation' => 'P',

    'fontDir' => array_merge ($fontDirs, [
        __DIR__. '/mpdf/mpdf/ttfonts',
        ]),
        'fontdata' => $fontData + [
            'frutiger' => [
                'R' => 'THSarabun.ttf',
                'B' => 'THSarabun Bold.ttf',
            ]
        ],
        'default_font' => 'frutiger'
    ]);

$mpdf->Image('assets/images/logo/logo.png', 0, 0, 210, 297, 'png', '', true, false);

$content .= '<!DOCTYPE html>
            <html lang="th">
            <head>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>NiceClean Invoice</title>
                <link rel="stylesheet" href="assets/css/invoice.css">
            </head>
            <body>
                <header class="clearfix">  ';
$content .= '<h1>หมายเลขใบเสร็จที่ '.$row['order_id'].' </h1>
            <div id="company" class="clearfix"> ';
$content .= '<div>'.$row['fNameCln']." ".$row['lNameCln'].'</div>';
$content .= '<div>'.$row['telCln'].'</div>';   
$content .= '<div>'.$row['emailCln'].'</div>
            </div>
                <div id="project">';
$content .= '<div><span>ลูกค้า:</span> '.$row['fNameCus']." ".$row['lNameCus'].'</div>';
$content .= '<div><span>อีเมล:</span> '.$row['emailCln'].'</div>';
$content .= '<div><span>จอง:</span> '.$row['order_start'].'</div>';
$content .= '<div><span>เสร็จสิ้น:</span> '.$row['order_end'].'</div>';
$content .= '</div>
            </header>
            <main>
            <table>
                <thead>
                <tr>
                    <th class="service">โพสต์</th>
                    <th class="desc">แพ็คเกจ</th>
                    <th colspan="3">ราคา</th>
                </tr>
                </thead>
                <tbody>
                <tr>';
$content .=  '<td class="service">'.$row['title'].'</td>';
$content .=  '<td class="desc">'.$row['package_name'].'</td>';
$content .=  '<td colspan="4" class="total">'.number_format($row['package_price'],0).' บาท</td>';
$content .=  '</tr>
            <tr>
            <td colspan="4">ค่าธรรมเนียม 3%</td>';
$content .=  '<td class="total">'.number_format($fee = $row['package_price']*0.03,0).' บาท</td>';
$content .=  '</tr>
            <tr>
                <td colspan="4" class="grand total">รวมสุทธิ</td>';
$content .=  '<td class="grand total">'.number_format($total = $row['package_price'] - $fee,0).' บาท</td>';
$content .=  '</tr>
            </tbody>
            </table>
            </main>
            </body>
            </html>';


$mpdf->WriteHTML($content);
$mpdf->Output();
exit;
?>
