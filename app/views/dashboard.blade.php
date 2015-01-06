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

        <div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
            <div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div>
            <div class="number"><?php echo $data['nbForums']; ?> <i class="icon-folder-open-alt"></i></div>
            <div class="title">Forums</div>
            <div class="footer">
                <a href="{{URL::to('report/forums')}}"> Voir les détails</a>
            </div>
        </div>
        <div class="span3 statbox green" onTablet="span6" onDesktop="span3">
            <div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
            <div class="number"><?php echo $data['nbMsg']; ?> <i class="icon-file-alt"></i></div>
            <div class="title">Messages</div>
            <div class="footer">
                <a href="{{URL::to('report/date')}}"> Voir les détails</a>
            </div>
        </div>
        <div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
            <div class="boxchart">5,6,7,2,0,-4,-2,4,8,2,3,3,2</div>
            <div class="number"><?php echo $data['nbUsers']; ?><i class="icon-arrow-up"></i></div>
            <div class="title">Utilisateurs</div>
            <div class="footer">
                <a href="{{URL::to('users')}}"> Voir les détails</a>
            </div>
        </div>
        <div class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
            <div class="boxchart">7,2,2,2,1,-4,-2,4,8,,0,3,3,5</div>
            <div class="number">678<i class="icon-arrow-down"></i></div>
            <div class="title">visites</div>
            <div class="footer">
                <a href="#"> </a>
            </div>
        </div>

    </div>

    <h2>Activités</h2>
    <!--<div id="piechart" style="height:300px"></div>-->
    <div id="chart" style="width: 100%; min-height: 500px; margin: 0 auto"></div>
@endsection


@section('scripts')
    <script>
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