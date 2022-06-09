<?php
    $wsdl = "http://ehusw.es/jav/ServiciosWeb/comprobarmatricula.php?wsdl";
    $options = [
        'cache_wsdl' => WSDL_CACHE_NONE,
        'exceptions' => true,
        'trace' => true,
    ];
    try{
        $soapclient = new SoapClient($wsdl, $options);
        if (isset($_GET['Email'])){
            $result = $soapclient->__soapCall('comprobar',array('x' => $_GET['Email']));
            echo "El correo ".$result." está matriculado";
        }
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
    
?>