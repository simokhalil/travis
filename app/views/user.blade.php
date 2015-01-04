@extends('default')
@section('title')
Users
@endsection
@section('content')
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="{{URL::to('/')}}">Dashboard</a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">Utilisateurs</a></li>
</ul>
 {{ Form::open(array('url' =>  'user')) }}
        {{ Form::label('nom', 'Entrez votre nom : ') }}
        {{ Form::text('nom') }}
        {{ Form::submit('Envoyer !') }}
 {{ Form::close() }}
<div class="sparkLineStats span4 widget green" onTablet="span5" onDesktop="span4">

    <ul class="unstyled">

        <li><input type="text"  value="<?php
            echo $data['nbMostActiveUser'] * 100/$data['maxActivities']?>" class="whiteCircle" readonly="readonly" style="width: 60px; position: absolute; margin-top: 42.8571428571429px; margin-left: -90px; font-size: 30px; border: none; font-family: Arial; font-weight: bold; text-align: center; color: rgba(255, 255, 255, 0.901961); padding: 0px; -webkit-appearance: none; background: none;">
            Le plus actif:
            <span class="number"><?php echo $data['mostActiveUser'] ?></span>
        </li>
        <li><input type="text"  value="<?php
            echo $data['nbMostMessageUser'] * 100/$data['maxMessage']?>" class="whiteCircle" readonly="readonly" style="width: 60px; position: absolute; margin-top: 42.8571428571429px; margin-left: -90px; font-size: 30px; border: none; font-family: Arial; font-weight: bold; text-align: center; color: rgba(255, 255, 255, 0.901961); padding: 0px; -webkit-appearance: none; background: none;"></span>

            Répondant au plus de messages:
            <span class="number"><?php echo $data['mostMessageUser'] ?></span>
        </li>
        <li><input type="text"  value="<?php
            echo $data['nbMostSujetUser'] * 100/$data['maxSujet']?>" class="whiteCircle" readonly="readonly" style="width: 60px; position: absolute; margin-top: 42.8571428571429px; margin-left: -90px; font-size: 30px; border: none; font-family: Arial; font-weight: bold; text-align: center; color: rgba(255, 255, 255, 0.901961); padding: 0px; -webkit-appearance: none; background: none;"></span>

            Postant le plus de sujets:
            <span class="number"><?php echo $data['mostSujetUser'] ?></span>
        </li>
        <li><input type="text"  value="<?php
            echo $data['nbMostDelaiUser'] * 100/$data['maxDelai']?>" class="whiteCircle" readonly="readonly" style="width: 60px; position: absolute; margin-top: 42.8571428571429px; margin-left: -90px; font-size: 30px; border: none; font-family: Arial; font-weight: bold; text-align: center; color: rgba(255, 255, 255, 0.901961); padding: 0px; -webkit-appearance: none; background: none;"></span>

            Passant le plus de temps sur le site: <span class="number"><?php echo $data['mostDelaiUser'] ?></span>
        </li>


    </ul>

    <div class="clearfix"></div>


</div><!-- End .sparkStats -->
<div id="ActivitesUsers" style="min-width: 310px; height: 800px; margin-bottom: 25%"></div>

<div class="box-content">
    <table class="table table-striped table-bordered bootstrap-datatable datatable">
        <thead>
        <tr>
            <th>Utilisateur</th>
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
        //ig
        foreach($data['Users'] as $u){
            $pourcentage = $data['ActivitesUser']['nbUserMsg'][$u] * 100/$data['nbMsg'];
            ?>
            <tr>
                <td>
                    <a href="<?php echo "/travis/public/user/".$u?>"><?php echo $u; ?></a>
                </td>
                <td>
                    <?php echo $data['ActivitesUser']['nbUserMsg'][$u]; ?>
                </td>
                <td>
                    <?php echo $data['ActivitesUser']['PosterNouveauMessage'][$u]; ?>
                </td>
                <td>
                    <?php echo $data['ActivitesUser']['RepondreMessage'][$u]; ?>
                </td>
                <td>
                    <?php echo $data['ActivitesUser']['AfficherContenuMessage'][$u]; ?>
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
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#ActivitesUsers').highcharts({
                chart: {
                    type: 'column'
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
                        text: 'Total fruit consumption'
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