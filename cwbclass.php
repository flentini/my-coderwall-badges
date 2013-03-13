<?php
if (!class_exists('CWB')) :
	class CWB {
		private $username;
		private $name;
		private $location;
		private $badges;
		private $show_endorse;

		public function __construct(){
			$this->username = get_option('cwb_username');
			$this->show_endorse = get_option('cwb_endorse');
			$this->name = null;
			$this->location = null;
			$this->init_badges();
		}

		public function set_username($cwbusername) {
			$this->username = $cwbusername;
			update_option('cwb_username',$cwbusername);
			$this->init_badges();
		}

		public function set_show_endorse($cwendorse){
			$this->endorse = $cwendorse;
			update_option('cwb_endorse', $cwendorse);
		}

		public function get_username() {
			return get_option('cwb_username');
		}

		public function get_show_endorse(){
			return get_option('cwb_endorse');
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

		public function get_endorsements() {
			return "<a href='http://coderwall.com/$this->username' title='Coderwall endorsements'>" .
					"<img src='http://api.coderwall.com/$this->username/endorsecount.png' alt='Coderwall endorsements' />" .
				"</a>";
		}


		protected function init_badges() {
			$cwbadges = wp_remote_get('https://coderwall.com/'.$this->username.'.json', array( 'sslverify' => false));
			if(!empty($cwbadges) && !is_wp_error($cwbadges)){
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
