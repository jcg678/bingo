<?php
/**
 * Created by PhpStorm.
 * User: alumno
 * Date: 18/11/15
 * Time: 13:22
 */
echo "<table border='3'>";
echo "<tr><td>X</td><td>20</td><td>30</td><td>40</td><td>50</td><td>60</td><td>70</td><td>80</td></tr>";

for($i=1 ;$i<=10 ;$i++){
    echo "<tr><td>".$i."</td><td>".(20+$i)."</td><td>".(30+$i)."</td><td>".(40+$i)."</td><td>".(50+$i)."</td><td>".(60+$i)."</td><td>".(70+$i)."</td><td>".(80+$i)."</td></tr>";
}

echo "</table>";