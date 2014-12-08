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

    <div id="piechart" style="height:300px"></div>

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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($data['forums'] as $forum){
                                $pourcentage = $data['nbForumMsg'][$forum] * 100/$data['nbMsg'];
                        ?>
                            <tr>
                                <td>
                                    <?php echo $forum; ?>
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
                                    <div class="meter blue"><span style="width: <?php echo $pourcentage;?>%"></span></div>
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

@endsection


@section('scripts')
    <script>
        /* ---------- Pie chart ---------- */

        var data = [
        <?php
        foreach($data['forums'] as $forum){
            $pourcentage = $data['nbForumMsg'][$forum] * 100/$data['nbMsg'];
            echo '{ label: "'.$forum.'", data:'.round($pourcentage).'},';
        }
        ?>
        ];

        	if($("#piechart").length)
        	{
        		$.plot($("#piechart"), data,
        		{
        			series: {
        					pie: {
        							show: true
        					}
        			},
        			grid: {
        					hoverable: true,
        					clickable: true
        			},
        			legend: {
        				show: false
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