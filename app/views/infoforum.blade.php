@extends('default')

@section('title')
    Dashboard
@endsection


@section('content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="#">Dashboard</a>
            <i class="icon-angle-right"></i>
        </li>
    </ul>

    <div class="row-fluid">
         <div class="span3 statbox red" style="width: 17%" onTablet="span6" onDesktop="span3">

                    <div class="number"><?php echo $data['nbSujets']; ?> <i class="icon-folder-open-alt"></i></div>
                    <div class="title">Sujets</div>
                    <div class="footer">
                        <a href="{{URL::to('forums')}}"> Rapport complet</a>
                    </div>
          </div>
        <div class="span3 statbox purple" style="width: 17%" onTablet="span6" onDesktop="span3">

            <div class="number"><?php echo $data['nbReponses']; ?> <i class="icon-ok"></i></div>
            <div class="title">Reponses</div>
            <div class="footer">
                <a href="{{URL::to('forums')}}"> Rapport complet</a>
            </div>
        </div>
        <div class="span3 statbox green" style="width: 17%" onTablet="span6" onDesktop="span3">

            <div class="number"><?php echo $data['nbMsgs']; ?><i class="icon-file-alt"></i></div>
            <div class="title">Messages</div>
            <div class="footer">
                <a href="#"> Rapport complet</a>
            </div>
        </div>
        <div class="span3 statbox blue noMargin" style="width: 17%" onTablet="span6" onDesktop="span3">

            <div class="number"><?php echo $data['nbUtilisateurs']; ?><i class=<?php if($data['nbUtilisateurs']>10)
                                                                                     {
                                                                                     echo "icon-arrow-up";
                                                                                     }
                                                                                     else
                                                                                     {
                                                                                     echo "icon-arrow-down";
                                                                                     }?>></i></div>
            <div class="title">Utilisateurs</div>
            <div class="footer">
                <a href="#"> Rapport complet</a>
            </div>
        </div>
        <div class="span3 statbox yellow" style="width: 17%" onTablet="span6" onDesktop="span3">


            <div class="number"><?php echo $data['nbVisites']; ?><i class=<?php if($data['nbVisites']>50)
                                                                                {
                                                                                    echo "icon-arrow-up";
                                                                                }
                                                                                else
                                                                                {
                                                                                     echo "icon-arrow-down";
                                                                                }?>></i></div>
            <div class="title">visites</div>
            <div class="footer">
                <a href="#"> Rapport complet</a>
            </div>
        </div>
        </div>
        <div class="box black span4" ontablet="span6" ondesktop="span4">
        					<div class="box-header">
        						<h2><i class="halflings-icon white list"></i><span class="break"></span>Activités récentes</h2>
        						<div class="box-icon">
        							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
        							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
        						</div>
        					</div>
        					<div class="box-content">
        						<ul class="dashboard-list metro">
        							<li><a href="#">
        									<i class="icon-arrow-up green"></i>

        									Jour où il y a eu le plus d'activités :
        									<strong><?php echo $data['DateActiviteMax'] ?></strong>
        									ce qui represente : <?php echo $data['ActivitesMax'] * 100/$data['TotalActivite'].'%'?>
        									de l'activité du forum
        								</a>
        							</li>
        						  <li>
        							<a href="#">
        							  <i class="icon-arrow-down red"></i>

        							  Nombre maximum d'activité par jour :
        							   <strong><?php echo $data['ActivitesMax'] ?></strong>
        							</a>
        						  </li>
        						  <li>
                                    <a href="#">
                                     <i class="icon-arrow-down red"></i>
                                      Sujet qui inscrit le plus d'activités :
                                       <strong><?php echo $data['MaxActiviteSujet'] ?></strong>
                                       Avec : <strong><?php echo $data['MaxActivite'] ?></strong>
                                     </a>
                                  </li>
                                   <li>
                                     <a href="#">
                                       <i class="icon-arrow-down red"></i>
                                          Utilisateur le plus actif :
                                          <strong><?php echo $data['MaxUserActivite'] ?></strong>
                                          Avec : <strong><?php echo $data['MaxNbUserActivite'] ?></strong>
                                     </a>
                                   </li>


        						</ul>
        					</div>

        </div>
<div id="camembertActivite" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
<div id="tauxActivite" style="width: 100%; min-height: 250px; margin: 0 auto"></div>



    @endsection

@section('scripts')
<script>
    $(function () {
        $('#tauxActivite').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: 1,//null,
                plotShadow: false
            },
            title: {
                text: 'Répartition des activités utilisateurs'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Taux d\'activité',
                data: [
                    <?php
                        echo '["forum patata", '.($data['nbActiviteForum']/$data['nbActiviteTotal']*100).'],';
                        echo '["reste", '.(100-($data['nbActiviteForum']/$data['nbActiviteTotal']*100)).'],';

                    ?>
                ]
            }]
        });
    });
    $(function () {
        $('#camembertActivite').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: 1,//null,
                plotShadow: false
            },
            title: {
                text: 'Browser market shares at a specific website, 2014'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
                data: [
                    ['Firefox',   45.0],
                    ['IE',       26.8],
                    {
                        name: 'Chrome',
                        y: 12.8,
                        sliced: true,
                        selected: true
                    },
                    ['Safari',    8.5],
                    ['Opera',     6.2],
                    ['Others',   0.7]
                ]
            }]
        });
    });
  </script>
@endsection