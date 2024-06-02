<?php

// python script related functions

function script__get_filename($experiment_id, $visualization_index){
	$script_path = DATA_PUBLIC_DIR . '/scripts/';
	// xp_id = {time_stamp}_{config_id}_{viz_index}.py
	// the time stamp has to be removed
	// it is required to disinguished several experiences from a same config
	// but the scripts are the same
	$experiment_id = substr($experiment_id, strpos($experiment_id, '_') + 1);
	$script_filename = $experiment_id . '_' . $visualization_index . '.py';
	return ($script_path . $script_filename);
}

/*
	./pythonfile input.json output.json
*/
function script__exec($script_filename, $data){

	// the script will be laumched as `./script.py input.json output.json 2>&1`
	$id = uniqid();
	$stderr = DATA_PUBLIC_DIR . '/pythonerror/' . $id . '.txt';
	$input_filename = DATA_PUBLIC_DIR . '/pythoninput/' . $id . '.json';
	$output_filename = DATA_PUBLIC_DIR . '/pythonoutput/' . $id . '.json';

	if (!file_put_contents($input_filename, json_encode($data)))
		json__puterror(ERR_FILE_CREATION);

	$cmd = 'python ' . $script_filename . ' ' . $input_filename . ' ' . $output_filename . ' 2> ' . $stderr;
	$exitcode = 0;
	$output = null;
	exec($cmd , $output, $exitcode);
	// if error from python, print it
	if ($exitcode){
		if (!file_exists($stderr))
			json__puterror(ERR_PY_NO_STDERR);
		json__puterror(file_get_contents($stderr));
	}

	if (!file_exists($output_filename))
		json__puterror(ERR_PY_OUTPUT);

	$output = json_decode(file_get_contents($output_filename), true);

	return $output;

}