<?php

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
	
			first	: put the data from inputs into experiment.visualization.phyphoxData
	
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
							
							break ;

						}

						// Single number or Histogram (1 dimensional data)
						if (isset($experiment_data['visualizations'][$visualization_index]['id'])
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
									}
									else
										$experiment_data['visualizations'][$visualization_index]['displayedData'] = 0;
								
								}
	
							}
						
							/* 	
								a match has found, so
								quit loop on $experiment_data['visualizations']
								and go to next input property
							*/
							$experiment_data['visualizations'][$visualization_index]['contributions_total'] += 1;
							break ; 
	
						}
	
						// Graph visualization (2 dimensional datas)
						if ((isset($experiment_data['visualizations'][$visualization_index]['idx']) && strcmp($input_data_key, $experiment_data['visualizations'][$visualization_index]['idx']) == 0)
							|| (isset($experiment_data['visualizations'][$visualization_index]['idy']) && strcmp($input_data_key, $experiment_data['visualizations'][$visualization_index]['idy']) == 0)) {
								
							// Graph visualization confirmation
							if (strcmp($experiment_data['visualizations'][$visualization_index]['type'], 'Graph') == 0){
								
								$phyphoxData_length = count($experiment_data['visualizations'][$visualization_index]['phyphoxData']);
								$x = isset($experiment_data['visualizations'][$visualization_index]['phyphoxData'][$phyphoxData_length][ $experiment_data['visualizations'][$visualization_index]['idx'] ]) ? $experiment_data['visualizations'][$visualization_index]['phyphoxData'][$phyphoxData_length][ $experiment_data['visualizations'][$visualization_index]['idx'] ] : $input_data[ $experiment_data['visualizations'][$visualization_index]['idx'] ];
								$y = isset($experiment_data['visualizations'][$visualization_index]['phyphoxData'][$phyphoxData_length][ $experiment_data['visualizations'][$visualization_index]['idy'] ]) ? $experiment_data['visualizations'][$visualization_index]['phyphoxData'][$phyphoxData_length][ $experiment_data['visualizations'][$visualization_index]['idy'] ] : $input_data[ $experiment_data['visualizations'][$visualization_index]['idy'] ];

								$new_line = [ $x, $y ];

								$experiment_data['visualizations'][$visualization_index]['phyphoxData'][$phyphoxData_length] = $new_line;
								
								//default value of displayedData if histogram = phyphoxData
								$experiment_data['visualizations'][$visualization_index]['displayedData'] = $experiment_data['visualizations'][$visualization_index]['phyphoxData'][$phyphoxData_length];

							}
							
							/* 
								a match has been found, so
								quit loop on experiment.visualizations
								and go to next input property
							*/
							$experiment_data['visualizations'][$visualization_index]['contributions_total'] += 1;
							break ; 
	
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