<?php 
class PasswordmanagerController extends BaseController{
	function index(){
		$this->view->render('passwordmanager/index.php',null,"info_layout.php");
	}
	function postresetlink(){
		$page=null;
		if(!empty($_POST['email'])){
			$email = $_POST["email"];
			$db = $this->GetModel();
			//get user by email
			$db->where ('email', $email);
			$user = $db->getOne('users');
			if(!empty($user)){
				$password_reset_key=random_str();
				$user_id = $user['id'];
				//Update user password reset key with new one
				$db->where ('id', $user_id);
				$db->update( 'users', array("password_reset_key"=>$password_reset_key) );
				$reset_link = SITE_ADDR."Passwordmanager/updatepassword/$password_reset_key";
				$sitename = SITE_NAME;
				$user_name = $user['username'];
				$mailtitle = "$sitename password reset";
				//Password reset html template
				$mailbody = file_get_contents(PAGES_DIR . "passwordmanager/password_reset_email_template.html");
				$mailbody = str_ireplace("{{username}}", $user_name, $mailbody);
				$mailbody = str_ireplace("{{link}}" , $reset_link,$mailbody);
				$mailbody = str_ireplace("{{sitename}}" , $sitename,$mailbody);
				$mailer = new Mailer;
				if($mailer->send_mail($email,$mailtitle,$mailbody) == true){
					$this->view->render('passwordmanager/password_reset_link_sent.php', $mailbody,"info_layout.php");
				}
				else{
					$msg = get_lang('erro_ao_enviar_email_entre_em_contato_com_o_administrador_do_sistema_para_mais_informa_es');
					$this->view->render('errors/error_general.php',$msg,"info_layout.php");
				}
			}
			else{
				$this->view->page_error = get_lang('o_endere_o_de_email_n_o_est_registrado_no_sistema');
				$this->view->render('passwordmanager/index.php',null,"info_layout.php");
			}
		}
		else{
			redirect_to_page("PasswordManager");
		}
	}
	function updatepassword($password_key=null){
		session_destroy();
		if(!empty($_POST['password'])){
			$password=$_POST["password"];
			$cpassword = $_POST["cpassword"];
			if($password == $cpassword){
				$db = $this->GetModel();
				$new_password_reset_key = random_str();
				$new_password_hash = password_hash($password , PASSWORD_DEFAULT);
				$new_password_data = array(
					"password" => $new_password_hash,
					"password_reset_key" => $new_password_reset_key
				);
				$db->where ("password_reset_key", $password_key);
				$db->update('users',$new_password_data);
				if($db->getRowCount()){
					$this->view->render('passwordmanager/password_reset_completed.php',null,"info_layout.php");
				}
				else{
					$this->view->render('passwordmanager/password_reset_error.php',null,"info_layout.php");
				}
			}
			else{
				$this->view->page_error = get_lang('sua_confirma_o_de_senha_n_o_consistente');
				$this->view->render('passwordmanager/password_reset_form.php',null,"info_layout.php");
			}
		}
		else{
			$this->view->render('passwordmanager/password_reset_form.php',null,"info_layout.php");
		}
	}
}
