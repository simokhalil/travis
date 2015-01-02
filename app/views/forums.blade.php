@extends('default')

@section('title')
    Dashboard
@endsection

@section('content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}">Dashboard</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Forums</a></li>
    </ul>

    <div class="sparkLineStats span4 widget green" onTablet="span5" onDesktop="span4">

                        <ul class="unstyled">

                            <li><span class="sparkLineStats3"></span>
                                Le plus consulté:
                                <span class="number"><?php echo $data['maxVisites'] ?></span>
                            </li>
                            <li><span class="sparkLineStats4"></span>
                                Contenant le plus de messages:
                                <span class="number"><?php echo $data['maxMsgs'] ?></span>
                            </li>
                            <li><span class="sparkLineStats5"></span>
                                Contenant le plus de sujets:
                                <span class="number"><?php echo $data['maxSujets'] ?></span>
                            </li>
                            <li><span class="sparkLineStats6"></span>
                                Contenant le plus de reponses <span class="number"><?php echo $data['maxReponses'] ?></span>
                            </li>
                           

                        </ul>

    					<div class="clearfix"></div>

                    </div><!-- End .sparkStats -->
    <div id="container" style="width: 100%; min-height: 500px; margin: 0 auto"></div>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon white list"></i><span class="break"></span>Forums</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>

             <div class="box-content">
                            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                                <thead>
                                    <tr>
                                        <th>ID Forum</th>
                                        <th>Total des Messages</th>
                                        <th>Sujets</th>
                                        <th>Réponses</th>
                                        <th>Consultations</th>
                                        <th>Activité</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($data['forums'] as $forum){
                                            $pourcentage = $data['nbForumMsg'][$forum] * 100/$data['nbMsg'];
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $forum; ?>
                                            </td>
                                            <td>
                                                <?php echo $data['nbForumMsg'][$forum]; ?>
                                            </td>
                                            <td>
                                                <?php echo $data['nbSujetsForum'][$forum]; ?>
                                            </td>
                                            <td>
                                                <?php echo $data['nbReponsesForum'][$forum]; ?>
                                            </td>
                                            <td>
                                                <?php echo $data['nbVisitesForum'][$forum]; ?>
                                            </td>
                                            <td>
                                                <?php echo round($pourcentage,2);?>%
                                                <div class="meter blue"><span style="width: <?php echo $pourcentage;?>%"></span></div>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>






        </div>

    </div>


@endsection


@section('scripts')
    <script>
        /* ---------- Pie chart ---------- */

       $(function () {

        $('#container').highcharts({
               chart: {
                          zoomType: 'x'
                      },
               title: {
                   text: 'Chart reflow is set to true'
               },

               subtitle: {
                   text: 'When resizing the window or the frame, the chart should resize'
               },


               xAxis: {
                   type: 'datetime'
               },

               series: [{
                   data: [<?php
                            foreach($data['activites'] as $activite){
                               echo '[Date.UTC('.$activite[0]->format('Y,m,d,H,i,s').'),'.$activite[1].'],';
                             }
                          ?>  ]
               }]
           });
          });


    </script>
@endsection