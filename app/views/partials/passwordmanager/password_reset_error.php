<div class="container">
	<h3><?php print_lang('gerenciador_de_redefini_o_de_senha'); ?></h3>
	
	<div class="card card-body mt-4 animated bounce">
		<h3 class="text-danger bold"><?php print_lang('sua_redefini_o_de_senha_n_o_foi_conclu_da'); ?></h3>
		<div class="text-muted"><?php print_lang('falha_na_chave_de_redefini_o_de_senha'); ?></div>
		<hr />
		<div class="text-success">
			<?php print_lang('por_favor_voc_pode_tentar_redefinir_sua_senha_seguindo_estes_passos'); ?>
			<br />
			<br />
			<a href="<?php print_link("passwordmanager/") ?>" class="btn btn-primary"><?php print_lang('redefinir_senha'); ?></a>
			
			<a href="<?php print_link(""); ?>" class="btn btn-info"><?php print_lang('clique_aqui_para_logar'); ?></a>
		</div>
	</div>
</div>
