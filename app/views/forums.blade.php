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

                            <li><input type="text"  value="<?php
                                 echo $data['nbVisitesForum'][$data['maxVisites']] * 100/$data['nbVisites']?>" class="whiteCircle" readonly="readonly" style="width: 60px; position: absolute; margin-top: 42.8571428571429px; margin-left: -90px; font-size: 30px; border: none; font-family: Arial; font-weight: bold; text-align: center; color: rgba(255, 255, 255, 0.901961); padding: 0px; -webkit-appearance: none; background: none;">
                                Le plus consulté:
                                <span class="number"><?php echo $data['maxVisites'] ?></span>
                            </li>
                            <li><input type="text"  value="<?php
                                                                 echo $data['nbForumMsg'][$data['maxMsgs']] * 100/$data['nbMsg']?>" class="whiteCircle" readonly="readonly" style="width: 60px; position: absolute; margin-top: 42.8571428571429px; margin-left: -90px; font-size: 30px; border: none; font-family: Arial; font-weight: bold; text-align: center; color: rgba(255, 255, 255, 0.901961); padding: 0px; -webkit-appearance: none; background: none;"></span>

                                Contenant le plus de messages:
                                <span class="number"><?php echo $data['maxMsgs'] ?></span>
                            </li>
                            <li><input type="text"  value="<?php
                                                                 echo $data['nbSujetsForum'][$data['maxSujets']] * 100/$data['nbSujets']?>" class="whiteCircle" readonly="readonly" style="width: 60px; position: absolute; margin-top: 42.8571428571429px; margin-left: -90px; font-size: 30px; border: none; font-family: Arial; font-weight: bold; text-align: center; color: rgba(255, 255, 255, 0.901961); padding: 0px; -webkit-appearance: none; background: none;"></span>

                                Contenant le plus de sujets:
                                <span class="number"><?php echo $data['maxSujets'] ?></span>
                            </li>
                            <li><input type="text"  value="<?php
                                                                 echo $data['nbReponsesForum'][$data['maxReponses']] * 100/$data['nbReponses']?>" class="whiteCircle" readonly="readonly" style="width: 60px; position: absolute; margin-top: 42.8571428571429px; margin-left: -90px; font-size: 30px; border: none; font-family: Arial; font-weight: bold; text-align: center; color: rgba(255, 255, 255, 0.901961); padding: 0px; -webkit-appearance: none; background: none;"></span>

                                Contenant le plus de reponses <span class="number"><?php echo $data['maxReponses'] ?></span>
                            </li>


                        </ul>

    					<div class="clearfix"></div>

                    </div><!-- End .sparkStats -->
    <div id="container" style="width: 100%; min-height: 500px; margin: 0 auto"></div>
    <div id="ActivitesForum" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($data['forums'] as $forum){
                                            $pourcentage = $data['nbForumMsg'][$forum] * 100/$data['nbMsg'];
                                    ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo "/travis/public/forum/".$forum?>"><?php echo $forum; ?></a>
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
                                            <td class="center">
                                           	<span class="<?php if($pourcentage>1){ echo "label label-success";} else {echo "label label-important";} ?>">
                                           	  <?php if($pourcentage>1){ echo "Actif";} else {echo "Inactif";}?></span>
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
                   text: 'Activités'
               },
               xAxis: {
                   type: 'datetime'
               },
               series: [{
                   type: 'area',
                   title: 'Taux activité' ,
                   data: [<?php
                            foreach($data['activites'] as $activite){
                               echo '[Date.UTC('.$activite[0]->format('Y,m,d,H,i,s').'),'.$activite[1].'],';
                             }
                          ?>  ]
               }]
           });
          });

        $(function () {
            $('#ActivitesForum').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Activités sur chaque forum'
                },
                xAxis: {
                    categories: [
                        <?php
                        foreach($data['forums'] as $forum){
                            echo "'".$forum."',";
                        }
                    ?>
                    ]
                    //categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Nombre d\'activités'
                    },
                    stackLabels: {
                        enabled: true,
                        style: {
                            fontWeight: 'bold',
                            color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                        }
                    }
                },
                legend: {
                    align: 'right',
                    x: -30,
                    verticalAlign: 'top',
                    y: 25,
                    floating: true,
                    backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                    borderColor: '#CCC',
                    borderWidth: 1,
                    shadow: false
                },
                tooltip: {
                    formatter: function () {
                        return '<b>' + this.x + '</b><br/>' +
                            this.series.name + ': ' + this.y + '<br/>' +
                            'Total: ' + this.point.stackTotal;
                    }
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true,
                            color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                            style: {
                                textShadow: '0 0 3px black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Afficher une structure (cours/forum)',
                    data: [
                        <?php
                            $activitesForum = $data["ActivitesForum"];
                            foreach($data['forums'] as $forum){
                                echo $activitesForum["AfficherStructure"][$forum].', ';

                            }
                        ?>
                    ]
                }, {
                    name: 'Répondre à un message',
                    data: [
                        <?php
                            $activitesForum = $data["ActivitesForum"];
                            foreach($data['forums'] as $forum){
                                echo $activitesForum["RepondreMessage"][$forum].', ';

                            }
                        ?>
                    ]
                }, {
                    name: 'Afficher le fil de discussion',
                    data: [
                        <?php
                            $activitesForum = $data["ActivitesForum"];
                            foreach($data['forums'] as $forum){
                                echo $activitesForum["AfficherFilDiscussion"][$forum].', ';

                            }
                        ?>
                    ]
                }, {
                    name: 'Poster un nouveau message',
                    data: [
                        <?php
                            $activitesForum = $data["ActivitesForum"];
                            foreach($data['forums'] as $forum){
                                echo $activitesForum["PosterNouveauMessage"][$forum].', ';

                            }
                        ?>
                    ]
                }, {
                    name: 'Afficher le contenu d\'un message',
                    data: [
                        <?php
                            $activitesForum = $data["ActivitesForum"];
                            foreach($data['forums'] as $forum){
                                echo $activitesForum["AfficherContenuMessage"][$forum].', ';

                            }
                        ?>
                    ]
                }, {
                    name: 'Bouger la scrollbar en bas - afficher la fin du message',
                    data: [
                        <?php
                            $activitesForum = $data["ActivitesForum"];
                            foreach($data['forums'] as $forum){
                                echo $activitesForum["BougerScrollbarEnBasEtAfficherFinMessage"][$forum].', ';

                            }
                        ?>
                    ]
                }, {
                    name: 'Citer un message',
                    data: [
                        <?php
                            $activitesForum = $data["ActivitesForum"];
                            foreach($data['forums'] as $forum){
                                echo $activitesForum["CiterMessage"][$forum].', ';

                            }
                        ?>
                    ]
                }, {
                    name: 'Bouger la scrollbar en bas',
                    data: [
                        <?php
                            $activitesForum = $data["ActivitesForum"];
                            foreach($data['forums'] as $forum){
                                echo $activitesForum["BougerScrollbarBas"][$forum].', ';

                            }
                        ?>
                    ]
                }, {
                    name: 'Download un fichier dans le message',
                    data: [
                        <?php
                            $activitesForum = $data["ActivitesForum"];
                            foreach($data['forums'] as $forum){
                                echo $activitesForum["DownloaFichierMessage"][$forum].', ';

                            }
                        ?>
                    ]
                }]
            });
        });
    </script>
@endsection