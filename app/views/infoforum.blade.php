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
         <div class="span3 statbox red" style="width: 17%" onTablet="span6" onDesktop="span3">

                    <div class="number"><?php echo $data['nbSujets']; ?> <i class="icon-folder-open-alt"></i></div>
                    <div class="title">Sujets</div>
                    <div class="footer">
                        <a href="{{URL::to('forums')}}"> Rapport complet</a>
                    </div>
          </div>
        <div class="span3 statbox purple" style="width: 17%" onTablet="span6" onDesktop="span3">

            <div class="number"><?php echo $data['nbReponses']; ?> <i class="icon-ok"></i></div>
            <div class="title">Reponses</div>
            <div class="footer">
                <a href="{{URL::to('forums')}}"> Rapport complet</a>
            </div>
        </div>
        <div class="span3 statbox green" style="width: 17%" onTablet="span6" onDesktop="span3">

            <div class="number"><?php echo $data['nbMsgs']; ?><i class="icon-file-alt"></i></div>
            <div class="title">Messages</div>
            <div class="footer">
                <a href="#"> Rapport complet</a>
            </div>
        </div>
        <div class="span3 statbox blue noMargin" style="width: 17%" onTablet="span6" onDesktop="span3">

            <div class="number"><?php echo $data['nbUtilisateurs']; ?><i class=<?php if($data['nbUtilisateurs']>10)
                                                                                     {
                                                                                     echo "icon-arrow-up";
                                                                                     }
                                                                                     else
                                                                                     {
                                                                                     echo "icon-arrow-down";
                                                                                     }?>></i></div>
            <div class="title">Utilisateurs</div>
            <div class="footer">
                <a href="#"> Rapport complet</a>
            </div>
        </div>
        <div class="span3 statbox yellow" style="width: 17%" onTablet="span6" onDesktop="span3">

            <div class="number"><?php echo $data['nbVisites']; ?><i class=<?php if($data['nbVisites']>50)
                                                                                {
                                                                                    echo "icon-arrow-up";
                                                                                }
                                                                                else
                                                                                {
                                                                                     echo "icon-arrow-down";
                                                                                }?>></i></div>
            <div class="title">visites</div>
            <div class="footer">
                <a href="#"> Rapport complet</a>
            </div>
        </div>

    </div>
    @endsection