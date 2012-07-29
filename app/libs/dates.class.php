<?php

class dates{
	
	static public function timeago($timestamp){
		$time_elapsed = time() - $timestamp; 
		
		$seconds = $time_elapsed; 
		$minutes = round($time_elapsed/60);
		$hours = round($time_elapsed/3600);
		$days = round($time_elapsed/86400);
		$weeks = round($time_elapsed/604800);
		$months = round($time_elapsed/2600640);
		$years = round($time_elapsed/31207680);

		if ($seconds <= 60){ //Seconds
			return $seconds . ' seconds ago'; 
		} else if($minutes <= 60){ //Minutes
			if($minutes == 1){
				return 'one minute ago'; 
			} else {
				return $minutes . ' minutes ago'; 
			}
		} else if ($hours <= 24){ //Hours
			if($hours == 1){
				return 'an hour ago';
			} else { 
				return $hours . ' hours ago';
			}
		} else if ($days <= 7){ //Days
	 		if ($days == 1){
				return 'yesterday';
			} else {
				return $days . ' days ago';
			}
		} else if($weeks <= 4.3){ //Weeks
	 		if($weeks==1){
				return 'a week ago';
			} else {
				return $weeks . ' weeks ago';
			}
		} else if ($months <= 12){ //Months
	 		if($months == 1){
				return 'a month ago';
			} else {
				return $months . ' months ago';
			}
		} else { //Years
			if($years == 1){
				return 'one year ago';
			} else {
				return $years . ' years ago';
			}
		}
	}
}