<?php
include_once(dirname(__FILE__).'./../classes/serverConfig.php'); 
include_once(dirname(__FILE__).'./../classes/post.php');

function isValidTimeStamp($timestamp)
{
     $mysqldate = date("Y-m-d H:i:s", strtotime($timestamp));

    if($timestamp==$mysqldate){
    	return 1;
    }else{
    	return 0;
    }

}

if(!empty($_REQUEST['updateId'])&&!empty($_REQUEST['updateTitle'])&&!empty($_REQUEST['updateContent'])&&!empty($_REQUEST['updateFecha']))
{

	

	$updateId = (int)$_REQUEST['updateId'];
	$updateTitle = strip_tags($_REQUEST['updateTitle']);
	$updateContent = strip_tags($_REQUEST['updateContent']);
	$updateFecha = $_REQUEST['updateFecha'];

	

	if(isset($updateId)&&is_numeric($updateId)&&isset($updateTitle)&&is_string($updateTitle)&&isset($updateContent)&&is_string($updateContent)&&isValidTimeStamp($updateFecha)){


        $aErrores = "No hay ningún error";  


        $arrayConfig = array();
        $oConfig = new serverConfig();
		$arrayConfig = $oConfig->allConfig();
		$oPost = new Post($arrayConfig[0],$arrayConfig[1],$arrayConfig[2],$arrayConfig[3]);
		$oPost->updatePost($updateId,$updateTitle,$updateContent,$updateFecha);

		header("Location: /blog");

	}else{
		
		echo $aErrores = "Ha ocurrido un error, por favor revisa el tipo de dato introducido";
		header("Location: /blog");

	}
}else{
	echo $aErrores = "Ha ocurrido un error, hay campos vacios";
}




?>