<div id="breadcumb">
	<a href="<?php echo Yii::app()->createUrl('appUser/index'); ?>"> <span class="icon_home"> Home </span> </a> 
    <small>></small> 
    <a href="#">Inference System</a>  
</div>

<div id="wrapped_content">
    <h1>Manage Inference System</h1>
    
    <?php
        foreach(Yii::app()->user->getFlashes() as $key => $message) 
        {
            echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
        }
    ?>
    <form action="<?php echo Yii::app()->createUrl('inferenceSystem/index'); ?>" method="post" name="inferenceSystem">
    <div id="input_container">
        
        <div class="input">
            <div class="input_title_text">
                <span class="icon_var_input"></span> Fuzzy Tsukamoto
            </div>
             
            <table>
                <tr>
                    <td>And Method</td>
                    <td>:</td>
                    <td>
                        <select name="andMethod" style="width: 200px;">
                            <option value="<?= ARFisType::$TSUKAMOTO_AND_METHOD_MIN ?>"
                                    <?= $fis->and_method == ARFisType::$TSUKAMOTO_AND_METHOD_MIN ? "selected='selected'" : "" ?>
                                    >Min</option>
                            <option value="<?= ARFisType::$TSUKAMOTO_AND_METHOD_PROD ?>"
                                    <?= $fis->and_method == ARFisType::$TSUKAMOTO_AND_METHOD_PROD ? "selected='selected'" : "" ?>
                                    >Prod</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Or Method</td>
                    <td>:</td>
                    <td>
                        <select name="orMethod" style="width: 200px;">
                            <option value="<?= ARFisType::$TSUKAMOTO_OR_METHOD_MAX ?>"
                                     <?= $fis->or_method == ARFisType::$TSUKAMOTO_OR_METHOD_MAX ? "selected='selected'" : "" ?>
                                    >Max</option>
                            <option value="<?= ARFisType::$TSUKAMOTO_OR_METHOD_PROBOR ?>"
                                    <?= $fis->or_method == ARFisType::$TSUKAMOTO_OR_METHOD_PROBOR ? "selected='selected'" : "" ?>
                                    >Probor</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Implication</td>
                    <td>:</td>
                    <td>
                        <select name="implication" disabled="disabled" style="width: 200px;">
                            <option></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Aggregation</td>
                    <td>:</td>
                    <td>
                        <select name="aggregation" disabled="disabled" style="width: 200px;">
                            <option></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Defuzzification</td>
                    <td>:</td>
                    <td>
                        <select name="defuzzification" style="width: 200px;">
                            <option value="<?= ARFisType::$TSUKAMOTO_DEFUZZIFICATION_WVTAVER ?>"
                                     <?= $fis->defuzzification == ARFisType::$TSUKAMOTO_DEFUZZIFICATION_WVTAVER ? "selected='selected'" : "" ?>
                                    >Rata-rata terboboti</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <input type="submit" value="Save" />
    </form>
</div>