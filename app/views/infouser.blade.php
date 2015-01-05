@extends('default')

@section('title')
    Info User
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


<div class="span3 statbox red" style="width: 25%" onTablet="span6" onDesktop="span3">

    <div class="number"><?php echo $data['ActivitesUser']['PosterNouveauMessage'][$data['user']]; ?> <i class="icon-folder-open-alt"></i></div>
    <div class="title">Sujets</div>
    <div class="footer">
        <a href="{{URL::to('users')}}"> Rapport complet</a>
    </div>
</div>
<div class="span3 statbox purple" style="width: 25%" onTablet="span6" onDesktop="span3">

    <div class="number"><?php echo $data['ActivitesUser']['RepondreMessage'][$data['user']] ?> <i class="icon-ok"></i></div>
    <div class="title">Reponses</div>
    <div class="footer">
        <a href="{{URL::to('users')}}"> Rapport complet</a>
    </div>
</div>
<div class="span3 statbox green" style="width: 25%" onTablet="span6" onDesktop="span3">

    <div class="number"><?php echo $data['ActivitesUser']['nbUserMsg'][$data['user']]; ?><i class="icon-file-alt"></i></div>
    <div class="title">Messages</div>
    <div class="footer">
        <a href="#"> Rapport complet</a>
    </div>
</div>

<div id="tauxActivite" style="width: 100%;  margin: 0 auto"></div>
<div class="box black span4" ontablet="span6" ondesktop="span4">
    <div class="box-header">
        <h2><i class="halflings-icon white list"></i><span class="break"></span>Top 5 jours avec le plus d'activités</h2>
        <div class="box-icon">
            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
        </div>
    </div>
    <div class="box-content">
        <ul class="dashboard-list metro">
            <?php
            $i=0;
            foreach($data['ActivitesMax'] as $d){
                echo '<li><a href="#">';
                echo '<i class="icon-arrow-up green"></i>';

                echo 'Le ';
                echo '<strong>';
                echo $data['DateActiviteMax'][$i];
                echo '</strong>';

                echo ' ce qui represente : ';
                echo '<strong>';
                echo (int)($d * 100/$data['TotalActivite']).'%';
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
                        echo '["Utilisateur '.$data['user'].'",'.($data['nbActiviteUser']/$data['nbActiviteTotal']*100).'],';
                        echo '["reste", '.(100-($data['nbActiviteUser']/$data['nbActiviteTotal']*100)).'],';

                    ?>
                ]
            }]
        });
    });
</script>
@endsection