<?php
/**
* Pokey
* - We need alot more homework.
*
* @version 0.1 Beta
* @author Michael McMillan
* @link http://github.com/michaelmcmillan/pokey
* @license http://www.gnu.org/licenses/gpl.html
* @package Pokey
* @example When a friend pokes you on Facebook, poke
*          him back in-real-life by ejecting from tray.
*/

$pokey['facebook'] = "http://m.facebook.com/login.php";
$pokey['username'] = "";
$pokey['password'] = "";

$splash =
"
 _____      _              
|  __ \    | |            
| |__) |__ | |   ___ _   _ 
|  ___/ _ \| |/ / _ \ | | |
| |  | (_) |   <  __/ |_| |
|_|   \___/|_|\_\___|\__, |
                      __/ |
   Version 0.1. Beta |___/ 
";

print $splash;

function Pokey ($pokey) {
  
    function Pokey_Execute ()
    {
        exec('pokey.exe eject');   
    }
  
    function Facebook_login ($username, $password, $url)
    {
        $ch = curl_init($url);
        $cookie = 'cookie.txt';
        $POST = "email=$username&pass=$password&login=Logg+inn";
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $POST); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie); 
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)"); 
        curl_setopt($ch, CURLOPT_POST, 1);
        $facebook_login = curl_exec ($ch); 
        
        while (true)
        {
            curl_setopt($ch, CURLOPT_URL, "http://m.facebook.com/home.php?"); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie); 
            curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);  
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)"); 
            $facebook_home = curl_exec ($ch);
            
            if ( stristr ($facebook_home, 'poket') )
            {
                print 'PREPARE FOR POKE MOTHERFUCKER!';
                Pokey_Execute ();   
            }
            sleep(60);
        }
    }
    Facebook_login ($pokey['username'], $pokey['password'], $pokey['facebook']);      
}
Pokey ($pokey);
    