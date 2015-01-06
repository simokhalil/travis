@extends('default')

@section('title')
    Liste des Forums
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



    <div class="row-fluid">
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