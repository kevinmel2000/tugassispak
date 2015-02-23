<div id="breadcumb">
	<a href="<?php echo Yii::app()->createUrl('appUser/index'); ?>"> <span class="icon_home"> Home </span> </a> 
    <small>></small> 
    <a href="#">Variable Output</a>  
</div>

<script type="text/javascript">
    $(document).ready(function(){
        
       // add new variabel  
       $("#add_variable").click(function(){
           
          var $varName = $("#variable_name").val();
          
          if($varName == "")
          {
             alert("Nama variabel harus diisi!");
             return;
          }
          
          $status = false;
          
          $("#input_container .input").each(function(){
             $name = $.trim($(this).find(".input_title_text").text());
             //console.log($name);
             
             if($name == $varName)
             {
                 alert("Nama variabel sudah ada!");
                 $status = true;
             }
          });
          
          if($status == true)
          {
              return;
          }
          
          $varNewInput = $("#template_var .input").clone();
          $varNewInput.find(".mf:gt(0)").remove();
          $varNewInput.find(".input_title_text").html("<span class=\"icon_var_input2\"></span> " + $varName);
          $varNewInput.find("#name").attr("name", $varName+"[name][]");
          $varNewInput.find("#param").attr("name", $varName+"[param][]");
          $varNewInput.find("#type").attr("name", $varName+"[type][]");
        
          $varNewInput.show().appendTo("#input_container");
          
          $("#variable_name").attr("value", "");
       });
    });
    
    function removeMf(obj)
    {
        $(obj).parentsUntil(".var_kiri").remove();
    }
    
    function addMf(obj)
    {
        $varName = $.trim($(obj).parentsUntil("#input_container").find(".input_title_text").text());
        
        $buttonRemove = $(obj).next();
        $varNewInput = $("#template_mf .mf").clone();
        $varNewInput.find("#name").attr("name", $varName+"[name][]");
        $varNewInput.find("#param").attr("name", $varName+"[param][]");
        $varNewInput.find("#type").attr("name", $varName+"[type][]");
        
        $(obj).parentsUntil(".input").append($varNewInput);
        $(obj).parentsUntil(".input").append(obj);
        $(obj).parentsUntil(".input").append($buttonRemove);
    }
    
    function removeVar(obj)
    {
        $(obj).parentsUntil("#input_container").remove();
    }
       
</script>

<div id="wrapped_content">
    <h1>Manage Variable Output</h1>
    
     <?php
        foreach(Yii::app()->user->getFlashes() as $key => $message) 
        {
            echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
        }
    ?>
    
    <div class="input">
        <div class="input_title_text">
            <span class="icon_var_input"></span> Add Variabel
        </div>
        
        <input type="text" id="variable_name" value="" size="30"/>
        <input type="button" id="add_variable" value="Add"/>
    </div>
    
    <form action="<?php echo Yii::app()->createUrl('variableOutput/index'); ?>" method="post">
    <div id="input_container">
        <?php foreach($vars as $var): ?>
        
        <div class="input">
            <div class="input_title_text">
                <span class="icon_var_input2"></span> <?= $var->name ?>
            </div>

            <div class="var_kiri">
                <?php foreach($var->mfs as $mf): ?>
                <table class="mf" style="margin: 20px 0px 20px 0px;">
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td><input type="text" name="<?= $var->name ?>[name][]" id="name" 
                                   size="30" value="<?= isset($mf->name)? $mf->name : ""?>"/></td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td>:</td>
                        <td>
                            <select name="<?= $var->name ?>[type][]" id="type">
                                <option value="<?= ARVariableShapeType::$VARIABLE_TRI_MF ?>"
                                        <?= $mf->type == ARVariableShapeType::$VARIABLE_TRI_MF ? "selected='selected'" : ""?>>Trimf</option>
                                <option value="<?= ARVariableShapeType::$VARIABLE_TRAF_MF ?>"
                                        <?= $mf->type == ARVariableShapeType::$VARIABLE_TRAF_MF ? "selected='selected'" : ""?>>Trafmf</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Param</td>
                        <td>:</td>
                        <td><input type="text" name="<?= $var->name ?>[param][]" id="param" 
                                   size="30" value="<?= isset($mf->value)? $mf->value : ""?>"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <input type="button" id="delete_variable" value="Remove MF" onclick="removeMf(this)"> 
                        </td>
                    </tr>
                </table>
                <?php endforeach; ?>
                <input type="button" id="add_mf" value="Add New MF" onclick="addMf(this)">
                <input type="button" id="delete_variable" value="Remove Variabel" onclick="removeVar(this)">
            </div>
        </div>

        <?php endforeach; ?>
    </div>
    <input type="submit" value="Save" />
    </form>
</div>


<!--template input-->
<div id="template_var" style="display: none;">
    
<div class="input">
    <div class="input_title_text">
        <span class="icon_var_input2"></span> Permintaan
    </div>

    <div class="var_kiri">
        <table class="mf" style="margin: 20px 0px 20px 0px;">
            <tr>
                <td>Name</td>
                <td>:</td>
                <td><input type="text" name="permintaan[name][]" id="name" size="30"/></td>
            </tr>
            <tr>
                <td>Type</td>
                <td>:</td>
                <td>
                    <select name="permintaan[type][]" id="type">
                        <option>Trimf</option>
                        <option>Trafmf</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Param</td>
                <td>:</td>
                <td><input type="text" name="permintaan[param][]" id="param" size="30"/></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <input type="button" id="delete_variable" value="Remove MF" onclick="removeMf(this)"> 
                </td>
            </tr>
        </table>
        <input type="button" id="add_mf" value="Add New MF" onclick="addMf(this)">
        <input type="button" id="delete_variable" value="Remove Variabel" onclick="removeVar(this)">
    </div>
</div>
    
</div>

<!--template input-->
<div id="template_mf" style="display: none;">
    
<table class="mf" style="margin: 20px 0px 20px 0px;">
    <tr>
        <td>Name</td>
        <td>:</td>
        <td><input type="text" name="permintaan[name][]" id="name" size="30"/></td>
    </tr>
    <tr>
        <td>Type</td>
        <td>:</td>
        <td>
            <select name="permintaan[type][]" id="type">
                <option>Trimf</option>
                <option>Trafmf</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Param</td>
        <td>:</td>
        <td><input type="text" name="permintaan[param][]" id="param" size="30"/></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>
            <input type="button" id="delete_mf" value="Remove MF" onclick="removeMf(this)"> 
        </td>
    </tr>
</table>
    
</div>