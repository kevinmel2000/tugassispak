<div id="wrapped_content">
    <div id="">
       
    </div>
    <h4 id="desc"></h4>
    
    <div>
       <h2>Sistem Pakar Produksi Benang</h2>
    </div>
    <form action="<?php Yii::app()->createUrl('frontEnd/index'); ?>" method="post">
    <div class="well" style="background-color: rgba(245, 245, 245, 0.4); background-image: none;"> 
        <h5>Persediaan</h5>
        <br/>
        <input id="persediaan" name="persediaanSlider" data-slider-id='ex1Slider' 
               style="width: 450px;" type="text" data-slider-min="225886" data-slider-max="264202" data-slider-step="1" data-slider-value="<?php echo isset($persediaan)? $persediaan : 0 ?>"
               value="<?php echo isset($persediaan)? $persediaan : 0 ?>"/>
        
        <input id="persediaanText" name="persediaanText"  style="width: 100px" type="text" value="<?php echo isset($persediaan)? $persediaan : 0 ?>"/>
        <div id="error" style="color: red"><?php echo $errorInput1 ?></div>
        <h5>Permintaan</h5>
        <br/>
        
        <input id="permintaan" name="permintaanSlider" data-slider-id='ex2Slider' 
               style="width: 450px" type="text" data-slider-min="224260" data-slider-max="350023" data-slider-step="1" data-slider-value="<?php echo isset($permintaan)? $permintaan : 0 ?>"
               value="<?php echo isset($permintaan)? $permintaan : 0 ?>"/>
        
        <input id="permintaanText" name="permintaanText" style="width: 100px" type="text" value="<?php echo isset($permintaan)? $permintaan : 0 ?>"/>
        <div id="error" style="color: red"><?php echo $errorInput2 ?></div>
        <br/>
        
        
        <h5>Option</h5>
        <input type="radio" id="type1" name="type" value="1"
               <?php echo $input == 1 ? "checked='checked'" : "" ?> > Slider  
        <input type="radio"  id="type2" name="type" value="2"
               <?php echo $input == 2 ? "checked='checked'" : "" ?> > Manual Input  
        
        <br/>
        <br/>
        <input style="display: none;" type="text" id="inputType" name="inputType" value="2"/>
        <input type="submit" value="Hitung" class="btn btn-ok"/>
    </div>
    
    <div id="result" 
            <?php echo $jumlahProduksi < 0 ? "style='display:none'" : ""?>
         >
        
        Disarankan untuk memproduksi benang sebanyak:
        <h3><?= isset($jumlahProduksi) ? $jumlahProduksi : ""?> kg</h3>
    </div>
    </form>
    
    <div style="padding: 80px 0px 0px 0px; text-align: center">
        Copyright 2013 Tugas Sistem Pakar AJ Ilkom 7 IPB    
    </div>
</div>

<script type="text/javascript">
    
    $("#persediaan").slider({
        tooltip: 'always'
    });
    
     $("#permintaan").slider({
        tooltip: 'always'
    });
    
    
    function hideSlider()
    {
       $("#ex1Slider").hide();
       $("#ex2Slider").hide();
    }
    
    function showSlider()
    {
       $("#ex1Slider").show();
       $("#ex2Slider").show();
    }
    
    function hideInputText()
    {
       $("#persediaanText").hide();
       $("#permintaanText").hide(); 
    }
    
    function showInputText()
    {
       $("#persediaanText").show();
       $("#permintaanText").show(); 
    }
    
    $(document).ready(function(){
       $("input[name='type']").change(function(){ 
           // 1 is slider
           if($('#type1').is(':checked')) 
           { 
               hideInputText();
               showSlider();
               
               $("#inputType").val(1);
           }
           
           // 2 is textbox
           if($('#type2').is(':checked')) 
           {
               hideSlider();
               showInputText();
               
               $("#inputType").val(2);
           }
       });
       
       $input = <?php echo $input; ?>;  
       if($input == 1)
       {
           hideInputText();
           showSlider();
               
           $("#inputType").val(1);
       }
       
       if($input == 2)
       {
            hideSlider();
            showInputText();
               
            $("#inputType").val(2);
       }
    });
</script>