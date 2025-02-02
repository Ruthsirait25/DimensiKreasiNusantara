<?php

//use Cloudflare\Api as Api;
//use Cloudflare\Exception\AuthenticationException;

/**
 * CloudFlare API
 *
 *
 * @author AzzA <azza@broadcasthe.net>
 * @copyright omgwtfhax inc. 2013
 * @version 1.1
 */
class cloudflare_api {

/*	
	// The URL of the API
	private static $URL = array (
			'USER' => 'https://www.cloudflare.com/api_json.html',
			'HOST' => 'https://api.cloudflare.com/host-gw.html',
			'SPAM' => 'https://www.cloudflare.com/ajax/external-event.html' 
	);
	
	// Service mode values.
	private static $MODE_SERVICE = array (
			'A',
			'AAAA',
			'CNAME' 
	);
	
	// Prio values.
	private static $PRIO = array (
			'MX',
			'SRV' 
	);
*/	
	
	// Timeout for the API requests in seconds
	const TIMEOUT = 50;
/*	
	// Interval values for Stats
	const INTERVAL_365_DAYS = 10;
	const INTERVAL_30_DAYS = 20;
	const INTERVAL_7_DAYS = 30;
	const INTERVAL_DAY = 40;
	const INTERVAL_24_HOURS = 100;
	const INTERVAL_12_HOURS = 110;
	const INTERVAL_6_HOURS = 120;
*/	
	
	// Stores the api key
	private $token_key = false;
	private $host_key = false;
	
	// Stores the email login
	private $email = false;
	
	private $zone = false;

	/**
	 * Make a new instance of the API client
	 */
	public function __construct( $email = false, $token_key = false, $zone = false ) {
		$settings = wpss_defaults( get_option( 'wpss_settings', array() ) );
		if ( isset( $settings['cloudflare_login'] ) && isset( $settings['cloudflare_api_key'] ) ) {
			$this->email = $settings['cloudflare_login'];
			$this->token_key = $settings['cloudflare_api_key'];
		}
		if ( isset( $settings['cloudflare_zone'] ) ) {
			$this->zone = $settings['cloudflare_zone'];
		}
		if ( $email !== false ) {
			$this->email = $email;
		}
		if ( $token_key !== false ) {
			$this->token_key = $token_key;
		}
		if ( $zone !== false ) {
			$this->zone = $zone;
		}
	}

	public function setEmail( $email ) {
		$this->email = $email;
	}

	public function setToken( $token_key ) {
		$this->token_key = $token_key;
	}

	/**
	 * CLIENT API
	 * Section 3
	 * Access
	 */
	
	/**
	 * 3.1 - Retrieve Domain Statistics For A Given Time Frame
	 * This function retrieves the current stats and settings for a particular website.
	 * It can also be used to get currently settings of values such as the security level.
	 */
	public function stats( $zone, $interval = 20 ) {
		$data = array (
				'a' => '/zones/' . $zone . '/analytics/dashboard',
				'params' => array(
						'since' => intval( $interval ) * -1
				) 
		);		
		return $this->http_get( $data );
	}

	/**
	 * 3.2 - Retrieve A List Of The Domains
	 * This lists all domains in a CloudFlare account along with other data.
	 */
/*	
	public function zone_load_multi() {
		$data = array (
				'a' => 'zone_load_multi' 
		);
		return $this->http_post( $data );
	}
*/
	/**
	 * 3.3 - Retrieve DNS Records Of A Given Domain
	 * This function retrieves the current DNS records for a particular website.
	 */
/*	
	public function rec_load_all( $domain ) {
		$data = array (
				'a' => 'rec_load_all',
				'z' => $domain 
		);
		return $this->http_post( $data );
	}
*/	
	public function list_zones( $page = 1 ) {
		$data = array(
			'a' 		=> '/zones',
			'params'	=> array(
					'match'		=> 'any',
					'status'	=> 'active',
					'order'		=> 'name',
					'per_page'	=> 50,
					'page'		=> $page,
			)
		);
		return $this->http_get( $data );
	}
	
	public function get_zone( $zone = false ) {
		if ( $zone == false ) {
			$zone = $this->zone;
		}
		$data = array(
				'a' 		=> '/zones/' . $zone,
				'params'	=> array()
		);
		return $this->http_get( $data );
	}	

	/**
	 * 3.4 - Checks For Active Zones And Returns Their Corresponding Zids
	 * This function retrieves domain statistics for a given time frame.
	 */
/*	
	public function zone_check( $zones ) {
		if ( is_array( $zones ) ) {
			$zones = implode( ',', $zones );
		}
		$data = array (
				'a' => 'zone_check',
				'zones' => $zones 
		);
		return $this->http_post( $data );
	}
*/
	/**
	 * 3.6 - Check The Threat Score For A Given IP
	 * This function retrieves the current threat score for a given IP.
	 * Note that scores are on a logarithmic scale, where a higher score indicates a higher threat.
	 */
/*	
	public function threat_score( $ip ) {
		$data = array (
				'a' => 'ip_lkup',
				'ip' => $ip 
		);
		return $this->http_post( $data );
	}
*/
	/**
	 * 3.7 - List All The Current Settings
	 * This function retrieves all the current settings for a given domain.
	 */
/*	
	public function zone_settings( $domain ) {
		$data = array (
				'a' => 'zone_settings',
				'z' => $domain 
		);
		return $this->http_post( $data );
	}
*/
	/**
	 * Undocumented method
	 * SEE: https://github.com/vexxhost/CloudFlare-API/pull/3
	 */
/*	
	public function zone_init( $zone ) {
		$data['a'] = 'zone_init';
		$data['z'] = $zone;
		return $this->http_post( $data );
	}
*/
	/**
	 * CLIENT API
	 * Section 4
	 * Modify
	 */
	
	/**
	 * 4.1 - Set The Security Level
	 * This function sets the Basic Security Level to I'M UNDER ATTACK! / HIGH / MEDIUM / LOW / ESSENTIALLY OFF.
	 * The switches are: (help|high|med|low|eoff).
	 */
/*	
	public function sec_lvl( $domain, $mode ) {
		$data = array (
				'a' => 'sec_lvl',
				'z' => $domain,
				'v' => $mode 
		);
		return $this->http_post( $data );
	}
*/
	/**
	 * 4.2 - Set The Cache Level
	 * This function sets the Caching Level to Aggressive or Basic.
	 * The switches are: (agg|basic).
	 */
/*	
	public function cache_lvl( $domain, $mode ) {
		$data = array (
				'a' => 'cache_lvl',
				'z' => $domain,
				'v' => (strtolower( $mode ) == 'agg') ? 'agg' : 'basic' 
		);
		return $this->http_post( $data );
	}
*/			
	/**
	 * 4.3 - Toggling Development Mode
	 * This function allows you to toggle Development Mode on or off for a particular domain.
	 * When Development Mode is on the cache is bypassed.
	 * Development mode remains on for 3 hours or until when it is toggled back off.
	 */
	public function devmode( $zone = false, $mode = false ) {
		if ( $zone == false ) {
			$zone = $this->zone;
		}
		if ( $mode == false) {
			$data = array(
					'a' 		=> '/zones/' . $zone . '/settings/development_mode',
					'params'	=> array()
			);
			return $this->http_get( $data );				
		}
		else {
			$data = array(
					'a' 		=> '/zones/' . $zone . '/settings/development_mode',
					'params'	=> array(),
					'data'		=> array( 'value' => $mode ),
			);
			return $this->http_patch( $data );				
		}
	}

	/**
	 * 4.4 - Clear CloudFlare's Cache
	 * This function will purge CloudFlare of any cached files.
	 * It may take up to 48 hours for the cache to rebuild and optimum performance to be achieved.
	 * This function should be used sparingly.
	 */
	public function fpurge_ts( $zone ) {
		$data = array (
				'a' => '/zones/' . $zone . '/purge_cache',
				'data' => array(
						'purge_everything' => true
				) 
		);
		return $this->http_delete( $data );
	}

	/**
	 * 4.5 - Purge A Single File In CloudFlare's Cache
	 * This function will purge a single file from CloudFlare's cache.
	 */
	public function zone_file_purge( $zone, $urls ) {
		if ( !is_array( $urls ) ) {
			$urls = array( $urls );
		}
		$data = array (
				'a' 	=> '/zones/' . $zone . '/purge_cache',
				'data' 	=> array(
						'files'	=> $urls
				)
		);
		return $this->http_delete( $data );
	}

	/**
	 * 4.6 - Update The Snapshot Of Your Site
	 * This snapshot is used on CloudFlare's challenge page
	 * This function tells CloudFlare to take a new image of your site.
	 * Note that this call is rate limited to once per zone per day.
	 * Also the new image may take up to 1 hour to appear.
	 */
/*	
	public function update_image( $zoneid ) {
		$data = array (
				'a' => 'zone_grab',
				'zid' => $zoneid 
		);
		return $this->http_post( $data );
	}
*/
	
	public function firewall_rules( $ip = null, $all_zones = false ) {
		if ( $all_zones ) {
			$data = array (
					'a' => '/user/firewall/access_rules/rules',
					'data' => array( 
					)
			);
			if ( $ip != null ) {
				$data['params']['configuration_target'] = 'ip';
				$data['params']['configuration_value'] = $ip;
			}
			return $this->http_get( $data );				
		}
		else {
			$zone = $this->zone;
			$data = array (
					'a' => '/zones/' . $zone . '/firewall/access_rules/rules',
					'params' => array( 
							'scope_type' => 'zone'
					)
			);
			if ( $ip != null ) {
				$data['params']['configuration_target'] = 'ip';
				$data['params']['configuration_value'] = $ip;
			}
			return $this->http_get( $data );
		}
	}
	
	/**
	 * 4.7a - Whitelist IPs
	 * You can add an IP address to your whitelist.
	 */
	public function wl( $ip, $notes = 'WP Supersonic', $all_zones = false ) {
		if ( $all_zones ) {
			$data = array (
					'a' => '/user/firewall/access_rules/rules',
					'data' => array(
							'notes'			=> $notes,
							'mode' 			=> 'whitelist',
							'configuration' => array(
									'target'	=> 'ip',
									'value'		=> $ip
							)
					),
			);
			return $this->http_post( $data );
		}
		else {
			$zone = $this->zone;
			$data = array (
					'a' => '/zones/' . $zone . '/firewall/access_rules/rules',
					'data' => array(
							'notes'			=> $notes,
							'mode' 			=> 'whitelist',
							'configuration' => array(
									'target'	=> 'ip',
									'value'		=> $ip	
							)						
					),
			);
			return $this->http_post( $data );
		}
	}

	/**
	 * 4.7b - Blacklist IPs
	 * You can add an IP address to your blacklist.
	 */
	public function ban( $ip, $notes = 'WP Supersonic', $all_zones = false ) {
		if ( $all_zones ) {
			$data = array (
					'a' => '/user/firewall/access_rules/rules',
					'data' => array(
							'notes'			=> $notes,
							'mode' 			=> 'block',
							'configuration' => array(
									'target'	=> 'ip',
									'value'		=> $ip	
							)						
					),
			);
			return $this->http_post( $data );
		}
		else {
			$zone = $this->zone;
			$data = array (
					'a' => '/zones/' . $zone . '/firewall/access_rules/rules',
					'data' => array(
							'notes'			=> $notes,
							'mode' 			=> 'block',
							'configuration' => array(
									'target'	=> 'ip',
									'value'		=> $ip	
							)						
					),
			);
			return $this->http_post( $data );
		}
	}

	/**
	 * 4.7b - Blacklist IPs
	 * You can add an IP address to your blacklist.
	 */
	public function challenge( $ip, $notes = 'WP Supersonic', $all_zones = false ) {
		if ( $all_zones ) {
			$data = array (
					'a' => '/user/firewall/access_rules/rules',
					'data' => array(
							'notes'			=> $notes,
							'mode' 			=> 'challenge',
							'configuration' => array(
									'target'	=> 'ip',
									'value'		=> $ip	
							)						
					),
			);
			return $this->http_post( $data );
		}
		else {
			$zone = $this->zone;
			$data = array (
					'a' => '/zones/' . $zone . '/firewall/access_rules/rules',
					'data' => array(
							'notes'			=> $notes,
							'mode' 			=> 'challenge',
							'configuration' => array(
									'target'	=> 'ip',
									'value'		=> $ip	
							)						
					),
			);
			return $this->http_post( $data );
		}
	}
	
	/**
	 * 4.7c - Unlist IPs
	 * You can remove an IP address from the whitelist and the blacklist.
	 */
	public function nul( $ip, $all_zones = false  ) {
		$rules = $this->firewall_rules( $ip, $all_zones );
		if ( $rules->result == 'error' ) {
			return $rules;
		}
		$ret = new stdClass();
		$ret->result = 'error';
		$ret->msg = 'None rules deleted.'; 
		foreach ( $rules->result as $rule ) {
			if ( $all_zones ) {			 
				$data = array (
						'a' => '/user/firewall/access_rules/rules/' . $rule->id,
						'data' => array(
								'cascade' => 'none'
						), 
				);
				$ret = $this->http_delete( $data );
			}
			else {
				$zone = $this->zone;
				$data = array (
						'a' => '/zones/' . $zone . '/firewall/access_rules/rules/' . $rule->id,
						'data' => array(
								'cascade' => 'none'
						), 
				);
				$ret = $this->http_delete( $data );
			}
		}		
		return $ret;
	}

	/**
	 * 4.8 - Toggle IPv6 Support
	 * This function toggles IPv6 support.
	 */
/*	
	public function ipv46( $domain, $mode ) {
		$data = array (
				'a' => 'ipv46',
				'z' => $domain,
				'v' => ($mode == true) ? 1 : 0 
		);
		return $this->http_post( $data );
	}
*/
	/**
	 * 4.9 - Set Rocket Loader
	 * This function changes Rocket Loader setting.
	 */
/*	
	public function async( $domain, $mode ) {
		$data = array (
				'a' => 'async',
				'z' => $domain,
				'v' => $mode 
		);
		return $this->http_post( $data );
	}
*/
	/**
	 * 4.10 - Set Minification
	 * This function changes minification settings.
	 */
/*	
	public function minify( $domain, $mode ) {
		$data = array (
				'a' => 'minify',
				'z' => $domain,
				'v' => $mode 
		);
		return $this->http_post( $data );
	}
*/
	/**
	 * CLIENT API
	 * Section 5
	 * DNS Record Management
	 */
	
	/**
	 * 5.1 - Add A New DNS Record
	 * This function creates a new DNS record for a zone.
	 * See http://www.cloudflare.com/docs/client-api.html#s5.1 for documentation.
	 */
/*	
	public function rec_new( $domain, $type, $name, $content, $ttl = 1, $mode = 1, $prio = 1, $service = 1, $srvname = 1, $protocol = 1, $weight = 1, $port = 1, $target = 1 ) {
		$data = array (
				'a' => 'rec_new',
				'z' => $domain,
				'type' => $type,
				'name' => $name,
				'content' => $content,
				'ttl' => $ttl 
		);
		if ( in_array( $type, self::$MODE_SERVICE ) )
			$data['service_mode'] = ($mode == true) ? 1 : 0;
		else if ( in_array( $type, self::$PRIO ) ) {
			$data['prio'] = $prio;
			if ( $type == 'SRV' ) {
				$data = array_merge( $data, array (
						'service' => $service,
						'srvname' => $srvname,
						'protocol' => $protocol,
						'weight' => $weight,
						'port' => $port,
						'target' => $target 
				) );
			}
		}
		return $this->http_post( $data );
	}
*/
	/**
	 * 5.2 - Edit A DNS Record
	 * This function edits a DNS record for a zone.
	 * See http://www.cloudflare.com/docs/client-api.html#s5.1 for documentation.
	 */
/*		
	public function rec_edit( $domain, $type, $id, $name, $content, $ttl = 1, $mode = 1, $prio = 1, $service = 1, $srvname = 1, $protocol = 1, $weight = 1, $port = 1, $target = 1 ) {
		$data = array (
				'a' => 'rec_edit',
				'z' => $domain,
				'type' => $type,
				'id' => $id,
				'name' => $name,
				'content' => $content,
				'ttl' => $ttl 
		);
		if ( in_array( $type, self::$MODE_SERVICE ) )
			$data['service_mode'] = ($mode == true) ? 1 : 0;
		else if ( in_array( $type, self::$PRIO ) ) {
			$data['prio'] = $prio;
			if ( $type == 'SRV' ) {
				$data = array_merge( $data, array (
						'service' => $service,
						'srvname' => $srvname,
						'protocol' => $protocol,
						'weight' => $weight,
						'port' => $port,
						'target' => $target 
				) );
			}
		}
		return $this->http_post( $data );
	}
*/
	/**
	 * 5.3 - Delete A DNS Record
	 * This function deletes a DNS record for a zone.
	 * $zone = zone
	 * $id = The DNS Record ID (Available by using the rec_load_all call)
	 * $type = A|CNAME
	 */
/*		
	public function delete_dns_record( $domain, $id ) {
		$data = array (
				'a' => 'rec_delete',
				'z' => $domain,
				'id' => $id 
		);
		return $this->http_post( $data );
	}
*/
	/**
	 * HOST API
	 * Section 3
	 * Specific Host Provider Operations
	 */
/*	
	public function user_create( $email, $password, $username = '', $id = '' ) {
		$data = array (
				'act' => 'user_create',
				'cloudflare_email' => $email,
				'cloudflare_pass' => $password,
				'cloudflare_username' => $username,
				'unique_id' => $id 
		);
		return $this->http_post( $data, 'HOST' );
	}
*/
/*		
	public function zone_set( $key, $zone, $resolve_to, $subdomains ) {
		if ( is_array( $subdomains ) )
			$subdomains = implode( ',', $subdomains );
		$data = array (
				'act' => 'zone_set',
				'user_key' => $key,
				'zone_name' => $zone,
				'resolve_to' => $resolve_to,
				'subdomains' => $subdomains 
		);
		return $this->http_post( $data, 'HOST' );
	}
*/
/*		
	public function user_lookup( $email, $isID = false ) {
		$data = array (
				'act' => 'user_lookup' 
		);
		if ( $isID ) {
			$data['unique_id'] = $email;
		} else {
			$data['cloudflare_email'] = $email;
		}
		return $this->http_post( $data, 'HOST' );
	}
*/
/*		
	public function user_auth( $email, $password, $id = '' ) {
		$data = array (
				'act' => 'user_auth',
				'cloudflare_email' => $email,
				'cloudflare_pass' => $password,
				'unique_id' => $id 
		);
		return $this->http_post( $data, 'HOST' );
	}
*/
/*		
	public function zone_lookup( $zone, $user_key ) {
		$data = array (
				'act' => 'zone_lookup',
				'user_key' => $user_key,
				'zone_name' => $zone 
		);
		return $this->http_post( $data, 'HOST' );
	}
*/
/*		
	public function zone_delete( $zone, $user_key ) {
		$data = array (
				'act' => 'zone_delete',
				'user_key' => $user_key,
				'zone_name' => $zone 
		);
		return $this->http_post( $data, 'HOST' );
	}
*/
/*		
	public function zone_list() {
		$data = array (
				'act' => 'zone_list',
				'one_status' => 'ALL',
				'sub_status' => 'ALL' 
		);
		return $this->http_post( $data, 'HOST' );
	}
*/
/*		
	public function spam( $author, $email, $ip, $content ) {
		$data = array (
				'value' => array (
						'a' => $author,
						'am' => $email,
						'ip' => $ip,
						'con' => $content 
				) 
		);
		return $this->http_post( $data, 'SPAM' );
	}
*/
	/**
	 * GLOBAL API CALL
	 * HTTP POST a specific task with the supplied data
	 */
/*		
	private function http_post_org( $data, $type = 'USER' ) {
		switch ($type) {
			case 'USER' :
				$data['u'] = $this->email;
				$data['tkn'] = $this->token_key;
				break;
			case 'HOST' :
				$data['host_key'] = $this->host_key;
				break;
		}
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_VERBOSE, 0 );
		curl_setopt( $ch, CURLOPT_FORBID_REUSE, true );
		curl_setopt( $ch, CURLOPT_URL, self::$URL[$type] );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_POST, 1 );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
		curl_setopt( $ch, CURLOPT_TIMEOUT, self::TIMEOUT );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		$http_result = curl_exec( $ch );
		$error = curl_error( $ch );
		$http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
		curl_close( $ch );
		if ( $http_code != 200 ) {
			return array (
					'error' => $error 
			);
		} else {
			return json_decode( $http_result );
		}
	}
*/
/*		
	private function http_post_v1( $data, $type = 'USER' ) {
		switch ($type) {
			case 'USER' :
				$data['u'] = $this->email;
				$data['tkn'] = $this->token_key;
				break;
			case 'HOST' :
				$data['host_key'] = $this->host_key;
				break;
		}
		if ( $type == 'SPAM' ) {
			$url = self::$URL[$type];
			$url .= "?event_v=" . urlencode( json_encode( $data['value'] ) );
			$url .= "&u=" . $this->email;
			$url .= "&tkn=" . $this->token_key;
			$url .= "&event_t=";
			$response = wp_remote_get( $url, array (
					'method' => 'GET',
					'timeout' => self::TIMEOUT,
					'redirection' => 5,
					'httpversion' => '1.0',
					'blocking' => true,
					'headers' => array (),
					'sslverify' => false,
					'cookies' => array () 
			) );
		} else {
			$response = wp_remote_post( self::$URL[$type], array (
					'method' => 'POST',
					'timeout' => self::TIMEOUT,
					'redirection' => 5,
					'httpversion' => '1.0',
					'blocking' => true,
					'headers' => array (),
					'body' => $data,
					'sslverify' => false,
					'cookies' => array () 
			) );
		}
		//
		if ( is_wp_error( $response ) ) {
			$ret = new stdClass();
			$ret->result = 'error';
			$ret->msg = $response->get_error_message();
			return $ret;
		} else {
			return json_decode( $response['body'] );
		}
	}
*/	
/*	
	private function http_post( $data, $type = 'USER' ) {
		return $this->http_post_v1($data, Type);
	}
*/
/*		
	private function http_get1( $data, $type = 'USER' ) {
		if ( $this->email == false || $this->token_key == false ) {
			$ret = new stdClass();
			$ret->result = 'error';
			$ret->msg = __( 'No login credintials.', 'wcss' );
			$ret->success = 0;
			return $ret;				
		}
		$url = 'https://api.cloudflare.com/client/v4' . $data['a'];
		if ( isset( $data['params'] ) ) {
			foreach ( $data['params'] as $param => $value ) {
				$url = add_query_arg( $param, $value, $url );
			}
		}
		$headers = array(
			'X-Auth-Email' 	=> $this->email,
			'X-Auth-Key'	=> $this->token_key,
			'Content-Type'	=> 'application/json'
		); 
		$args = array(
				'method' => 'GET',
				'timeout' => self::TIMEOUT,
				'redirection' => 5,
				'httpversion' => '1.0',
				'blocking' => true,
				'headers' => $headers,
				'sslverify' => false,
				'cookies' => array (),
		);
		$response = wp_remote_get( $url, $args );
		if ( is_wp_error( $response ) ) {
			$ret = new stdClass();
			$ret->result = 'error';
			$ret->msg = $response->get_error_message();
			return $ret;
		} 
		else {
			$ret_json = json_decode( $response['body'] );
			if ( isset( $ret_json->errors ) && isset( $ret_json->errors[0] ) ) {
				$ret = new stdClass();
				$ret->result = 'error';
				$ret->msg = $ret_json->errors[0]->message;
				$ret->success = 0;
				return $ret;
			}
			return $ret_json;
		}
	}
*/	
	private function http_post( $data, $type = 'USER', $method = 'POST' ) {
		if ( $this->email == false || $this->token_key == false ) {
			$ret = new stdClass();
			$ret->result = 'error';
			$ret->msg = __( 'No login credintials.', 'wcss' );
			$ret->success = 0;
			return $ret;				
		}
		$url = 'https://api.cloudflare.com/client/v4' . $data['a'];
		if ( isset( $data['params'] ) ) {
			foreach ( $data['params'] as $param => $value ) {
				$url = add_query_arg( $param, $value, $url );
			}
		}
		$headers = array(
			'X-Auth-Email' 	=> $this->email,
			'X-Auth-Key'	=> $this->token_key,
			'Content-Type'	=> 'application/json'
		); 
		$args = array(
				'method' => $method,
				'timeout' => self::TIMEOUT,
				'redirection' => 5,
				'httpversion' => '1.0',
				'blocking' => true,
				'headers' => $headers,
				'sslverify' => false,
				'cookies' => array (),
		);
		if ( $method !== 'GET' && isset($data['data']) ) {
			$args['body'] = json_encode( $data['data'] );
		}
		$response = wp_remote_post( $url, $args );
		if ( is_wp_error( $response ) ) {
			$ret = new stdClass();
			$ret->result = 'error';
			$ret->msg = $response->get_error_message();
			return $ret;
		} 
		else {
			$ret_json = json_decode( $response['body'] );
			if ( isset( $ret_json->errors ) && isset( $ret_json->errors[0] ) ) {
				$ret = new stdClass();
				$ret->result = 'error';
				$ret->success = 0;
				$ret->msg = $ret_json->errors[0]->message;
				return $ret;
			}
			return $ret_json;
		}
	}

	private function http_patch( $data, $type = 'USER' ) {
		return $this->http_post( $data, $type, 'PATCH' );
	}
	
	private function http_delete( $data, $type = 'USER' ) {
		return $this->http_post( $data, $type, 'DELETE' );
	}
	
	private function http_get( $data, $type = 'USER' ) {
		return $this->http_post( $data, $type, 'GET' );
	}

}
