<?php

class Session
{
   
    public static function init()
    {
        
        if (session_id() == '') {
            session_start();
        }
    }

    
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    
    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    
    public static function destroy()
    {
        session_destroy();
    }
	   public static function setArray($key, $value)
    {
        $_SESSION[$key][] = $value;
    }
	public static function cut($key)
    {
        if (isset($_SESSION[$key])) {
          $str = $_SESSION[$key];
		  unset($_SESSION[$key]);
		 
		  return  $str;
        }
		else if($key == 'prev_view' || $key == 'next_view')
		{
		
		 $_SESSION['prev_view'] = null;
		 $_SESSION['next_view'] = null;
		return $_SESSION['view'][1];
		}
		else if($key == 'redirect_view')
		{
			return URL;
		}

    }
}
