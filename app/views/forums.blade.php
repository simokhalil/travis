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




                      <div id="container" style="width: 100%; min-height: 500px; margin: 0 auto"></div>


        </div>
    </div>

@endsection


@section('scripts')
    <script>
        /* ---------- Pie chart ---------- */

       $(function () {

        $('#container').highcharts({
               title: {
                   text: 'Chart reflow is set to true'
               },

               subtitle: {
                   text: 'When resizing the window or the frame, the chart should resize'
               },


               xAxis: {
                   type: 'datetime'
               },

               series: [{
                   data: [<?php
                            foreach($data['activites'] as $activite){
                             echo '[Date.UTC('.$activite[0]->format('Y,m,d').'),'.$activite[1].'],';
                             }
                          ?>  ]
               }]
           });
          });

    </script>
@endsection