<script type="text/javascript">
	
	// on value change on dropdown, show privilages
	$(document).ready(function() {
		$("#Module_p_id").change(function() {
			setPrivilages();
		});
        
        setPrivilages();
	});
	
	
	function setPrivilages()
	{
		if($("#Module_p_id").val() != 0)
		{
			$("#input_privilages").show();
		}
		else
		{
			$("#input_privilages").hide();
		}
	}		
</script>


<?php
    function getParent($baseArray, $parentValue)
    {
        sort($baseArray);
        $parentLevel = array();

        foreach ($baseArray as $ul) 
        {
            if ($ul->p_id == $parentValue) 
            {
                $parentLevel[] = $ul;
            }
        }

        return $parentLevel;
    }

    function isChecked($preCheckedArray, $checkedId)
    {
        if(in_array($checkedId, $preCheckedArray))
        {
            return 'checked="checked"';
        }
    }

    function printCheckboxList($baseArray, $levelMenu = 0, $formName, $preCheckedArray = array() , $subMargin = 10)
    {
        foreach (getParent($baseArray, $levelMenu) as $level)
        {
            echo '<input '. isChecked($preCheckedArray, $level->id) .' style="margin-left: '. $subMargin .'px;margin-bottom:7px" type="checkbox" name="' . $formName . '" value="' . $level->id . '">' . ' ' . $level->name . ' <br />';
            printCheckboxList($baseArray, $level->id, $formName, $preCheckedArray, $subMargin + 20);
        }
    }
?>

<?php
/* @var $this ModuleController */
/* @var $model Module */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'module-form',
                        'enableAjaxValidation'=>false,
                    )); ?>

<p class="note">Fields with <span class="required">*</span> are required.</p>


<div class="form">
     <?php echo $form->errorSummary($model); ?>
    
    <table>
        <tr>
            <td style="width: 50%; padding-right: 20px;">
                <div class="row">
                    <?php echo $form->labelEx($model,'name'); ?>
                    <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model,'description'); ?>
                    <?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'description'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model,'url'); ?>
                    <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'url'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model,'p_id'); ?>
                    <?php echo $form->dropDownList(
                            $model,
                            'p_id',
                            array('0' => 'Parent') +
                            CHtml::listData(Module::model()->getParents()->findAll(), 'id', 'name'),
                            NULL
                            ); 
                    ?>
                    <?php echo $form->error($model,'p_id'); ?>
                </div>
            </td>
            <td style="width: 50%; vertical-align: top;">
                <div class="row" id="input_privilages">
                    <?php echo $form->labelEx($model, 'hasPrivilage') ?>
                    <? printCheckboxList($userLevel, 0, 'privilages[]', $preCheckedArray) ?>
                    <?php echo $form->error($model, 'hasPrivilage', array('style'=>'display:block;')) ?>
                </div>
            </td>
        </tr>
    </table>
    
    <?php $this->endWidget(); ?>
    
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>
</div><!-- form -->