<?php

if (!file_exists(DATA_PUBLIC_DIR . '/app/state.json')){

	if (!json__create_from_schema(DATA_PRIVATE_DIR . '/schemas/appstate.json', DATA_PUBLIC_DIR . '/app/state.json'))
		json_puterror(ERR_PERMISSIONS);

}