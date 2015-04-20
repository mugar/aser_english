<?php
	/**
	 * This component named licence is inspired from a padl app used for licensing php application.
	 * Some of the code is inspired from the file	"class.license.app.php"
	 * 
	 * The role of this component is to protect the aser application against running on unauthorized 
	 * servers. It achivies this by restricting the app to a given ip address, server name & most
	 * importantly to a given mac address
	 */


	class LicenseComponent extends Object {
		
		function server_name_checker(){
			$server_name_conf=Configure::read('license.server_name');
			$server_name_found=$_SERVER['SERVER_NAME'];
			$found=false;
			if($server_name_conf==''){ //means we don't do server name restriction
				$found=true;
			}
			else {
				if($server_name_found==$server_name_conf) {
					$found=true;
				}
			}
			return $found;
		}
		
		function ip_checker(){
			$ip_address_conf=Configure::read('license.server_ip_address');
			$ip_address_found=$this->get_ip_address();
			$found=false;
			if($ip_address_conf==''){ //means we don't do ip address restriction
				$found=true;
			}
			else {
				foreach($ip_address_found as $ip) {
					if($ip==$ip_address_conf) {
						$found=true;
						break;
					}
				}
			}
			return $found;
		}
		
		function mac_checker(){
			$mac_address_conf=Configure::read('license.server_mac_address');
			$mac_address_found=$this->get_mac_address();
			$found=false;
			if($mac_address_conf==''){ //means we don't do mac address restriction
				$found=true;
			}
			else {
				foreach($mac_address_found as $mac) {
					if($mac==$mac_address_conf) {
						$found=true;
						break;
					}
				}
			}
			if(!$found)
				exit('Access Denied!');
		}
		
		/**
		* get_config
		*
		* gets the server config info via /sbin/ifconfig on linux,mac (darwin) & other unix based os
		* or ipconfig/all on windows and returns it
		**/
		function get_config()
		{  
			$os = strtolower(PHP_OS);
			if(substr($os, 0, 3)=='win')
			{
				$conf=shell_exec('ipconfig/all');
			}
			else
			{
				$conf=shell_exec('/sbin/ifconfig');
			}
			return $conf;
		}
		
		/**
		* get_ip_address
		* a given machine may have many ips because of an ethernet card & wifi card
		 * so the ouput is an array containing all the found ips
		**/
		function get_ip_address(){
			
			$ips = array();
			$conf = $this->get_config();
			$regex='((25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)\.){3}(25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)';
			$matches=array();
		
  			if (preg_match_all("#$regex#", $conf,$matches)){
       			 $ips=$matches[0];
        	}
			else {
				# if the conf has returned nothing
				# attempt to use the $_SERVER data
				$ips[0]=gethostbyname ($_SERVER['SERVER_NAME']);
				# if the $_SERVER addr is not the same as the returned ip include it aswell
				#will to check soon if they can be really different !
				if($ips[0] !=$_SERVER['SERVER_ADDR'])
				{
					$ips[1] = $_SERVER['SERVER_ADDR'];
				}
			}
			return $ips;
		}
		
		/**
		* get_mac_address
		*
		* Used to get the MAC address of the host server. It works with Linux,
		* and Win XP. It may work with unix based OS and Darwin (mac OS),
		* but they haven't been tested
		* 
		* Because many network cards (ethernet, wifi) that may be
		* present on a given machine we will have an array of 
		* mac addresses.
		**/
		function get_mac_address(){
			
			$conf = $this->get_config();
			$macs = array();
   			$regex='([0-9a-f][0-9a-f][-:]){5}([0-9a-f][0-9a-f])';
			$matches=array();
    		if (preg_match_all("#$regex#i", $conf,$matches)){
    			$macs=$matches[0];
			}
			return $macs;
		}

	}
