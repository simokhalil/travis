@extends('default')

@section('title')
    Informations forum
@endsection

@section('styles')

@endsection

@section('content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="#">Dashboard</a>
            <i class="icon-angle-right"></i>
             <a href="#">Forums</a>
             <i class="icon-angle-right"></i>
            <a href="#">{{$data['idForum']}}</a>
        </li>
    </ul>
<h2 style="align-items: center">Forum : {{$data['idForum']}}</h2>
<div class="row-fluid hideInIE8 circleStats">

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox yellow">
						<div class="header">Sujets</div>
						<span class="percent">pourcent</span>
						<div class="circleStat">
                    		<input type="text" value="<?php echo $data['nbSujets'] * 100/$data['nbSujetTotal']?>" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">{{$data['nbSujets']}}</span>
								<span class="unit">MB</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">{{$data['nbSujetTotal']}}</span>
								<span class="unit">MB</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox green">
						<div class="header">Messages</div>
						<span class="percent">pourcent</span>
						<div class="circleStat">
                    		<input type="text" value="<?php echo $data['nbMsgs'] * 100/$data['nbMsgTotal']?>" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">{{$data['nbMsgs']}}</span>
								<span class="unit">Msgs</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">{{$data['nbMsgTotal']}}</span>
								<span class="unit">Msgs</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox red">
						<div class="header">Réponses</div>
						<span class="percent">pourcent</span>
                    	<div class="circleStat">
                    		<input type="text" value="<?php echo $data['nbReponses'] * 100/$data['nbReponseTotal']?>" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">{{$data['nbReponses']}}</span>
								<span class="unit">Rep</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">{{$data['nbReponseTotal']}}</span>
								<span class="unit">Rep</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2 noMargin" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox pink">
						<div class="header">Utilisateurs</div>
						<span class="percent">pourcent</span>
                    	<div class="circleStat">
                    		<input type="text" value="<?php echo $data['nbUtilisateurs'] * 100/$data['nbUserTotal']?>" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number"> {{$data['nbUtilisateurs']}}</span>
								<span class="unit">Users</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">{{$data['nbUserTotal']}}</span>
								<span class="unit">Users</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox blue">
						<div class="header">Visites</div>
						<span class="percent">pourcent</span>
                    	<div class="circleStat">
                    		<input type="text" value="<?php echo $data['nbVisites'] * 100/$data['nbVisiteTotal']?>" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
								<span class="number">{{$data['nbVisites']}}</span>
								<span class="unit">V</span>
							</span>
							<span class="sep"> / </span>
							<span class="value">
								<span class="number">{{$data['nbVisiteTotal']}}</span>
								<span class="unit">V</span>
							</span>
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox green">
						<div class="header">Uploads</div>
						<span class="percent">pourcent</span>
                    	<div class="circleStat">
                    		<input type="text" value="<?php echo $data['nbUploads'] * 100/$data['nbUploadTotal']?>" class="whiteCircle" />
						</div>
						<div class="footer">
							<span class="count">
                            								<span class="number">{{$data['nbUploads']}}</span>
                            								<span class="unit">V</span>
                            							</span>
                            							<span class="sep"> / </span>
                            							<span class="value">
                            								<span class="number">{{$data['nbUploadTotal']}}</span>
                            								<span class="unit">V</span>
                            							</span>
							</span>
						</div>
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
        <div id="timeline">
            <!-- Timeline.js will genereate the markup here -->
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
                    text: 'Rapport d\'activités'
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
                    text: 'Répartition des activités sur le forum'
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

   {{HTML::script("js/jquery.circliful.min.js")}}
@endsection