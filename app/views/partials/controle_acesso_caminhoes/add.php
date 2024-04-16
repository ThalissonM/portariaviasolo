
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
                
                <div class="col-12 ">
                    <h3 class="record-title"><?php print_lang('adicionar_novo'); ?></h3>
                    
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
                        <form id="controle_acesso_caminhoes-add-form" role="form" novalidate enctype="multipart/form-data" class="form form-horizontal needs-validation" action="<?php print_link("controle_acesso_caminhoes/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                
                                
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="id_cliente_real"><?php print_lang('cliente'); ?> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                
                                                <select required="" data-endpoint="<?php print_link('api/json/controle_acesso_caminhoes_id_cliente_real_option_list') ?>" id="ctrl-id_cliente_real" data-load-select-options="cliente_permitido" name="id_cliente_real"  placeholder="<?php print_lang('selecione_um_valor_'); ?>"    class="selectize-ajax" >
                                                    <option value=""><?php print_lang('selecione_um_valor_'); ?></option>
                                                    
                                                </select>
                                                
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="clientes_id"><?php print_lang('transportadora'); ?> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                
                                                <select required=""  id="ctrl-clientes_id" data-load-select-options="motoristas_id,placa" name="clientes_id"  placeholder="<?php print_lang('selecione_um_valor_'); ?>"    class="selectize" >
                                                    <option value=""><?php print_lang('selecione_um_valor_'); ?></option>
                                                    
                                                    <?php 
                                                    $clientes_id_options = $comp_model -> controle_acesso_caminhoes_clientes_id_option_list();
                                                    if(!empty($clientes_id_options)){
                                                    foreach($clientes_id_options as $option){
                                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                                    $selected = $this->set_field_selected('clientes_id',$value, '');
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
                                
                                
                                
                                
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="motoristas_id"><?php print_lang('motorista'); ?> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                
                                                <select required=""  id="ctrl-motoristas_id" data-load-path="<?php print_link('api/json/controle_acesso_caminhoes_motoristas_id_option_list') ?>" data-load-select-options="motorista_permitido" name="motoristas_id"  placeholder="<?php print_lang('selecione_um_valor_'); ?>"    class="selectize" >
                                                    <option value=""><?php print_lang('selecione_um_valor_'); ?></option>
                                                    
                                                </select>
                                                
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="placa"><?php print_lang('placa'); ?> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                
                                                <select required=""  id="ctrl-placa" data-load-path="<?php print_link('api/json/controle_acesso_caminhoes_placa_option_list') ?>" name="placa"  placeholder="<?php print_lang('selecione_um_valor_'); ?>"    class="selectize" >
                                                    <option value=""><?php print_lang('selecione_um_valor_'); ?></option>
                                                    
                                                </select>
                                                
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="entrada"><?php print_lang('entrada'); ?> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                
                                                <input id="ctrl-entrada" class="form-control datepicker  datepicker" required="" value="<?php  echo $this->set_field_value('entrada',datetime_now()); ?>" type="datetime"  name="entrada" placeholder="<?php print_lang('entrar_entrada'); ?>" data-enable-time="true" data-min-date="" data-max-date="" data-date-format="Y-m-d H:i:S" data-alt-format="d/m/Y H:i" data-inline="false" data-no-calendar="false" data-mode="single" /> 
                                                    
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                                    </div>
                                                    
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="cliente_permitido"><?php print_lang('cliente_permitido'); ?> <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    
                                                    <select required=""  id="ctrl-cliente_permitido" data-load-path="<?php print_link('api/json/controle_acesso_caminhoes_cliente_permitido_option_list') ?>" name="cliente_permitido"  placeholder="<?php print_lang('selecione_um_valor_'); ?>"    class="custom-select" >
                                                        <option value=""><?php print_lang('selecione_um_valor_'); ?></option>
                                                        
                                                    </select>
                                                    
                                                    
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="motorista_permitido"><?php print_lang('motorista_permitido'); ?> <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    
                                                    <select required=""  id="ctrl-motorista_permitido" data-load-path="<?php print_link('api/json/controle_acesso_caminhoes_motorista_permitido_option_list') ?>" name="motorista_permitido"  placeholder="<?php print_lang('selecione_um_valor_'); ?>"    class="custom-select" >
                                                        <option value=""><?php print_lang('selecione_um_valor_'); ?></option>
                                                        
                                                    </select>
                                                    
                                                    
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                </div>
                                <div class="form-group form-submit-btn-holder text-center">
                                    <div class="form-ajax-status"></div>
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
    