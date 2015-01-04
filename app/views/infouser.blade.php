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


<div class="span3 statbox red" style="width: 17%" onTablet="span6" onDesktop="span3">

    <div class="number"><?php //echo $data['nbSujets']; ?> <i class="icon-folder-open-alt"></i></div>
    <div class="title">Sujets</div>
    <div class="footer">
        <a href="{{URL::to('forums')}}"> Rapport complet</a>
    </div>
</div>
<div class="span3 statbox purple" style="width: 17%" onTablet="span6" onDesktop="span3">

    <div class="number"><?php// echo $data['nbReponses']; ?> <i class="icon-ok"></i></div>
    <div class="title">Reponses</div>
    <div class="footer">
        <a href="{{URL::to('forums')}}"> Rapport complet</a>
    </div>
</div>
<div class="span3 statbox green" style="width: 17%" onTablet="span6" onDesktop="span3">

    <div class="number"><?php //echo $data['nbMsgs']; ?><i class="icon-file-alt"></i></div>
    <div class="title">Messages</div>
    <div class="footer">
        <a href="#"> Rapport complet</a>
    </div>
</div>

@endsection