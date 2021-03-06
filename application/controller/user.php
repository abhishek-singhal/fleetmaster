<?php

class User extends Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['user_id'])) {
			if (isset($_COOKIE['fmelogin'])) {
				$checkcookie = $this->model->fetchCookieID($_COOKIE['fmelogin']);
				if ($checkcookie->count_users == 1) {
					$_SESSION['user_id'] = $checkcookie->user_id;
				} else {
					setcookie('fmelogin', '', time() - 3600, '/');
					header('location: ' . URL . 'home/index');
				}
			} else {
				header('location: ' . URL . 'home/index');
			}
		}
	}

	public function index()
	{
		$page = 1;
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		$points = $this->model->fetchContent();
		$count_event = $this->model->countOtherEvent(time()-3600);
		$other_events = $this->model->fetchAllOtherEvents(time()-3600);
		require APP . 'view/_templates/header.php';
		require APP . 'view/user/index.php';
		require APP . 'view/_templates/footer.php';
	}

	public function create()
	{
		$page = 3;
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if (isset($_POST['create_event'])) {
			$event_name = $this->protect($_POST['event_name']);
			$server = $this->protect($_POST['server']);
			$source = $this->protect($_POST['source']);
			$destination = $this->protect($_POST['destination']);
			$time = strtotime($this->protect($_POST['time']));
			if (isset($_POST['trailer'])) {
				$trailer = "Yes";
			} else {
				$trailer = "No";
			}
			$route_map = $this->protect($_POST['route_map']);
			$event_page = $this->protect($_POST['event_page']);
			$notes = $this->protect($_POST['notes']);
			$spreadsheet = $this->protect($_POST['spreadsheet']);
			if ($event_name == null || $source == null || $destination == null || $time == null || $route_map == null || $event_page == null || $notes == null || $spreadsheet == null) {
				$success = 0;
			} else if ($time < time()) {
				$success = 0;
			} else {
				$event_id = $this->model->createEvent($_SESSION['user_id'], $event_name, $server, $source, $destination, $time, $trailer, $route_map, $event_page, $notes, $spreadsheet);
				if (isset($_POST['lead'])) {
					$this->model->insertEventRoles($event_id, 0, 1);
				}
				if (isset($_POST['colead'])) {
					$this->model->insertEventRoles($event_id, 0, 2);
				}
				if (isset($_POST['cc1'])) {
					$this->model->insertEventRoles($event_id, 0, 3);
				}
				if (isset($_POST['cc2'])) {
					$this->model->insertEventRoles($event_id, 0, 4);
				}
				if (isset($_POST['cc3'])) {
					$this->model->insertEventRoles($event_id, 0, 5);
				}
				if (isset($_POST['cc4'])) {
					$this->model->insertEventRoles($event_id, 0, 6);
				}
				if (isset($_POST['cc5'])) {
					$this->model->insertEventRoles($event_id, 0, 7);
				}
				if (isset($_POST['cc6'])) {
					$this->model->insertEventRoles($event_id, 0, 8);
				}
				if (isset($_POST['cc7'])) {
					$this->model->insertEventRoles($event_id, 0, 12);
				}
				if (isset($_POST['cc8'])) {
					$this->model->insertEventRoles($event_id, 0, 13);
				}
				if (isset($_POST['cc9'])) {
					$this->model->insertEventRoles($event_id, 0, 14);
				}
				if (isset($_POST['cc10'])) {
					$this->model->insertEventRoles($event_id, 0, 15);
				}
				if (isset($_POST['middle'])) {
					$this->model->insertEventRoles($event_id, 0, 9);
				}
				if (isset($_POST['tail'])) {
					$this->model->insertEventRoles($event_id, 0, 10);
				}
				if (isset($_POST['reserve'])) {
					$this->model->insertEventRoles($event_id, 0, 11);
				}
				$success = 1;
			}
		}
		require APP . 'view/_templates/header.php';
		require APP . 'view/user/create.php';
		require APP . 'view/_templates/footer.php';
	}

	public function upcoming()
	{
		$page = 2;
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		$time = time() - 3600;
		$fetch_events = $this->model->fetchFutureEvents($time);
		require APP . 'view/_templates/header.php';
		require APP . 'view/user/upcoming.php';
		require APP . 'view/_templates/footer.php';
	}

	public function event($event_id)
	{
		$page = 2;
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if ($rank == 0) {
			header('location: ' . URL . 'user/logout');
		}
		$event_details = $this->model->fetchEvent($event_id);
		if ($rank < 2) {
			if (($event_details->time + 3600) < time()) {
				header('location: ' . URL . 'user/upcoming');
			}
		}
		$event_roles = $this->model->fetchEventRoles($event_id);
		$available_roles = $this->model->fetchRoleList($event_id);
		$safety_check = $this->model->findUserRole($event_id, $_SESSION['user_id']);
		if (file_exists('uploads/saves/' . 'fleet_master_' . $event_id . '.zip')) {
			$file_check = 1;
		} else {
			$file_check = 0;
		}
		if (isset($_POST['pick_role'])) {
			$event_role_id = $this->protect($_POST['role']);
			if ($this->model->checkAvailable($event_id, $event_role_id) == 0) {
				if ($safety_check->count_role != 0) {
					$this->model->updateEventRole($event_id, 0, $safety_check->role_id, 0);
				}
				$this->model->updateEventRole($event_id, $_SESSION['user_id'], $event_role_id, 0);
				header('location: ' . URL . 'user/event/' . $event_id);
			} else {
				$message1 = "Role already taken by someone else. Please choose another role.";
			}
		}
		if ($safety_check->count_role != 0) {
			if (isset($_POST['remove_role'])) {
				$this->model->updateEventRole($event_id, 0, $safety_check->role_id, 0);
				header('location: ' . URL . 'user/event/' . $event_id);
			}
		}
		if (isset($_POST['upload_save'])) {
			$tmp = explode('.', $_FILES['save_file']['name']);
			$file_ext = strtolower(end($tmp));
			if ($file_ext == "zip" || $file_ext == "ZIP") {
				$target_dir = 'uploads/saves/';
				$file_name = 'fleet_master_' . $event_id . '.zip';
				$target_file = $target_dir . $file_name;
				$file_size = $_FILES['save_file']['size'];
				if ($file_size <= 134217728) {
					move_uploaded_file($_FILES["save_file"]["tmp_name"], $target_file);
					header('location: ' . URL . 'user/event/' . $event_id);
				} else {
					$message = "File size too large.";
				}
			} else {
				$message = "Unsupported File Format. Please use zip.";
			}
		}
		if (isset($_POST['register_driver'])) {
			$this->model->insertDriver($event_id, $_SESSION['user_id']);
			header('location: ' . URL . 'user/event/' . $event_id);
		}
		if (isset($_POST['remove_driver'])) {
			$this->model->removeDriver($event_id, $_SESSION['user_id']);
			header('location: ' . URL . 'user/event/' . $event_id);
		}
		if (isset($_POST['delete_save'])) {
			unlink('uploads/saves/' . 'fleet_master_' . $event_id . '.zip');
			header('location: ' . URL . 'user/event/' . $event_id);
		}
		if (isset($_POST['submit_link'])) {
			$link = $this->protect($_POST['save_link']);
			$this->model->updateSaveFile($event_id, $link);
			header('location: ' . URL . 'user/event/' . $event_id);
		}
		if (isset($_POST['remove_link'])) {
			$this->model->updateSaveFile($event_id, NULL);
			header('location: ' . URL . 'user/event/' . $event_id);
		}
		if (isset($_POST['give_role'])) {
			$give_role = $this->protect($_POST['role']);
			$give_userid = $this->protect($_POST['user']);
			if ($give_role == "20") {
				if ($give_role == 0 || $give_userid == 0) {
					$showmessage = "Please select values in both fields";
				} else if ($this->model->findUserRole($event_id, $give_userid)->count_role != 0) {
					$showmessage = "A role is already assigned to this user. Please choose another user.";
				} else if ($this->model->checkDriver($event_id, $give_userid)->count_drivers != 0) {
					$showmessage = "A role is already assigned to this user. Please choose another user.";
				} else {
					$this->model->insertDriver($event_id, $give_userid);
					header('location:' . URL . 'user/event/' . $event_id);
				}
			} else {
				if ($give_role == 0 || $give_userid == 0) {
					$showmessage = "Please select values in both fields";
				} else if ($this->model->checkAvailable($event_id, $give_role) != 0) {
					$showmessage = "Role already taken by someone else. Please choose another role.";
				} else if ($this->model->findUserRole($event_id, $give_userid)->count_role != 0) {
					$showmessage = "A role is already assigned to this user. Please choose another user.";
				} else if ($this->model->checkDriver($event_id, $give_userid)->count_drivers != 0) {
					$showmessage = "A role is already assigned to this user. Please choose another user.";
				} else {
					$this->model->updateEventRole($event_id, $give_userid, $give_role, 0);
					header('location:' . URL . 'user/event/' . $event_id);
				}
			}
		}
		if ($rank > 1) {
			$all_members = $this->model->fetchMembers();
		}
		require APP . 'view/_templates/header.php';
		require APP . 'view/user/event.php';
		require APP . 'view/_templates/footer.php';
	}

	public function confirm($input)
	{
		if (!isset($input)) {
			header('location: ' . URL . 'user/upcoming');
		}
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if ($rank > 1) {
			$parts = explode('-', $input);
			$event_id = $parts[0];
			$role_id = $parts[1];
			$this->model->updateRoleStatus($event_id, $role_id, 1);
		}
		header('location: ' . URL . 'user/event/' . $event_id);
	}

	public function unconfirm($input)
	{
		if (!isset($input)) {
			header('location: ' . URL . 'user/upcoming');
		}
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if ($rank > 1) {
			$parts = explode('-', $input);
			$event_id = $parts[0];
			$role_id = $parts[1];
			$this->model->updateRoleStatus($event_id, $role_id, 0);
		}
		header('location: ' . URL . 'user/event/' . $event_id);
	}

	public function deleterole($input)
	{
		if (!isset($input)) {
			header('location: ' . URL . 'user/upcoming');
		}
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if ($rank > 1) {
			$parts = explode('-', $input);
			$event_id = $parts[0];
			$role_id = $parts[1];
			$this->model->updateEventRole($event_id, 0, $role_id, 0);
		}
		header('location: ' . URL . 'user/event/' . $event_id);
	}

	public function deletedriver($input)
	{
		if (!isset($input)) {
			header('location: ' . URL . 'user/upcoming');
		}
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if ($rank > 1) {
			$parts = explode('-', $input);
			$event_id = $parts[0];
			$user_id = $parts[1];
			$this->model->removeDriver($event_id, $user_id);
		}
		header('location: ' . URL . 'user/event/' . $event_id);
	}

	public function delete($event_id)
	{
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if ($rank == 0) {
			header('location: ' . URL . 'user/logout');
		}
		$event_details = $this->model->fetchEvent($event_id);
		if ($event_details->user_id == $_SESSION['user_id'] || $rank > 1) {
			$this->model->deleteEvent($event_id);
		}
		header('location: ' . URL . 'user/upcoming');
	}

	public function edit($event_id)
	{
		if (!isset($event_id)) {
			header('location: ' . URL . 'user/upcoming');
		}
		$page = 3;
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		$event_details = $this->model->fetchEvent($event_id);
		if ($event_details->time < time()) {
			header('location: ' . URL . 'user/upcoming');
		}
		if ($event_details->user_id != $_SESSION['user_id'] && $rank < 2) {
			header('location: ' . URL . 'user/upcoming');
		}
		if (isset($_POST['update_event'])) {
			$event_name = $this->protect($_POST['event_name']);
			$server = $this->protect($_POST['server']);
			$source = $this->protect($_POST['source']);
			$destination = $this->protect($_POST['destination']);
			$time = strtotime($this->protect($_POST['time']));
			if (isset($_POST['trailer'])) {
				$trailer = "Yes";
			} else {
				$trailer = "No";
			}
			//$trailer = $this->protect($_POST['trailer']);
			$route_map = $this->protect($_POST['route_map']);
			$event_page = $this->protect($_POST['event_page']);
			$notes = $this->protect($_POST['notes']);
			$spreadsheet = $this->protect($_POST['spreadsheet']);
			if ($event_name == null || $source == null || $destination == null || $time == null || $route_map == null || $event_page == null || $notes == null || $spreadsheet == null) {
				$success = 0;
			} else if ($time < time()) {
				$success = 0;
			} else {
				$this->model->updateEvent($event_id, $event_name, $server, $source, $destination, $time, $trailer, $route_map, $event_page, $notes, $spreadsheet);
				$success = 1;
			}
		}
		require APP . 'view/_templates/header.php';
		require APP . 'view/user/edit.php';
		require APP . 'view/_templates/footer.php';
	}

	public function profiles()
	{
		$page = 4;
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if ($rank == 0) {
			header('location: ' . URL . 'user/logout');
		}
		$profiles = $this->model->fetchProfilesAll();
		require APP . 'view/_templates/header.php';
		require APP . 'view/user/profiles.php';
		require APP . 'view/_templates/footer.php';
	}

	public function profile($user_id)
	{
		$page = 4;
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if ($rank == 0) {
			header('location: ' . URL . 'user/logout');
		}
		$profile = $this->model->fetchUser($user_id);
		require APP . '../public/includes/keys.php';
		$url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$_STEAMAPI&steamids=$profile->steam_id";
		$json_object = file_get_contents($url);
		$json_decoded = json_decode($json_object);
		foreach ($json_decoded->response->players as $player) {
			$profile_state = $player->communityvisibilitystate;
			$profile_url = $player->profileurl;
		}
		$url2 = "http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=$_STEAMAPI&steamid=$profile->steam_id";
		$json_object2 = file_get_contents($url2);
		$json_decoded2 = json_decode($json_object2);
		if ($profile_state == 3) {
			foreach ($json_decoded2->response->games as $game) {
				$game_id = $game->appid;
				$playtime2 = $game->playtime_forever;
				if ($game_id == 227300) {
					break;
				}
			}
			if ($game_id == 227300) {
				$playtime3 = round($playtime2 / 60);
				$playtime = "$playtime3 hours";
			} else {
				$playtime = "Game not owned";
			}
		} else {
			$playtime = "Unknown";
		}
		if (isset($_POST['update_rank'])) {
			$new_rank = $this->protect($_POST['rank']);
			$this->model->updateRank($user_id, $new_rank);
			header('location: ' . URL . 'user/profile/' . $user_id);
		}
		if(isset($_POST['update_role'])){
			$new_role = $this->protect($_POST['role_val']);
			$this->model->updateRole($user_id, $new_role);
			header('location:' . URL . 'user/profile/' . $user_id);
		}
		require APP . 'view/_templates/header.php';
		require APP . 'view/user/profile.php';
		require APP . 'view/_templates/footer.php';
	}

	public function absent()
	{
		$page = 5;
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		$current_absents = $this->model->currentAbsent(time());
		$future_absents = $this->model->futureAbsent(time());
		if (isset($_POST['absent'])) {
			$date = explode(' - ', $this->protect($_POST['date']));
			$start_date = strtotime($date[0]);
			$end_date = strtotime($date[1]);
			$reason = $this->protect($_POST['reason']);
			if ($reason == NULL || $start_date == NULL || $end_date == NULL) {
				$success = 0;
			} else {
				$this->model->insertAbsence($_SESSION['user_id'], $start_date, $end_date, $reason);
				header('location: ' . URL . 'user/absent');
			}
		}
		require APP . 'view/_templates/header.php';
		require APP . 'view/user/absent.php';
	}
	public function deleteabsent($serial){
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if ($rank > 1) {
			$this->model->deleteAbsent($serial);
		}
		header('location: ' . URL . 'user/absent');
	}

	public function past()
	{
		$page = 6;
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		$time = time() - 3600;
		$fetch_events = $this->model->fetchPastEvents($time);
		require APP . 'view/_templates/header.php';
		require APP . 'view/user/past.php';
		require APP . 'view/_templates/footer.php';
	}

	public function pastevent($event_id)
	{
		$page = 6;
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		$event_details = $this->model->fetchEvent($event_id);
		if ($event_details->time > time() - 3600) {
			header('location: ' . URL . 'user/past');
		}
		$event_roles = $this->model->fetchEventRoles($event_id);
		$fetch_drivers = $this->model->fetchDrivers($event_id);
		if (file_exists('uploads/saves/' . 'fleet_master_' . $event_id . '.zip')) {
			$file_check = 1;
		} else {
			$file_check = 0;
		}
		require APP . 'view/_templates/header.php';
		require APP . 'view/user/pastevent.php';
		require APP . 'view/_templates/footer.php';
	}

	public function attendance()
	{
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		$page = 7;
		$time = time();
		$attendCC = $this->model->countAttendCC($time);
		require APP . 'view/_templates/header.php';
		require APP . 'view/user/attendance.php';
		require APP . 'view/_templates/footer.php';
	}

	public function newmembers()
	{
		$page = 8;
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if ($rank < 2) {
			header('location: ' . URL . 'user/index');
		}
		$profiles = $this->model->fetchNewProfiles();
		require APP . 'view/_templates/header.php';
		require APP . 'view/user/newmem.php';
		require APP . 'view/_templates/footer.php';
	}

	public function confirmuser($user_id)
	{
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if ($rank > 1) {
			$this->model->updateRank($user_id, 1);
		}
		header('location: ' . URL . 'user/newmembers');
	}

	public function removeuser($user_id)
	{
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if ($rank > 1) {
			$this->model->deleteUser($user_id);
		}
		header('location: ' . URL . 'user/newmembers');
	}

	public function contact($id = null)
	{
		$page = 9;
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if ($rank < 2) {
			header('location: ' . URL . 'user/index');
		}
		if (isset($id)) {
			$message = $this->model->fetchMessage($id);
			$this->model->updateContactUs($id, 1);
		}
		$all_messages = $this->model->fetchMessages();
		//load views
		require APP . 'view/_templates/header.php';
		require APP . 'view/user/contact.php';
		require APP . 'view/_templates/footer.php';
	}

	public function deleteContactUs($id)
	{
		$page = 9;
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if ($rank > 1) {
			$this->model->deleteContactUs($id);
		}
		header('location: ' . URL . 'user/contact');
	}

	public function updateContactUs($input)
	{
		$page = 9;
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if ($rank > 1) {
			$parts = explode('-', $input);
			$id = $parts[0];
			$status = $parts[1];
			$this->model->updateContactUs($id, $status);
		}
		header('location: ' . URL . 'user/contact');
	}

	public function editdash($input = null)
	{
		$page = 10;
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if ($rank < 2) {
			header('location: ' . URL . 'user/index');
		}
		$contents = $this->model->fetchContent();
		if (isset($_POST['insert_point'])) {
			$point = $this->protect($_POST['new_point']);
			$this->model->insertContent($point);
			header('location: ' . URL . 'user/editdash');
		}
		if (isset($_POST['update_point'])) {
			$point = $this->protect($_POST['point']);
			$this->model->updateContent($input, $point);
			header('location: ' . URL . 'user/editdash');
		}
		//load views
		require APP . 'view/_templates/header.php';
		require APP . 'view/user/editdash.php';
		require APP . 'view/_templates/footer.php';
	}

	public function deletedash($input)
	{
		$page = 10;
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if ($rank > 1) {
			$this->model->deleteContent($input);
		}
		header('location: ' . URL . 'user/editdash');
	}
	public function otherevents(){
		$page = 11;
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if ($rank < 2) {
			header('location: ' . URL . 'user/index');
		}
		if(isset($_POST['other_event'])){
			$planner = $this->protect($_POST['planner']);
			$server = $this->protect($_POST['server']);
			$source = $this->protect($_POST['source']);
			$destination = $this->protect($_POST['destination']);
			$time = strtotime($this->protect($_POST['time']));
			$event_page = $this->protect($_POST['event_page']);
			$notes = $this->protect($_POST['notes']);
			if (isset($_POST['trailer'])) {
				$trailer = "Yes";
			} else {
				$trailer = "No";
			}
			if($planner == null || $source == null || $destination == null || $time == null || $event_page == null || $notes == null || $server == null){
				$success = 0;
			}
			else if($time < time()){
				$success = 0;
			}else{
				$this->model->insertOtherEvent($planner, $server, $source, $destination, $trailer, $event_page, $time, $notes);
				$success = 1;
			}
		}
		//load views
		require APP . 'view/_templates/header.php';
		require APP . 'view/user/otherevent.php';
		require APP . 'view/_templates/footer.php';
	}
	public function deleteother($id){
		$page = 1;
		list($user_details, $avatar, $rank) = $this->check($_SESSION['user_id']);
		if ($rank > 1) {
			$this->model->deleteOtherEvent($id);
		}
		header('location: ' . URL . 'user/index');
	}
	public function logout()
	{
		if (isset($_SESSION['user_id']) || isset($_COOKIE['user_id'])) {
			session_destroy();
			setcookie('fmelogin', '', time() - 3600, '/');
		}
		header('location: ' . URL . 'home/index');
	}
}