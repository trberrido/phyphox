<?php

const DATA_PUBLIC_DIR	= './data/public';
const DATA_PRIVATE_DIR	= './data/private';

const COOKIE_KEY_TOKEN = 'phyphox';
const COOKIE_MAX_AGE = 43200;

const SIG_CLOSING				= 'closing';
const APPSTATE_ISCLOSED			= false;
const APPSTATE_ISOPEN			= true;

// Error constants

const ERR_URL_INVALID			= 'Invalid URL';
const ERR_USER_NOTAUTHORIZED	= 'Not authorised.';
const ERR_USER_ALREADYEXISTS	= 'Only one user allowed.';
const ERR_HTTPMETHOD_INVALID	= 'Method not supported';
const ERR_COLLECTION_INVALID	= 'Collection doesn\'t exists.';
const ERR_RESSOURCE_INVALID		= 'Ressource doesn\'t exists.';
const ERR_FIELD_INVALID			= 'Unvalid field.';
const ERR_FILE_CREATION			= 'Unable to create file';
const ERR_FILE_CPY				= 'Unable to make a copy';
const ERR_DATA_INVALID			= 'The received datas are not accepted.';
const ERR_DATA_NOTMATCHING		= 'displayedData doesn\'t match with the type.';
const ERR_FITS_OUTPUT			= 'Python output, fits don\'t meet requirements : ';
const ERR_PASSWORD				= 'Wrong password';
const ERR_EMAIL					= 'Wrong email';
const ERR_EMAIL_NOTSENT			= 'The server were unable to send the email.';
const ERR_PY					= 'An error occured with the python script.';
const ERR_PY_OUTPUT				= 'Your script didn\'t produce any output file.';