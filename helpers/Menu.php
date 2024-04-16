<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
	public static $navbartopleft = array(
		array(
			'path' => 'home', 
			'label' => 'Home', 
			'icon' => ''
		),
		
		array(
			'path' => '',
            'label' => 'Caminhões',
            'icon' => '',
            'submenu' => array(
                array(
                    'path' => 'controle_acesso_caminhoes',
                    'label' => 'Controle Acesso Caminhões',
                    'icon' => ''
                ),
                array(
                    'path' => 'controle_acesso_caminhoes_internos',
                    'label' => 'Controle Acesso Caminhões Internos',
                    'icon' => ''
                )
            )
		),
		
		array(
			'path' => 'controle_acesso_veiculos_leves', 
			'label' => 'Controle Acesso Veículos Leves', 
			'icon' => ''
		),
		
		array(
			'path' => 'controle_acesso_visitantes', 
			'label' => 'Controle Acesso Visitantes', 
			'icon' => ''
		),
		
		array(
			'path' => '', 
			'label' => 'Clientes e Transportadoras', 
			'icon' => '',
'submenu' => array(
		array(
			'path' => 'veiculos_clientes', 
			'label' => 'Veículos', 
			'icon' => ''
		),
		
		array(
			'path' => 'motoristas', 
			'label' => 'Motoristas', 
			'icon' => ''
		),
		
		array(
			'path' => 'clientes', 
			'label' => 'Clientes / Transportadoras', 
			'icon' => ''
		)
	)
		),
		
		array(
			'path' => '', 
			'label' => 'Colaboradores', 
			'icon' => '',
'submenu' => array(
		array(
			'path' => 'veiculos_colaboradores', 
			'label' => 'Veículos', 
			'icon' => ''
		),
		
		array(
			'path' => 'colaboradores', 
			'label' => 'Colaboradores', 
			'icon' => ''
		)
	)
		),
		
		array(
			'path' => '', 
			'label' => 'Configurações', 
			'icon' => '',
'submenu' => array(
		array(
			'path' => 'users', 
			'label' => 'Users', 
			'icon' => ''
		),
		
		array(
			'path' => 'unidades', 
			'label' => 'Unidades', 
			'icon' => ''
		),
		
		array(
			'path' => 'turnos', 
			'label' => 'Turnos', 
			'icon' => ''
		),
		
		array(
			'path' => 'tipos_veiculos', 
			'label' => 'Tipos Veículos', 
			'icon' => ''
		)
	)
		)
	);

	
	
	public static $nome_empresa = array();

	public static $permissao = array(
		array(
			"value" => "SIM", 
			"label" => "SIM", 
		),);

	public static $role = array(
		array(
			"value" => "User", 
			"label" => "Usuário", 
		),
		array(
			"value" => "Administrator", 
			"label" => "Administrador", 
		),);

}