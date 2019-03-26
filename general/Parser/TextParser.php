<?php

namespace general\Parser;

/*
 * TextParser class - data conversion (from the text of the array).
 */
class TextParser implements TextParserInterface{

    /*
     * Method parse($text) converts text to array.
     */
	public function parse($text){
        $linesForParse = json_decode($text,true);

        $parsedData = [];

        foreach($linesForParse as $value){
            $parsedData[] = [
                'nodeId' => $value['id'],
                'parentId' => $value['parent_id'],
                'nodeName' => $value['name'],
            ];
        }

        return $parsedData;
    }

}

?>