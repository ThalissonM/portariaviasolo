<?php 
/**
 * Controle_acesso_caminhoes Page Controller
 * @category  Controller
 */
class Controle_acesso_caminhoesController extends SecureController{
	/**
     * Load Record Action 
     * $arg1 Field Name
     * $arg2 Field Value 
     * $param $arg1 string
     * $param $arg1 string
     * @return View
     */
	function index($fieldname = null , $fieldvalue = null){
		$db = $this->GetModel();
		$tablename = $this->tablename = 'controle_acesso_caminhoes';
		$fields = array('id', 
			'cliente', 
			'nome_cliente_real', 
			'motorista', 
			'placa', 
			'entrada', 
			'saida', 
			'users_id', 
			'nome_responsavel_entrada', 
			'users_id1', 
			'nome_responsavel_saida');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		$getdata = $this->getdata; //array of sanitized values passed via $_GET;
if (!empty($this->search)) {
		 	$text = trim($this->search);
	
		 	// Check if $this->search contains two dates in the format 'd/m/Y-d/m/Y'
		 	$dateRange = explode('-', $text);
		 	if (count($dateRange) === 2) {
				$limit = $this->get_page_limit(30000); 
		 		
		 	}

		}
/*		if(!empty($this->search)){
			$text = trim($this->search);
			$db->where("(id LIKE ? OR clientes_id LIKE ? OR cliente LIKE ? OR nome_cliente_real LIKE ? OR motorista LIKE ? OR placa LIKE ? OR entrada LIKE ? OR saida LIKE ? OR cliente_permitido LIKE ? OR motorista_permitido LIKE ? OR users_id LIKE ? OR nome_responsavel_entrada LIKE ? OR users_id1 LIKE ? OR nome_responsavel_saida LIKE ? OR motoristas_id LIKE ? OR id_cliente_real LIKE ?)", array("%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"));
		}*/
if (!empty($this->search)) {
			$text = trim($this->search);
		
			// Check if $this->search contains two dates in the format 'd/m/Y-d/m/Y'
			$dateRange = explode('-', $text);
			if (count($dateRange) === 2) {
				$startDate = DateTime::createFromFormat('d/m/Y', trim($dateRange[0]));
				$endDate = DateTime::createFromFormat('d/m/Y', trim($dateRange[1]));
		
				if ($startDate && $endDate) {
					// Format the dates for the database (Y-m-d H:i:s)
					$formattedStartDate = $startDate->format('Y-m-d 00:00:00');
					$formattedEndDate = $endDate->format('Y-m-d 23:59:59');
		
					// Add the date range condition to the query's WHERE clause
					$db->where("(entrada BETWEEN ? AND ? OR saida BETWEEN ? AND ?)", array($formattedStartDate, $formattedEndDate, $formattedStartDate, $formattedEndDate));
		
					// Remove the date portion from the search text, so other conditions can still apply if needed
					$text = trim($dateRange[0] . ' ' . $dateRange[1]);
				}
			} else {
				// If it's not a date range, continue with the regular search conditions
				$db->where("(id LIKE ? OR clientes_id LIKE ? OR cliente LIKE ? OR nome_cliente_real LIKE ? OR motorista LIKE ? OR placa LIKE ? OR entrada LIKE ? OR saida LIKE ? OR cliente_permitido LIKE ? OR motorista_permitido LIKE ? OR users_id LIKE ? OR nome_responsavel_entrada LIKE ? OR users_id1 LIKE ? OR nome_responsavel_saida LIKE ? OR motoristas_id LIKE ? OR id_cliente_real LIKE ?)", array("%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"));
			}
		}
		if(!empty($this->orderby)){ // when order by request fields (from $_GET param)
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('controle_acesso_caminhoes.id', ORDER_TYPE);
		}
		if( !empty($fieldname) ){
			$db->where($fieldname , $fieldvalue);
		}
		//page filter command
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $limit, $fields);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = count($records);
		$data->total_records = intval($tc->totalCount);
		if($db->getLastError()){
			$page_error = $db->getLastError();
			$this->view->page_error = $page_error;
		}
		$this->view->page_title =get_lang('controle_acesso_caminh_es');
		$this->view->render('controle_acesso_caminhoes/list.php' , $data ,'main_layout.php');
	}
	/**
     * View Record Action 
     * @return View
     */
	function view( $rec_id = null , $value = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename = 'controle_acesso_caminhoes';
		$fields = array('id', 
			'id_cliente_real', 
			'nome_cliente_real', 
			'clientes_id', 
			'cliente', 
			'placa', 
			'entrada', 
			'saida', 
			'motoristas_id', 
			'motorista', 
			'cliente_permitido', 
			'motorista_permitido', 
			'users_id', 
			'nome_responsavel_entrada', 
			'users_id1', 
			'nome_responsavel_saida');
		$getdata = $this->getdata; //array of sanitized values passed via $_GET;
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('controle_acesso_caminhoes.id' , $rec_id);
		}
		$record = $db->getOne($tablename, $fields );
		if(!empty($record)){
			$record['entrada'] = format_date($record['entrada'],'d/m/Y H:i');
$record['saida'] = format_date($record['saida'],'d/m/Y H:i');
			$this->view->page_title =get_lang('vis_o');
			$this->view->render('controle_acesso_caminhoes/view.php' , $record ,'main_layout.php');
		}
		else{
			$page_error = null;
			if($db->getLastError()){
				$page_error = $db->getLastError();
			}
			else{
				$page_error = get_lang('registro_n_o_encontrado');
			}
			$this->view->page_error = $page_error;
			$this->view->render('controle_acesso_caminhoes/view.php' , $record , 'main_layout.php');
		}
	}
	/**
     * Add New Record Action 
     * If Not $_POST Request, Display Add Record Form View
     * @return View
     */
	function add(){
		if(is_post_request()){
			Csrf :: cross_check();
			$db = $this->GetModel();
			$tablename = $this->tablename = 'controle_acesso_caminhoes';
			$fields = $this->fields = array('id_cliente_real','clientes_id','motoristas_id','placa','entrada','cliente_permitido','motorista_permitido','users_id','nome_responsavel_entrada'); //insert fields
			$postdata = $this->transform_request_data($_POST);
			$this->rules_array = array(
				'id_cliente_real' => 'required',
				'clientes_id' => 'required',
				'motoristas_id' => 'required',
				'placa' => 'required',
				'entrada' => 'required',
				'cliente_permitido' => 'required',
				'motorista_permitido' => 'required',
			);
			$this->sanitize_array = array(
				'id_cliente_real' => 'sanitize_string',
				'clientes_id' => 'sanitize_string',
				'motoristas_id' => 'sanitize_string',
				'placa' => 'sanitize_string',
				'entrada' => 'sanitize_string',
				'cliente_permitido' => 'sanitize_string',
				'motorista_permitido' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this -> modeldata = $this->validate_form($postdata);
			$modeldata['users_id']=USER_ID;
$modeldata['nome_responsavel_entrada']=USER_NAME;
			if(empty($this->view->page_error)){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if(!empty($rec_id)){
					if(is_ajax()){
						render_json(get_lang('registro_adicionado_com_sucesso'));
					}
					else{
						set_flash_msg(get_lang('registro_adicionado_com_sucesso'),'success');
						if(!empty($this->redirect)){ 
							redirect_to_page($this->redirect); //if redirect url is passed via $_GET
						}
						else{
							redirect_to_page("controle_acesso_caminhoes");
						}
					}
					return;
				}
				else{
					$page_error = null;
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					else{
						$page_error = get_lang('erro_ao_inserir_registro');
					}
					if(is_ajax()){
						render_error($page_error); 
						return;
					}
					else{
						$this->view->page_error[] = $page_error;
					}
				}
			}
		}
		$this->view->page_title =get_lang('adicionar_novo');
		$this->view->render('controle_acesso_caminhoes/add.php' ,null,'main_layout.php');
	}
	/**
     * Edit Record Action 
     * If Not $_POST Request, Display Edit Record Form View
     * @return View
     */
	function edit($rec_id = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename = 'controle_acesso_caminhoes';
		$fields = $this->fields = array('id','id_cliente_real','clientes_id','motoristas_id','placa','entrada','saida','cliente_permitido','motorista_permitido'); //editable fields
		if(is_post_request()){
			Csrf :: cross_check();
			$postdata = $this->transform_request_data($_POST);
			$this->rules_array = array(
				'id_cliente_real' => 'required',
				'clientes_id' => 'required',
				'motoristas_id' => 'required',
				'placa' => 'required',
				'entrada' => 'required',
				'cliente_permitido' => 'required',
				'motorista_permitido' => 'required',
			);
			$this->sanitize_array = array(
				'id_cliente_real' => 'sanitize_string',
				'clientes_id' => 'sanitize_string',
				'motoristas_id' => 'sanitize_string',
				'placa' => 'sanitize_string',
				'entrada' => 'sanitize_string',
				'saida' => 'sanitize_string',
				'cliente_permitido' => 'sanitize_string',
				'motorista_permitido' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if(empty($this->view->page_error)){
				$db->where('controle_acesso_caminhoes.id' , $rec_id);
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					if(is_ajax()){
						render_json(get_lang('registro_atualizado_com_sucesso'));
					}
					else{
						set_flash_msg(get_lang('registro_atualizado_com_sucesso'),'success');
						if(!empty($this->redirect)){ 
							redirect_to_page($this->redirect); //if redirect url is passed via $_GET
						}
						else{
							redirect_to_page("controle_acesso_caminhoes");
						}
					}
					return;
				}
				else{
					$page_error = null;
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = get_lang('nenhum_registro_atualizado');
						if(is_ajax()){
							render_error($page_error); //return http status error
						}
						else{
							//no changes made to the table record
							set_flash_msg($page_error, 'warning');
							if(!empty($this->redirect)){ 
								redirect_to_page($this->redirect); //if redirect url is passed via $_GET
							}
							else{
								redirect_to_page("controle_acesso_caminhoes");
							}
						}
						return;
					}
					else{
						$page_error = get_lang('registro_n_o_encontrado');
					}
					if(is_ajax()){
						render_error($page_error); //return http status error
						return;
					}
					//continue to display edit page with errors
					$this->view->page_error[] = $page_error;
				}
			}
		}
		$db->where('controle_acesso_caminhoes.id' , $rec_id);
		$data = $db->getOne($tablename, $fields);
		$this->view->page_title =get_lang('editar_controle_acesso_caminhoes');
		if(!empty($data)){
			$this->view->render('controle_acesso_caminhoes/edit.php' , $data, 'main_layout.php');
		}
		else{
			if($db->getLastError()){
				$this->view->page_error[] = $db->getLastError();
			}
			else{
				$this->view->page_error[] = get_lang('registro_n_o_encontrado');
			}
			$this->view->render('controle_acesso_caminhoes/edit.php' , $data , 'main_layout.php');
		}
	}
	/**
     * Edit single field Action 
     * Return record id
     * @return View
     */
	function editfield($rec_id = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename = 'controle_acesso_caminhoes';
		$fields = $this->fields = array('id','id_cliente_real','clientes_id','motoristas_id','placa','entrada','saida','cliente_permitido','motorista_permitido'); //editable fields
		if(is_post_request()){
			Csrf :: cross_check();
			$postdata = array();
			if(isset($_POST['name']) && isset($_POST['value'])){
				$fieldname = $_POST['name'];
				$fieldvalue = $_POST['value'];
				$postdata[$fieldname] = $fieldvalue;
				$postdata = $this->transform_request_data($postdata);
			}
			else{
				$this->view->page_error = "invalid post data";
			}
			$this->rules_array = array(
				'id_cliente_real' => 'required',
				'clientes_id' => 'required',
				'motoristas_id' => 'required',
				'placa' => 'required',
				'entrada' => 'required',
				'cliente_permitido' => 'required',
				'motorista_permitido' => 'required',
			);
			$this->sanitize_array = array(
				'id_cliente_real' => 'sanitize_string',
				'clientes_id' => 'sanitize_string',
				'motoristas_id' => 'sanitize_string',
				'placa' => 'sanitize_string',
				'entrada' => 'sanitize_string',
				'saida' => 'sanitize_string',
				'cliente_permitido' => 'sanitize_string',
				'motorista_permitido' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the POST Data
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if(empty($this->view->page_error)){
				$db->where('controle_acesso_caminhoes.id' , $rec_id);
				try{
					$bool = $db->update($tablename, $modeldata);
					$numRows = $db->getRowCount();
					if($bool && $numRows){
						render_json(
							array(
								'num_rows' =>$numRows,
								'rec_id' =>$rec_id,
							)
						);
					}
					else{
						$page_error = null;
						if($db->getLastError()){
							$page_error = $db->getLastError();
						}
						elseif(!$numRows){
							$page_error = get_lang('nenhum_registro_atualizado');
						}
						else{
							$page_error = get_lang('registro_n_o_encontrado');
						}
						render_error($page_error);
					}
				}
				catch(Exception $e){
					render_error($e->getMessage());
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		else{
			render_error("Request type not accepted");
		}
	}
	/**
     * Delete Record Action 
     * @return View
     */
	function delete( $rec_ids = null ){
		Csrf :: cross_check();
		$db = $this->GetModel();
		$this->rec_id = $rec_ids;
		$tablename = $this->tablename = 'controle_acesso_caminhoes';
		//split record id separated by comma into array
		$arr_id = explode(',', $rec_ids);
		//set query conditions for all records that will be deleted
		foreach($arr_id as $rec_id){
			$db->where('controle_acesso_caminhoes.id' , $rec_id,"=",'OR');
		}
		$bool = $db->delete($tablename);
		if($bool){
			set_flash_msg(get_lang('registro_exclu_do_com_sucesso'),'success');
		}
		else{
			$page_error = "";
			if($db->getLastError()){
				$page_error = $db->getLastError();
			}
			else{
				$page_error = get_lang('erro_ao_excluir_o_registro_por_favor_certifique_se_de_que_a_sa_da_de_registro');
			}
			set_flash_msg($page_error,'danger');
		}
		if(!empty($this->redirect)){ 
			redirect_to_page($this->redirect); //if redirect url is passed via $_GET
		}
		else{
			redirect_to_page("controle_acesso_caminhoes");
		}
	}
}