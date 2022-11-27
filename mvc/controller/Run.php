<?php
    //http://127.0.0.1/Run
    class Run extends Controller{
        function display(){
            //model cần chạy
            $obj = $this->getModel('SanPhamDB');
            $rs = $obj->createNextProductId();

            echo '<pre>';
            print_r($rs);
        }
    }
?>
