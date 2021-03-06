@extends('default')

@section('title')
    Informations utilisateur
@endsection


@section('content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}">Dashboard</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <a href="{{URL::to('/users')}}">Utilisateurs</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#"><?php echo $data['user'] ?></a></li>
    </ul>


    <div class="span4 statbox red" onTablet="span6" onDesktop="span3">

        <div class="number"><?php echo $data['ActivitesUser']['PosterNouveauMessage'][$data['user']]; ?> <i
                    class="icon-folder-open-alt"></i></div>
        <div class="title">Sujets</div>
        <div class="footer">
            <a href="{{URL::to('users')}}"> Rapport complet</a>
        </div>
    </div>
    <div class="span4 statbox purple" onTablet="span6" onDesktop="span3">

        <div class="number"><?php echo $data['ActivitesUser']['RepondreMessage'][$data['user']] ?> <i
                    class="icon-ok"></i>
        </div>
        <div class="title">Reponses</div>
        <div class="footer">
            <a href="{{URL::to('users')}}"> Rapport complet</a>
        </div>
    </div>
    <div class="span4 statbox green" onTablet="span6" onDesktop="span3">

        <div class="number"><?php echo $data['ActivitesUser']['nbUserMsg'][$data['user']]; ?><i
                    class="icon-file-alt"></i>
        </div>
        <div class="title">Messages</div>
        <div class="footer">
            <a href="#"> Rapport complet</a>
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
                <h2><i class="halflings-icon white list"></i><span class="break"></span>Top 5 jours avec le plus
                    d'activités
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
                        echo ' de l\'activité de l\'utilisateur';
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
                <h2><i class="halflings-icon white list"></i><span class="break"></span>Top 5 des forums avec le plus
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
                    foreach ($data['MaxNbForumActivite'] as $d) {
                        if ($data['MaxForumActivite'][$i] != "") {
                            echo '<li><a href="#">';
                            echo '<i class="icon-arrow-up green"></i>';

                            echo 'Le ';
                            echo '<strong>';
                            echo $data['MaxForumActivite'][$i];
                            echo '</strong>';

                            echo ' ce qui represente : ';
                            echo '<strong>';
                            echo number_format($d * 100 / $data['TotalActivite'], 2) . '%';
                            echo '</strong>';
                            echo ' de l\'activité';
                            echo '</a>';
                            echo '</li>';


                        } elseif ($i == 0) {
                            echo '<li><a><i class="icon-arrow-up green"></i>';
                            echo 'Aucune donnée à afficher';
                            echo '</a></li>';
                        }
                        $i++;
                    }
                    ?>
                </ul>
            </div>

        </div>

        <div class="box black span6" ontablet="span6" ondesktop="span6">
            <div class="box-header">
                <h2><i class="halflings-icon white list"></i><span class="break"></span>Top 5 des forums avec le moins
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
                    foreach ($data['MinNbForumActivite'] as $d) {
                        if ($data['MinForumActivite'][$i] != "") {
                            echo '<li><a href="#">';
                            echo '<i class="icon-arrow-down red"></i>';

                            echo 'Le ';
                            echo '<strong>';
                            echo $data['MinForumActivite'][$i];
                            echo '</strong>';

                            echo ' ce qui represente : ';
                            echo '<strong>';
                            echo number_format($d * 100 / $data['TotalActivite'], 2) . '%';
                            echo '</strong>';
                            echo ' de l\'activité';
                            echo '</a>';
                            echo '</li>';


                        } elseif ($i == 0) {
                            echo '<li><a><i class="icon-arrow-up green"></i>';
                            echo 'Aucune donnée à afficher';
                            echo '</a></li>';
                        }
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
                        if (isset($data['MaxActiviteSujet'][$i])) {
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


                        } elseif ($i == 0) {
                            echo '<li><a><i class="icon-arrow-up green"></i>';
                            echo 'Aucune donnée à afficher';
                            echo '</a></li>';
                        }
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
                        if (isset($data['MinActiviteSujet'][$i])) {
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
                        } elseif ($i == 0) {
                            echo '<li><a><i class="icon-arrow-up green"></i>';
                            echo 'Aucune donnée à afficher';
                            echo '</a></li>';
                        }

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
                    text: 'Activité de l\'utilisateur'
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
                series: [
                    {
                        type: 'pie',
                        name: 'Taux d\'activité',
                        data: [
                            <?php
                                echo '["Utilisateur '.$data['user'].'",'.($data['nbActiviteUser']/$data['nbActiviteTotal']*100).'],';
                                echo '["reste", '.(100-($data['nbActiviteUser']/$data['nbActiviteTotal']*100)).'],';

                            ?>
                        ]
                    }
                ]
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
                    text: 'Répartition des activités de l\'utilisateur'
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