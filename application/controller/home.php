<?php

class Home extends Controller
{
	public function index()
	{
		$latest_event = $this->model->fetchLatestEvent(time());
		$t = $latest_event->min_time - time();
		$members = $this->model->fetchProfilesAll();
		require APP . '../public/includes/openid.php';
		require APP . '../public/includes/keys.php';
		try {
			$openid = new LightOpenID('http://127.0.0.1/fme/home/index');
			if (!$openid->mode) {
				if (isset($_GET['login'])) {
					$openid->identity = "http://steamcommunity.com/openid?l=english";
					header('location:' . $openid->authUrl());
				}
			} else if ($openid->mode == 'cancel') {
				$message = "User has cancelled authentication.";
			} else {
				if ($openid->validate()) {
					$id = $openid->identity;
					$ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
					preg_match($ptn, $id, $matches);

					$url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$_STEAMAPI&steamids=$matches[1]";
					$json_object = file_get_contents($url);
					$json_decoded = json_decode($json_object);

					foreach ($json_decoded->response->players as $player) {
						$steam_id = $player->steamid;
						$steam_name = $player->personaname;
						$avatar = $player->avatarfull;
						$user_details = $this->model->checkUser($steam_id);
						if ($user_details->count_user == 0) {
							$url2 = "https://api.truckersmp.com/v2/player/$steam_id";
							$json_object2 = file_get_contents($url2);
							$json_decoded2 = json_decode($json_object2);
							$check_error = $json_decoded2->error;
							if ($check_error == false) {
								$truckersmp_id = $json_decoded2->response->id;
								$truckersmp_date = $json_decoded2->response->joinDate;
							} else if ($check_error == true) {
								$truckersmp_id = 0;
								$truckersmp_date = 0;
							}
							$register_time = time();
							$ran = rand(1000, 9999);
							$combine = $steam_id . $ran;
							$key = hash('sha256', $combine);
							$this->model->insertUser($steam_id, $truckersmp_id, $steam_name, $avatar, $truckersmp_date, $register_time, $key);
						} else if ($user_details->count_user == 1) {
							$this->model->updateUser($steam_id, $steam_name, $avatar);
						}
						$user_details = $this->model->checkUser($steam_id);
						$this->model->updateIP($user_details->user_id, $this->getuserIP());
						if ($user_details->rank != 0) {
							$_SESSION['user_id'] = $user_details->user_id;
							setcookie("fmelogin", $user_details->cookie, time() + (86400 * 90), "/");
							header('location:' . URL . 'user/index');
						} else {
							header('location:' . URL .'home/index');
						}
					}
				} else {
					$message = "User is not logged in";
				}
			}
		} catch (ErrorException $e) {
			echo $e->getMessage();
		}
		require APP . 'view/home/index.php';
	}

	public function message()
	{
		$name = $this->protect($_GET['name']);
		$email = $this->protect($_GET['email']);
		$message = $this->protect($_GET['message']);
		if ($name == null || $email == null || $message == null) {
			$result = "Fill all the empty fields.";
		} else {
			$this->model->insertContactus($name, $email, $message, time());
			$result = "Message sent!";
		}
		echo $result;
	}
	public function updatesteam(){
		$members = $this->model->fetchProfilesAll();
		$_STEAMAPI = "03B0C68B2B0BF14C49BF8131D3CF6022";
		$url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$_STEAMAPI&steamids=";
		foreach($members AS $member){
			$url = $url . $member->steam_id . ",";
		}
		$json_object = file_get_contents($url);
		$json_decoded = json_decode($json_object);
		foreach($json_decoded->response->players AS $player){
			$steam_id = $player->steamid;
			$steam_name  = $player->personaname;
			$avatar = $player->avatarfull;
			$this->model->updateUser($steam_id, $steam_name, $avatar);
		}
	}
}