<?php
	/**
	 * Role Based Access Control
	 * @category  RBAC Helper
	 */
	defined('ROOT') OR exit('No direct script access allowed');
	class PageAccessManager{
		/**
	     * Array Of User Roles And Page Access 
	     * Use "*" to Grant All Access Right to Particular User Role
	     * @return Html View
	     */
		public static $usersRolePermissions=array(
			'administrator' =>
						array(
							'clientes' => array('list','view','add','edit', 'editfield','delete'),
							'colaboradores' => array('list','view','add','edit', 'editfield','delete'),
							'controle_acesso_caminhoes' => array('list','view','add','edit', 'editfield','delete'),
'controle_acesso_caminhoes_internos' => array('list','view','add','edit', 'editfield','delete'),
							'controle_acesso_veiculos_leves' => array('list','view','add','edit', 'editfield','delete'),
							'controle_acesso_visitantes' => array('list','view','add','edit', 'editfield','delete'),
							'motoristas' => array('list','view','add','edit', 'editfield','delete'),
							'tipos_veiculos' => array('list','view','add','edit', 'editfield','delete'),
							'turnos' => array('list','view','add','edit', 'editfield','delete'),
							'unidades' => array('list','view','add','edit', 'editfield','delete'),
							'users' => array('list','view','add','edit', 'editfield','delete','userregister','accountedit','accountview'),
							'veiculos_clientes' => array('list','view','add','edit', 'editfield','delete'),
							'veiculos_colaboradores' => array('list','view','add','edit', 'editfield','delete')
						),
		
			'user' =>
						array(
							'clientes' => array('list','view'),
							'colaboradores' => array('view'),
							'controle_acesso_caminhoes' => array('list','view','add'),
'controle_acesso_caminhoes_internos' => array('list','view','add'),
							'controle_acesso_veiculos_leves' => array('list','view','add'),
							'controle_acesso_visitantes' => array('list','view','add'),
							'motoristas' => array('list','view'),
							'users' => array('userregister','accountview'),
							'veiculos_clientes' => array('list','view'),
							'veiculos_colaboradores' => array('list','view')
						)
		);
		
		/**
	     * pages to Exclude From Access Validation Check
	     * @var $excludePageCheck array()
	     */
		public static $excludePageCheck = array("","index","home","account","info","masterdetail","report");
		
		/**
	     * Display About us page
	     * @return string
	     */
		public static function GetPageAccess($path){
			$rp=self::$usersRolePermissions;
			if($rp=="*"){
				return "AUTHORIZED"; // Grant Access To Any User
			}
			else{
				$path = strtolower(trim($path, '/')); 

				$arrPath=explode("/", $path);
				$page=strtolower($arrPath[0]);
				
				//If User Is Accessing Exclude Access Check Page
				if(in_array($page , self :: $excludePageCheck)){
					return "AUTHORIZED";
				}
					
				$userRole = strtolower(USER_ROLE); // Get User Defined Role From Session Value
				if(array_key_exists($userRole,$rp)){
					$action = (!empty($arrPath[1]) ? $arrPath[1] : null);
					if($action == "index" || $action == ""){
						$action="list";
					}
					//Check If User Have Access To All Pages Or User Have Access to All Page Actions
					if($rp[$userRole] == "*" || (!empty($rp[$userRole][$page]) && $rp[$userRole][$page] == "*")){
						return "AUTHORIZED";
					}
					else{
						if(!empty($rp[$userRole][$page]) && in_array($action, $rp[$userRole][$page])){
							return "AUTHORIZED";
						}
					}
					return "NOT_AUTHORIZED";
				}
				else{
					//User Does Not Have Any Role.
					return "NO_ROLE_PERMISSION";
				}
			}
		}
		
		public static function is_allowed($path){
			$access = self::GetPageAccess($path);
			return ($access == 'AUTHORIZED');
		}
	}
?>