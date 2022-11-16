
            <?php
                //-> Verifica com o navegador qual o dispositivo sendo usado
                $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
                $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
                $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
                $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
                $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
                $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
                $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
                if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
                    $mobile_footer = "<br>";
                    $mobile = 1;
                } else {
                    $mobile_footer = "&nbsp; | &nbsp;";
                    $mobile = 0;
                }
            ?>

           <div style="height: 70px"></div>

            <style>
                .n-footer{
                    width: 25px;
                    display: inline;
                    margin-right: 5px;
                    margin-left: 5px;
                }
            </style>

            <!--footer start-->
            <?php if($mobile == 0){ ?>
                <footer class="site-footer" style="position: fixed; width: 100%; bottom: 0; background: black; z-index: 999">
                    <div class="text-center" style="margin-left:25px; margin-top:0px">
                        <p style="font-size: 11px;"><z style="margin-left:60%;">&copy; Catálogo Digital - Versão 3.05<?php echo $mobile_footer ?></z>Desenvolvido por <img src="<?php echo base_url('assets/admin_base/n.png') ?>" class="n-footer"><strong>N Soluções</strong></p>
                    </div>
                </footer>
            <?php }else{ ?>
                <footer class="site-footer" style="position: relative; width: 100%; bottom: 0; background: black; z-index: 999">
                    <div class="text-center" style="margin-left:25px; margin-top:0px">
                        <br><p style="font-size: 11px; position: relative; left: -5.5%;"><z>&copy; Catálogo Digital - Versão 3.05<?php echo $mobile_footer ?></z><br>Desenvolvido por <img src="<?php echo base_url('assets/admin_base/n.png') ?>" class="n-footer"><strong>N Soluções</strong></p>
                    </div>
                </footer>
            <?php } ?>
            <!--footer end-->
        </section>
        
        <script src="<?php echo base_url('resources/'); ?>assets/js/popper.min.js"></script>
        <script src="<?php echo base_url('assets/admin/');?>lib/bootstrap/js/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="<?php echo base_url('assets/admin/');?>lib/jquery.dcjqaccordion.2.7.js"></script>
        <script src="<?php echo base_url('assets/admin/');?>lib/jquery.scrollTo.min.js"></script>
        <script src="<?php echo base_url('assets/admin/');?>lib/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/admin/');?>lib/jquery.sparkline.js"></script>
        <script src="<?php echo base_url('assets/admin/');?>lib/common-scripts.js"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/');?>lib/gritter/js/jquery.gritter.js"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/');?>lib/gritter-conf.js"></script>
        <script src="<?php echo base_url('assets/admin/');?>lib/sparkline-chart.js"></script>
        <script src="<?php echo base_url('assets/admin/');?>lib/zabuto_calendar.js"></script>
        <script type="text/javascript" charset="utf8" src="<?php echo base_url('resources/datatables/datatable/js/jquery.dataTables.js')?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('resources/datatables/datatable/js/jquery.dataTables.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/datatables/datatable/js/dataTables.bootstrap.min.js');?>"></script>
        <script src="<?php echo base_url('resources/select2/dist/js/select2.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/') ?>js/jquery_mask/dist/jquery.mask.min.js"></script>
        
        <!-- sweetalert2 -->
        <script src="<?php echo base_url('recursos/lib/sweetalert2/dist/sweetalert2.min.js') ?>"></script>
        
        <script type="text/javascript">
            $('[data-toggle="tooltip"]').tooltip()
            $('#myTable').DataTable( {
                "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado- refaça sua busca",
                    "info": "Mostrando _PAGE_ de _PAGES_",
                    "infoEmpty": "Sem registros disponíves",
                    "infoFiltered": "(filtrado _MAX_ dos registros totais)",
                    "sSearch":       "Procurar:",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Próximo",
                    }
                }
            } );
            
            $('#myTable2').DataTable( {
                "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado- refaça sua busca",
                    "info": "Mostrando _PAGE_ de _PAGES_",
                    "infoEmpty": "Sem registros disponíves",
                    "infoFiltered": "(filtrado _MAX_ dos registros totais)",
                    "sSearch":       "Procurar:",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Próximo",
                    }
                }
            } );
            
            $('#myTableSemRecurso').DataTable( {
                "paging":   false,
                "ordering": false,
                "info":     false,
                "searching": false,
                "language": {
                    "zeroRecords": " ",
                }
            } );
        </script>
        <script type="application/javascript">
            $(document).ready(function() {
                $('#qtepremio').mask('0000',{'translation': {0: {pattern: /[0-9*]/}}});
                $('#valor').mask("###0,00", {reverse: true});
                $('.js-example-basic-multiple').select2({theme: "bootstrap"});
                $("#date-popover").popover({
                    html: true,
                    trigger: "manual"
                });
                $("#date-popover").hide();
                $("#date-popover").click(function(e) {
                    $(this).hide();
                });
    
                $("#my-calendar").zabuto_calendar({
                    action: function() {
                        return myDateFunction(this.id, false);
                    },
                    action_nav: function() {
                        return myNavFunction(this.id);
                    },
                    ajax: {
                        url: "show_data.php?action=1",
                        modal: true
                    },
                    legend: [{
                        type: "text",
                        label: "Special event",
                        badge: "00"
                    },
                    {
                        type: "block",
                        label: "Regular event",
                    }]
                });
            });
    
            function myNavFunction(id) {
                $("#date-popover").hide();
                var nav = $("#" + id).data("navigation");
                var to = $("#" + id).data("to");
                console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
            }
        </script>
    <?php if($this->session->userdata('footer')){?>
        <script src='https://maps.googleapis.com/maps/api/js?key=<?php if($this->session->userdata('mapkey')){echo $this->session->userdata('mapkey');}?>'></script>
        <script src='<?php echo base_url('recursos/js/');?>/material/core/jquery.min.js'></script>
        <script src='<?php echo base_url('recursos/js/');?>/material/core/bootstrap-material-design.min.js'></script>
        <script src='<?php echo base_url('recursos/js/');?>/material/plugins/perfect-scrollbar.jquery.min.js'></script>
        <script src='<?php echo base_url('recursos/js/');?>/material/plugins/moment.min.js'></script>
        <script src='<?php echo base_url('recursos/js/');?>/material/plugins/sweetalert2.js'></script>
        <script src='<?php echo base_url('recursos/js/');?>/material/plugins/jquery.validate.min.js'></script>
        <script src='<?php echo base_url('recursos/js/');?>/material/plugins/jquery.bootstrap-wizard.js'></script>
        <script src='<?php echo base_url('recursos/js/');?>/material/plugins/bootstrap-selectpicker.js'></script>
        <script src='<?php echo base_url('recursos/js/');?>/material/plugins/bootstrap-datetimepicker.min.js'></script>
        <script src='<?php echo base_url('recursos/js/');?>/material/plugins/bootstrap-tagsinput.js'></script>
        <script src='<?php echo base_url('recursos/js/');?>/material/plugins/jasny-bootstrap.min.js'></script>
        <script src='<?php echo base_url('recursos/js/');?>/material/plugins/fullcalendar.min.js'></script>
        <script src='<?php echo base_url('recursos/js/');?>/material/plugins/jquery-jvectormap.js'></script>
        <script src='<?php echo base_url('recursos/js/');?>/material/plugins/nouislider.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js'></script>
        <script src='<?php echo base_url('recursos/js/');?>/material/plugins/arrive.min.js'></script>
        <script src='<?php echo base_url('recursos/js/');?>/material/plugins/chartist.min.js'></script>
        <script src='<?php echo base_url('recursos/js/');?>/material/plugins/bootstrap-notify.js'></script>
        <script src='<?php echo base_url('recursos/js/');?>/material/material-dashboard.js?v=2.1.2' type='text/javascript'></script>
    <?php }?>
    </body>

</html>
