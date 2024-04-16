
<?php
	$comp_model = new SharedController;
	$current_page = get_current_url();
	$csrf_token = Csrf :: $token;
	
	$show_header = $this->show_header;
	$view_title = $this->view_title;
	$redirect_to = $this->redirect_to;

?>

	<section class="page">
		
<?php
	if( $show_header == true ){
?>

		<div  class="bg-light p-3 mb-3">
			<div class="container">
				
				<div class="row ">
					
		<div class="col-sm-6 ">
			<h3 class="record-title"><?php print_lang('registro_do_usu_rio'); ?></h3>

		</div>

		<div class="col-sm-6 comp-grid">
			<div class="">
	<div class="text-center">
		<?php print_lang('j_tem_uma_conta_'); ?>  <a class="btn btn-primary" href="<?php print_link('') ?>"> <?php print_lang('entrar'); ?></a>
	</div>
</div>
		</div>

				</div>
			</div>
		</div>

<?php
	}
?>

		<div  class="">
			<div class="container">
				
				<div class="row ">
					
		<div class="col-md-7 comp-grid">
			
	<?php $this :: display_page_errors(); ?>
	
	<div  class=" animated fadeIn">
		<form id="users-userregister-form" role="form" novalidate enctype="multipart/form-data" class="form form-horizontal needs-validation" action="<?php print_link("index/register?csrf_token=$csrf_token") ?>" method="post">
		<div>
		
								
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="username"><?php print_lang('username'); ?> <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												<input id="ctrl-username"  value="<?php  echo $this->set_field_value('username',''); ?>" type="text" placeholder="<?php print_lang('entrar_username'); ?>"  required="" name="username"  data-url="api/json/users_username_value_exist/" data-loading-msg="<?php print_lang('checando_disponibilidade_'); ?>" data-available-msg="<?php print_lang('dispon_vel'); ?>" data-unavailable-msg="<?php print_lang('n_o_dispon_vel'); ?>" class="form-control  ctrl-check-duplicate" />
									 
<div class="check-status"></div> 
												
											</div>
											 
											
										</div>
									</div>
								</div>
				
				

								
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="password"><?php print_lang('password'); ?> <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												<input id="ctrl-password"  value="<?php  echo $this->set_field_value('password',''); ?>" type="password" placeholder="<?php print_lang('entrar_password'); ?>"  required="" name="password"  class="form-control " />
									 
 
												
											</div>
											 
											
										</div>
									</div>
								</div>
				
				
								
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="confirm_password"><?php print_lang('confirm_password'); ?> <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												
<input id="-confirm"  class="form-control " type="password" name="confirm_password" required placeholder="<?php print_lang('confirm_password'); ?>" />
 
												
											</div>
											 
											
										</div>
									</div>
								</div>
				
				

								
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="email"><?php print_lang('email'); ?> <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												<input id="ctrl-email"  value="<?php  echo $this->set_field_value('email',''); ?>" type="email" placeholder="<?php print_lang('entrar_email'); ?>"  required="" name="email"  data-url="api/json/users_email_value_exist/" data-loading-msg="<?php print_lang('checando_disponibilidade_'); ?>" data-available-msg="<?php print_lang('dispon_vel'); ?>" data-unavailable-msg="<?php print_lang('n_o_dispon_vel'); ?>" class="form-control  ctrl-check-duplicate" />
									 
<div class="check-status"></div> 
												
											</div>
											 
											
										</div>
									</div>
								</div>
				
				

								
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="id_viasolo"><?php print_lang('id_viasolo'); ?> <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												<input id="ctrl-id_viasolo"  value="<?php  echo $this->set_field_value('id_viasolo',''); ?>" type="text" placeholder="<?php print_lang('entrar_id_viasolo'); ?>"  required="" name="id_viasolo"  class="form-control " />
									 
 
												
											</div>
											 
											
										</div>
									</div>
								</div>
				
				

								
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="unidades_id"><?php print_lang('unidades_id'); ?> <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												
	<select required=""  id="ctrl-unidades_id" name="unidades_id"  placeholder="<?php print_lang('selecione_um_valor_'); ?>"    class="custom-select" >
			<option value=""><?php print_lang('selecione_um_valor_'); ?></option>
			
	<?php 
		$unidades_id_options = $comp_model -> users_unidades_id_option_list();
		if(!empty($unidades_id_options)){
			foreach($unidades_id_options as $option){
				$value = (!empty($option['value']) ? $option['value'] : null);
                $label = (!empty($option['label']) ? $option['label'] : $value);
				$selected = $this->set_field_selected('unidades_id',$value, '');
				?>
				<option <?php echo $selected; ?> value="<?php echo $value; ?>">
					<?php echo $label; ?>
				</option>
				<?php
			}
		}
	?>
			
	</select>
 
												
											</div>
											 
											
										</div>
									</div>
								</div>
				
				


		</div>
		<div class="form-group form-submit-btn-holder text-center">
			<button class="btn btn-primary" type="submit">
				<?php print_lang('enviar'); ?>
				<i class="material-icons">send</i>
			</button>
		</div>
	</form>
	</div>

		</div>

				</div>
			</div>
		</div>

	</section>
