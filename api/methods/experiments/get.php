<?php

// utility function : check if the displayedData is valid through a schema
function displayeddata_match_schema($data, $type){

	$schemas = [
		'Single Number'	=> 'displayeddata_singlenumber',
		'Histogram'		=> 'displayeddata_histogram',
		'Graph'			=> 'displayeddata_graph'
	];
	$schema = json_decode(file_get_contents(DATA_PUBLIC_DIR . '/schemas/' . $schemas[$type]. '.json'), true);

	return json_validate($data, $schema);
		 
}

/*
	GET experiments / current
		if the app is open, GET produces every second a new set of data to be displayed
		from the data / input folder
		else | then, the generic get method will be running

	experiment data structure :

		experiments = {
			infos : {
				title, description, id
			},
			visualizations: [
				{
					title, description, pythonfile, id | { idx, idy },
					phyphoxData, displayedData
				},
				{...}, 
			]
		}

*/

// if the app is not listening for data anymore, send a closing signal
$is_applistening = app_islistening();
if (strcmp($request['ressource'], 'current') == 0 && !$is_applistening)
	json_put(SIG_CLOSING);

// otherwise, if app is listening, gather data from data/inputs/{current_experiment} .json
if (strcmp($request['ressource'], 'current') == 0 && $is_applistening){
	
	// Set $request['ressource'] so the generic GET method can handle it
	$current_experiment_id = app_currentexperience();
	$request['ressource'] = $current_experiment_id;

	// only the admin can update the experiment's displayedData. Regular viewers can only ask for processed displayedData
	if (user_isauthorized()){

		// reopen already filled experiment file if exists
		// otherwise, build a first one based on data/configurations/{current_configuration}.json
		$experiment_filename = DATA_PUBLIC_DIR . '/' .  $request['collection'] . '/' . $current_experiment_id;
		if (file_exists($experiment_filename)){

			$experiment_data = json_decode(file_get_contents($experiment_filename), true);
	
		} else {

			$current_configuration_id = app_currentconfiguration();
			$configuration = json_decode(file_get_contents(DATA_PUBLIC_DIR . '/configurations/' . $current_configuration_id), true);
			if (!$configuration)
				json_puterror(ERR_RESSOURCE_INVALID);
	
			$experiment_data = [
				'title'					=> $configuration['title'],
				'description'			=> $configuration['description'],
				'configurationid'		=> $current_experiment_id,
				'visualizations'		=> array_values($configuration['visualizations'])
			];
	
			$index = 0;
			$length = count($experiment_data['visualizations']);
			while ($index < $length){
				$experiment_data['visualizations'][$index]['contributions_total'] = 0;
				$experiment_data['visualizations'][$index]['phyphoxData'] = [];
				$experiment_data['visualizations'][$index]['displayedData'] = [];
				$experiment_data['visualizations'][$index]['extravariables'] = [];
				unset($experiment_data['visualizations'][$index]['pythonfile']['data']);
				$index += 1;
			}
		
		}
	
		/*
	
			first	: put the data from inputs to experiment.visualization.phyphoxData
	
				loop on each input.file older than 1 sec
					loop on each input.property
						loop on each experiment.visualization
							if a input.property matches a experiment.visualization.property
							-	set experiment.visualization.property.phyphoxData = input.property
							-	set default behavior for experiment.visualization.property.display
	
			then	: set experiment.visualization.displayedData
	
				loop on each configuration visualization
					if python file is present
						experiment.visualization.displayedData = python_script(visualization.phyphoxData)
	
		*/
	
		$inputs = glob(DATA_PUBLIC_DIR . '/input/*.json');
		$now = time();
		$timelimite = 1;
	
		foreach($inputs as $input){
			
			// filter only the inputs files older than 1 sec
			if ($now - filemtime($input) >= $timelimite){
				
				// put each data from input in their corresponding visualizations
				$input_data = json_decode(file_get_contents($input), true);
				foreach ($input_data as $input_data_key => $input_data_value){
	
					// find matching data in visualization
					$visualization_index = 0;
					$visualizations_length = count($experiment_data['visualizations']);
					while ($visualization_index < $visualizations_length){
						
						// look for extra variables
						if (in_array($input_data_key, $experiment_data['visualizations'][$visualization_index]['pythonfile']['extravariables'])){
							
							if (!isset($experiment_data['visualizations'][$visualization_index]['extravariables'][$input_data_key]))
								$experiment_data['visualizations'][$visualization_index]['extravariables'][$input_data_key] = array();
							
							array_push($experiment_data['visualizations'][$visualization_index]['extravariables'][$input_data_key], $input_data_value);

						}

						// Single number or Histogram (1 dimensional data)
						else if (isset($experiment_data['visualizations'][$visualization_index]['id'])
							&& strcmp($input_data_key, $experiment_data['visualizations'][$visualization_index]['id']) == 0){
													
							// if present, remove useless lines data (relevant for graph only)
							if (isset($experiment_data['visualizations'][$visualization_index]['lines']))
								unset($experiment_data['visualizations'][$visualization_index]['lines']);
								
							// add the new contribution from input
							// into the experiment data 'phyphoxData'
							array_push($experiment_data['visualizations'][$visualization_index]['phyphoxData'], $input_data_value);
						
							// if no python script, set default value for displayedData field
							if (empty($experiment_data['visualizations'][$visualization_index]['pythonfile']['name'])){

								//default value of displayedData = array_merge(phyphoxData)
								$experiment_data['visualizations'][$visualization_index]['displayedData'] = array();
								$phyphoxData_length = count($experiment_data['visualizations'][$visualization_index]['phyphoxData']);
								$phyphoxData_index = 0;
								while ($phyphoxData_index < $phyphoxData_length){
									$experiment_data['visualizations'][$visualization_index]['displayedData'] = array_merge($experiment_data['visualizations'][$visualization_index]['displayedData'], $experiment_data['visualizations'][$visualization_index]['phyphoxData'][$phyphoxData_index]);
									$phyphoxData_index += 1;
								}

								// default value of displayedData if single number = average(array_merge(displayedData))
								if (strcmp($experiment_data['visualizations'][$visualization_index]['type'], 'Single Number') == 0){

									$displayedData_length = count($experiment_data['visualizations'][$visualization_index]['displayedData']);
									if ($displayedData_length){
										$experiment_data['visualizations'][$visualization_index]['displayedData'] = array_sum($experiment_data['visualizations'][$visualization_index]['displayedData']) / $displayedData_length;
									} else {
										$experiment_data['visualizations'][$visualization_index]['displayedData'] = 0;
									}
								
								}

								//	check if displayedData matches the schema
								if (!displayeddata_match_schema(	// @data, @type
									$experiment_data['visualizations'][$visualization_index],
									$experiment_data['visualizations'][$visualization_index]['type']
								)){
									json_puterror(ERR_DATA_NOTMATCHING);
								}

							}
						
							$experiment_data['visualizations'][$visualization_index]['contributions_total'] += 1;
	
						}
	
						// Graph visualization (2 dimensional datas)
						else if ((isset($experiment_data['visualizations'][$visualization_index]['idx']) && strcmp($input_data_key, $experiment_data['visualizations'][$visualization_index]['idx']) == 0)
							|| (isset($experiment_data['visualizations'][$visualization_index]['idy']) && strcmp($input_data_key, $experiment_data['visualizations'][$visualization_index]['idy']) == 0)) {
								
							// Graph visualization confirmation
							if (strcmp($experiment_data['visualizations'][$visualization_index]['type'], 'Graph') == 0){
								
								$phyphoxData_length = count($experiment_data['visualizations'][$visualization_index]['phyphoxData']);
								$phyphoxData_last_index = $phyphoxData_length ? $phyphoxData_length - 1 : $phyphoxData_length;

								if (strcmp($input_data_key, $experiment_data['visualizations'][$visualization_index]['idx']) == 0){

									if (empty($experiment_data['visualizations'][$visualization_index]['phyphoxData']))
										array_push($experiment_data['visualizations'][$visualization_index]['phyphoxData'], [ 'x' => $input_data_value ]);
									else if (array_key_exists('x', $experiment_data['visualizations'][$visualization_index]['phyphoxData'][$phyphoxData_last_index]))
										array_push($experiment_data['visualizations'][$visualization_index]['phyphoxData'], [ 'x' => $input_data_value ]); 
									else 
										$experiment_data['visualizations'][$visualization_index]['phyphoxData'][$phyphoxData_last_index]['x'] = $input_data_value;

								} else if (strcmp($input_data_key, $experiment_data['visualizations'][$visualization_index]['idy']) == 0){
									
									if (empty($experiment_data['visualizations'][$visualization_index]['phyphoxData']))
										array_push($experiment_data['visualizations'][$visualization_index]['phyphoxData'], [ 'y' => $input_data_value ]);
									else if (array_key_exists('y', $experiment_data['visualizations'][$visualization_index]['phyphoxData'][$phyphoxData_last_index]))
										array_push($experiment_data['visualizations'][$visualization_index]['phyphoxData'], [ 'y' => $input_data_value ]); 
									else 
										$experiment_data['visualizations'][$visualization_index]['phyphoxData'][$phyphoxData_last_index]['y'] = $input_data_value;

								}

								// if x and y are set
								// push to displayedData and incremnet total contributions counter
								$phyphoxData_last_index = count($experiment_data['visualizations'][$visualization_index]['phyphoxData']) - 1;
								if ($phyphoxData_last_index > -1
									&& array_key_exists('x', $experiment_data['visualizations'][$visualization_index]['phyphoxData'][$phyphoxData_last_index])
									&& array_key_exists('y', $experiment_data['visualizations'][$visualization_index]['phyphoxData'][$phyphoxData_last_index])){

									if (!array_key_exists('measures', $experiment_data['visualizations'][$visualization_index]['displayedData'])){
										$experiment_data['visualizations'][$visualization_index]['displayedData']['measures'] = [];
										$experiment_data['visualizations'][$visualization_index]['displayedData']['fits'] = [];
									}

									array_push($experiment_data['visualizations'][$visualization_index]['displayedData']['measures'], $experiment_data['visualizations'][$visualization_index]['phyphoxData'][$phyphoxData_last_index]);

									$experiment_data['visualizations'][$visualization_index]['contributions_total'] += 1;

									if (!displayeddata_match_schema(	// @data, @type
										$experiment_data['visualizations'][$visualization_index],
										$experiment_data['visualizations'][$visualization_index]['type']
									)){
										json_puterror(ERR_DATA_NOTMATCHING);
									}

								}
	
							}
	
						}
	
						$visualization_index += 1;
	
					}
	
				}
				
				unlink($input);
	
			}
		}
		
		if (count($inputs)){

			$visualization_index = 0;
			$visualizations_length = count($experiment_data['visualizations']);
			while ($visualization_index < $visualizations_length){		
					
				// if a script python exist, execute it
				// otherwise record the new value as it in the 'displayedData' field
				if (!empty($experiment_data['visualizations'][$visualization_index]['pythonfile']['name'])
					&& count($experiment_data['visualizations'][$visualization_index]['phyphoxData'])){
	
					$script_filename = script_getfilename($current_experiment_id, $visualization_index);
					if (file_exists($script_filename)){
	
						// add extra variables if avalaible for python scripts
						$data = ['phyphoxData' => $experiment_data['visualizations'][$visualization_index]['phyphoxData']];

						if (!empty($experiment_data['visualizations'][$visualization_index]['extravariables']))
							$data['extravariables'] =  $experiment_data['visualizations'][$visualization_index]['extravariables'];
						
						$experiment_data['visualizations'][$visualization_index]['displayedData'] = script_exec($script_filename, $data);
						
						//	check if displayedData matches the schema
						if (!displayeddata_match_schema(	// @data, @type
							$experiment_data['visualizations'][$visualization_index],
							$experiment_data['visualizations'][$visualization_index]['type']
						)){
							json_puterror(ERR_DATA_NOTMATCHING);
						}

						// add extra controls for graph fits
						if (strcmp($experiment_data['visualizations'][$visualization_index]['type'], 'Graph') == 0){
							if (array_key_exists('fits', $experiment_data['visualizations'][$visualization_index]['displayedData'])){
								foreach ($experiment_data['visualizations'][$visualization_index]['displayedData']['fits'] as $fit_key => $fit_value){
									
									// each fit should have to keys: x and y 
									if (!array_key_exists('x', $fit_value) || !array_key_exists('y', $fit_value))
										json_puterror(ERR_FITS_OUTPUT . 'x or y key missing inside fit ' . $fit_key);

									
									// each keys should be an array of number
									if (!is_array($fit_value['x']) || !is_array($fit_value['x']))
										json_puterror(ERR_FITS_OUTPUT . 'x or y key is not an array inside fit ' . $fit_key);
									
									foreach ($fit_value['x'] as $x){
										if (!is_numeric($x))
											json_puterror(ERR_FITS_OUTPUT . 'x should only contain numbers inside fit ' . $fit_key);
									}

									foreach ($fit_value['y'] as $y){
										if (!is_numeric($y))
										json_puterror(ERR_FITS_OUTPUT . 'y should only contain numbers inside fit ' . $fit_key);
									}

									// each key should have a correspondance with the lines
									$has_correspondance = false;
									foreach($experiment_data['visualizations'][$visualization_index]['lines'] as $line){
										if (strcmp($line['idline'], $fit_key) == 0){
											$has_correspondance = true;
											break ;
										}
									}
									if (!$has_correspondance)
										json_puterror(ERR_FITS_OUTPUT . 'no matching line informations (for eg : color ?) for ' . $fit_key);
								}
							}
						}

					} else {
						json_puterror(ERR_PY);
					}
					
				}

				$visualization_index += 1;
	
			}

		}

		if (!file_put_contents($experiment_filename, json_encode($experiment_data), LOCK_EX))
			json_puterror(ERR_FILE_CREATION);
		

	}

}