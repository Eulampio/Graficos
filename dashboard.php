<?php
include "db.php";

// Arrays para os gráficos
$anos = [];
$valores = [];

// Pegar todos os dados
$sql = "SELECT ano, valor FROM salario_minimo ORDER BY ano ASC";
$result = $mysqli->query($sql);

$salarioAtual = 0;
$maiorSalario = 0;
$menorSalario = PHP_INT_MAX;

while ($row = $result->fetch_assoc()) {
    $anos[] = $row['ano'];
    $valores[] = $row['valor'];

    if ($row['ano'] == max($anos)) $salarioAtual = $row['valor'];
    if ($row['valor'] > $maiorSalario) $maiorSalario = $row['valor'];
    if ($row['valor'] < $menorSalario) $menorSalario = $row['valor'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Salário Mínimo</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f4f6f9; }
        h1 { text-align: center; margin-bottom: 30px; }
        .cards { display: flex; justify-content: space-around; flex-wrap: wrap; margin-bottom: 40px; }
        .card {
            background: #fff; padding: 20px; border-radius: 10px; width: 250px; text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin: 10px;
        }
        .card h2 { margin: 10px 0; color: #3498db; }
        .charts { display: flex; justify-content: space-around; flex-wrap: wrap; }
        .chart-container { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin: 10px; }
    </style>
</head>
<body>

<h1>Dashboard Salário Mínimo</h1>

<!-- Cards de resumo -->
<div class="cards">
    <div class="card">
        <h3>Salário Atual</h3>
        <h2>R$ <?php echo number_format($salarioAtual,2,',','.'); ?></h2>
    </div>
    <div class="card">
        <h3>Maior Salário</h3>
        <h2>R$ <?php echo number_format($maiorSalario,2,',','.'); ?></h2>
    </div>
    <div class="card">
        <h3>Menor Salário</h3>
        <h2>R$ <?php echo number_format($menorSalario,2,',','.'); ?></h2>
    </div>
</div>

<!-- Gráficos -->
<div class="charts">
    <div class="chart-container">
        <h3>Evolução do Salário Mínimo</h3>
        <canvas id="lineChart" width="400" height="300"></canvas>
    </div>
    <div class="chart-container">
        <h3>Comparação Anual</h3>
        <canvas id="barChart" width="400" height="300"></canvas>
    </div>
</div>

<script>
const anos = <?php echo json_encode($anos); ?>;
const valores = <?php echo json_encode($valores); ?>;

// Gráfico de linha
const ctxLine = document.getElementById('lineChart').getContext('2d');
const lineChart = new Chart(ctxLine, {
    type: 'line',
    data: {
        labels: anos,
        datasets: [{
            label: 'Salário Mínimo (R$)',
            data: valores,
            borderColor: 'rgba(52,152,219,1)',
            backgroundColor: 'rgba(52,152,219,0.2)',
            fill: true,
            tension: 0.3
        }]
    },
    options: { responsive: true }
});

// Gráfico de barra
const ctxBar = document.getElementById('barChart').getContext('2d');
const barChart = new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: anos,
        datasets: [{
            label: 'Salário Mínimo (R$)',
            data: valores,
            backgroundColor: 'rgba(231,76,60,0.6)',
            borderColor: 'rgba(231,76,60,1)',
            borderWidth: 1
        }]
    },
    options: { responsive: true }
});
</script>

</body>
</html>
