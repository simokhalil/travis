@extends('default')
@section('title')
Utilisateurs
@endsection
@section('content')
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="{{URL::to('/')}}">Dashboard</a>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <a href="#">Utilisateurs</a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">Récapitulatif</a></li>
</ul>

<div class="row-fluid hideInIE8 circleStats">
    <div class="span3" onTablet="span4" onDesktop="span3">
        <div class="circleStatsItemBox yellow">
            <div class="header">Le plus actif</div>
            <span class="percent">{{$data['mostActiveUser']}}</span>
            <div class="circleStat">
                <input type="text" value="<?php echo $data['nbMostActiveUser'] * 100/$data['maxActivities']; ?>" class="whiteCircle" />
            </div>
            <div class="footer">


							<span class="value">

								<span class="number">{{$data['nbMostActiveUser']}}</span>
                                <span class="unit">activités</span>
							</span>
                <span class="sep"> / </span>
							<span >
                            	<span class="number">{{$data['maxActivities']}}</span>
                            	<span class="unit"></span>
                            </span>
            </div>
        </div>
    </div>

    <div class="span3" onTablet="span4" onDesktop="span3">
        <div class="circleStatsItemBox green">
            <div class="header">Le plus répondant</div>
            <span class="percent">{{$data['mostMessageUser']}}</span>
            <div class="circleStat">
                <input type="text" value="<?php echo $data['nbMostMessageUser'] * 100/$data['maxMessage']; ?>" class="whiteCircle" />
            </div>
            <div class="footer">


							<span class="value">

								<span class="number">{{$data['nbMostMessageUser']}}</span>
                                <span class="unit">réponses</span>
							</span>
                <span class="sep"> / </span>
							<span >
                            	<span class="number">{{$data['maxMessage']}}</span>
                            	<span class="unit"></span>
                            </span>
            </div>
        </div>
    </div>

    <div class="span3" onTablet="span4" onDesktop="span3">
        <div class="circleStatsItemBox red">
            <div class="header">Le plus posteur</div>
            <span class="percent">{{$data['mostSujetUser']}}</span>
            <div class="circleStat">
                <input type="text" value="<?php echo $data['nbMostSujetUser'] * 100/$data['maxSujet']; ?>" class="whiteCircle" />
            </div>
            <div class="footer">


							<span class="value">

								<span class="number">{{$data['nbMostSujetUser']}}</span>
                                <span class="unit">sujets</span>
							</span>
                <span class="sep"> / </span>
							<span >
                            	<span class="number">{{$data['maxSujet']}}</span>
                            	<span class="unit"></span>
                            </span>
            </div>
        </div>
    </div>

    <div class="span3" onTablet="span4" onDesktop="span3">
        <div class="circleStatsItemBox blue">
            <div class="header">Le plus campeur</div>
            <span class="percent">{{$data['mostDelaiUser']}}</span>
            <div class="circleStat">
                <input type="text" value="<?php echo $data['nbMostDelaiUser'] * 100/$data['maxDelai']; ?>" class="whiteCircle" />
            </div>
            <div class="footer">


							<span class="value">
                                <?php
                                    $hours = floor($data['nbMostDelaiUser'] / 3600);
                                    $mins = floor(($data['nbMostDelaiUser'] - ($hours*3600)) / 60);
                                    $secs = floor($data['nbMostDelaiUser'] % 60);
                                ?>
								<span class="number">{{$hours}}h{{$mins}}min{{$secs}}s</span>
                                <span class="unit"></span>
							</span>
                <span class="sep"></span>
							<span >
                            	<span class="number"></span>
                            	<span class="unit"></span>
                            </span>
            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="box black span12" ontablet="span6" ondesktop="span12">
        <div class="box-header">
            <h2><i class="halflings-icon white list"></i><span class="break"></span>Activités</h2>

            <div class="box-icon">
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>INFO!</strong> Vous pouvez zoomer sur ce graphique en séléctionnat une plage verticale.<br />
                Vous pouvez également séléctionner les éléments à afficher/masquer en cliquent sur les labels dans la légende.
            </div>
            <div id="ActivitesUsers" style="min-width: 310px; height: 800px;"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#ActivitesUsers').highcharts({
                chart: {
                    type: 'column',
                     zoomType:'x'
                },
                title: {
                    text: 'Activités pour chaque utilisateur'
                },
                xAxis: {
                    categories: [<?php
                        foreach($data['Users'] as $u)
                            echo'"'.$u.'", ';
                    ?>
                    ]
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total activités'
                    },
                    stackLabels: {
                        enabled: false,
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
                            enabled: false,
                            color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                            style: {
                                textShadow: '0 0 3px black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Afficher une structure (cours/forum)',
                    data: [<?php
                            $activitesUser = $data["ActivitesUser"];
                            foreach($data['Users'] as $u){
                                echo $activitesUser["AfficherStructure"][$u].', ';

                            }
                        ?>]
                }, {
                    name: 'Répondre à un message',
                    data: [<?php
                            $activitesUser = $data["ActivitesUser"];
                            foreach($data['Users'] as $u){
                                echo $activitesUser["RepondreMessage"][$u].', ';

                            }
                        ?>]
                }, {
                    name: 'Afficher le fil de discussion',
                    data: [<?php
                            $activitesUser = $data["ActivitesUser"];
                            foreach($data['Users'] as $u){
                                echo $activitesUser["AfficherFilDiscussion"][$u].', ';

                            }
                        ?>]
                }, {
                    name: 'Poster un nouveau message',
                    data: [<?php
                            $activitesUser = $data["ActivitesUser"];
                            foreach($data['Users'] as $u){
                                echo $activitesUser["PosterNouveauMessage"][$u].', ';

                            }
                        ?>]
                }, {
                    name: 'Afficher le contenu d\'un message',
                    data: [<?php
                            $activitesUser = $data["ActivitesUser"];
                            foreach($data['Users'] as $u){
                                echo $activitesUser["AfficherContenuMessage"][$u].', ';

                            }
                        ?>]
                }, {
                    name: 'Bouger la scrollbar en bas - afficher la fin du message',
                    data: [<?php
                            $activitesUser = $data["ActivitesUser"];
                            foreach($data['Users'] as $u){
                                echo $activitesUser["BougerScrollbarEnBasEtAfficherFinMessage"][$u].', ';

                            }
                        ?>]
                }, {
                    name: 'Citer un message',
                    data: [<?php
                            $activitesUser = $data["ActivitesUser"];
                            foreach($data['Users'] as $u){
                                echo $activitesUser["CiterMessage"][$u].', ';

                            }
                        ?>]
                }, {
                    name: 'Bouger la scrollbar en bas',
                    data: [<?php
                            $activitesUser = $data["ActivitesUser"];
                            foreach($data['Users'] as $u){
                                echo $activitesUser["BougerScrollbarBas"][$u].', ';

                            }
                        ?>]
                }, {
                    name: 'Download un fichier dans le message',
                    data: [<?php
                            $activitesUser = $data["ActivitesUser"];
                            foreach($data['Users'] as $u){
                                echo $activitesUser["DownloaFichierMessage"][$u].', ';

                            }
                        ?>]
                }]
            });
        });
    </script>
@endsection