<div class="container">
	<div>
		<h3><?php print_lang('gerenciador_de_redefini_o_de_senha'); ?></h3>
		<small class="text-muted">
			<?php print_lang('por_favor_forne_a_o_endere_o_de_e_mail_v_lido_que_voc_usou_para_se_registrar'); ?>
		</small>
	</div>
	<hr />
	<div class="row">
		<div class="col-md-8">
			<?php 
				$this :: display_page_errors(); 
			?>
			<form method="post" action="<?php print_link("passwordmanager/postresetlink"); ?>">
				<div class="row">
					<div class="col-9">
						<input value="<?php echo get_form_field_value('email'); ?>" placeholder="Enter Your Email Address" required="required" class="form-control default" name="email" type="email" />
					</div>
					<div class="col-3">
						<button class="btn btn-success" type="submit"> <?php print_lang('enviar'); ?> <i class="material-icons">email</i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<br />
	<div class="text-info">
		<?php print_lang('um_link_ser_enviado_para_o_seu_e_mail_contendo_as_informa_es_necess_rias_para_sua_senha'); ?>
	</div>
</div>




