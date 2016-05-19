<?php
if (isset($bezoekers)) {
    // alle 24 u in label zetten
    $labels = '';
    $data = '';
    $datahitsvandaag = '';
    $dataGisteren = '';
    for ($x = 0; $x <= 24; $x++) {
        $labels .= '"' . $x . 'u", ';

        $aantalopuur = 0;
        $aantalopuurGisteren = 0;
        $aantalhitsopuur = 0;
        foreach ($bezoekers as $bezoeker) {
            $time = strtotime($bezoeker->bezoekdatum);
            $newformat = date('H', $time);
            if ($newformat == $x) {
                $aantalopuur++;                
            }
        }
        $data .= $aantalopuur . ', ';        
        
        foreach ($bezoekersGisteren as $bezoeker) {
            $time = strtotime($bezoeker->bezoekdatum);
            $newformat = date('H', $time);
            if ($newformat == $x) {                
                $aantalopuurGisteren++;
            }
        }
        $dataGisteren .= $aantalopuurGisteren . ', ';
        
        foreach ($bezoekerhitsvandaag as $bezoeker) {
            $time = strtotime($bezoeker->bezoekdatum);
            $newformat = date('H', $time);
            if ($newformat == $x) {                
                $aantalhitsopuur++;
            }
        }
        $datahitsvandaag .= $aantalhitsopuur . ', ';
    }
    $labels = substr($labels, 0, -2);
    $data = substr($data, 0, -2);
    $datahitsvandaag = substr($datahitsvandaag, 0, -2);
    $dataGisteren = substr($dataGisteren, 0, -2);
    
    
    $datahits = '';
    $databezoekersall = '';
    for ($x = 1; $x <= 12; $x++) {
        $aantalhitsopmaand = 0;
        foreach ($bezoekerhitsall as $bezoeker) {
            $time = strtotime($bezoeker->bezoekdatum);
            $newformat = date('m', $time);
            $year = date('Y', $time);
            $currentYear = date("Y");
            if ($newformat == $x && $currentYear = $year) {
                $aantalhitsopmaand++;                
            }
        }
        $datahits .= $aantalhitsopmaand . ', ';
        
        $aantalbezoekersopmaand = 0;
        foreach ($bezoekersall as $bezoeker) {
            $time = strtotime($bezoeker->bezoekdatum);
            $newformat = date('m', $time);
            $year = date('Y', $time);
            $currentYear = date("Y");
            if ($newformat == $x && $currentYear = $year) {
                $aantalbezoekersopmaand++;                
            }
        }
        $databezoekersall .= $aantalbezoekersopmaand . ', ';
    }
    $datahits = substr($datahits, 0, -2);
    $databezoekersall = substr($databezoekersall, 0, -2);
}
?>
<style>
    .chart-legend li span{
    display: inline-block;
    width: 12px;
    height: 12px;
    margin-right: 5px;
}
</style>
<h3>Bezoekers per uur (vandaag) - Totaal unieke bezoekers: <?php echo $lastbezoeker->id; ?></h3>
<div style="width:100%">
    <div>
        <canvas id="canvas" height="auto" width="auto"></canvas>
    </div>
</div>
<div id="bezoekersperuur">

</div>
<div id="bezoekersperuurlegend" class="chart-legend"></div>

<!-- Bezoekers TOTAAL -->

<h3>Bezoekers per maand - Totaal bezoekers: <?php echo $lastbezoekerhit->id; ?></h3>
<div style="width:100%">
    <div>
        <canvas id="canvas2" height="auto" width="auto"></canvas>
    </div>
</div>
<div id="bezoekerspermaand">

</div> 
<div id="bezoekerspermaandlegend" class="chart-legend"></div>

<script>
    var randomScalingFactor = function () {
        return Math.round(Math.random() * 100)
    };
    var lineChartData = {
        labels: [<?php echo $labels; ?>],
        datasets: [
            {
                label: "Totaal bezoekers vandaag",
                fillColor: "rgba(16,160,213,0.2)",
                strokeColor: "rgba(16,160,213,1)",
                pointColor: "rgba(16,160,213,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(16,160,213,1)",
                data: [<?php echo $datahitsvandaag; ?>]
            },
            {
                label: "Unieke bezoekers vandaag",
                fillColor: "rgba(16,224,11,0.2)",
                strokeColor: "rgba(16,224,11,1)",
                pointColor: "rgba(16,224,11,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(16,224,11,1)",
                data: [<?php echo $data; ?>]
            },             
            {
                label: "Unieke bezoekers gisteren",
                fillColor: "rgba(230,29,128,0.2)",
                strokeColor: "rgba(230,29,128,1)",
                pointColor: "rgba(230,29,128,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(230,29,128,1)",
                data: [<?php echo $dataGisteren; ?>]
            }
        ]

    };

    var ctx = document.getElementById("canvas").getContext("2d");
    window.myLine = new Chart(ctx).Line(lineChartData, {
        responsive: true
    });
    document.getElementById('bezoekersperuurlegend').innerHTML = window.myLine.generateLegend();
    
    var lineChartData2 = {
        labels: ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Aug","Sep","Okt","Nov","Dec"],
        datasets: [
            {
                label: "Totaal hits per maand",
                fillColor: "rgba(16,160,213,0.2)",
                strokeColor: "rgba(16,160,213,1)",
                pointColor: "rgba(16,160,213,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(16,160,213,1)", 
                data: [<?php echo $datahits; ?>]
            },
            {
                label: "Unieke bezoekers per maand",
                fillColor: "rgba(16,224,11,0.2)",
                strokeColor: "rgba(16,224,11,1)",
                pointColor: "rgba(16,224,11,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(16,224,11,1)",                             
                data: [<?php echo $databezoekersall; ?>]
            }
        ]

    };

    var ctx = document.getElementById("canvas2").getContext("2d");
    window.myLine = new Chart(ctx).Line(lineChartData2, {
        responsive: true
    });
    document.getElementById('bezoekerspermaandlegend').innerHTML = window.myLine.generateLegend();
</script>