<?php

function json__validate_number(mixed $data, array $schema): bool {
	return is_numeric($data);
}