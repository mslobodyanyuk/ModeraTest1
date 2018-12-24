<?php
namespace src\controller;

use general as G;		
use src\Factory as F;
use src\Composite as C;
use config as Config;
use \app\models\Tree as Tree;

error_reporting(E_ALL & ~(E_NOTICE| E_WARNING ));
/*
 * Class File Process Controller, the controller performs Actions according to the address bar.
 */
class FileProcessController {

    /*
     * Method (Action) indexAction() of controller is executed by default
     * when specifying the address bar http://modera_test.loc/, view index.php
     */
	public function indexAction() {

	}

    /*
     * Method (Action) uploadAction() of controller to the server to download a file,
     * processing content, the transmission parameters listAction(),
     * is performed by specifying the address bar http: //modera_test.loc/upload, view upload.php
     */
	public function uploadAction() {
        $configParams = new Config\Parameters();
        $uplPath = $configParams -> getConfigParameters();
        $parameters = $configParams -> getConfigParameters('fileUploadParameters');

        $uplTempNamePath = $parameters['uplTempNamePath'];
        $uplNamePath = $parameters['uplNamePath'];

        if (is_uploaded_file($uplTempNamePath)) {
            $uploadfile = $uplPath.basename($uplNamePath);
            copy($uplNamePath, $uploadfile);

			if (!$handle = fopen($uploadfile, 'a')){
				echo "Can't open file($uploadfile)";
				exit;
			}
					
			$params['success'] = true;
			$params['filename'] = $uploadfile;				
										
			$file = new G\File\File($params['filename']);
			$params['size'] = filesize($params['filename']);
			$text = $file->getContent();	
			$params['text'] = $text;

/**
 ******************************************************************************************************************************************************/
            $configDatabase = new Config\Database();
            $databaseParameters = $configDatabase->getDatabaseParameters();

            $db = new Tree($databaseParameters['host'], $databaseParameters['name'], $databaseParameters['password'], $databaseParameters['database']);

            $params['databaseTree'] = $db->getTree();
/**
 ******************************************************************************************************************************************************/

		}
		else{
			$params['success'] = false;
		}

		return  $params;
	}

    /*
     * Method (Action) listAction() of controller, parsed into an array of content,
     * is performed by specifying the address bar http://modera_test.loc/list, result output - view list.php
     */
	public function listAction() {
        $configParams = new Config\Parameters();
        $uplPath = $configParams -> getConfigParameters();

        $path = $uplPath;
		if ($handle = opendir($path)) {		
			while (false !== ($file = readdir($handle))) { 
				if ($file != "." && $file != "..") {
                    $path = $uplPath.$file;
				} 
			}
		}
		closedir($handle); 			
						
		$file = new G\File\File($path);
		$text = $file->getContent();		

		/*PARSE DATA*/		
		$parser = new G\Parser\TextParser();
		$dataArray = $parser->parse($text);
		/*PARSE DATA*/
/**
******************************************************************************************************************************************************/
        $configDatabase = new Config\Database();
        $databaseParameters = $configDatabase->getDatabaseParameters();

        $db = new Tree($databaseParameters['host'], $databaseParameters['name'], $databaseParameters['password'], $databaseParameters['database']);
        $db->deleteTree();
        $db->plantTree($dataArray);
        $databaseArray = $db->getTree();
/**
******************************************************************************************************************************************************/



/***********Create a tree structure******************************/
		$factory = new F\GoodsFactory();
        // Sort the array with the data so that the branches was the first.
	    usort($dataArray, create_function('$a,$b','if ((int)$a["parentId"]===(int)$b["parentId"]) return 0;
	     return (int)$a["parentId"]>(int)$b["parentId"] ? 1 : -1;'));
        // To create the main node through the factory.
		$root = $factory->createRoot(array('nodeId'=>0, 'nodeName'=>'root'));
        // Gathering wood
		foreach($dataArray as $data) {
			$iterator = $root->getIterator();
            $iterator->seek($data['parentId']);
			$parent = $iterator->current();
			$item = $factory->create($data);
            $parent->addChild($item);
		}	
/***********Create a tree structure******************************/
		$params[0] = $root->getDataToPrint();
        usort($dataArray, create_function('$a,$b','if ((int)$a["nodeId"]===(int)$b["nodeId"]) return 0;
	     return (int)$a["nodeId"]>(int)$b["nodeId"] ? 1 : -1;'));
        $params[1] = $dataArray;
        $params[2] = $databaseArray;
		return $params;
	}
	
}
