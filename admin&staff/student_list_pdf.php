<?php 
    require('../config.php');

    ob_start ();
?>
    <page backtop="2%" backbottom="2%" backleft="2%" backright="2%" style="font-size:12px;">
    <div style="width:100%; height:30%;">
            <img src="../img/sch_sign.PNG" style="width:13%; height:30%;">
            <p style="margin-top:-95px; margin-left:95px;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REPUBLIC OF RWANDA<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MINISTRY OF EDUCATION<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Saint Philip Technical Secondary School<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P.O.BOX 1692 KIGALI<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;saintphiliptss1985@gmail.com<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+250 788 565 100
            </p>
            <h3 align="center">STUDENT PAYMENT LIST</h3>
        </div>
        
     <table style="width:100%; margin-top:-150px;">
        <tr>
            <th style="width: 30%; border:1px;">Student Names</th>
            <th style="width: 10%; border:1px;">Class</th>
            <th style="width: 10%; border:1px;">Serial Number</th>
            <th style="width: 10%; border:1px;">School Fees</th>
            <th style="width: 10%; border:1px;">Status</th>
            <th style="width: 10%; border:1px;">Content</th>
            <th style="width: 10%; border:1px;"></th>
        </tr>
        <?php 
            $req = mysql_query("SELECT * FROM student_tb");

            while($row = mysql_fetch_array($req)){
        ?>
        <tr>
                <td style="border:1px;"><?php echo "<p>".$row['firstname']." ".$row['lastname']."</p>"; ?></td>
                <td style="border:1px;"><?php echo $row['class']; ?></td>
                <td style="border:1px;"><?php echo $row['student_ID']; ?></td>
                <td style="border:1px;"><?php echo number_format($row['school_fees'],2,'.',''); ?>Frw</td>
                <td style="border:1px;"><?php echo $row['status']; ?></td>
                <td style="border:1px;"><?php echo $row['content']; ?></td>
                <td style="border:1px;"></td>
        </tr>
        <?php
            }
        ?>
     </table>
    </page>
<?php
    $content = ob_get_clean();

    require ('../html2pdf/vendor/autoload.php');

    $pdf = new HTML2PDF ('P', 'A4', 'fr', 'true', 'UTF-8');
    $pdf->writeHTML($content);
    $pdf->Output('Student List.pdf');

?>