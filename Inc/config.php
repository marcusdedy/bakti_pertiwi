<?php


// File Koneksi
require_once('Connections/koneksi.php');

// File ini wajib mempunyai session
if (!isset($_SESSION)) {
  session_start();
}

// Untuk penangan Error
define('ENVIRONMENT', 'production');

if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case 'development':
			error_reporting(E_ALL);
		break;
	
		case 'testing':
		case 'production':
			error_reporting(0);
		break;

		default:
			exit('The application environment is not set correctly.');
	}
}


