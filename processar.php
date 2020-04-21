<?php
$Bimestre1 = 4;
$Bimestre2 = 6;

$P_Oficial1 = $_POST['ProvaOF1'];
$P_Oficial2 = $_POST['ProvaOF2'];
$P_Parcial1 = $_POST['ProvaPar1'];
$P_Parcial2 = $_POST['ProvaPar2'];


//Calcula a media bimetral 1
$media_bimestre1 = (($P_Oficial1 * $Bimestre1) + ($P_Parcial1 * $Bimestre1))/ ($Bimestre1 * 2);
    
//Calcula media bimestral 2

$media_bimestre2 = (($P_Oficial2 * $Bimestre2) + ($P_Parcial2 * $Bimestre2)) /($Bimestre2 * 2);

//Calcula media final

$media_final = (($media_bimestre1 * $Bimestre1) + ($media_bimestre2 * $Bimestre2)) / ($Bimestre1 + $Bimestre2);



if($media_final > 6.5){
    $status = "Aprovado";
}
else if($media_final == 5){
    $status = "Recuperacao";
}
else {
   $status = "Reprovado";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
</head>
<body>

<table class="table">
        <thead class="thead-dark">
            <tr>
                
                <th scope="col">Media Bimestre 1</th>
                <th scope="col">Media Bimestre 2</th>
                <th scope="col">Media Final</th>
                <th scope="col">Resultado</th>
            </tr>
                </thead>
                <tbody>
                    <tr>
                    
                    <?php echo "<td scope='row'>". $media_bimestre1."</td>"; ?>
                    <?php echo "<td scope='row'>". $media_bimestre2 ."</td>";?>
                    <?php echo "<td scope='row'>". $media_final ."</td>";?>
                    <?php echo "<td scope='row '>".$status ."</td>";?>
                    </tr>
                
                </tbody>
            </table>
            <canvas class="mx-auto my-2" id="grafico" ></canvas>
            <script type="text/javascript" >
                var ProvaOF1 = "<?php echo $P_Oficial1; ?>" //cor A
                var ProvaPar1 = "<?php echo $P_Parcial1; ?>" // cor b
                var MediaBimestre1 = "<?php echo $media_bimestre1; ?>" //cor c

                var ProvaOF2 = "<?php echo $P_Oficial2; ?>" // cor a
                var ProvaPar2 = "<?php echo $P_Parcial2; ?>" // cor b 
                var MediaBimestre2 = "<?php echo $media_bimestre2; ?>" // cor c

                var mediaFinal = "<?php echo $media_final; ?>" 
                var cor
                
                if (mediaFinal >=6)
                {
                    cor = 'rgba(51,255,51,0.2)';
                }
                else if(mediaFinal == 5){
                     cor = 'rgba(255,0,0,0.2)'
                }
                else{
                     cor = 'rgba(204,255,0,0.2)'
                }
                
                var ctx = document.getElementById('grafico').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Prova Oficial 1', 'Prova Parcial 1', 'Media do Bimestre', 'Prova Oficial 2', 'Prova Parcial 2','Media do Bimestre','Media final do Semestre'],
                        datasets: [{
                            label: '# Provas e medias',
                            data: [<?php echo $P_Oficial1; ?>, <?php echo $P_Parcial1; ?>, <?php echo $media_bimestre1; ?>,<?php echo $P_Oficial2; ?>,<?php echo $P_Parcial2; ?>,<?php echo $media_bimestre2; ?>,<?php echo $media_final; ?>],
                            backgroundColor: [
                                'rgba(102,0,255,0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(0,0,0,0.2)',
                                'rgba(102,0,255,0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(0,0,0,0.2)',
                                cor
                            ],
                            borderColor: [
                                'rgba(102,0,255,0.2)',
                                'rgba(102,0,255,0.2)',
                                'rgba(102,0,255,0.2)',
                                'rgba(102,0,255,0.2)',
                                'rgba(102,0,255,0.2)',
                                'rgba(102,0,255,0.2)',
                                'rgba(102,0,255,0.2)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            

            </script>
</body>
</html>