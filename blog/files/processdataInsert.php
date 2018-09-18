<?php
include_once(dirname(__FILE__).'./../classes/serverConfig.php'); 
include_once(dirname(__FILE__).'./../classes/post.php');

if(!empty($_REQUEST['postTitle'])&&!empty($_REQUEST['postContent']))
{
	$postTitle = strip_tags($_REQUEST['postTitle']);
	$postContent = strip_tags($_REQUEST['postContent']);

	if(isset($postTitle)&&is_string($postTitle)&&isset($postContent)&&is_string($postContent)){
  

        $arrayConfig = array();
        $oConfig = new serverConfig();
		$arrayConfig = $oConfig->allConfig();
		$oPost = new Post($arrayConfig[0],$arrayConfig[1],$arrayConfig[2],$arrayConfig[3]);
		$aErrores = $oPost->insertPost($postTitle,$postContent);

		echo $aErrores;

	}else{

		echo $aErrores = "Ha ocurrido un error, por favor revisa el tipo de dato introducido";

	}
}else{
	echo $aErrores = "Ha ocurrido un error, hay campos vacios";
}


?>