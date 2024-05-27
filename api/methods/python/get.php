<?php

// GET /python
// display the available version of python on this server

$informations = [
	'Available py versions on this server' => [
		'version 2' => 'not available',
		'version 3' => 'not available'
	],
];

$py2_cmd = escapeshellcmd('./' . DATA_PRIVATE_DIR . '/py2.py');
$py3_cmd = escapeshellcmd('./' . DATA_PRIVATE_DIR . '/py3.py');

$py2_output = shell_exec($py2_cmd);

if ($py2_output){
	$py2_numpy_cmd = escapeshellcmd('./' . DATA_PRIVATE_DIR . '/py2_numpy.py');
	$shell_output = shell_exec($py2_numpy_cmd);
	$numpy_version = $shell_output ? $shell_output : 'not installed';
	$informations['Available py versions on this server']['version 2'] = [
		'version' 	=> $py2_output,
		'numpy'		=> $numpy_version,
		'notes'		=> 'Please use the shebang below and the "import sys", "import json" and, if installed, "import numpy" commands on top of your script.',
		'shebang'	=> '#!/usr/bin/env python',
		'examples'	=> 'https://someexamples'
	];
}

$py3_output = shell_exec($py3_cmd);

if ($py3_output){
	$py3_numpy_cmd = escapeshellcmd('./' . DATA_PRIVATE_DIR . '/py3_numpy.py');
	$shell_output = shell_exec($py3_numpy_cmd);
	$numpy_version = $shell_output ? $shell_output : 'not installed';
	$informations['Available py versions on this server']['version 3'] = [
		'version' 	=> $py3_output,
		'numpy'		=> $numpy_version,
		'notes'		=> 'Please use the shebang below and the "import sys", "import json", and, if installed, "import numpy" commands on top of your script.',
		'shebang'	=> '#!/usr/bin/env python3',
		'examples'	=> 'https://someexamples'
	];
}

json__put($informations);