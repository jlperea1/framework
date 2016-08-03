<html>
<body>
<?php
system ("gpio mode 0 out");
system ("gpio mode 1 out");
system ("gpio mode 3 out");
system ("gpio mode 4 out");

system ("gpio mode 0 out");
$opcion = '';
echo exec('whoami');
echo '<br>';
 if (isset($_POST['opcion'])) {
  $opcion=$_POST['opcion'];
  echo $opcion;
  if ($opcion=='avanza')
  {
   system("gpio write 0 1");
   system("gpio write 3 1");
   usleep(100000);
   system("gpio write 0 0");
   system("gpio write 3 0");
   $opcion='';
   
  }
 if ($opcion=='retrocede')
  {
   system("gpio write 1 1");
   system("gpio write 4 1");
   usleep(100000);
   system("gpio write 1 0");
   system("gpio write 4 0");
   $opcion='';
   
  }
 if ($opcion=='izquierda')
  {
   system("gpio write 0 1");
   system("gpio write 4 1");
   usleep(100000);
   system("gpio write 0 0");
   system("gpio write 4 0");
   $opcion='';
   
  }
 if ($opcion=='derecha')
  {
   system("gpio write 1 1");
   system("gpio write 3 1");
   usleep(100000);
   system("gpio write 1 0");
   system("gpio write 3 0");
   $opcion='';
   
  }
 if ($opcion=='capturar')
  {
   //system("sudo LD_PRELOAD=/usr/lib/arm-linux-gnueabihf/libv4l/v4l2convert.so fswebcam -s contrast=10 -s brightness=60  -r 640x480 -v test.jpg");
   //exec("sudo fswebcam -D 1 -S 20 test.jpg");
   exec("sudo raspistill -o test.jpg");
   sleep(1);
   header("Refresh:0");   
   $opcion='';
  }
 if ($opcion=='capturar con poca luz')
  {
   //system("sudo LD_PRELOAD=/usr/lib/arm-linux-gnueabihf/libv4l/v4l2convert.so$
   //exec("sudo fswebcam -F 21 --fps 5 -D 1 -S 20 -s brightness=50% -s contrast$
   exec("sudo python webcamsnap.py");
   sleep(1);
   header("Refresh:0");   
   $opcion='';
  }
 if ($opcion=='pan')
  {
   //echo $_POST['deg'];
//   exec("sudo python i2creadsendarduino.py 1 ");
//   sleep(1);
   exec("sudo python i2creadsendarduino.py 1 ".$_POST['deg']);
   sleep(1);
   $opcion='';
   
  }
 if ($opcion=='medir')
  {
   exec("sudo python i2creadsendarduino.py 2 100 ", $distancia);
   sleep(1);
   //var_dump($distancia);
   echo '<br>';
   echo 'Distancia: '.$distancia[0];
   $opcion='';
   
  }

 if ($opcion=='grados')
  {
   exec("sudo python i2creadsendarduino.py 3 100 ", $gra1);
   usleep(1);
   exec("sudo python i2creadsendarduino.py 4 100 ", $gra2);
   usleep(1);
   exec("sudo python i2creadsendarduino.py 5 100 ", $gra3);
   usleep(1);
   exec("sudo python i2creadsendarduino.py 6 100 ", $gra4);
   usleep(1);
   //var_dump($gra);
   //echo '<br>';
   //echo 'Grados: '.$gra1[0];
   echo '<br>';
   $numgra=$gra2[0]*100+$gra3[0]*10+$gra4[0];
   echo 'Grados: '.$numgra;
   $opcion='';
   
  }

  
  echo '<br>';

}

?>
Prueba
<form method="post">
<table>
<tr><td></td>
<td>
<input type="submit" name="opcion" value="avanza">
</td>
<td></td></tr>
<tr>
<td><input type="submit" name="opcion" value="izquierda">
</td>
<td>
</td>
<td>
<input type="submit" name="opcion" value="derecha">
</td></tr>
<tr><td></td>
<td>

<input type="submit" name="opcion" value="retrocede">
</td>
<td></td></tr>
<tr>
<td colspan="2">
<input type="range"  name="deg" min="75" max="125">
</td><td>
<input type="submit" name="opcion" value="pan">
</td></tr>
<tr><td>
<input type="submit" name="opcion" value="capturar">
</td>
<td></td><td></td>
</tr>
<tr><td colspan="2">
<input type="submit" name="opcion" value="capturar con poca luz">
</td>
<td></td><td></td>
</tr>
<tr><td colspan="3">
<img src="test.jpg" height="240" width="320">
</td></tr>
<tr><td>
<input type="submit" name="opcion" value="medir">
</td>
<td></td><td></td>
</tr>
<tr><td>
<input type="submit" name="opcion" value="grados">
</td>
<td></td><td></td>
</tr>


</table>
</form>
</body>
</html>
