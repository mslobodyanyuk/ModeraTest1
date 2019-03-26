<?php
/* List - result display
 * view/FileProcess/list.php
 */
header('Content-Type: text/html; charset=utf-8'); 
use src\Factory as F;

$params = $controllerParams;
echo "- I am a view list.php,<br />",
	 "<h2>Tree structure:</h2>","<pre>",print_r($params[0]),"</pre>",
     "<h2>List array:</h2>","<pre>",print_r($params[1]),"</pre>",
     "<h2>Database array:</h2>","<pre>",print_r($params[2]),"</pre>";
?>

<!DOCTYPE html>
<html>
<head>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <style>
        h3 { cursor:pointer;}
    </style>
</head>
<body>

<?php
    foreach($params[1] as $param ) {

        if ($param['parentId'] == 0) {
            echo "</ul></div>";

            $parentId = $param['nodeId'];
            echo "<div class='box'><h3><span>", $param['nodeName'], "</span></h3><ul>";
        }else{
            echo "<li>", $param['nodeName'], "</li>";

            if ($param['parentId'] != $parentId) {
                echo "</ul></div>";
            }
        }

    }
    echo "</ul></div>";
?>

<script>
    $(document).ready(function(){
        $("ul").hide();
        $("h3 span").click(function(){
            $(this).parent().next().slideToggle();
        });
    });
</script>
</body>
</html>