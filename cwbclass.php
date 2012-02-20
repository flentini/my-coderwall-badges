<?php
if (!class_exists('CWB')) :
	class CWB {
		private $username;
		private $name;
		private $location;
		private $badges;
		
		public function __construct(){
			$this->username = get_option('cwb_username');
			$this->name = null;
			$this->location = null;
			$this->init_badges();
		}
		
		public function set_username($cwbusername) {
			$this->username = $cwbusername;
			update_option('cwb_username',$cwbusername);
			$this->init_badges();
		}
		
		public function get_username() {
			return get_option('cwb_username');
		}
		
		public function get_name(){
			return $this->name;
		}
		
		public function get_badges() {
			return $this->badges;
		}
		
		public function get_location() {
			return $this->location;
		}
		
		protected function init_badges() {
			$url = 'http://coderwall.com/'.$this->username.'.json';
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			$cwbadges = curl_exec($ch);
			curl_close($ch);
			
			if(!empty($cwbadges)){
				$badges_string = '<div>';
				$cwbadges = json_decode($cwbadges);
				if(count($cwbadges->badges)>0){
					foreach($cwbadges->badges as $badge){
						$badges_string.='<img class="cwbtip" src="'.$badge->badge.'" 
							alt="'.$badge->name.'" title="'.$badge->description.'" />';
					}
					$badges_string.='</div>';
					$this->name = $cwbadges->name;
					$this->location = $cwbadges->location;
					$this->badges = $badges_string;
				} else {
					$this->badges = 'No achievement earned yet!';
				}
			} else {
				$this->badges = 'Username not found!';
			}
		}
	}
endif;
