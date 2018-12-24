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
        $lines4Parse = json_decode($text,true);

        foreach($lines4Parse as $v){
            $parsedLine = '';
            $parsedLine["nodeId"] = $v["id"];
            $parsedLine["parentId"] = $v["parent_id"];
            $parsedLine["nodeName"] = $v["name"];

            $parsedData[] = $parsedLine;
        }
        return $parsedData;
    }

}

?>