<?php

function json__validate_boolean(mixed $data, array $schema): bool {
	return is_bool($data);
}