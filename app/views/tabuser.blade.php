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
        <li>
            <a href="#">Utilisateurs</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Liste des utilisateurs</a></li>
    </ul>

    <h1>Liste des utilisateurs</h1>
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
                    <a href="<?php echo "user/".$u?>"><?php echo $u; ?></a>
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
@endsection