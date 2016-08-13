<html>

      <head>

            <title>

            Libro de visitas

            </title>

      </head>



      <body bgcolor="#220000">



            <font color="#ffffff">



            <?php

            $this_file = "index.php";
            
            if (!isset($PHP_SELF) || $PHP_SELF == "") { $PHP_SELF = $this_file; }

            if (isset($_POST['texto_enviado'])) { $texto_enviado = $_POST['texto_enviado']; }

            if (!isset($REMOTE_ADDR)) { $REMOTE_ADDR = $HTTP_SERVER_VARS['REMOTE_ADDR']; }

            //si el archivo enviados.txt no existe, se crea:

            if (!file_exists("enviados.txt")) {

                 //echo "EL ARCHIVO NOOOOOOO EXISTE Y SE CREARA";

                 $archivo = fopen("enviados.txt", "a+");

                 fwrite($archivo,"\n");

                 }

            else { 

                 $archivo = fopen("enviados.txt", "a+"); 

                 //echo "EL ARCHIVO EXISTE"; 

                 }

            ?>



            <h1>Libro de visitas de pruebita tita</h1>

            <h3>by A-Kristo</h3>

            <br>

            <br>

            <h4>Escribe aqui tu texto que pasar&aacute; a la posteridad:</h4>

            <form action="<? echo $PHP_SELF ?>" method="POST">

            <textarea cols="60" rows="5" name="texto_enviado"></textarea> <!-- wrap="virtual" */ -->

            <input type="submit" value =" Enviar ">

            </form>

            

            <?php

            if (isset($texto_enviado) && ($texto_enviado != null)) {

               $fecha_pre = getdate();

               $fecha = $fecha_pre['mday'] . "/" . $fecha_pre['mon'] . "/" . $fecha_pre['year'];

               $hora = $fecha_pre['hours'] . ":" . $fecha_pre['minutes'];

//             fwrite($archivo,"<p>Texto desde <b>" . $REMOTE_ADDR . "</b> (<b>" . gethostbyaddr($REMOTE_ADDR) . "</b>) el $fecha a las $hora &gt;&gt;&gt;<br><font color='#aaaaaa'>".nl2br(wordwrap($texto_enviado, 180, " <br>", 1))."</font><br>--- fin de texto enviado</p>\n");

               fwrite($archivo,"\n\n<p>Texto desde <b>" . $REMOTE_ADDR . "</b> (<b>" . gethostbyaddr($REMOTE_ADDR) . "</b>) el $fecha a las $hora &gt;&gt;&gt;<br><font color=\"#aaaaaa\">\n".str_replace("\\\"", "\"", str_replace("<br />", "<br>", nl2br(wordwrap(htmlspecialchars($texto_enviado), 180, " <br>", 1))))."</font><br>\n--- fin de texto enviado</p>\n");

               }

            //   else { echo "<h2><b>TEXTO ENVIADO NULO... &iexcl;&iexcl;&iexcl;ESCRIBE ALGO!!!</b></h2>"; }

            ?>



            <br>

            <br>

            <br>

            <br>

            <br>



            <p><b><u>Comentarios enviados</u>:</b></p>

            <br>

            

            <?php

            

            readfile("enviados.txt");

            fclose($archivo);

                        

            ?>



            </font>

      </body>

</html>

