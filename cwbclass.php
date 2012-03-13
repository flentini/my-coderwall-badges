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
			$cwbadges = wp_remote_get('http://coderwall.com/'.$this->username.'.json');
			if(!empty($cwbadges)){
				$badges_string = '<div>';
				$cwbadges = json_decode($cwbadges['body']);
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
					$this->badges = __('No achievement earned yet!', 'my-coderwall-badges');
				}
			} else {
				$this->badges = __('Username not found!', 'my-coderwall-badges');
			}
		}
	}
endif;
