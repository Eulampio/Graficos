<?php
include "db.php";

// Pegar dados do banco
$anos = [];
$valores = [];

$sql = "SELECT ano, valor FROM salario_minimo ORDER BY ano ASC";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
    $anos[] = $row['ano'];
    $valores[] = $row['valor'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gráfico Salário Mínimo</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
    <h1>Evolução do Salário Mínimo</h1>
    <canvas id="salarioChart" width="600" height="400"></canvas>

    <script>
        const ctx = document.getElementById('salarioChart').getContext('2d');
        const salarioChart = new Chart(ctx, {
            type: 'line', // gráfico de linha
            data: {
                labels: <?php echo json_encode($anos); ?>, // anos
                datasets: [{
                    label: 'Salário Mínimo (R$)',
                    data: <?php echo json_encode($valores); ?>, // valores
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3 // curva suave
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
    </script>
</body>
</html>
