<div id="last_attr">
    <div class="page">
        <div class="subpage" id="attr_page1">
            <center><p><u style="font-size: 24px;">รายชื่อและที่อยู่ของจำเลยแนบประกอบท้ายคำฟ้อง</u></p></center>
            
        </div>
    </div>
    <!-- if page 2 -->
</div>



<script>
var page = 1;
    <?php
        $i_num = 1;
        
        while($objResult_def = mysqli_fetch_assoc($objQuery_def)){
            $defendant_id = $objResult_def['defendant_id'];
            $strSQL_defendant = "SELECT * FROM `defendant` WHERE `defendant_id` = '$defendant_id'";
            $objQuery_defendant = $conDB->sqlQuery($strSQL_defendant);
            $objResult_defendant = mysqli_fetch_assoc($objQuery_defendant)
            ?>
            if((<?php echo $i_num ?> % 10) == 0){
                page++;
                console.log(page);
                var d = document.createElement("div");
                d.innerHTML = "<div class=\"page\"><div class=\"subpage\" id=\"attr_page"+ page +"\">";
                document.getElementById('last_attr').appendChild(d);
            }

            var d = document.createElement("div");
            d.innerHTML = "<p>- <u><?php echo $objResult_def['doc_def_name'] ?></u>  จำเลยที่<?php echo $i_num ?> (<?php echo $objResult_def['doc_def_no'] ?>)<br><a class=\"absolute\"><input class=\"transparent text-center\" type=\"text\" id=\"unit_<?php echo $i_num ?>\" name=\"unit_<?php echo $i_num ?>\" size=\"6\" value=\"<?php echo $objResult_defendant['current_unit'] ?>\"></a>……………  หมู่ที่<a class=\"absolute\"><input class=\"transparent text-center\" type=\"text\" id=\"bloc_<?php echo $i_num ?>\" name=\"bloc_<?php echo $i_num ?>\" size=\"3\" value=\"<?php echo $objResult_defendant['current_bloc'] ?>\"></a>………  ตำบล<a class=\"absolute\"><input class=\"transparent text-center\" type=\"text\" id=\"zone_<?php echo $i_num ?>\" name=\"zone_<?php echo $i_num ?>\" size=\"11\" value=\"<?php echo $objResult_defendant['current_zone'] ?>\"></a>…………………  อำเภอ<a class=\"absolute\"><input class=\"transparent text-center\" type=\"text\" id=\"area_<?php echo $i_num ?>\" name=\"area_<?php echo $i_num ?>\" size=\"15\" value=\"<?php echo $objResult_defendant['current_area'] ?>\"></a>………………………..  จังหวัด<a class=\"absolute\"><input class=\"transparent text-center\" type=\"text\" id=\"county_<?php echo $i_num ?>\" name=\"county_<?php echo $i_num ?>\" size=\"15\" value=\"<?php echo $objResult_defendant['current_county'] ?>\"></a>……………………….."
            document.getElementById('attr_page'+page).appendChild(d);
            <?php
            $i_num++;
        }
    ?>
</script>