<div id='wrapped_content'>
    
    <div id="company_info">
        <div id="company_text_header">
            Sistem Pakar 
        </div>
        <div class="text_description">
            Dibuat untuk memenuhi tugas akhir Sistem Pakar.
        </div>
        <br/>
        <div class="text_description">
            Anggota Kelompok:
            <ul>
                <li>
                    Agus Setiawan
                </li>
                <li>
                    Angga Nugraha
                </li>
                <li>
                    Asep Rahmat Ginanjar
                </li>
                <li>
                    Fonda Rizenda
                </li>
            </ul>
        </div>
        <br/>
        <div class="text_description">
            
        </div>
    </div>
    
    <div id="login">
        <?php $form=$this->beginWidget('CActiveForm',array(
            'id'=>'login-form',
            'enableAjaxValidation'=>false,
        )); ?>

        <div id="login_title_text">
            Login
        </div>
        <br/>
        <div class="form">
            <div class="row">
                <?php echo $form->labelEx($model,'username'); ?>
                <?php echo $form->textField($model,'username', array('size'=> 35)); ?>
                <?php echo $form->error($model,'username'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model,'password'); ?>
                <?php echo $form->passwordField($model,'password', array('size'=> 35)); ?>
                <?php echo $form->error($model,'password'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::submitButton('Login'); ?>
                <?php echo $form->checkbox($model, 'rememberMe', array('style'=>'margin: 2px 0px 2px 10px;')); ?> Remember me
            </div>
        </div>
        <?php
             $this->endWidget(); 
        ?>
    </div>
</div>