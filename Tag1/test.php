<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    Hier ist normales HTML <br>
    <?php
        function Write($text = ""){
            echo $text. "<br>" .chr(10);
        }

        /* Kommentar: Hier wird der Text zwischen den Anführungszeichen ausgegeben */
        $var1 = "Und das ist im PHP - code."; 
        $var1 = 123456789;
        $var1 = '3';

        $var1 = $var1 ** 2;
        Write($var1);

        $var2 = 'text Hallo Welt :) $var1';
        Write($var2);

        $var2 = "text Hallo Welt :) $var1";
        write($var2);

        $text1 = "Hallo Welt";
        $text2 = "Jaja";
        Write($text1 . " " . $text2);
        Write("$text1 $text2");

        $text2 = "Heute ist ";
        $text2 .= "Montag";// $text2 = $text1 . "Montag";
        Write($text2);

        $zahl = 5;
        $zahl++;
        Write($zahl);

        write(date("d.m.Y"));

        $id = 5;
        $sql = "Select * from tabelle where id = $id";

        Write();
        //insert SQL
        $sql = "Insert into tabelle (name) values ('Sullivan')";
        Write($sql);
     
        $name = "Sullivan";
        $sql = "Insert into tabelle (name) values ('$name')";
        Write($sql);

        Write();
        //Html   
        Write('<input type="button" value="senden">');
        Write("<input type=\"button\" value=\"senden\">");

        $value = "senden";
        Write('<input type="button" value="'.$value.'">');
        Write("<input type=\"button\" value=\"$value\">");

    ?>
</body>

</html>