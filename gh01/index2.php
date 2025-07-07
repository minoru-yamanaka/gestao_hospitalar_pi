<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu Sanfona</title>
  <style>
    .accordion {
      cursor: pointer;
      padding: 10px;
      border: none;
      text-align: left;
      outline: none;
      transition: background-color 0.3s;
      font-size: 16px;
    }

    .accordion.active {
      background-color: #ddd;
    }

    .panel {
      padding: 0 10px;
      display: none;
      overflow: hidden;
      background-color: #f1f1f1;
    }

    main{
        width: 80%;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        
    }

  </style>
</head>
<body>
<main>

    <h2>Menu Sanfona</h2>
    <button class="accordion">Seção 1</button>
    <div class="panel">
        <p>Conteúdo da Seção 1.</p>
    </div>
    <br><br>
    <button class="accordion">Seção 2</button>
    <div class="panel">
        <p>Conteúdo da Seção 2.</p>
    </div>
    <br><br>
    <button class="accordion">Seção 3</button>
    <div class="panel">
        <p>Conteúdo da Seção 3.</p>
        <p>Conteúdo da Seção 3.</p>
        <p>Conteúdo da Seção 3.</p>
    </div>
  </main>
  <script>
        document.addEventListener("DOMContentLoaded", () => {
        const accordions = document.querySelectorAll(".accordion");

        accordions.forEach((accordion) => {
            accordion.addEventListener("click", () => {
            // Alterna a classe "active" no botão clicado
            accordion.classList.toggle("active");

            // Mostra ou esconde o painel correspondente
            const panel = accordion.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
            });
        });
        });
  </script>
</body>
</html>
