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
<div class="row-fluid hideInIE8 circleStats">

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox yellow">
						<div class="header">Forum le plus consulté</div>
						<span class="percent">pourcent</span>
						<div class="circleStat">
                    		<input type="text" value="<?php echo $data['nbVisitesForum'][$data['maxVisites']] * 100/$data['nbVisites']?>" class="whiteCircle" />
						</div>
						<div class="footer">


							<span class="value">
							    <span class="unit">Forum </span>
								<span class="number">{{$data['maxVisites']}}</span>

							</span>
                            <span class="sep"> : </span>
							<span >
                            	<span class="number">{{$data['nbVisitesForum'][$data['maxVisites']]}}</span>
                            	<span class="unit">visites</span>
                            </span>
						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox green">
						<div class="header">Max de messages</div>
						<span class="percent">pourcent</span>
						<div class="circleStat">
                    		<input type="text" value="<?php echo $data['nbForumMsg'][$data['maxMsgs']] * 100/$data['nbMsg']?>" class="whiteCircle" />
						</div>
						<div class="footer">


                        							<span class="value">
                        							    <span class="unit">Forum </span>
                        								<span class="number">{{$data['maxMsgs']}}</span>

                        							</span>
                                                    <span class="sep"> : </span>
                        							<span >
                                                    	<span class="number">{{$data['nbForumMsg'][$data['maxMsgs']]}}</span>
                                                    	<span class="unit">msg</span>
                                                    </span>
                        						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox red">
						<div class="header">Max de sujets</div>
						<span class="percent">pourcent</span>
                    	<div class="circleStat">
                    		<input type="text" value="<?php echo $data['nbSujetsForum'][$data['maxSujets']] * 100/$data['nbSujets']?>" class="whiteCircle" />
						</div>
						<div class="footer">


                        							<span class="value">
                        							    <span class="unit">Forum </span>
                        								<span class="number">{{$data['maxSujets']}}</span>

                        							</span>
                                                    <span class="sep"> : </span>
                        							<span >
                                                    	<span class="number">{{$data['nbSujetsForum'][$data['maxSujets']]}}</span>
                                                    	<span class="unit">sujets</span>
                                                    </span>
                        						</div>
                	</div>
				</div>

				<div class="span2 noMargin" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox pink">
						<div class="header">Max de reponses</div>
						<span class="percent">pourcent</span>
                    	<div class="circleStat">
                    		<input type="text" value="<?php echo $data['nbReponsesForum'][$data['maxReponses']] * 100/$data['nbReponses']?>" class="whiteCircle" />
						</div>
						<div class="footer">


                        							<span class="value">
                        							    <span class="unit">Forum </span>
                        								<span class="number">{{$data['maxReponses']}}</span>

                        							</span>
                                                    <span class="sep"> : </span>
                        							<span >
                                                    	<span class="number">{{$data['nbReponsesForum'][$data['maxReponses']]}}</span>
                                                    	<span class="unit">rep</span>
                                                    </span>
                        						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox blue">
						<div class="header">Max d'upload</div>
						<span class="percent">pourcent</span>
                    	<div class="circleStat">
                    		<input type="text" value="<?php echo $data['nbUploadsForum'][$data['maxUploads']] * 100/$data['nbUploads']?>" class="whiteCircle" />
						</div>
						<div class="footer">


                        							<span class="value">
                        							    <span class="unit">Forum </span>
                        								<span class="number">{{$data['maxUploads']}}</span>

                        							</span>
                                                    <span class="sep"> : </span>
                        							<span >
                                                    	<span class="number">{{$data['nbUploadsForum'][$data['maxUploads']]}}</span>
                                                    	<span class="unit">uploads</span>
                                                    </span>
                        						</div>
                	</div>
				</div>

				<div class="span2" onTablet="span4" onDesktop="span2">
                	<div class="circleStatsItemBox green">
						<div class="header">Max Citations</div>
						<span class="percent">percent</span>
                    	<div class="circleStat">
                    		<input type="text" value="<?php echo $data['nbCitationsForum'][$data['maxCitations']] * 100/$data['nbCitation']?>" class="whiteCircle" />
						</div>
					<div class="footer">


                    							<span class="value">
                    							    <span class="unit">Forum </span>
                    								<span class="number">{{$data['maxCitations']}}</span>

                    							</span>
                                                <span class="sep"> : </span>
                    							<span >
                                                	<span class="number">{{$data['nbCitationsForum'][$data['maxVisites']]}}</span>
                                                	<span class="unit">Cit</span>
                                                </span>
                    						</div>
                	</div>
				</div>

</div>

    <div class="row-fluid">
        <div class="box black span12" ontablet="span6" ondesktop="span12">
            <div class="box-header">
                <h2><i class="halflings-icon white list"></i><span class="break"></span></h2>

                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div id="container" style="width: 100%; min-height: 500px; margin: 0 auto"></div>
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
                <div id="ActivitesForum" style="min-width: 310px; height: 800px; margin: 0 auto"></div>
            </div>
        </div>
    </div>

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
                                                <a href="<?php echo "forum/".$forum?>"><?php echo $forum; ?></a>
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
                                                <div class="meter blue"><span <?php echo 'style="width:'.$pourcentage.'%"';?>></span></div>
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
                    type: 'column',
                    zoomType:'x'
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