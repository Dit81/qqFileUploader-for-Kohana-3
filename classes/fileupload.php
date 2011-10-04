<?php defined('SYSPATH') or die('No direct script access.');

class Fileupload
{
	public static $post_name = 'qqfile';
	
	public static function exists()
	{
		if (qq_Ajax::exists()) return true;
		if (qq_Traditional::exists()) return true;
		return false;
	}
	
	public static function name()
	{
		if (qq_Ajax::exists())
		{
			return qq_Ajax::name();
		}
		else if (qq_Traditional::exists())
		{
			return qq_Traditional::name();
		}
		
		return null;
	}
	
	public static function size()
	{
		if (qq_Ajax::exists())
		{
			return qq_Ajax::size();
		}
		else if (qq_Traditional::exists())
		{
			return qq_Traditional::size();
		}
		
		return 0;
	}
	
	public static function save($path=null, $chmod=0644)
	{
		$exists = false;
		if (qq_Ajax::exists())
		{
			$exists = true;
			$class = 'qq_Ajax';
		}
		else if (qq_Traditional::exists())
		{
			$exists = true;
			$class = 'qq_Traditional';
		}
		
		if ($exists == false) return false;
		
		call_user_func(array($class, 'save'), $path);
		chmod($path, $chmod);
		return true;
	}
}