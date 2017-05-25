<?php

class Model
{
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }
    public function checkUser($steam_id){
    	$sql = "SELECT count(user_id) AS count_user, user_id, rank, cookie FROM users WHERE steam_id = :steam_id";
    	$query = $this->db->prepare($sql);
    	$parameters = array(':steam_id' => $steam_id);
    	$query->execute($parameters);
    	return $query->fetch();
    }
    public function insertUser($steam_id, $truckersmp_id, $steam_name, $avatar, $truckersmp_date, $register_time, $cookie){
    	$sql = "INSERT INTO users (steam_id, truckersmp_id, steam_name, avatar, truckersmp_joindate, register_time, cookie) VALUES (:steam_id, :truckersmp_id, :steam_name, :avatar, :truckersmp_date, :register_time, :cookie)";
    	$query = $this->db->prepare($sql);
    	$parameters = array(':steam_id' => $steam_id, ':truckersmp_id' => $truckersmp_id, ':steam_name' => $steam_name, ':avatar' => $avatar, ':truckersmp_date' => $truckersmp_date, ':register_time' => $register_time, ':cookie' => $cookie);
    	$query->execute($parameters);
    }
    public function updateUser($steam_id, $steam_name, $avatar){
    	$sql = "UPDATE users SET steam_name = :steam_name, avatar = :avatar WHERE steam_id = :steam_id";
    	$query = $this->db->prepare($sql);
    	$parameters = array(':steam_id' => $steam_id, ':steam_name' => $steam_name, ':avatar' => $avatar);
    	$query->execute($parameters);
    }
    public function fetchUser($user_id){
    	$sql = "SELECT * FROM users WHERE user_id = :user_id";
    	$query = $this->db->prepare($sql);
    	$parameters = array(':user_id' => $user_id);
    	$query->execute($parameters);
    	return $query->fetch();
    }
    public function createEvent($user_id, $event_name, $server, $source, $destination, $time, $trailer, $route_map, $event_page, $notes){
        $sql = "INSERT INTO events (user_id, event_name, server, source, destination, time, trailer, route_map, event_page, notes) VALUES (:user_id, :event_name, :server, :source, :destination, :time, :trailer, :route_map, :event_page, :notes)";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id, ':event_name' => $event_name, ':server' => $server, ':source' => $source, ':destination' => $destination, ':time' => $time, ':trailer' => $trailer, ':route_map' => $route_map, ':event_page' => $event_page, ':notes' => $notes);
        $query->execute($parameters);
        $event_id = $this->db->lastInsertId();
        return $event_id;
    }
    public function insertEventRoles($event_id, $user_id, $role_id){
        $sql = "INSERT INTO event_roles (event_id, user_id, role_id) VALUES(:event_id, :user_id, :role_id)";
        $query = $this->db->prepare($sql);
        $parameters = array(':event_id' => $event_id, ':user_id' => $user_id, ':role_id' => $role_id);
        $query->execute($parameters);
    }
	public function fetchEvent($event_id){
		$sql = "SELECT * FROM events WHERE event_id = :event_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':event_id' => $event_id);
		$query->execute($parameters);
		return $query->fetch();
	}
	public function fetchEventRoles($event_id){
		$sql = "SELECT * FROM event_roles WHERE event_id = :event_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':event_id' => $event_id);
		$query->execute($parameters);
		return $query->fetchAll();
	}
	public function updateEventRole($event_id, $user_id, $role_id, $confirm){
		$sql = "UPDATE event_roles SET user_id = :user_id, confirm = :confirm WHERE event_id = :event_id AND role_id = :role_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':event_id' => $event_id, ':user_id' => $user_id, ':role_id' => $role_id, ':confirm' => $confirm);
		$query->execute($parameters);
	}
	public function findUserRole($event_id, $user_id){
		$sql = "SELECT count(serial) AS count_role, role_id FROM event_roles WHERE event_id = :event_id AND user_id = :user_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':event_id' => $event_id, ':user_id' => $user_id);
		$query->execute($parameters);
		return $query->fetch();
	}
	public function fetchRole($role_id){
		$sql = "SELECT role_name FROM roles WHERE role_id = :role_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':role_id' => $role_id);
		$query->execute($parameters);
		return $query->fetch()->role_name;
	}
	public function fetchRoleList($event_id){
		$sql = "SELECT roles.role_id, role_name, event_roles.user_id FROM roles LEFT JOIN event_roles ON roles.role_id = event_roles.role_id WHERE event_id = :event_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':event_id' => $event_id);
		$query->execute($parameters);
		return $query->fetchAll();
	}
    public function fetchFutureEvents($time){
    	$sql = "SELECT * FROM events WHERE time >= :time ORDER BY time ASC";
    	$query = $this->db->prepare($sql);
    	$parameters = array(':time' => $time);
    	$query->execute($parameters);
    	return $query->fetchAll();
    }
    public function fetchPastEvents($time){
        $sql = "SELECT * FROM events WHERE time < :time ORDER BY time DESC";
        $query = $this->db->prepare($sql);
        $parameters = array(':time' => $time);
        $query->execute($parameters);
        return $query->fetchAll();
    }
	public function countFutureEvents($time){
		$sql = "SELECT count(event_id) AS count_events FROM events WHERE time >= :time";
		$query = $this->db->prepare($sql);
		$parameters = array(':time' => $time);
		$query->execute($parameters);
		return $query->fetch()->count_events;
	}
    public function deleteEvent($event_id){
        $sql = "DELETE FROM events WHERE event_id = :event_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':event_id' => $event_id);
        $query->execute($parameters);
		
		$sql = "DELETE FROM event_roles WHERE event_id = :event_id";
		$query = $this->db->prepare($sql);
        $parameters = array(':event_id' => $event_id);
        $query->execute($parameters);
		
		$sql = "DELETE FROM drivers WHERE event_id = :event_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':event_id' => $event_id);
		$query->execute($parameters);
    }
	public function fetchProfilesAll(){
		$sql = "SELECT user_id, steam_id, steam_name, ip FROM users WHERE rank > 0 ORDER BY user_id ASC";
		$query = $this->db->prepare($sql);
		$parameters = array('');
		$query->execute($parameters);
		return $query->fetchAll();
	}
	public function countNewMembers(){
	    $sql = "SELECT count(user_id) AS count_new FROM users WHERE rank = 0";
	    $query = $this->db->prepare($sql);
	    $parameters = array('');
	    $query->execute($parameters);
	    return $query->fetch()->count_new;
    }
	public function updateRank($user_id, $rank){
		$sql = "UPDATE users SET rank = :rank WHERE user_id = :user_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':user_id' => $user_id, ':rank' => $rank);
		$query->execute($parameters);
	}
	public function resetCookie($user_id){
		$sql = "UPDATE users SET cookie = NULL WHERE user_id = :user_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':user_id' => $user_id);
		$query->execute($parameters);
	}
	public function fetchCookieID($cookie){
		$sql = "SELECT count(user_id) AS count_users, user_id FROM users WHERE cookie = :cookie";
		$query = $this->db->prepare($sql);
		$parameters = array(':cookie' => $cookie);
		$query->execute($parameters);
		return $query->fetch();
	}
	public function checkAvailable($event_id, $role_id){
		$sql = "SELECT user_id FROM event_roles WHERE event_id = :event_id AND role_id = :role_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':event_id' => $event_id, ':role_id' => $role_id);
		$query->execute($parameters);
		return $query->fetch()->user_id;
	}
	public function updateSaveFile($event_id, $link){
		$sql = "UPDATE events SET save_file = :link WHERE event_id = :event_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':event_id' => $event_id, ':link' => $link);
		$query->execute($parameters);
	}
	public function insertDriver($event_id, $user_id){
		$sql = "INSERT INTO drivers (event_id, user_id) VALUES(:event_id, :user_id)";
		$query = $this->db->prepare($sql);
		$parameters = array(':event_id' => $event_id, ':user_id' => $user_id);
		$query->execute($parameters);
	}
	public function checkDriver($event_id, $user_id){
		$sql = "SELECT count(serial) AS count_drivers FROM drivers WHERE event_id = :event_id AND user_id = :user_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':event_id' => $event_id, ':user_id' => $user_id);
		$query->execute($parameters);
		return $query->fetch();
	}
	public function removeDriver($event_id, $user_id){
		$sql = "DELETE FROM drivers WHERE event_id = :event_id AND user_id = :user_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':event_id' => $event_id, ':user_id' => $user_id);
		$query->execute($parameters);
	}
	public function fetchDrivers($event_id){
		$sql = "SELECT * FROM drivers WHERE event_id = :event_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':event_id' => $event_id);
		$query->execute($parameters);
		return $query->fetchAll();
	}
	public function updateRoleStatus($event_id, $role_id, $confirm){
		$sql = "UPDATE event_roles SET confirm = :confirm WHERE event_id = :event_id AND role_id = :role_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':confirm' => $confirm, ':event_id' => $event_id, ':role_id' => $role_id);
		$query->execute($parameters);
	}
	public function updateEvent($event_id, $event_name, $server, $source, $destination, $time, $trailer, $route_map, $event_page, $notes){
		$sql = "UPDATE events SET event_name = :event_name, server = :server, source = :source, destination = :destination, time = :time, trailer = :trailer, route_map = :route_map, event_page = :event_page, notes = :notes WHERE event_id = :event_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':event_id' => $event_id, ':event_name' => $event_name, ':server' => $server, ':source' => $source, ':destination' => $destination, ':time' => $time, ':trailer' => $trailer, ':route_map' => $route_map, ':event_page' => $event_page, ':notes' => $notes);
		$query->execute($parameters);
	}
	public function insertAbsence($user_id, $start_date, $end_date, $reason){
		$sql = "INSERT INTO absent (user_id, start_date, end_date, reason) VALUES(:user_id, :start_date, :end_date, :reason)";
		$query = $this->db->prepare($sql);
		$parameters = array(':user_id' => $user_id, ':start_date' => $start_date, ':end_date' => $end_date, ':reason' =>$reason);
		$query->execute($parameters);
	}
	public function currentAbsent($time){
		$sql = "SELECT * FROM absent WHERE start_date < :time AND end_date > :time ORDER BY end_date ASC";
		$query = $this->db->prepare($sql);
		$parameters = array(':time' => $time);
		$query->execute($parameters);
		return $query->fetchAll();
	}
	public function futureAbsent($time){
		$sql = "SELECT * FROM absent WHERE start_date > :time ORDER BY start_date ASC";
		$query = $this->db->prepare($sql);
		$parameters = array(':time' => $time);
		$query->execute($parameters);
		return $query->fetchAll();
	}
	public function fetchNewProfiles(){
        $sql = "SELECT user_id, steam_id, steam_name, ip FROM users WHERE rank = 0 ORDER BY user_id ASC";
        $query = $this->db->prepare($sql);
        $parameters = array('');
        $query->execute($parameters);
        return $query->fetchAll();
    }
    public function deleteUser($user_id){
	    $sql = "DELETE FROM users WHERE user_id = :user_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);
        $query->execute($parameters);
    }
    public function fetchMembers(){
        $sql = "SELECT user_id, steam_id, steam_name FROM users WHERE rank > 0 ORDER BY steam_name ASC";
        $query = $this->db->prepare($sql);
        $parameters = array('');
        $query->execute($parameters);
        return $query->fetchAll();
    }
    public function updateIP($user_id, $ip){
        $sql = "UPDATE users SET ip = :ip WHERE user_id = :user_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id, ':ip' => $ip);
        $query->execute($parameters);
    }
    public function fetchLatestEvent($time){
        $sql = "SELECT min(time) AS min_time, event_id, event_page FROM events WHERE time >= :time";
        $query = $this->db->prepare($sql);
        $parameters = array(':time' => $time);
        $query->execute($parameters);
        return $query->fetch();
    }
    public function countAttendDriver($user_id, $time){
        $sql = "SELECT count(drivers.user_id) AS attendance FROM drivers LEFT OUTER JOIN events ON drivers.event_id = events.event_id WHERE drivers.user_id = :user_id AND time < :time";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id, ':time' => $time);
        $query->execute($parameters);
        return $query->fetch();
    }
    public function countAttendDriver4($user_id, $time){
        $sql = "SELECT count(drivers.user_id) AS attendance FROM drivers LEFT OUTER JOIN events ON drivers.event_id = events.event_id WHERE drivers.user_id = :user_id AND time < :time AND time > :time - 2419200";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id, ':time' => $time);
        $query->execute($parameters);
        return $query->fetch()->attendance;
    }
    public function countAttendCC($time){
        $sql = "SELECT users.user_id, count(test.user_id) AS attendance FROM users LEFT OUTER JOIN (SELECT event_roles.event_id, event_roles.user_id, time FROM event_roles LEFT OUTER JOIN events ON event_roles.event_id = events.event_id WHERE time < :time) AS test ON users.user_id = test.user_id WHERE rank > 0 GROUP BY users.user_id ORDER BY steam_name";
        $query = $this->db->prepare($sql);
        $parameters = array(':time' => $time);
        $query->execute($parameters);
        return $query->fetchAll();
    }
    public function countAttendCC4($user_id, $time){
        $sql = "SELECT count(event_roles.user_id) AS attendance FROM event_roles LEFT OUTER JOIN events ON event_roles.event_id = events.event_id WHERE event_roles.user_id = :user_id AND time < :time AND time > :time - 2419200";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id, ':time' => $time);
        $query->execute($parameters);
        return $query->fetch()->attendance;
}
    public function fetchLatestEventCC($user_id, $time){
        $sql = "SELECT max(time) AS max_time FROM event_roles LEFT OUTER JOIN events ON event_roles.event_id = events.event_id WHERE event_roles.user_id = :user_id AND time < :time";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id, ':time' => $time);
        $query->execute($parameters);
        return $query->fetch()->max_time;
    }
    public function fetchLatestEventDriver($user_id, $time){
        $sql = "SELECT max(time) AS max_time FROM drivers LEFT OUTER JOIN events ON drivers.event_id = events.event_id WHERE drivers.user_id = :user_id AND time < :time";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id, ':time' => $time);
        $query->execute($parameters);
        return $query->fetch()->max_time;
    }
    public function fetchEventID($time){
        $sql = "SELECT event_id FROM events WHERE time = :time LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':time' => $time);
        $query->execute($parameters);
        return $query->fetch()->event_id;
    }
    public function totalevents($time){
        $sql = "SELECT count(event_id) AS count_events FROM events WHERE time < :time";
        $query = $this->db->prepare($sql);
        $parameters = array(':time' => $time);
        $query->execute($parameters);
        return $query->fetch()->count_events;
    }
    public function insertContactus($name, $email, $message, $time){
        $sql = "INSERT INTO contact (name, email, message, time) VALUES(:name, :email, :message, :time)";
        $query = $this->db->prepare($sql);
        $parameters = array(':name' => $name, ':email' => $email, ':message' => $message, ':time' => $time);
        $query->execute($parameters);
    }
}