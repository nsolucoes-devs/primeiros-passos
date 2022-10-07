<?php if(isset($relacionados)){
    foreach($relacionados as $p){ ?>
    <div class="item">
        <a href="<?php echo base_url('71b141ddd8292dea8bb362092fd5661f/'). $p['produto_id'] ?>">
            <div class="card zoom" style="height: 320px;">
                <div class="card-body" style="padding: 2px;">
                    <img style="display:block; height: 180px;width: 250px;" src="<?php echo base_url('imagens/produtos/').$p['produto_id'] .'.jpg'; ?>" alt="">
                    <div class="col-md-12 text-center">
                        <div class="estrelas" style="color: gold!important; padding-top: 3%">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <p style="color: lightgrey; font-size: 13px; line-height: 12px; margin: 0; padding: 0"><b><?php echo ucfirst(mb_strtolower($p['produto_departamento'])) ?></b></p>
                    </div>
                    <p class="produto-titulo"><b><?php echo ucfirst(mb_strtolower($p['produto_nome'])) ?></b></p>
                    <div class="row" style="height: 5px; background-color: var(--base-color); position: absolute;bottom: 0;left: 15px; width: 100%">
                    </div>
                </div>
            </div>
        </a>
    </div>
<?php }
    }?>