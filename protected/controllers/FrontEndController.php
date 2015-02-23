<?php

class FrontEndController extends Controller
{
    public $layout = '//layouts/frontEnd';
    
    public function actionIndex()
    {
        $persediaan = 0;
        $permintaan = 0;
        $jumlahProduksi = -1;
        
        $errorInput1 = "";
        $errorInput2 = "";
        $isError = 0;
        
        // 1 is slider
        // 2 is textbox
        $input = 1;
        
        if(isset($_POST) && count($_POST) > 0)
        {
            $fis = Fis::model()->find('id=:id', array(':id' => 6));
            
            $input = $_POST["inputType"];
            
            if($input == 1)
            {
                $persediaan = $_POST["persediaanSlider"];
                $permintaan =  $_POST["permintaanSlider"];
            }
            else if($input == 2)
            {
                $persediaan = $_POST["persediaanText"];
                $permintaan =  $_POST["permintaanText"];
            }
            
            $stat = 0;
            if(!is_numeric($persediaan) || !is_numeric($permintaan))
            {
                $isError = 1;
                
                if(!is_numeric($persediaan))
                    $errorInput1 = "Harus numerik";
                
                if(!is_numeric($permintaan))
                    $errorInput2 = "Harus numerik";
            }
            
            if($isError == 1)
            {
                $this->render('index', array(
                    'persediaan' => $persediaan,
                    'permintaan' => $permintaan,
                    'jumlahProduksi' => $jumlahProduksi,
                    'input' => $input,
                    'isError' => $isError,
                    'errorInput1' => $errorInput1,
                    'errorInput2' => $errorInput2,
                ));
                return;
                
            }  
            
            //$persediaan = 230500;
            //$permintaan =  260000;
        
            $idPersediaan = 0;
            $idPermintaan = 0;
            
            
//            $fis = Fis::model()->find('id=:id', array(':id' => 1));
//            
//            $persediaan = 256500;
//            $permintaan =  335500;
//        
//            $idPersediaan = 97;
//            $idPermintaan = 96;
            
            
            foreach($fis->variables as $variable)
            {
                if($variable->name == "persediaan")
                {
                    $idPersediaan = $variable->id;
                }
                else if($variable->name == "permintaan")
                {
                    $idPermintaan = $variable->id;
                }
            }
            
            $userInput = array($idPermintaan => $permintaan, $idPersediaan => $persediaan);
            $arFis = new ARFisTsukamoto();
            
            $result = $arFis->setInput($fis->id, $userInput);
            
           // print_r($result);
            $jumlahProduksi = ceil($result["results"]["produksi"]["hasil"]);
        }
        
        $this->render('index', array(
            'persediaan' => $persediaan,
            'permintaan' => $permintaan,
            'jumlahProduksi' => $jumlahProduksi,
            'input' => $input,
            'isError' => $isError,
            'errorInput1' => $errorInput1,
            'errorInput2' => $errorInput2,
           ));
    }
}
