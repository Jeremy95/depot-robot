<?php

$host = "localhost";         
$database = "bchiri";        
$user = "bchiri" ;            
$password = "618143" ;           
@mysql_close();
$link = mysql_connect ($host, $user, $password) ;
mysql_select_db ($database) ;
if (!isset($admin) and !isset($insert))
{
    $result=mysql_query("SELECT * FROM cronemul");
    while ($row=mysql_fetch_array($result) or die (mysql_error()) )
            {
            $day = $row[day];      // correct dates are from 01 to 31
            $month = $row[month];     // correct months are from 01 to 12
            $year = $row[year];         // correct years are from 1970 to 2037
            $seconds = $row[seconds];      // from 00 to 59
            $minutes = $row[minutes];      // from 00 to 59
            $hour = $row[hour];         // from 00 to 23
            $frequency=$row[frequency]; // in hours (unit)
            $file_to_execute=$row[file];
             break;
            }
    $this_moment = time();
    $date_to_go = mktime($hour, $minutes, $seconds, $month, $day, $year);
            if($date_to_go <= $this_moment)
                    {
                                 @mysql_close();
                                require($file_to_execute);
                            $next=getdate($date_to_go + ($frequency*3600) );
                             $year=$next[year];
                             $month=$next[mon];
                             $day=$next[mday];
                             $hour=$next[hours];
                             $minutes=$next[minutes];
                             $seconds=$next[seconds];
                                 $link = @mysql_connect ($host, $user, $password) ;
                                 @mysql_select_db ($database) ;
                                 $result=@mysql_query("UPDATE cronemul SET year= '$year',  month='$month',  day='$day',        hour='$hour', minutes='$minutes', seconds='$seconds' where year is not null") or die(mysql_error());
                    }
}
/// Formulaire d'administration
if ($admin==1)
{
echo "<br><br><table align=\"center\"><form action=\"$PHP_SELF\" method=\"get\" target=\"_self\">" ;
echo "<tr> <th colspan=6> Entrez les paramètres du cron : premier déclenchement, fréquence, fichier à exécuter";
$year=2001;
echo "<tr><td>Année<br><select name=\"year\"> <option value=\"$year\">";
echo $year;
$year++;
echo "</option>        <option value=\"$year\"> ";
echo $year;
$year++;
echo "</option>        <option value=\"$year\"> ";
echo $year;
$year++;
echo "</option>        <option value=\"$year\"> ";
echo $year;
$year++;
echo "</option>        <option value=\"$year\"> ";
echo $year;
$year++;
echo " </option><option value=\"$year\">";
echo $year;
echo "</option> </select>";
echo "<td>Mois<br><select name=\"month\">";
for($month=1;$month<=12;$month++)
        {
        echo "<option value=\"$month\">".$month."</option>";
        }
echo "</select>";
echo "<td>Jour<br><select name=\"day\">";
for($day=1;$day<=31;$day++)
        {
        echo "<option value=\"$day\"> ".$day." </option>";
        }
echo "</select>";
echo "<td>Heures<br><select name=\"hour\">";
for($hour=0;$hour<=23;$hour++)
        {
        echo "<option value=\"$hour\">".$hour."</option>";
        }
echo "</select>";
echo "<td>Minutes<br> <select name=\"minutes\">";
for($minutes=0;$minutes<=59;$minutes++)
        {
        echo "<option value=\"$minutes\">".$minutes."</option>";
        }
echo "</select>";
echo "<td>Fréquence du cron<br>en heures<br> <select name=\"frequency\">";
for($frequency=1;$frequency<=720;$frequency++)
        {
        echo "<option value=\"$frequency\">".$frequency."</option>";
        }
echo "</td><</select><td>Fichier à éxécuter<br>chemin complet<br>
<input type=\"text\" name=\"file\" >
<input type=\"hidden\" name=\"insert\" value=\"ok\">
<tr><td colspan=6 align=\center\"><input type=\"submit\" value=\"Go !\"></form></table>";
} /////////// fin de administration CRON
if ($insert=="ok")
        {
        echo "Jour : ".$day."<br>Mois : ".$month."<br>Année : ".$year;
        echo "<br>Heure : ".$hour."<br>minutes : ".$minutes."<br>Fréquence : ".$frequency;
        if(checkdate( $month, $day , $year ))
        {
        mysql_query("DELETE FROM cronemul ") or die (mysql_error());
        mysql_query("INSERT INTO cronemul SET year='$year', month='$month',        day='$day',        hour='$hour', minutes='$minutes', seconds=0, frequency='$frequency', file='$file' ") or die (mysql_error());
        echo "<br>Données enregistrées"; } else {
        echo "<h2 align=\"center\"> date non valide, recommencez</h2>"; }
        } // fin de insertion base
?>