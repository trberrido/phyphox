<?php

// GET /python
// display the available version of python on this server

$informations = [
	'Available versions on this server' => [
		'version 2' => 'not available',
		'version 3' => 'not available'
	],
];

$py2_cmd = escapeshellcmd('./' . DATA_PRIVATE_DIR . '/py2.py');
$py3_cmd = escapeshellcmd('./' . DATA_PRIVATE_DIR . '/py3.py');

$py2_output = shell_exec($py2_cmd);

if ($py2_output){
	$informations['Available versions on this server']['version 2'] = [
		'version' 	=> $py2_output,
		'notes'		=> 'Please use the shebang below and the "import sys" command on top of your script.',
		'shebang'	=> '#!/usr/bin/env python'
	];
}

$py3_output = shell_exec($py3_cmd);

if ($py3_output){
	$informations['Available versions on this server']['version 3'] = [
		'version' 	=> $py3_output,
		'notes'		=> 'Please use the shebang below and the "import sys" command on top of your script.',
		'shebang'	=> '#!/usr/bin/env python3'
	];
}

json__put($informations);