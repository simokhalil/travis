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
        <li>
            <a href="#">Forums</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Liste des forums</a></li>
    </ul>


    <h1>Liste des forums</h1>


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


@endsection