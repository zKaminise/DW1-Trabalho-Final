<?php
$pageTitle = 'Casos de Uso - AgendAí';
include __DIR__ . '/../app/includes/header.php';
include __DIR__ . '/../app/includes/flash.php';
?>

<div class="cases-page">
    <div class="cases-container">
        <h2>Casos de Sucesso</h2>
        <p class="intro">Conheça profissionais que transformaram seus negócios com o AgendAí</p>

        <div class="case-item">
            <img src="/agendai/assets/img/medico.jpg" alt="Dr. Carlos Silva" class="case-photo">
            <div class="case-content">
                <h3>Dr. Carlos Silva - Cardiologista</h3>
                <p>"Desde que comecei a usar o AgendAí, minha clínica ficou muito mais organizada..."</p>
            </div>
        </div>

        <div class="case-item">
            <img src="/agendai/assets/img/manicure.jpg" alt="Juliana Santos" class="case-photo">
            <div class="case-content">
                <h3>Juliana Santos - Manicure e Pedicure</h3>
                <p>"O AgendAí revolucionou meu salão! Trabalho sozinha e antes ficava perdida..."</p>
            </div>
        </div>

        <div class="case-item">
            <img src="/agendai/assets/img/personal.jpg" alt="Rafael Oliveira" class="case-photo">
            <div class="case-content">
                <h3>Rafael Oliveira - Personal Trainer</h3>
                <p>"Como personal, minha agenda muda constantemente. O AgendAí me deu liberdade!..."</p>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../app/includes/footer.php'; ?>