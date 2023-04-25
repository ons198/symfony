<?php
// Se connecter à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=autoxpress', 'root', '');
 // Récupérer les données des types de véhicules et leurs quantités correspondantes depuis la base de données
$stmt = $pdo->query('SELECT Type_vehicule, COUNT(*) AS quantite FROM Offre GROUP BY Type_vehicule');
$vehicules = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Créer un tableau des noms de types de véhicules et des quantités correspondantes
$labels = array_column($vehicules, 'type');
$data = array_column($vehicules, 'quantite');

// Créer une nouvelle charte à secteurs en utilisant Chart.js
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Exemple de charte à secteurs</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   
  </head>
  <body>
    <canvas id="chart" ></canvas>
    <script>
      const labels = <?php echo json_encode($labels); ?>;
      const data = <?php echo json_encode($data); ?>;
      const chart = new Chart(document.getElementById("chart"), {
        type: "pie",
        data: {
          labels: ["voiture","van","bus"],
          datasets: [
            {
              label: "Pourcentage des types de véhicules",
              data: data,
              backgroundColor: ["#ff6384", "#36a2eb", "#ffce56"],
            },
          ],
        },
        
      });
    </script>
    <button >back to list</button>
  </body>
</html>