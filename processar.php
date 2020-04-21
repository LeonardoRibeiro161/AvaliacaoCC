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

/*
echo "Prova Oficial01 :".$P_Oficial1 . "<br>";
echo "Prova Oficial02 :".$P_Oficial2 . "<br>";
echo "Prova Parcial 1 :".$P_Parcial1 . "<br>";
echo "Prova Parcial 1 :".$P_Parcial2 . "<br>"; 

echo "<br>";

echo "Valor do bimestre1:".$media_bimestre1. "<br>";
echo "Valor do bimestre2:".$media_bimestre2. "<br>";
echo "Valor final:".$media_final."<br>";
*/

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
            <canvas id="grafico" ></canvas>
            <script>
                var ProvaOF1 = "<?php echo $P_Oficial1; ?>" //cor A
                var ProvaPar1 = "<?php echo $P_Parcial1; ?>" // cor b
                var MediaBimestre1 = "<?php echo $media_bimestre1; ?>" //cor c

                var ProvaOF2 = "<?php echo $P_Oficial2; ?>" // cor a
                var ProvaPar2 = "<?php echo $P_Parcial2; ?>" // cor b 
                var MediaBimestre2 = "<?php echo $media_bimestre2; ?>" // cor c

                var mediaFinal = "<?php echo $media_final; ?>" 


                function criarEixos(canvas, margem) {
                    var c=document.getElementById(canvas);
                    var ctx=c.getContext("2d");
                    var rightX = c.width - margem;
                    // y
                    ctx.moveTo(margem, margem);
                    ctx.lineTo(margem, rightX);
                    // setas do y
                    ctx.moveTo(margem, margem);
                    ctx.lineTo(margem + 5, margem + 5);
                    ctx.moveTo(margem, margem);
                    ctx.lineTo(margem - 5, margem + 5);
                    // x
                    ctx.moveTo(margem, rightX);
                    ctx.lineTo(rightX, rightX);
                    // setas x
                    ctx.moveTo(rightX, rightX);
                    ctx.lineTo(rightX - 5, rightX + 5);
                    ctx.moveTo(rightX, rightX);
                    ctx.lineTo(rightX - 5, rightX - 5);
                    // Define style and stroke lines.
                    ctx.strokeStyle = "#000";
                    
                    ctx.stroke();
                    }
                            
                    function criarBarra(canvas,xPos, yPos, largura, altura, cor){
                        var c=document.getElementById(canvas);
                        var ctx=c.getContext("2d");
                        ctx.fillStyle = cor;  
                        ctx.fillRect(xPos, yPos, largura, altura);
                    }
                    
                    function criarGrafico(canvas, margem, barras, cor){
                        var largura=document.getElementById(canvas).width;
                        var altura = document.getElementById(canvas).height-(margem*2)-5;
                        var qtd = barras.length;
                        var barra = (largura/(qtd*1.5))-5;
                        var entre = (largura-(barra*qtd))/(qtd+3);
                        var total = 0;
                        
                        for (i = 0; i < qtd; i++) {		
                            if(total<barras[i]){
                                total=barras[i];
                            }
                        }
                        
                        for (i = 0; i < qtd; i++) {		
                            criarBarra(canvas,((barra+entre)*i)+(margem+entre),largura-margem-altura*(barras[i]/total),barra,altura*(barras[i]/total),cor);
                        }
                        
                        criarEixos(canvas, margem);
                    }
                    
                    var dados = new Array(10, 20, 30);
                    criarGrafico("grafico",10, dados, "#696");
                
            </script>
</body>
</html>