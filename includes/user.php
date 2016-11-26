<?php

# User extra field (would be nicer to have it in About Yourself)
add_filter('user_contactmethods', function($profile_fields) {
	$profile_fields['title'] = 'Title';
	$profile_fields['location'] = 'Location';
	return $profile_fields;
});

# Weather widget data for header
if (!wp_next_scheduled('weather')) wp_schedule_event(time(), 'hourly', 'weather');
add_action('weather', function() {
	$users = get_users();
	foreach ($users as $user) {
		get_meta_for_user($user->ID);
	}
});

# Refresh user meta when profile updated
add_action('profile_update', 'get_meta_for_user', 10, 2);

# Retrieve weather and current time zone for user
function get_meta_for_user($user_id) {
	if ($location = get_the_author_meta('location', $user_id)) {

		//get weather
		if ($file = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=' . urlencode($location) . '&units=imperial&APPID=' . OPEN_WEATHER_DATA_API_KEY)) {
			$data = json_decode($file);
			$weather = round($data->main->temp) . '° ' . $data->weather[0]->main;
			$coordinates = $data->coord->lat . ',' . $data->coord->lon; 
			update_user_meta($user_id, 'weather', $weather);
			
			//get timezone
			if ($file = file_get_contents('https://maps.googleapis.com/maps/api/timezone/json?location=' . $coordinates . '&timestamp=' . time() . '&key=' . GOOGLE_API_KEY)) {
				$data = json_decode($file);
				$timezone = $data->timeZoneId;
				update_user_meta($user_id, 'timezone', $timezone);
			}
			
			return;
		}
	}
	
	delete_user_meta($user_id, 'weather');
	delete_user_meta($user_id, 'timezone');
}