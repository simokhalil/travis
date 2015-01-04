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
 {{ Form::open(array('url' =>  'users')) }}
        {{ Form::label('nom', 'Entrez votre nom : ') }}
        {{ Form::text('nom') }}
        {{ Form::submit('Envoyer !') }}
 {{ Form::close() }}
<div class="sparkLineStats span4 widget green" onTablet="span5" onDesktop="span4">

    <ul class="unstyled">

        <li><input type="text"  value="<?php
            //echo $data['nbVisitesForum'][$data['maxVisites']] * 100/$data['nbVisites']?>" class="whiteCircle" readonly="readonly" style="width: 60px; position: absolute; margin-top: 42.8571428571429px; margin-left: -90px; font-size: 30px; border: none; font-family: Arial; font-weight: bold; text-align: center; color: rgba(255, 255, 255, 0.901961); padding: 0px; -webkit-appearance: none; background: none;">
            Le plus actif:
            <span class="number"><?php //echo $data['maxVisites'] ?></span>
        </li>
        <li><input type="text"  value="<?php
            //echo $data['nbForumMsg'][$data['maxMsgs']] * 100/$data['nbMsg']?>" class="whiteCircle" readonly="readonly" style="width: 60px; position: absolute; margin-top: 42.8571428571429px; margin-left: -90px; font-size: 30px; border: none; font-family: Arial; font-weight: bold; text-align: center; color: rgba(255, 255, 255, 0.901961); padding: 0px; -webkit-appearance: none; background: none;"></span>

            Postant le plus de messages:
            <span class="number"><?php //echo $data['maxMsgs'] ?></span>
        </li>
        <li><input type="text"  value="<?php
            //echo $data['nbSujetsForum'][$data['maxSujets']] * 100/$data['nbSujets']?>" class="whiteCircle" readonly="readonly" style="width: 60px; position: absolute; margin-top: 42.8571428571429px; margin-left: -90px; font-size: 30px; border: none; font-family: Arial; font-weight: bold; text-align: center; color: rgba(255, 255, 255, 0.901961); padding: 0px; -webkit-appearance: none; background: none;"></span>

            Postant le plus de sujets:
            <span class="number"><?php //echo $data['maxSujets'] ?></span>
        </li>
        <li><input type="text"  value="<?php
            //echo $data['nbReponsesForum'][$data['maxReponses']] * 100/$data['nbReponses']?>" class="whiteCircle" readonly="readonly" style="width: 60px; position: absolute; margin-top: 42.8571428571429px; margin-left: -90px; font-size: 30px; border: none; font-family: Arial; font-weight: bold; text-align: center; color: rgba(255, 255, 255, 0.901961); padding: 0px; -webkit-appearance: none; background: none;"></span>

            Passant le plus de temps sur le site: <span class="number"><?php //echo $data['maxReponses'] ?></span>
        </li>


    </ul>

    <div class="clearfix"></div>

</div><!-- End .sparkStats -->
@endsection