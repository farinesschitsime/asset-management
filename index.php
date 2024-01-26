<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $username = "farie";
        $age = 12;
        $weight = 90.67;
        $array = [1,2,3,6];
        $names = ["carol","dominic","esther"];
        $languages = [1=>"java",2=>"PHP", 3=>"Javascript"];
        $color =["white"=>"#FFFFFF","grey"=>"DDDDDDD"];
        echo "<ul>";
        foreach($names as $name){
            echo "<li>".$name."</li>";
        }
        echo "</ul>";

        $array[3];
        echo "<h1>hello ".$username."</h>";
        echo "<p>the value of last element is " .$array[3]."</p>";
        echo "<p>the color is ".$color['white']."</p>";
    ?>
</body>
</html>