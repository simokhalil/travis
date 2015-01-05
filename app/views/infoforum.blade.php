@extends('default')

@section('title')
    Info Forum
@endsection


@section('content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="#">Dashboard</a>
            <i class="icon-angle-right"></i>
        </li>
    </ul>
     <div class="circleStatsItemBox pink">
           						<div class="header">Sujets</div>
           						<span class="percent">%</span>
                               	<div class="circleStat">
                               		<div style="width:120px;display:inline;&quot;"><canvas width="120" height="120"></canvas><input type="text" value=<?php echo $data['nbSujets']/$data['nbSujetTotal']*100 ?> class="whiteCircle" readonly="readonly" style="width: 60px; position: absolute; margin-top: 42.8571428571429px; margin-left: -90px; font-size: 30px; border: none; font-family: Arial; font-weight: bold; text-align: center; color: rgba(255, 255, 255, 0.901961); padding: 0px; -webkit-appearance: none; background: none;"></div>
           						</div>
           						<div class="footer">
           							<span class="">
           								<span class="number">{{$data['nbSujets']}}</span>
           								<span class="unit">Sujets</span>

           							</span>
           							<span class="sep"> / </span>
           							<span class="value">
           								<span class="number"><?php echo $data['nbSujetTotal']; ?></span>
           								<span class="unit">Sujets</span>
           							</span>
           						</div>
                           	</div>

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

            <div class="number"><?php echo $data['nbUtilisateurs']; ?><i class=<?php if ($data['nbUtilisateurs'] > 10) {
                    echo "icon-arrow-up";
                } else {
                    echo "icon-arrow-down";
                }?>></i></div>
            <div class="title">Utilisateurs</div>
            <div class="footer">
                <a href="#"> Rapport complet</a>
            </div>
        </div>
        <div class="span3 statbox yellow" style="width: 17%" onTablet="span6" onDesktop="span3">


            <div class="number"><?php echo $data['nbVisites']; ?><i class=<?php if ($data['nbVisites'] > 50) {
                    echo "icon-arrow-up";
                } else {
                    echo "icon-arrow-down";
                }?>></i></div>
            <div class="title">visites</div>
            <div class="footer">
                <a href="#"> Rapport complet</a>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="box black span6" ontablet="span6" ondesktop="span6">
            <div class="box-header">
                <h2><i class="halflings-icon white list"></i><span class="break"></span></h2>

                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div id="tauxActivite" style="width: 100%;  margin: 0 auto"></div>
            </div>
        </div>

        <div class="box black span6" ontablet="span6" ondesktop="span6">
            <div class="box-header">
                <h2><i class="halflings-icon white list"></i><span class="break"></span></h2>

                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div id="chart" style="width: 100%; margin: 0 auto"></div>
            </div>
        </div>
    </div>



    <div class="row-fluid">
        <div class="box black span6" ontablet="span6" ondesktop="span6">
            <div class="box-header">
                <h2><i class="halflings-icon white list"></i><span class="break"></span>Top 5 jours avec le plus d'activités
                </h2>

                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <ul class="dashboard-list metro">
                    <?php
                    $i = 0;
                    foreach ($data['ActivitesMax'] as $d) {
                        echo '<li><a href="#">';
                        echo '<i class="icon-arrow-up green"></i>';

                        echo 'Le ';
                        echo '<strong>';
                        echo $data['DateActiviteMax'][$i];
                        echo '</strong>';

                        echo ' ce qui represente : ';
                        echo '<strong>';
                        echo (int)($d * 100 / $data['TotalActivite']) . '%';
                        echo '</strong>';
                        echo ' de l\'activité du forum';
                        echo '</a>';
                        echo '</li>';

                        $i++;
                    }
                    ?>
                </ul>
            </div>

        </div>

        <div class="box black span6" ontablet="span6" ondesktop="span6">
        <div class="box-header">
            <h2><i class="halflings-icon white list"></i><span class="break"></span>Top 5 jours avec le moins
                d'activités</h2>

            <div class="box-icon">
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <ul class="dashboard-list metro">
                <?php
                $i = 0;
                foreach ($data['ActivitesMin'] as $d) {
                    echo '<li><a href="#">';
                    echo '<i class="icon-arrow-down red"></i>';

                    echo 'Le ';
                    echo '<strong>';
                    echo $data['DateActiviteMin'][$i];
                    echo '</strong>';

                    echo ' ce qui represente : ';
                    echo '<strong>';
                    echo number_format($d * 100 / $data['TotalActivite'], 2) . '%';
                    echo '</strong>';
                    echo ' de l\'activité';
                    echo '</a>';
                    echo '</li>';

                    $i++;
                }
                ?>
            </ul>
        </div>

    </div>
    </div>
    <div class="row-fluid">
        <div class="box black span6" ontablet="span6" ondesktop="span6">
            <div class="box-header">
                <h2><i class="halflings-icon white list"></i><span class="break"></span>Top 5 utilisateurs avec le plus
                    d'activités</h2>

                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <ul class="dashboard-list metro">
                    <?php
                    $i = 0;
                    foreach ($data['MaxNbUserActivite'] as $d) {
                        echo '<li><a href="#">';
                        echo '<i class="icon-arrow-up green"></i>';


                        echo '<strong>';
                        echo $data['MaxUserActivite'][$i];
                        echo '</strong>';

                        echo ' ce qui represente : ';
                        echo '<strong>';
                        echo number_format($d * 100 / $data['TotalActivite'], 2) . '%';
                        echo '</strong>';
                        echo ' de l\'activité';
                        echo '</a>';
                        echo '</li>';

                        $i++;
                    }
                    ?>
                </ul>
            </div>

        </div>

        <div class="box black span6" ontablet="span6" ondesktop="span6">
            <div class="box-header">
                <h2><i class="halflings-icon white list"></i><span class="break"></span>Top 5 utilisateurs avec le moins
                    d'activités</h2>

                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <ul class="dashboard-list metro">
                    <?php
                    $i = 0;
                    foreach ($data['MinNbUserActivite'] as $d) {
                        echo '<li><a href="#">';
                        echo '<i class="icon-arrow-down red"></i>';

                        echo 'Le ';
                        echo '<strong>';
                        echo $data['MinUserActivite'][$i];
                        echo '</strong>';

                        echo ' ce qui represente : ';
                        echo '<strong>';
                        echo number_format($d * 100 / $data['TotalActivite'], 2) . '%';
                        echo '</strong>';
                        echo ' de l\'activité';
                        echo '</a>';
                        echo '</li>';

                        $i++;
                    }
                    ?>
                </ul>
            </div>

        </div>
    </div>

    <div class="row-fluid">
        <div class="box black span6" ontablet="span6" ondesktop="span6">
            <div class="box-header">
                <h2><i class="halflings-icon white list"></i><span class="break"></span>Top 5 Sujets avec le plus
                    d'activités</h2>

                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <ul class="dashboard-list metro">
                    <?php
                    $i = 0;
                    foreach ($data['MaxNbActiviteSujet'] as $d) {
                        echo '<li><a href="#">';
                        echo '<i class="icon-arrow-up green"></i>';


                        echo '<strong>';
                        echo $data['MaxActiviteSujet'][$i];
                        echo '</strong>';

                        echo ' ce qui represente : ';
                        echo '<strong>';
                        echo number_format($d * 100 / $data['TotalActivite'], 2) . '%';
                        echo '</strong>';
                        echo ' de l\'activité';
                        echo '</a>';
                        echo '</li>';

                        $i++;
                    }
                    ?>
                </ul>
            </div>

        </div>

        <div class="box black span6" ontablet="span6" ondesktop="span6">
        <div class="box-header">
            <h2><i class="halflings-icon white list"></i><span class="break"></span>Top 5 sujets avec le moins
                d'activités</h2>

            <div class="box-icon">
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <ul class="dashboard-list metro">
                <?php
                $i = 0;
                foreach ($data['MinNbActiviteSujet'] as $d) {
                    echo '<li><a href="#">';
                    echo '<i class="icon-arrow-down red"></i>';

                    echo 'Le ';
                    echo '<strong>';
                    echo $data['MinActiviteSujet'][$i];
                    echo '</strong>';

                    echo ' ce qui represente : ';
                    echo '<strong>';
                    echo number_format($d * 100 / $data['TotalActivite'], 2) . '%';
                    echo '</strong>';
                    echo ' de l\'activité';
                    echo '</a>';
                    echo '</li>';

                    $i++;
                }
                ?>
            </ul>
        </div>

    </div>
    </div>




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
                            echo '["forum '.$data['idForum'].'",'.($data['nbActiviteForum']/$data['nbActiviteTotal']*100).'],';
                            echo '["reste", '.(100-($data['nbActiviteForum']/$data['nbActiviteTotal']*100)).'],';

                        ?>
                    ]
                }]
            });
        });
        $(function () {
            $('#chart').highcharts({
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
                            enabled: false,
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
                        foreach($data['activities'] as $activity){
                            echo '["'.$activity->titre.'", '.$data['activitiesPercentage'][$activity->titre].'],';
                        }
                        ?>
                    ]
                }]
            });
        });
    </script>
@endsection