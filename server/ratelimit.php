<?php


function CheckIPAddr()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ipX = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ipX = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ipX = $_SERVER['REMOTE_ADDR'];
	}
	return $ipX;
}

$ipAddr = CheckIPAddr();

DEFINE('RATE_LIMITER_FOLDER', 'php_rate_limiter');
DEFINE('MAXIMUM_RATE_AGE_IN_SECONDS', '86400');
DEFINE('INCLUDE_READABLE_COMMENT', 'FALSE');


function check_within_rate_limit($resource, $limit_group, $rate_per_period, $period_in_seconds, $add_to_rate)
{

	$rate_limiter_folder = RATE_LIMITER_FOLDER;
	$maximum_rate_age_in_seconds = MAXIMUM_RATE_AGE_IN_SECONDS;
	$rate_counter = 0;

	if (strlen($rate_limiter_folder) > 1 && substr($rate_limiter_folder, -1) == DIRECTORY_SEPARATOR) {
		$rate_limiter_folder = substr($rate_limiter_folder, 0, -1);
	}

	if (!file_exists($rate_limiter_folder)) {
		if (!mkdir($rate_limiter_folder)) {
			die('Rate limiter folder failed to be created');
		}
	}

	$resource_hash = hash('sha256', $resource);
	if (!file_exists($rate_limiter_folder . DIRECTORY_SEPARATOR . $resource_hash)) {
		if (!mkdir($rate_limiter_folder . DIRECTORY_SEPARATOR . $resource_hash)) {
			die('Resource Rate limiter folder failed to be created');
		}
	}

	$limit_group_hash = hash('sha256', $limit_group);
    
	if (!file_exists($rate_limiter_folder . DIRECTORY_SEPARATOR . $resource_hash . DIRECTORY_SEPARATOR . $limit_group_hash) || filemtime($rate_limiter_folder . DIRECTORY_SEPARATOR . $resource_hash . DIRECTORY_SEPARATOR . $limit_group_hash) < (time() - $maximum_rate_age_in_seconds)) {

		if ($add_to_rate == 0) 
		{
			return TRUE;
		}

		$file_handle = fopen($rate_limiter_folder . DIRECTORY_SEPARATOR . $resource_hash . DIRECTORY_SEPARATOR . $limit_group_hash, 'w');
		if ($file_handle) {
			if (INCLUDE_READABLE_COMMENT == 'TRUE') {
				fwrite($file_handle, '# ' . $resource . ',' . $limit_group . "\n");
			}

			while ($add_to_rate > 0) {
				fwrite($file_handle, time() . "\n");
				$add_to_rate--;
			}

			fclose($file_handle);

			if (rand(1, 1000) == 1) {
				clean_directory($rate_limiter_folder . DIRECTORY_SEPARATOR . $resource_hash . DIRECTORY_SEPARATOR, $maximum_rate_age_in_seconds);
			}


			return TRUE;
		}
	} else {

		$filesize = filesize($rate_limiter_folder . DIRECTORY_SEPARATOR . $resource_hash . DIRECTORY_SEPARATOR . $limit_group_hash);


		if (INCLUDE_READABLE_COMMENT == 'TRUE') {
			$filesize = $filesize - strlen('# ' . $resource . ',' . $limit_group . "\n");
		}

		$rate_counter = intval(($filesize) / 11); 
		$file_handle = fopen($rate_limiter_folder . DIRECTORY_SEPARATOR . $resource_hash . DIRECTORY_SEPARATOR . $limit_group_hash, 'a+');


		if ($rate_counter >= $rate_per_period) {
			fseek($file_handle, (-11 * ($rate_per_period)), SEEK_END);
			$buffer = fgets($file_handle, 4096);

			if ($buffer >= (time() - $period_in_seconds)) {
				$rate_counter = $rate_per_period + 1;
			} else {
				$rate_counter = $rate_per_period - 1;
			}
		}

		fseek($file_handle, 0, SEEK_END);
		while ($add_to_rate > 0) {
			fwrite($file_handle, time() . "\n");
			$add_to_rate--;
		}
		fclose($file_handle);
	}

	if (rand(1, 1000) == 1) {
		clean_directory($rate_limiter_folder . DIRECTORY_SEPARATOR . $resource_hash, $maximum_rate_age_in_seconds);
	}

	if ($rate_counter >= $rate_per_period) {
		return false;
	}

	return true;
}

function clean_directory($directory, $age_in_seconds)
{

	$dir = scandir($directory);
	foreach ($dir as $key => $value) {
		if (!is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
			if (filemtime($dir . DIRECTORY_SEPARATOR . $value)  < (time() - $age_in_seconds)) {
				unlink($dir . DIRECTORY_SEPARATOR . $value);
			}
		}
	}
}

session_start();

if (!check_within_rate_limit('login_page', $ipAddr, 40, 60, 1)) 
{
	die();
	exit();
}
