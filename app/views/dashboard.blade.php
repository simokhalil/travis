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
                <a href="{{URL::to('forums')}}"> Rapport complet</a>
            </div>
        </div>
        <div class="span3 statbox green" onTablet="span6" onDesktop="span3">
            <div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
            <div class="number"><?php echo $data['nbMsg']; ?> <i class="icon-file-alt"></i></div>
            <div class="title">Messages</div>
            <div class="footer">
                <a href="#"> Rapport complet</a>
            </div>
        </div>
        <div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
            <div class="boxchart">5,6,7,2,0,-4,-2,4,8,2,3,3,2</div>
            <div class="number"><?php echo $data['nbUsers']; ?><i class="icon-arrow-up"></i></div>
            <div class="title">Utilisateurs</div>
            <div class="footer">
                <a href="#"> Rapport complet</a>
            </div>
        </div>
        <div class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
            <div class="boxchart">7,2,2,2,1,-4,-2,4,8,,0,3,3,5</div>
            <div class="number">678<i class="icon-arrow-down"></i></div>
            <div class="title">visits</div>
            <div class="footer">
                <a href="#"> Rapport complet</a>
            </div>
        </div>

    </div>

    <h2>Activités</h2>
    <div id="piechart" style="height:300px"></div>
@endsection


@section('scripts')
    <script>
        /* ---------- Pie chart ---------- */

        var data = [
        <?php
        foreach($data['activities'] as $activity){
            echo '{ label: "'.$activity->titre.'", data:'.$data['activitiesPercentage'][$activity->titre].'},';
        }
        ?>
        ];

            if($("#piechart").length)
            {
                $.plot($("#piechart"), data,
                {
                    series: {
                            pie: {
                                show: true,
                                radius: 1,
                                tilt: 0.5
                            }
                    },
                    grid: {
                        hoverable: true,
                        clickable: true
                    },
                    legend: {
                        show: true
                    },
                    colors: ["#FA5833", "#2FABE9", "#FABB3D", "#78CD51"]
                });

                function pieHover(event, pos, obj)
                {
                    if (!obj)
                            return;
                    percent = parseFloat(obj.series.percent).toFixed(2);
                    $("#hover").html('<span style="font-weight: bold; color: '+obj.series.color+'">'+obj.series.label+' ('+percent+'%)</span>');
                }
                $("#piechart").bind("plothover", pieHover);
            }
    </script>
@endsection