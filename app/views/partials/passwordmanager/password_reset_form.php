<div class="container">
	<h3><?php print_lang('gerenciador_de_redefini_o_de_senha'); ?></h3>
	<hr />
	<div class="row">
		<div class="col-sm-6">
			<form method="post" action="<?php print_link(get_current_url()); ?>">
				<?php 
					$this :: display_page_errors();			
				?>
				<div class="form-group">
					<label><?php print_lang('nova_senha'); ?></label>
					<input placeholder="Your New Password" required value="" class="form-control default" name="password" id="txtpass" type="password" />
					<strong class="help-block"><?php print_lang('dicas_n_o_menos_de_6_caracteres'); ?> </strong>
				</div>
				<div class="form-group">
					<label><?php print_lang('confirme_a_nova_senha'); ?></label>
					<input placeholder="Confirm Password" required class="form-control default" name="cpassword" id="txtcpass" type="password" />
				</div>
				<div class="mt-2 "><button  class="btn btn-success" type="submit"><?php print_lang('mudar_senha'); ?></button></div>
			</form>
		</div>
	</div>
</div>
