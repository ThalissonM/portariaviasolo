<?php 
/**
 * Veiculos_clientes Page Controller
 * @category  Controller
 */
class Veiculos_clientesController extends SecureController{
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
		$tablename = $this->tablename = 'veiculos_clientes';
		$fields = array('id', 
			'placa', 
			'modelo', 
			'tipo', 
			'nome_motorista', 
			'nome_cliente');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		$getdata = $this->getdata; //array of sanitized values passed via $_GET;
		if(!empty($this->search)){
			$text = trim($this->search);
			$db->where("(id LIKE ? OR placa LIKE ? OR modelo LIKE ? OR tipo LIKE ? OR clientes_id LIKE ? OR motoristas_id LIKE ? OR nome_motorista LIKE ? OR nome_cliente LIKE ?)", array("%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"));
		}
		if(!empty($this->orderby)){ // when order by request fields (from $_GET param)
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('veiculos_clientes.id', ORDER_TYPE);
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
		$this->view->page_title =get_lang('veiculos_clientes');
		$this->view->render('veiculos_clientes/list.php' , $data ,'main_layout.php');
	}
	/**
     * View Record Action 
     * @return View
     */
	function view( $rec_id = null , $value = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename = 'veiculos_clientes';
		$fields = array('id', 
			'placa', 
			'modelo', 
			'tipo', 
			'clientes_id', 
			'motoristas_id', 
			'nome_motorista', 
			'nome_cliente');
		$getdata = $this->getdata; //array of sanitized values passed via $_GET;
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('veiculos_clientes.id' , $rec_id);
		}
		$record = $db->getOne($tablename, $fields );
		if(!empty($record)){
			$this->view->page_title =get_lang('vis_o');
			$this->view->render('veiculos_clientes/view.php' , $record ,'main_layout.php');
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
			$this->view->render('veiculos_clientes/view.php' , $record , 'main_layout.php');
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
			$tablename = $this->tablename = 'veiculos_clientes';
			$fields = $this->fields = array('placa','modelo','tipo','clientes_id','motoristas_id'); //insert fields
			$postdata = $this->transform_request_data($_POST);
			$this->rules_array = array(
				'placa' => 'required',
				'modelo' => 'required',
				'tipo' => 'required',
				'clientes_id' => 'required',
				'motoristas_id' => 'required',
			);
			$this->sanitize_array = array(
				'placa' => 'sanitize_string',
				'modelo' => 'sanitize_string',
				'tipo' => 'sanitize_string',
				'clientes_id' => 'sanitize_string',
				'motoristas_id' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this -> modeldata = $this->validate_form($postdata);
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
							redirect_to_page("veiculos_clientes");
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
		$this->view->render('veiculos_clientes/add.php' ,null,'main_layout.php');
	}
	/**
     * Edit Record Action 
     * If Not $_POST Request, Display Edit Record Form View
     * @return View
     */
	function edit($rec_id = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename = 'veiculos_clientes';
		$fields = $this->fields = array('id','placa','modelo','tipo','clientes_id','motoristas_id'); //editable fields
		if(is_post_request()){
			Csrf :: cross_check();
			$postdata = $this->transform_request_data($_POST);
			$this->rules_array = array(
				'placa' => 'required',
				'modelo' => 'required',
				'tipo' => 'required',
				'clientes_id' => 'required',
				'motoristas_id' => 'required',
			);
			$this->sanitize_array = array(
				'placa' => 'sanitize_string',
				'modelo' => 'sanitize_string',
				'tipo' => 'sanitize_string',
				'clientes_id' => 'sanitize_string',
				'motoristas_id' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if(empty($this->view->page_error)){
				$db->where('veiculos_clientes.id' , $rec_id);
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
							redirect_to_page("veiculos_clientes");
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
								redirect_to_page("veiculos_clientes");
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
		$db->where('veiculos_clientes.id' , $rec_id);
		$data = $db->getOne($tablename, $fields);
		$this->view->page_title =get_lang('editar_veiculos_clientes');
		if(!empty($data)){
			$this->view->render('veiculos_clientes/edit.php' , $data, 'main_layout.php');
		}
		else{
			if($db->getLastError()){
				$this->view->page_error[] = $db->getLastError();
			}
			else{
				$this->view->page_error[] = get_lang('registro_n_o_encontrado');
			}
			$this->view->render('veiculos_clientes/edit.php' , $data , 'main_layout.php');
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
		$tablename = $this->tablename = 'veiculos_clientes';
		$fields = $this->fields = array('id','placa','modelo','tipo','clientes_id','motoristas_id'); //editable fields
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
				'placa' => 'required',
				'modelo' => 'required',
				'tipo' => 'required',
				'clientes_id' => 'required',
				'motoristas_id' => 'required',
			);
			$this->sanitize_array = array(
				'placa' => 'sanitize_string',
				'modelo' => 'sanitize_string',
				'tipo' => 'sanitize_string',
				'clientes_id' => 'sanitize_string',
				'motoristas_id' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the POST Data
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if(empty($this->view->page_error)){
				$db->where('veiculos_clientes.id' , $rec_id);
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
		$tablename = $this->tablename = 'veiculos_clientes';
		//split record id separated by comma into array
		$arr_id = explode(',', $rec_ids);
		//set query conditions for all records that will be deleted
		foreach($arr_id as $rec_id){
			$db->where('veiculos_clientes.id' , $rec_id,"=",'OR');
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
			redirect_to_page("veiculos_clientes");
		}
	}
}
