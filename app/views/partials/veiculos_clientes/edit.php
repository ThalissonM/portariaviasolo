
<?php
$comp_model = new SharedController;
$current_page = get_current_url();
$csrf_token = Csrf :: $token;

$data = $this->view_data;

//$rec_id = $data['__tableprimarykey'];
$page_id = Router :: $page_id;

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
                    <h3 class="record-title"><?php print_lang('editar_ve_culo'); ?></h3>
                    
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form form-horizontal needs-validation" action="<?php print_link("veiculos_clientes/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                
                                
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="placa"><?php print_lang('placa'); ?> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <input id="ctrl-placa"  value="<?php  echo $data['placa']; ?>" type="text" placeholder="<?php print_lang('entrar_placa'); ?>"  required="" name="placa"  class="form-control " />
                                                    
                                                    
                                                    
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="modelo"><?php print_lang('modelo'); ?> <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input id="ctrl-modelo"  value="<?php  echo $data['modelo']; ?>" type="text" placeholder="<?php print_lang('entrar_modelo'); ?>"  required="" name="modelo"  class="form-control " />
                                                        
                                                        
                                                        
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="tipo"><?php print_lang('tipo'); ?> <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        
                                                        <select required="" data-endpoint="<?php print_link('api/json/veiculos_clientes_tipo_option_list') ?>" id="ctrl-tipo" name="tipo"  placeholder="<?php print_lang('selecione_um_valor_'); ?>"    class="selectize-ajax" >
                                                            
                                                            <option value=""><?php print_lang('selecione_um_valor_'); ?></option>
                                                            
                                                            
                                                        </select>
                                                        
                                                        
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="clientes_id"><?php print_lang('cliente_ou_transportadora'); ?> <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        
                                                        <select required="" data-endpoint="<?php print_link('api/json/veiculos_clientes_clientes_id_option_list') ?>" id="ctrl-clientes_id" data-load-select-options="motoristas_id" name="clientes_id"  placeholder="<?php print_lang('selecione_um_valor_'); ?>"    class="selectize-ajax" >
                                                            
                                                            <option value=""><?php print_lang('selecione_um_valor_'); ?></option>
                                                            
                                                            
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
                                                        
                                                        <select required=""  id="ctrl-motoristas_id" data-load-path="<?php print_link('api/json/veiculos_clientes_motoristas_id_option_list') ?>" name="motoristas_id"  placeholder="<?php print_lang('selecione_um_valor_'); ?>"    class="selectize" >
                                                            
                                                            <?php
                                                            $rec = $data['motoristas_id'];
                                                            $motoristas_id_options = $comp_model -> veiculos_clientes_motoristas_id_option_list($data['clientes_id']);
                                                            if(!empty($motoristas_id_options)){
                                                            foreach($motoristas_id_options as $option){
                                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                                            $selected = ( $value == $rec ? 'selected' : null );
                                                            ?>
                                                            <option 
                                                                <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
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
                                    <div class="form-ajax-status"></div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary" type="submit">
                                            <?php print_lang('atualizar'); ?>
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
        