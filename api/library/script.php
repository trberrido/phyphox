<?php

// python script related functions

function script_getfilename($experiment_id, $visualization_index){
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
function script_exec($script_filename, $data){

	// erase all input / output previous files
	$folder = DATA_PRIVATE_DIR . '/scripts/';
	$files = glob($folder . '*.{*}', GLOB_BRACE);
	foreach($files as $file){
		unlink($file);
	}

	// the script will be laumched as `./script.py input.json output.json 2>&1`
	$id = uniqid();
	$input_filename = DATA_PRIVATE_DIR . '/scripts/' . $id . '_input.json';
	$output_filename = DATA_PRIVATE_DIR . '/scripts/' . $id . '_output.json';
	$stderr = DATA_PRIVATE_DIR . '/scripts/' . $id . '_error.json';
	$outputcpy = DATA_PUBLIC_DIR . '/pythonoutput/' . $id . '.json';
	$inputcpy = DATA_PUBLIC_DIR . '/pythoninput/' . $id . '.json';

	if (!file_put_contents($input_filename, json_encode($data)))
		json_puterror(ERR_FILE_CREATION);
	
	if (!copy($input_filename, $inputcpy))
		json_puterror(ERR_FILE_CPY);

	$cmd = './' . $script_filename . ' ' . $input_filename . ' ' . $output_filename . ' 2> ' . $stderr;
	$exitcode = 0;
	exec($cmd , $output, $exitcode);

	// if error from python, print it 
	if ($exitcode){
		file_put_contents($outputcpy, json_encode(file_get_contents($stderr)));
		json_puterror(file_get_contents($stderr));
	}

	// make a copy of the output
	if (!copy($output_filename, $outputcpy))
		json_puterror(ERR_FILE_CPY);

	$output = json_decode(file_get_contents($output_filename));
	
	return $output;

}