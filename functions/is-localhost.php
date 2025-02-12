<?php

function is_localhost() {

	$whitelist = array( '127.0.0.1', '::1', 'localhost', '.local' );

	if ( in_array( $_SERVER['REMOTE_ADDR'], $whitelist ) ) {

		return true;

	}

}