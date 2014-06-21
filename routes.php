<?php
$requestURI = explode('/', $_SERVER['REQUEST_URI']);
$scriptName = explode('/',$_SERVER['SCRIPT_NAME']);
 
for($i= 0;$i < sizeof($scriptName);$i++)
        {
      if ($requestURI[$i]     == $scriptName[$i])
              {
                unset($requestURI[$i]);
            }
      }
 
$command = array_values($requestURI);
switch($command[0])
      {
 
      case 'commandOne' :
                echo 'You entered command: '.$command[0];
                break;
 
      case 'commandTwo' :
                echo 'You entered command: '.$command[0];
                break;
 
      default:
                echo 'That command does not exist.';
                  break;
      }
  echo $_SERVER['REQUEST_URI'];
?>