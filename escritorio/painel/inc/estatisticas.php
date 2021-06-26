<?php
$rel = new Relatorios();
?>
<div class="page-header"> <h3>Estatisticas </h3></div>

<div class="col-md-12">
    
    <div class="row">

        <div class="col-md-4">
    <canvas class="line-chart"> </canvas>
        </div>

        <div class="col-md-4">
    <canvas class="line-chart2"> </canvas>
        </div>

        <div class="col-md-4">
    <canvas class="line-chart2"> </canvas>
        </div>
    
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<?php 
$meses = array(["jan", "fev", "mar", "abr", "mai", "jun", "jul", "ago", "set", "out", "nov", "dez"]);

echo json_encode($meses);


?>

<script>


    var ctx = document.getElementsByClassName("line-chart");
    
    var chartGraph = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["jan", "fev", "mar", "abr", "mai", "jun", "jul", "ago", "set", "out", "nov", "dez"] ,
            datasets: [{
                    label: "taxa clique 2019",
                    data: [5, 10, 12, 34, 34, 15, 86, 45, 23, 45, 22, 02],
                    borderWidth: 2,
                    borderColor: 'rgba(77,167,34,56)',
                    backgroundColor: 'transparent',
                },
                {
                    label: "taxa clique 2018",
                    data: [15, 110, 112, 134, 134, 115, 186, 145, 123, 145, 122, 102],
                    borderWidth: 2,
                    borderColor: 'rgba(12,456,04,12)',
                    backgroundColor: 'transparent',
                }
                ]

        }
    }
    )
    
 

</script>
