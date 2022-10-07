    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <?php
        $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
        $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
        $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
        $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
        if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
            $mobile_view = 1;
        } else {
            $mobile_view = 0;
        }
    ?>
    
    <style>
        path[fill='#123456']{display:none !important;}
        .select2{
            width:100%!important;
        }
        
        .c-card{
            box-shadow: 0 1px 4px 0 rgb(0 0 0 / 14%);
            border: 0;
            margin-bottom: 30px;
            margin-top: 30px;
            border-radius: 6px;
            color: #333333;
            background: #fff;
            width: 100%;
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
        }
        
        .c-card-header{
            text-align: right;
            margin: 0px 15px 0;
            padding: 0;
            position: relative;
            z-index: 3 !important;
            color: #fff;
            border-bottom: none;
            background: transparent;
            border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
            padding-bottom: 15px;
        }
        
        .c-card-icon{
            border-radius: 50px;
            background-color: #999999;
            padding: 20px;
            margin-top: -20px;
            margin-right: 15px;
            float: left;
        }
        
        .c-card-icon2{
            border-radius: 0px;
            background-color: #999999;
            padding: 20px;
            margin-top: -20px;
            margin-right: 15px;
            float: left;
        }
        
        
        
        .c-aprovados{
            box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(76 175 80 / 40%);
            background: linear-gradient(60deg, #66bb6a, #43a047);
        }
        
        .c-negadas{
            box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(244 67 54 / 40%);
            background: linear-gradient(60deg, #ef5350, #e53935);
        }
        
        .c-analise{
            box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(255 152 0 / 40%);
            background: linear-gradient(60deg, #ffa726, #fb8c00);
        }
        
        .c-analise{
            box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(255 152 0 / 40%);
            background: linear-gradient(60deg, #ffa726, #fb8c00);
        }
        .c-inscritos{
            box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(255 152 0 / 40%);
            background: linear-gradient(60deg, #4ac6e2, #4d8ed2);
        }
        
        .c-titulos{
            box-shadow: 0 4px 20px 0 rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(0 188 212 / 40%);
                background: linear-gradient(60deg, #26c6da, #00acc1);
        }
        
        .c-tabela{
            box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(156 39 176 / 40%);
           
        }
        
        .c-icon{
            font-size: 33px;
            line-height: 40px;
            width: 40px;
            height: 40px;
            text-align: center;
        }
        
        .c-card-category{
            color: black;
            font-size: 14px;
            margin: 0;
            padding-top: 10px;
            font-weight: bold;
        }
        
        .c-card-title{
            margin: 0;
            color: #3C4858;
            font-size: 1.5625rem;
            line-height: 1.4em;
        }
        
        .c-card-title small{
            font-size: 80%;
            font-weight: 400;
        }
        
        .c-card-footer{
            border-top: 1px solid #d6d5d5;
            margin-top: 20px;
            padding: 0;
            padding-top: 10px;
            margin: 0 15px 10px;
            border-radius: 0;
            justify-content: flex-end;
            align-items: center;
            display: flex;
            background-color: transparent;
        }
        
        .c-card-body{
            border-top: 1px solid #d6d5d5;
            padding: 0.9375rem 20px;
            border-radius: 0;
            display: flex;
            background-color: transparent;
        }
        
        .bordeless{
            border-top: 0!important;
        }
        
        .c-stats{
            color: #999999;
            font-size: 12px;
            line-height: 22px;
            display: inline-flex;
        }
        
        .c-stats-icon{
            position: relative;
            top: 4px;
            font-size: 16px;
            margin-right: 3px;
            margin-left: 3px;
            color: grey;
        }
        
        .c-stats-text{
            color: grey;
        }
        
        .c-table{
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }
        
        .c-table thead{
            color:  #1b9045!important;
        }
        
        .c-table thead tr th{
            padding: 8px;
            vertical-align: middle;
        }
        
        .c-table tbody tr td {
            padding: 8px;
            vertical-align: middle;
            border-top: 1px solid #ddd;
        }
        
        .c-table tbody tr:hover{
            cursor: pointer;
            background-color: #eee!important;
        }
        
        .check-all{
            width: 32px;
            font-size: 12px;
            color: white;
            border: 0;
            padding: 6px 10px;
            text-align: center;
            border-radius: 5px;
        }
        
        .button-area{
            margin-top: 20px;
        }
        
        .button-custom{
            color: white;
            background-color:  #1b9045;
            border: 0;
            font-size: 14px;
            padding: 6px 10px;
            text-align: center;
            border-radius: 5px;
        }
        
        .search{
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        
        .form-control-custom{
            border-radius: 5px;
            border: 1px solid #80808061;
            padding: 5px;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            margin-right: -4px;
            height: 32px;
            width: 165px;
            color: black;
        }
        
        .form-control-custom:focus {
            outline: unset;
            border: 2px solid #43006d;
            color: #43006d;
        }
        
        .search-field{
            box-shadow: 0 4px 20px 0px rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(0 0 0 / 40%);
            display: inline-flex;
            border-radius: 5px;
        }
        
        .def-item{
            display: block;
            padding: 7px 10px;
            color: black;
            font-size: 14px;
        }
        
        .def-item:hover{
            background-color: #eee;
            color: #9c27b0;
        }
        
           
        .check1{
            min-width: 20px;
            min-height: 20px;
        }
        
        .check2{
            min-width: 20px;
            min-height: 20px;
        }
        .active{
            background-color: black!important;
            border-color: black!important;
        }
        
    </style>
    
    
    <section id="main-content">
        <section class="wrapper">

            
            <!-- COMEÇO DO NOVO DASHBOARD -->
            
            <div class="row" style="margin: 0">
                
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Loja</label>
                        <select class="form-control" id="loja_id" onchange="diasDash(false)">
                            <option value="all">Todas</option>
                            <?php $aux = 0;
                            foreach($lojas as $loja){  ?>
                             <option value="<?php echo $loja['id'] ?>" <?php if($aux == 0) echo 'selected'; ?>><?php echo $loja['nome']?></option>
                            <?php $aux++; } ?>
                        </select>
                        
                    </div>
                </div>
                <div class="col-lg-6" id="newdash" style="display: block; ">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-xl-12 col-12">
                            <div class="button-area" align="right">
                                <button id="dia1" type="button" class="btn btn-primary" onclick="diasDash(1)" style="  margin-right: 15px">Hoje</button>
                                <button id="dia7" type="button" class="btn btn-primary" onclick="diasDash(7)" style="margin-right: 15px">7 dias</button>
                                <button id="dia15" type="button" class="btn btn-primary" onclick="diasDash(15)" style="margin-right: 15px">15 dias</button>
                                <button id="dia30" type="button" class="active btn btn-primary" onclick="diasDash(30)" style="margin-right: 15px">30 dias</button>
                            </div>
                        </div>
                        <div class="c-card-body bordeless">
                            <div id="columnchart_values" style="width: 100%; height: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
                    
                    <div class="row">
                            
                        <div class="col-xs-3 col-md-3 col-xl-3 col-3" <?php if($mobile_view) { echo 'style="width: 100%!important"'; } ?>>
                            <div class="c-card">
                                <div class="c-card-header">
                                    <div class="c-card-icon c-aprovados">
                                        <em class="fa fa-dollar c-icon"></em>
                                    </div>
                                    <p class="c-card-category">Pedidos Aprovados</p>
                                    <h3 class="c-card-title">
                                        <small>R$</small>
                                        <span id="transacao_aprovada"></span>
                                    </h3>
                                </div>
                                <div class="c-card-footer">
                                    <div class="c-stats">
                                        <em class="fa fa-clock-o c-stats-icon"></em>
                                        <span class="c-stats-text">Atualizado: <?php echo date('H:i') ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xs-3 col-md-3 col-xl-3 col-3" <?php if($mobile_view) { echo 'style="width: 100%!important"'; } ?>>
                            <div class="c-card">
                                <div class="c-card-header">
                                    <div class="c-card-icon c-analise">
                                        <em class="fa fa-hourglass-o c-icon"></em>
                                    </div>
                                    <p class="c-card-category">Pedidos Análise</p>
                                    <h3 class="c-card-title">
                                        <small>R$</small>
                                        <span id="transacao_analise"></span>
                                    </h3>
                                </div>
                                <div class="c-card-footer">
                                    <div class="c-stats">
                                        <em class="fa fa-clock-o c-stats-icon"></em>
                                        <span class="c-stats-text">Atualizado: <?php echo date('H:i') ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xs-3 col-md-3 col-xl-3 col-3" <?php if($mobile_view) { echo 'style="width: 100%!important"'; } ?>>
                            <div class="c-card">
                                <div class="c-card-header">
                                    <div class="c-card-icon c-negadas">
                                        <em class="fa fa-times-circle-o c-icon"></em>
                                    </div>
                                    <p class="c-card-category">Pedidos Negados</p>
                                    <h3 class="c-card-title">
                                        <small>R$</small>
                                        <span id="transacao_negada"></span>
                                    </h3>
                                </div>
                                <div class="c-card-footer">
                                    <div class="c-stats">
                                        <em class="fa fa-clock-o c-stats-icon"></em>
                                        <span class="c-stats-text">Atualizado: <?php echo date('H:i') ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xs-3 col-md-3 col-xl-3 col-3" <?php if($mobile_view) { echo 'style="width: 100%!important"'; } ?>>
                            <div class="c-card">
                                <div class="c-card-header">
                                    <div class="c-card-icon c-inscritos">
                                        <em class="fa fa-user c-icon"></em>
                                    </div>
                                    <p class="c-card-category">Clientes Cadastrados</p>
                                    <h3 class="c-card-title">
                                        <span id="inscritos"></span>
                                        <small>clientes</small>
                                    </h3>
                                </div>
                                <div class="c-card-footer">
                                    <div class="c-stats">
                                        <em class="fa fa-clock-o c-stats-icon"></em>
                                        <span class="c-stats-text">Atualizado: <?php echo date('H:i') ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    
                    
                    <div class="row">
                        
                        <div class="col-xs-9 col-md-9 col-xl-9 col-9" <?php if($mobile_view) { echo 'style="width: 100%!important"'; } ?>>
                            <div class="c-card">
                                <div class="c-card-header">
                                    <div class="c-card-icon2 c-tabela">
                                        <span class="c-icon" style="font-size: 20px;">Últimos Pedidos</span>
                                    </div>
                                </div>
                                <div class="c-card-body" style="display: block;">
                                    <div class="table-responsive" style="width: 100%">
                                        <table class="c-table" id="tabela">
                                            <thead>
                                                <tr>
                                                    <th style='width: 40%'>NOME</th>
                                                    <th style='width: 20%'>DATA/HORA</th>
                                                    <th class="text-center" style='width: 20%'>VALOR</th>
                                                    <th class="text-center" style='width: 10%'>STATUS</th>
                                                    <th class="text-center" style='width: 10%'>LOJA</th>
                                                    <th class="text-center" style='width: 10%'>AÇÕES</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tabela_aprovado">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <a href="<?php echo base_url('954d03a8bbb7febfcd39f9e071407b4b') ?>" class="vermais btn btn-primary">Ver +</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xs-3 col-md-3 col-xl-3 col-3" <?php if($mobile_view) { echo 'style="width: 100%!important"'; } ?>>
                            <div class="c-card">
                                <div class="c-card-header">
                                    <div class="c-card-icon2 c-tabela">
                                        <span class="c-icon" style="font-size: 20px;">Vendas Estado</span>
                                    </div>
                                </div>
                                <div class="c-card-body" style="display: block;">
                                    <div id="chart_div" style="width: 100%; height: 100%;"></div>
                                </div>
                            </div>
                        </div>
                        

                        
                    </div>
                    
                    
                    
                    
                    
                </div>
                
            
            <!-- FINAL DO NOVO DASHBOARD -->
            
                <div class="col-xs-12 col-md-12 col-xl-12 col-12">
                    <div class="row">
                        <div class="col-xs-9 col-md-9 col-xl-9 col-9" id="graficohora" <?php if($mobile_view) { echo 'style="width: 100%!important"'; } ?>>
                            <div class="c-card">
                                <div class="c-card-header" style="padding: 0">
                                    <div class="c-card-icon2 c-tabela">
                                        <span class="c-icon" style="font-size: 20px;">Métricas de Acesso | Hora</span>
                                    </div>
                                    <div class="button-area">
                                        <button type="button" class="btn btn-primary" onclick="mudagrafico(1)" style="margin-right: 15px">Hora</button>
                                        <?php if(isset($min) && isset($minv)) { ?>
                                            <button type="button" class="btn btn-primary" onclick="mudagrafico(2)" style="margin-right: 15px">Minuto</button>
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-primary" style="margin-right: 15px">Minuto</button>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="c-card-body bordeless">
                                    <div id="curve_chart" style="width: 95%; height: 95%;"></div>
                                    <div class="ct-chart" id="dailySalesChart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-9 col-md-9 col-xl-9 col-9" id="graficominuto" style="display:none;<?php if($mobile_view) { echo 'style=";width: 100%!important"'; } ?>">
                            <div class="c-card">
                                <div class="c-card-header" style="padding: 0">
                                    <div class="c-card-icon2 c-tabela">
                                        <span class="c-icon" style="font-size: 20px;">Métricas de Acesso | Minuto</span>
                                    </div>
                                    <div class="button-area">
                                        <button type="button" class="btn btn-primary" onclick="mudagrafico(1)" style="margin-right: 15px">Hora</button>
                                        <button type="button" class="btn btn-primary" onclick="mudagrafico(2)" style="margin-right: 15px">Minuto</button>
                                    </div>
                                </div>
                                <div class="c-card-body bordeless">
                                    <div id="curve_chart2" style="width: 95%; height: 95%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3 col-md-3 col-xl-3 col-3" id="graficohora" <?php if($mobile_view) { echo 'style="width: 100%!important"'; } ?>>
                            <div class="c-card">
                                <div class="c-card-header" style="padding: 0">
                                    <div class="c-card-icon2 c-tabela">
                                        <span class="c-icon" style="font-size: 20px;">Formas Pagamento</span>
                                    </div>
                                </div>
                                <div class="c-card-body bordeless">
                                    <div id="piechart2" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script>
        function mudagrafico(id){
            if(id == 1){
                $('#graficohora').show();
                $('#graficominuto').hide();
            } else {
                google.charts.setOnLoadCallback(drawChart10);
                $('#graficohora').hide();
                $('#graficominuto').show();
            }
        }
    </script>
    
    <script>
        $('document').ready(function(){
            $('#dia30').click(); 
        });
    </script>
    
    <script>
        function diasDash(dias){
            
            if(dias == 1){
                $('#dia1').addClass('active');
                $('#dia7').removeClass('active');
                $('#dia15').removeClass('active');
                $('#dia30').removeClass('active');
            } else if(dias == 7){
                $('#dia1').removeClass('active');
                $('#dia7').addClass('active');
                $('#dia15').removeClass('active');
                $('#dia30').removeClass('active');
            } else if(dias == 15){
                $('#dia1').removeClass('active');
                $('#dia7').removeClass('active');
                $('#dia15').addClass('active');
                $('#dia30').removeClass('active');
            } else if (dias == 30){
                $('#dia1').removeClass('active');
                $('#dia7').removeClass('active');
                $('#dia15').removeClass('active');
                $('#dia30').addClass('active');
            }
            
           let dias_ = 30;
           let loja_id = $("#loja_id").val();
           if(dias){
               dias_ = dias;
           }else{
               dias_ = parseInt($(".button-area .active").html().replace('dias', ''));
           }
            
            ultimosPedidos(loja_id);
            
            dados = new FormData();
            dados.append('dias', dias_);
            dados.append('loja_id', loja_id);
            
            
            $.ajax({
                url: '<?php echo base_url('7353df2c4374b05e205fa76aeb593a7b'); ?>',
                method: 'post',
                data: dados,
                processData: false,
                contentType: false,
                dataType: 'json',
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                },
                success: function(dados) {
                    $('#transacao_aprovada').unmask().html(dados.total_aprovado.toFixed(2)).mask("#.##0,00", {reverse: true});
                    $('#transacao_analise').unmask().html(dados.total_analise.toFixed(2)).mask("#.##0,00", {reverse: true});
                    $('#transacao_negada').unmask().html(dados.total_negado.toFixed(2)).mask("#.##0,00", {reverse: true});
                    $('#inscritos').html(dados.clientes);
                    
                },
            });
        }
        
          function ultimosPedidos(loja_id){
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {loja_id},
                url: '<?php echo base_url('get-ultimos-pedidos') ?>',
                beforeSend: function(){
                    $("#tabela_aprovado").empty();
                    console.log('Buscando ultimos pedidos para: '+loja_id);
                },
                success: function(retorno){
                    retorno.map(function(value, i){
                        $("#tabela_aprovado").append(`
                        
                         <tr>
                           <td>${value.nome}</td>
                           <td>${value.data}</td>
                           <td class="text-center">${value.valor}</td>
                           <td class="text-center">${value.status}</td>
                           <td class="text-center">${value.loja}</td>
                           <td class="text-center">
                              <a style="color: #1b9045;" href="<?php echo base_url() ?>aeb6ca97f00431672db51d34b87c4a50/${value.id}"><i style="font-size: 25px" class="fa fa-eye" aria-hidden="true"></i></a>
                           </td>
                        </tr>
                        `);
                    })
                },
                error: function(xhr){
                    console.log(xhr);
                }
            })
            
        }
        
        
  
    </script>
    
    <script>
      
    </script>
    
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        
        <?php 
            $aux_min   = explode(',', $min);
            $aux_minv  = explode(',', $minv);
            $ax = 0;
            $minuto = 0;
        ?>
        
      function drawChart10() {
        var data = google.visualization.arrayToDataTable([
          ['Minutos', 'Home','Carrinho'],
          <?php while($minuto <= 60){ ?>
          <?php if(isset($aux_min[$ax]) || isset($aux_minv[$ax])){ ?>
            <?php if($minuto == 0) { ?>
                ['01min',  <?php echo $aux_min[$ax] ?>, <?php echo $aux_minv[$ax] ?>],
            <?php } else if($minuto < 10) { ?>
                ['0' + <?php echo $minuto ?> +'min',  <?php echo $aux_min[$ax] ?>, <?php echo $aux_minv[$ax] ?>],
            <?php } else if($minuto == 60) { ?>
                ['59min',  <?php echo $aux_min[$ax] ?>, <?php echo $aux_minv[$ax] ?>],
            <?php } else { ?>
                [<?php echo $minuto ?> +'min',  <?php echo $aux_min[$ax] ?>, <?php echo $aux_minv[$ax] ?>],
            <?php } } ?>
          <?php $ax++; $minuto = $minuto + 5;} ?>
        ]);

        var options = {
            height: 300,
            chartArea: {left:'10%',right:'5%',width:'85%',height:'80%'},
            colors: ['purple', 'orange'],
            curveType: 'function',
            legend: { position: 'top', alignment: 'center' },
            vAxis: {viewWindowMode: "explicit", viewWindow:{ min: 0 }},
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart2'));

        chart.draw(data, options);
      }
    </script>

    
    
    
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        
        <?php 
            $aux_hora   = explode(',', $hora);
            $aux_horav  = explode(',', $horav);
            $aux_horaa  = explode(',', $horaa);
            $aux_horaav = explode(',', $horaav);
        
        ?>
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Horários', 'Home Dia Atual','Carrinho Dia Atual', 'Home Dia Anterior', 'Carrinho Dia Anterior'],
          <?php for($i = 0; $i < 24; $i++){ ?>
            <?php if($i < 10) { ?>
                ['0' + <?php echo $i ?> +'h',  <?php echo $aux_hora[$i] ?>, <?php echo $aux_horav[$i] ?>, <?php echo $aux_horaa[$i] ?>, <?php echo $aux_horaav[$i] ?>],
            <?php } else { ?>
                [<?php echo $i ?> +'h',  <?php echo $aux_hora[$i] ?>, <?php echo $aux_horav[$i] ?>, <?php echo $aux_horaa[$i] ?>, <?php echo $aux_horaav[$i] ?>],
            <?php } ?>
          <?php } ?>
        ]);
        
        
        var options = {
            height: 300,
            chartArea: {left:'10%',right:'5%',width:'85%',height:'80%'},
            colors: ['forestgreen', 'red', 'lightgreen', 'pink'],
            curveType: 'function',
            legend: { position: 'top', alignment: 'center' },
            vAxis: {viewWindowMode: "explicit", viewWindow:{ min: 0 }},
            gradient: { color1: '#fbf6a7',  color2: '#66bb6a'},
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
    
    
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        
        <?php 
            $aux_hora   = explode(',', $hora);
            $aux_horav  = explode(',', $horav);
            $aux_horaa  = explode(',', $horaa);
            $aux_horaav = explode(',', $horaav);
        
        ?>
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Horários', 'Home Dia Atual','Carrinho Dia Atual', 'Home Dia Anterior', 'Carrinho Dia Anterior'],
          <?php for($i = 0; $i < 24; $i++){ ?>
            <?php if($i < 10) { ?>
                ['0' + <?php echo $i ?> +'h',  <?php echo $aux_hora[$i] ?>, <?php echo $aux_horav[$i] ?>, <?php echo $aux_horaa[$i] ?>, <?php echo $aux_horaav[$i] ?>],
            <?php } else { ?>
                [<?php echo $i ?> +'h',  <?php echo $aux_hora[$i] ?>, <?php echo $aux_horav[$i] ?>, <?php echo $aux_horaa[$i] ?>, <?php echo $aux_horaav[$i] ?>],
            <?php } ?>
          <?php } ?>
        ]);
        
        
        var options = {
            height: 300,
            chartArea: {left:'10%',right:'5%',width:'85%',height:'80%'},
            colors: ['forestgreen', 'red', 'lightgreen', 'pink'],
            curveType: 'function',
            legend: { position: 'top', alignment: 'center' },
            vAxis: {viewWindowMode: "explicit", viewWindow:{ min: 0 }},
            gradient: { color1: '#fbf6a7',  color2: '#66bb6a'},
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
    
    
    <script>
        google.load('visualization', '1', {'packages': ['geochart', 'table']});
        google.setOnLoadCallback(drawRegionsMap);
  
        function drawRegionsMap() {
            var data = google.visualization.arrayToDataTable([
            ['State', 'Views'],
                ['Acre',                <?php echo $pedidos_cont['ac']  ?>],
                ['Alagoas',             <?php echo $pedidos_cont['al']  ?>],
                ['Amapá',               <?php echo $pedidos_cont['ap']  ?>],
                ['Amazonas',            <?php echo $pedidos_cont['am']  ?>],
                ['Bahia',               <?php echo $pedidos_cont['ba']  ?>],
                ['Ceará',               <?php echo $pedidos_cont['ce']  ?>],
                ['Distrito Federal',    <?php echo $pedidos_cont['df']  ?>],
                ['Espírito Santo',      <?php echo $pedidos_cont['es']  ?>],
                ['Goiás',               <?php echo $pedidos_cont['go']  ?>],
                ['Maranhão',            <?php echo $pedidos_cont['ma']  ?>],
                ['Mato Grosso',         <?php echo $pedidos_cont['mt']  ?>],
                ['Mato Grosso do Sul',  <?php echo $pedidos_cont['ms']  ?>],
                ['Minas Gerais',        <?php echo $pedidos_cont['mg']  ?>],
                ['Pará',                <?php echo $pedidos_cont['pa']  ?>],
                ['Paraíba',             <?php echo $pedidos_cont['pb']  ?>],
                ['Paraná',              <?php echo $pedidos_cont['pr']  ?>],
                ['Pernambuco',          <?php echo $pedidos_cont['pe']  ?>],
                ['Piauí',               <?php echo $pedidos_cont['pi']  ?>],
                ['Rio de Janeiro',      <?php echo $pedidos_cont['rj']  ?>],
                ['Rio Grande do Norte', <?php echo $pedidos_cont['rn']  ?>],
                ['Rio Grande do Sul',   <?php echo $pedidos_cont['rs']  ?>],
                ['Rondônia',            <?php echo $pedidos_cont['ro']  ?>],
                ['Roraima',             <?php echo $pedidos_cont['rr']  ?>],
                ['Santa Catarina',      <?php echo $pedidos_cont['sc']  ?>],
                ['São Paulo',           <?php echo $pedidos_cont['sp']  ?>],
                ['Sergipe',             <?php echo $pedidos_cont['se']  ?>],
                ['Tocantins',           <?php echo $pedidos_cont['to']  ?>],
          ]);
      
          var view = new google.visualization.DataView(data)
          view.setColumns([0, 1])
      
          var options = {
                height: 350,
                chartArea: {left:15,right:15,width:'90%',height:'80%'},
                datalessRegionColor: '#123456',
                region: 'BR',
                resolution: 'provinces',
                colorAxis: {
                  colors: ['darkseagreen', 'forestgreen']
                },
    
          };
      
          var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
          chart.draw(data, options);
    
      
      };
    </script>
    

    
    
    <script type="text/javascript">
    google.charts.setOnLoadCallback(drawChart6);
        google.charts.load('current', {'packages':['corechart']});

      function drawChart6() {
        var data = google.visualization.arrayToDataTable([
          ['Formas de Pagamento', 'Quantidade'],
          ['Vendedor',        <?php echo $pedidos_cont['total_cartao']  ?>],
        ]);

        var options = {
            chartArea: {left:15,right:15,width:'90%',height:'80%'},
            height: 350,
            pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart.draw(data, options);
      }
    </script>

