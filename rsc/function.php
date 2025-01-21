<?php 
    define('__ROOT__', dirname(dirname(__FILE__)));

    $GLOBALS['settings'] = [ 
		'database' => [
            'host' => 'localhost',
            'user' => '',
            'password' => '',
            'dbname' => ''
        ],
        'site' => [
            'url' => '',
        ]
   	];

    function surl($withTild){
        require_once __DIR__.'/function.php';
        $baseUrl = $GLOBALS['settings']['site']['url'];
        $wip = str_replace("~/", $baseUrl, $withTild);

        return $wip;
    }

    function serv_init(){
        $servername = $GLOBALS['settings']['database']['host'];
        $username   = $GLOBALS['settings']['database']['user'];
        $password   = $GLOBALS['settings']['database']['password'];
        $dbname     = $GLOBALS['settings']['database']['dbname'];
    
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) :
        {
            die("&Eacute;chec de connection : " . $conn->connect_error);
        }
        endif;

        return ($conn);
    }

	function script_css() 
	{
		$script = '
		<link rel="stylesheet" href="'.surl("~/").'rsc/css/style.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		';
		
		return($script);
	}

	function script_js() 
	{		
		$script = '
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
		';		
		return($script);
	}

	if (!function_exists('str_contains')) {
		function str_contains($haystack, $needle) {
			return $needle !== '' && mb_strpos($haystack, $needle) !== false;
		}
	}
?>