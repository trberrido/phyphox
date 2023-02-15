<?php

/*
 *	POST | PUT configurations
 *		generate python scripts
 *		in data / scripts / {config_id}_{visualization_index}.py
 */

 if ($request['data']['isListening']){

	$script_path = DATA_PUBLIC_DIR . '/scripts/';
	$configuration_id = $request['data']['currentConfiguration'];
	
	$configuration_data = json_decode(file_get_contents(DATA_PUBLIC_DIR . '/configurations/' . $configuration_id), true);
	
	$visualization_index = 0;
	foreach ($configuration_data['visualizations'] as &$visualization){
	
		if ($visualization['pythonfile']['data']){
	
			$script = explode(',', $visualization['pythonfile']['data']);
			$script_filename = $configuration_id . '_' . $visualization_index . '.py';
			$script_content = base64_decode($script[1]);
			
			// replace CRLF by LF
			$script_content = preg_replace('~\r\n?~', "\n", $script_content);
			
			file_put_contents($script_path . $script_filename, $script_content);
			chmod($script_path . $script_filename, 0777);

		}
	
		$visualization_index += 1;
	
	}

}

