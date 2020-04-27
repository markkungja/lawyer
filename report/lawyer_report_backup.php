<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @font-face {
            font-family: myFont;
            src: url(font/cordia.ttf);
        }
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font-size: 22px;
            font-weight: 100;
            font-family: myFont;
        }
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
        .page {
            width: 210mm;
            min-height: 297mm;
            padding-top: 10mm;
            padding-left: 20mm;
            padding-right: 10mm;
            padding-bottom: 10mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .subpage {
            padding: 0.5cm;
            /* border: 5px red solid; */
            height: 277mm;
            /* outline: 1cm #FFEAEA solid; */
        }
        .form{
            position: absolute;
            /* top: 0;
            left: 0;
            bottom: 0;
            right: 0; */
            z-index: -1;
            /* overflow: hidden; */
        }

        .left-top{
            vertical-align: top;
            text-align: left;
        }
        .right{
            text-align: right;
        }
        .normal-line{
            line-height: 0.6cm;
        }
        .short-line{
            line-height: 0.3cm;
        }

        /* Text Box Start*/

        .absolute {
            margin-right: 50px;
        }
        .text1 {
            position: absolute;
            /* padding-inline-start : 100px */
            /* padding-top: 50px; */
            /* margin-left: 20px; */
        }

        /* Text Box End */
        
        @page {
            size: A4;
            margin: 0;
        }
        @media print {
            html, body {
                width: 210mm;
                height: 297mm;        
            }
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
</head>
<body>

<div class="book">
    <div class="page">
        <div class="subpage">
            <!-- <div class="form"> -->
                <table style="width:100%;border: 0px solid black" align="left">
                    <tr>
                        <td class="left-top" align="left" style="width:40%">
                            <br><img src="assets/circle.png">&nbsp;&nbsp;(๙)<br>ใบแต่งทนายความ
                        </td>
                        <td style="width:20%" align="top"><img src="assets/logo.png"></td>
                        <td style="width:40%" align="right">
                            <br><br>
                            <div>คดีหมายเลขดำที่_____<a class="text1">asdasdasdasdasdas</a>_____/๒๕___</div>
                            คดีหมายเลขแดงที่__________/๒๕___
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right">
                            ศาล_________________________________<br>
                            วันที่_____เดือน_____________พุทธศัราช ๒๕___<br>
                            ความ_<a style="padding-bottom: 30px" class="text1"><input style="background: transparent;" type="text"></a>_______________________________<br>
                        </td>
                    </tr>
                </table>
                
                <p><img src="assets/plan_def.png"></p>
                <div class="normal-line">
                    <p style="text-indent: 2.5em;">ข้าพเจ้า_______________________________________________________________________</p>
                    <p>ขอแต่งตั้งให้___________________________________________________________________________</p>
                    <p>เป็นทนายความของข้าพเจ้าในคดีนี้ และให้มีอำนาจ *__________________________________________</p>
                    <p>_____________________________________________________________________________________</p>
                    <p>_____________________________________________________________________________________</p>
                    <p>ข้าพเจ้ายอมรับผิดชอบตามที่_____________________________________________________________</p>
                    <p>ทนายความจะได้ดำเนินกระบวนพิจารณาต่อไปตามกฎหมาย</p>
                    <p>ขอรับรองว่าผู้แต่งทนายความได้ลงลายมือชื่อจริง_______________________________ผู้แต่งทนายความ</p>
                    <p style="text-indent: 15em;">(__________________)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(พลิก)
                </div>
                ลงชื่อ________________________________________________________________________________<br>
                <u>หมายเหตุ</u> *ตามประมวลกฎหมายวิธีพิจารณาความแพ่งมาตรา ๖๒ ทนายความไม่มีอำนาจดำเนินกระบวน  
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;พิจารณาใดไปในทางจำหน่ายสิทธิของคู่ความนั้น  เช่น การยอมรับตามที่คู่ความอีกฝ่ายหนึ่งเรียก
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ร้อง การถอนฟ้อง การประนีประนอมยอมความ การสละสิทธิหรือการใช้สิทธิในการอุทธรณ์หรือ
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ฎีกาหรือในการขอให้พิจารณาคดีใหม่ ถ้าจะมอบให้มีอำนาจดังกล่าวประการใดบ้าง ให้กรอกลง
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในช่องที่ว่าง ไว้ โดยระบุให้ชัดเจน (คำที่ไม่ใช้และช่องว่างที่เหลือให้ขีดเสีย)
                </p>
            <!-- </div> -->
            <!-- absolote -->
            <a class="absolute text1">asdasdasdasdasdas</a>
            <!-- End absolute -->
        </div>    
    </div>
    <div class="page">
        <div class="subpage">
            <br><br><br>
            <p><center><u>คำรับเป็นทนายความ</u></center></p>
            <p style="text-indent: 2.5em;">ข้าพเจ้า______________________________________________________________________<br>
            เลขประจำตัวประชาชน ---- <br>
            ใบอนุญาตให้เป็นทนายความเลขที่____________________ได้รับอนุญาตให้ว่าความ_______________<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                ที่อยู่ปัจจุบันเลขที่__________________หมู่ที่__________ถนน___________________________<br>
            ตรอก/ซอย___________________ตำบล/แขวง_________________อำเภอ/เขต____________________<br>
            จังหวัด____________________รหัสไปรษณีย์_________________โทรศัพท์______________________<br>
            โทรสาร___________________ไปรษณีย์อิเล็กทรอนิกส์ ______________________________________<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                สำนักงานอยู่ที่_________________หมู่ที่__________ถนน______________________________<br>
            ตรอก/ซอย___________________ตำบล/แขวง_________________อำเภอ/เขต____________________<br>
            จังหวัด____________________รหัสไปรษณีย์_________________โทรศัพท์______________________<br>
            โทรสาร___________________ไปรษณีย์อิเล็กทรอนิกส์ ______________________________________<br>
            ขอรับเป็นทนายของ___________________________________________________________________<br>
            เพื่อดำเนินกระบวนพิจารณาต่อไปตามหน้าที่ในกฎหมาย<br>
                <p class="right">____________________________ทนายความ<br>
                    (_________________)
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </p>
            </p>
            <p><center><u>คำสั่ง</u></center></p>
            <p>_______________________________________________________________________________________</p>
            <p>_______________________________________________________________________________________</p>
            <p class="right">_________________________ผู้พิพากษา</p>
            
            
        </div>    
    </div>
</div>

</body>

<script>

// window.print();

</script>

</html>