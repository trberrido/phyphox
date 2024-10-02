<?php

// GET /python
// display the available version of python on this server

$informations = [
	'Available py versions on this server' => ['python not available. If you know for sure your server use python3, you may try: `sudo ln -sf /usr/bin/python3 /usr/bin/python`'],
];

$py_cmd = escapeshellcmd('python ' . DATA_PRIVATE_DIR . '/py.py');

$py_output = shell_exec($py_cmd);

if ($py_output){
	$py_numpy_cmd = escapeshellcmd('python ' . DATA_PRIVATE_DIR . '/py_numpy.py');
	$shell_output = shell_exec($py_numpy_cmd);
	$numpy_version = $shell_output ? $shell_output : 'not installed';
	$informations['Available py versions on this server'] = [
		'version' 	=> $py_output,
		'numpy'		=> $numpy_version,
		'notes'		=> 'Use the "import json" and, if installed, "import numpy" commands on top of your script.',
		'examples'	=> 'https://github.com/frederic-bouquet/phyphox-dataviz-tools'
	];
}

json__put($informations);