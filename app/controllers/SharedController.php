<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * controle_acesso_caminhoes_id_cliente_real_option_list Model Action
     * @return array
     */
	function controle_acesso_caminhoes_id_cliente_real_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT id AS value,nome_empresa AS label FROM clientes WHERE nome_empresa LIKE ? ORDER BY nome_empresa ASC LIMIT 0,10" ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

	/**
     * controle_acesso_caminhoes_clientes_id_option_list Model Action
     * @return array
     */
	function controle_acesso_caminhoes_clientes_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,nome_empresa AS label FROM clientes ORDER BY nome_empresa ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * controle_acesso_caminhoes_motoristas_id_option_list Model Action
     * @return array
     */
	function controle_acesso_caminhoes_motoristas_id_option_list($lookup_clientes_id){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,nome AS label FROM motoristas WHERE clientes_id= ? ORDER BY nome ASC" ;
		$queryparams = array($lookup_clientes_id);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * controle_acesso_caminhoes_placa_option_list Model Action
     * @return array
     */
	function controle_acesso_caminhoes_placa_option_list($lookup_clientes_id){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT placa AS value,placa AS label FROM veiculos_clientes WHERE clientes_id= ? ORDER BY placa ASC" ;
		$queryparams = array($lookup_clientes_id);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * controle_acesso_caminhoes_cliente_permitido_option_list Model Action
     * @return array
     */
	function controle_acesso_caminhoes_cliente_permitido_option_list($lookup_id_cliente_real){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT permissao AS value,permissao AS label FROM clientes WHERE id= ? ORDER BY permissao ASC" ;
		$queryparams = array($lookup_id_cliente_real);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * controle_acesso_caminhoes_motorista_permitido_option_list Model Action
     * @return array
     */
	function controle_acesso_caminhoes_motorista_permitido_option_list($lookup_motoristas_id){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT permissao AS value,permissao AS label FROM motoristas WHERE id= ? ORDER BY permissao ASC" ;
		$queryparams = array($lookup_motoristas_id);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * controle_acesso_veiculos_leves_colaboradores_id_viasolo_option_list Model Action
     * @return array
     */
	function controle_acesso_veiculos_leves_colaboradores_id_viasolo_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT id_viasolo AS value,nome AS label FROM colaboradores WHERE nome LIKE ? ORDER BY nome ASC LIMIT 0,10" ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

	/**
     * controle_acesso_veiculos_leves_motorista_option_list Model Action
     * @return array
     */
	function controle_acesso_veiculos_leves_motorista_option_list($lookup_colaboradores_id_viasolo){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT nome AS value,nome AS label FROM colaboradores WHERE id_viasolo= ? ORDER BY nome ASC" ;
		$queryparams = array($lookup_colaboradores_id_viasolo);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * controle_acesso_veiculos_leves_placa_option_list Model Action
     * @return array
     */
	function controle_acesso_veiculos_leves_placa_option_list($lookup_colaboradores_id_viasolo){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT placa AS value,placa AS label FROM veiculos_colaboradores WHERE colaboradores_id_viasolo= ? ORDER BY placa ASC" ;
		$queryparams = array($lookup_colaboradores_id_viasolo);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * controle_acesso_veiculos_leves_modelo_option_list Model Action
     * @return array
     */
	function controle_acesso_veiculos_leves_modelo_option_list($lookup_placa){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT modelo AS value,modelo AS label FROM veiculos_colaboradores WHERE placa= ? ORDER BY modelo ASC" ;
		$queryparams = array($lookup_placa);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * controle_acesso_visitantes_turno_option_list Model Action
     * @return array
     */
	function controle_acesso_visitantes_turno_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT value AS value,label AS label FROM turnos ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * controle_acesso_visitantes_cliente_id_option_list Model Action
     * @return array
     */
	function controle_acesso_visitantes_cliente_id_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT id AS value,nome_empresa AS label FROM clientes WHERE nome_empresa LIKE ? ORDER BY nome_empresa ASC LIMIT 0,10" ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

	/**
     * controle_acesso_visitantes_cliente_id_default_value Model Action
     * @return Value
     */
	function controle_acesso_visitantes_cliente_id_default_value(){
		$db = $this->GetModel();
		$sqltext = "SELECT  c.id FROM clientes AS c WHERE  (c.nome_empresa  ='Outros' )";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * controle_acesso_visitantes_motoristas_id_option_list Model Action
     * @return array
     */
	function controle_acesso_visitantes_motoristas_id_option_list($lookup_cliente_id){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,nome AS label FROM motoristas WHERE clientes_id= ? ORDER BY nome ASC" ;
		$queryparams = array($lookup_cliente_id);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * controle_acesso_visitantes_nome_option_list Model Action
     * @return array
     */
	function controle_acesso_visitantes_nome_option_list($lookup_motoristas_id){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT nome AS value,nome AS label FROM motoristas WHERE id= ? ORDER BY nome ASC" ;
		$queryparams = array($lookup_motoristas_id);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * controle_acesso_visitantes_rg_option_list Model Action
     * @return array
     */
	function controle_acesso_visitantes_rg_option_list($lookup_motoristas_id){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT RG AS value,RG AS label FROM motoristas WHERE id= ? ORDER BY RG ASC" ;
		$queryparams = array($lookup_motoristas_id);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * controle_acesso_visitantes_placa_option_list Model Action
     * @return array
     */
	function controle_acesso_visitantes_placa_option_list($lookup_motoristas_id){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT placa AS value,placa AS label FROM veiculos_clientes WHERE motoristas_id= ? ORDER BY placa ASC" ;
		$queryparams = array($lookup_motoristas_id);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * controle_acesso_visitantes_colaboradores_id_viasolo_option_list Model Action
     * @return array
     */
	function controle_acesso_visitantes_colaboradores_id_viasolo_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT id_viasolo AS value,nome AS label FROM colaboradores WHERE nome LIKE ? ORDER BY nome ASC LIMIT 0,10" ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

	/**
     * controle_acesso_visitantes_visitado_option_list Model Action
     * @return array
     */
	function controle_acesso_visitantes_visitado_option_list($lookup_colaboradores_id_viasolo){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT nome AS value,nome AS label FROM colaboradores WHERE id_viasolo= ? ORDER BY nome ASC" ;
		$queryparams = array($lookup_colaboradores_id_viasolo);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * motoristas_clientes_id_option_list Model Action
     * @return array
     */
	function motoristas_clientes_id_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT id AS value,nome_empresa AS label FROM clientes WHERE nome_empresa LIKE ? ORDER BY nome_empresa ASC LIMIT 0,10" ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

	/**
     * users_username_value_exist Model Action
     * @return array
     */
	function users_username_value_exist($val){
		$db = $this->GetModel();
		$db->where('username', $val);
		$exist = $db->has('users');
		return $exist;
	}

	/**
     * users_email_value_exist Model Action
     * @return array
     */
	function users_email_value_exist($val){
		$db = $this->GetModel();
		$db->where('email', $val);
		$exist = $db->has('users');
		return $exist;
	}

	/**
     * users_unidades_id_option_list Model Action
     * @return array
     */
	function users_unidades_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,nomeunidade AS label FROM unidades ORDER BY nomeunidade ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * veiculos_clientes_tipo_option_list Model Action
     * @return array
     */
	function veiculos_clientes_tipo_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT value AS value,label AS label FROM tipos_veiculos WHERE label LIKE ? ORDER BY label ASC LIMIT 0,10" ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

	/**
     * veiculos_clientes_clientes_id_option_list Model Action
     * @return array
     */
	function veiculos_clientes_clientes_id_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT id AS value,nome_empresa AS label FROM clientes WHERE nome_empresa LIKE ? ORDER BY nome_empresa ASC LIMIT 0,10" ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

	/**
     * veiculos_clientes_motoristas_id_option_list Model Action
     * @return array
     */
	function veiculos_clientes_motoristas_id_option_list($lookup_clientes_id){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,nome AS label FROM motoristas WHERE clientes_id= ? ORDER BY nome ASC" ;
		$queryparams = array($lookup_clientes_id);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * veiculos_colaboradores_colaboradores_id_viasolo_option_list Model Action
     * @return array
     */
	function veiculos_colaboradores_colaboradores_id_viasolo_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT id_viasolo AS value,nome AS label FROM colaboradores WHERE nome LIKE ? ORDER BY nome ASC LIMIT 0,10" ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

}
