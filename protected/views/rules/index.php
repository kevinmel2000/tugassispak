<div id="breadcumb">
	<a href="<?php echo Yii::app()->createUrl('appUser/index'); ?>"> <span class="icon_home"> Home </span> </a> 
    <small>></small> 
    <a href="#">Rule</a>  
</div>

<script type="text/javascript">
    
    var $ruleNumber = <?= $countRule; ?>;
    
    function removeForm($position)
    {
        $("#form_container li:eq("+$position+")").remove();
    }
    
    function removeRule()
    {
        $position = $("select#textRules option:selected").index();
        
        if($position > -1)
        {
            removeForm($position);
            $("select#textRules option:selected").remove();
        }
        else
        {
            alert("Pilih rule dulu!");
        }
    }
    
    function addForm($connection, $arrIdFuzzyInput, $arrIdMfInput,
                $arrIdFuzzyOutput, $arrIdMfOutput, $ruleNumber, $isNew, $position)
    {
        // add to form
        $form = $("#liTemplate #form_input").clone();
        
        $conn = $form.find("#connection")
        $conn.attr("name", "connection["+ $ruleNumber +"]");
        $conn.attr("value", $connection);
        
        for(var x=0;x<$arrIdFuzzyInput.length; x++)
        {
            var $fuzzyName = $form.find("#varFuzzy").clone();
            $fuzzyName.attr('name', "varFuzzyInput["+ $ruleNumber +"][]");
            $fuzzyName.attr("value", $arrIdFuzzyInput[x]);
            $fuzzyName.attr("id", "varFuzzyInput");
            
            $form.append($fuzzyName);
        }
        
        for(var x=0;x<$arrIdMfInput.length; x++)
        {          
            var $mf = $form.find("#mf").clone();
            $mf.attr('name', "mfInput["+ $ruleNumber +"][]");
            $mf.attr("value", $arrIdMfInput[x]);
            $mf.attr("id", "varMfInput");
            
            $form.append($mf);
        }
        
        for(var x=0;x<$arrIdFuzzyOutput.length; x++)
        {
            var $fuzzyName = $form.find("#varFuzzy").clone();
            $fuzzyName.attr('name', "varFuzzyOutput["+ $ruleNumber +"][]");
            $fuzzyName.attr("value", $arrIdFuzzyOutput[x]);
            $fuzzyName.attr("id", "varFuzzyOutput");
            
            $form.append($fuzzyName);
        }
        
        for(var x=0;x<$arrIdMfOutput.length; x++)
        {          
            var $mf = $form.find("#mf").clone();
            $mf.attr('name', "mfOutput["+ $ruleNumber +"][]");
            $mf.attr("value", $arrIdMfOutput[x]);
            $mf.attr("id", "varMfOutput");
            
            $form.append($mf);
        }
        
        
        $form.find("#varFuzzy").remove();
        $form.find("#mf").remove();
        
        if($isNew == true)
        {
            $("#form_container").append($form);
        }
        else
        {
            $("#form_container li:eq("+$position+")").html($form);
        }
    }
    
    function addRule($position)
    {
        var $connection = $(".connection:checked").val();
        var $arrInput = new Array();
        var $arrIdFuzzyInput = new Array();
        var $arrIdMfInput = new Array();
        
        var $arrOutput = new Array();
        var $arrIdFuzzyOutput = new Array();
        var $arrIdMfOutput = new Array();
        
        $("table#input_wrapper").each(function(){
            var $mf = $(this).find(".textInputRules option:selected");
            $mf.each(function(){
                var $varFuzzy = $(this).parentsUntil("td").find(".input_title_text").text();
                var $varIdFuzzy = $(this).parentsUntil("td").find("#id_var_fuzzy").val();
                
                if($(this).text() != "NONE")
                {
                   $arrInput.push("( " + $varFuzzy + " = "+ $(this).text() + " )");
                   $arrIdFuzzyInput.push($varIdFuzzy);
                   
                   $arrIdMfInput.push($(this).val());
                }
            })
        });
        
         $("table#output_wrapper").each(function(){
            var $mf = $(this).find(".textOutputRules option:selected");
            
            $mf.each(function(){
                var $varFuzzy = $(this).parentsUntil("td").find(".input_title_text").text();
                var $varIdFuzzy = $(this).parentsUntil("td").find("#id_var_fuzzy").val();
                
                if($(this).text() != "NONE")
                {
                     $arrOutput.push("( " + $varFuzzy + " = "+ $(this).text() + " )");
                     $arrIdFuzzyOutput.push($varIdFuzzy);
                     
                     $arrIdMfOutput.push($(this).val());
                }
            })
        });
        
        if($arrInput.length == 0)
        {
            alert("Input belum terpilih!");
            return;
        }
        
        if($arrOutput.length == 0)
        {
            alert("Output belum terpilih!");
            return;
        }
        
        // attach to listbox
        $text = "IF " + $arrInput.join(" "+ $connection +" ")+ " THEN " + $arrOutput.join(" AND ");
        
        $("select#textRules").each(function(){
           if($text == $(this).text())
           {
               alert("Rule sudah ada!");
               return;
           }
        });
        
        $ruleNumber++;
        
        // add
        if($position == -1)
        {
            $("select#textRules").append("<option>" + $text + "</option>");
            addForm($connection, $arrIdFuzzyInput, $arrIdMfInput,
                $arrIdFuzzyOutput, $arrIdMfOutput, $ruleNumber, true, -1);
        }
        // edit
        else if($position > -1)
        {
            $position = $("select#textRules option:selected").index();
            
            if($position > -1)
            {
                $("select#textRules option:selected").html($text);

                addForm($connection, $arrIdFuzzyInput, $arrIdMfInput,
                    $arrIdFuzzyOutput, $arrIdMfOutput, $ruleNumber, false, $position);
            }
        }
        
        
    }
    
    function changeRule()
    {
        $position = $("select#textRules option:selected").index();
            
        if($position > -1)
        {
            addRule(2);
        }
        else
        {
            alert("Pilih rule dulu!");
        }
    }
</script>

<div id="wrapped_content">
    <h1>Manage Rule</h1>
    
    <?php
        foreach(Yii::app()->user->getFlashes() as $key => $message) 
        {
            echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
        }
    ?>
    
    <div class="input">
        <div class="input_title_text">
            <span class="icon_var_input"></span> Rules
        </div>
        
        <select name="rules" id="textRules" size="10" style="width: 100%">
            <?php foreach($arrRuleText as $text): ?>
                <option><?= $text; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="input">
        <div class="input_title_text">
            <span class="icon_var_input"></span> Connection
        </div>

        <input type="radio" name="connection" checked="checked" class="connection" value="<?= ARRule::$CONNECTION_AND ?>" />AND
        <input type="radio" name="connection" class="connection" value="<?= ARRule::$CONNECTION_OR ?>"/>OR
    </div>
    
    <div id="input_container">
        <table id="input_wrapper">
            <tr>
                <?php $x = 1; ?>
                <?php foreach($varInput as $input): ?>
                <?php
                    if($x==5 && $line == 1) 
                    {
                        echo "<tr>";
                    }
                ?>
                <td>
                    <div class="input" style="width: 150px">
                        <div class="input_title_text">
                            <input type="text" id="id_var_fuzzy" value="<?= $input->id ?>" style="display:none;"/>
                            <span class="icon_var_input"></span> <?= $input->name ?>
                        </div>

                        <select name="rules" class="textInputRules" size="10" style="width: 100%">
                            <?php foreach($input->mfs as $mf): ?>
                                <?= "<option value='". $mf->id ."'> ". $mf->name ." </option>" ?>
                            <?php endforeach; ?>
                            <option selected="selected">NONE</option>
                        </select>
                    </div>
                </td>
                <?php
                    if($x==4)
                    {
                        echo "</tr>";
                        $x = 0;
                    }
                    
                    $x++;
                ?>
                <?php endforeach; ?>
            </tr>
        </table>
        <table id="output_wrapper">
            <tr>
                <?php $x = 1; ?>
                <?php foreach($varOutput as $output): ?>
                <?php
                    if($x==5 && $line == 1) 
                    {
                        echo "<tr>";
                    }
                ?>
                <td>
                    <div class="input" style="width: 150px">
                        <div class="input_title_text">
                            <input type="text" id="id_var_fuzzy" value="<?= $output->id ?>" style="display: none;"/>
                            <span class="icon_var_input"></span> <?= $output->name ?>
                        </div>

                        <select name="rules" class="textOutputRules" size="10" style="width: 100%">
                            <?php foreach($output->mfs as $mf): ?>
                                <?= "<option value='". $mf->id ."'> ". $mf->name ." </option>" ?>
                            <?php endforeach; ?>
                            <option selected="selected">NONE</option>
                        </select>
                    </div>
                </td>
                <?php
                    if($x==4)
                    {
                        echo "</tr>";
                        $x = 0;
                    }
                    
                    $x++;
                ?>
                <?php endforeach; ?>
            </tr>
        </table> 
    </div>
    
    <form action="<?php echo Yii::app()->createUrl('rules/index'); ?>" method="post">
    
    <ul id="form_container" style="display: none;">
        <?php 
        
        $x=0; 
        foreach($rules as $rule)
        {
            echo "<li id='form_input'>";
            echo "<input type='text' name='connection[$x]' id='connection' value='$rule->connection'/>";
            
            $y = 0;
            $z = 0;
            foreach($rule->ruleDetails as $detail)
            {
                if($detail->type_rule == Rule::$TYPE_INPUT)
                {
                    echo "<input type='text' name='varFuzzyInput[$x][$y]' id='varFuzzyInput' value='$detail->id_variable'/>";
                    echo "<input type='text' name='mfInput[$x][$y]' id='varMfInput' value='$detail->id_mf'/>";
                    $y++;
                }
                else if($detail->type_rule == Rule::$TYPE_CONCLUSION)
                {
                    echo "<input type='text' name='varFuzzyOutput[$x][$z]' id='varFuzzyOutput' value='$detail->id_variable'/>";
                    echo "<input type='text' name='mfOutput[$x][$z]' id='varMfOutput' value='$detail->id_mf'/>";
                    $z++;
                }
            }
            echo "</li>";
            $x++;
        }
        
        ?>
    </ul>   

    <input type="button" id="add_rule" value="Add Rule" onclick="addRule(-1)"> 
    <input type="button" id="change_rule" value="Change Rule" onclick="changeRule()"> 
    <input type="button" id="remove_rule" value="Remove Rule" onclick="removeRule()"> 
    <input type="submit" value="Save"> 
    
    </form>
</div>

<div id="liTemplate" style="display: none;">
    <li id="form_input">
        <input type="text" name="connection[]" id="connection" value=""/>
        <input type="text" name="varFuzzy[][]" id="varFuzzy" value=""/>
        <input type="text" name="mf[][]" id="mf" value=""/>
    </li>
</div>