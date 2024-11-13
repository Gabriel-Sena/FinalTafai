<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/vars.css">
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/pages-css/tabela.css"> <!-- Arquivo de estilo principal -->
  <title>Tabela</title>
</head>
<body>
  <div class="wrapper">
    <div class="container">

        <!-- Imagem Tabela -->
        <div class="tabela-imagem">
            <img src="../assets/images/tabela.png" alt="Imagem da Tabela">
        </div>

        <!-- Caixa de Busca -->
        <div class="search-box">
            <label for="search">Buscar Produto:</label>
            <input type="text" id="search" placeholder="Digite o nome do produto">
            <button onclick="searchProduct()">Buscar</button>
        </div>

        <!-- Tabela de Produtos -->
        <div class="product-table">
            <table id="productTable">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Código de Barras</th>
                        <th>Produto</th>
                        <th>Marca</th>
                        <th>Caixa/Peso</th>
                        <th>Preço</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Incluir o arquivo que conecta ao banco de dados
                    include '../scripts/get_products.php';
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Menu de Navegação -->
        <nav class="menu">
            <ul>
                <li><a href="../index.html">Menu</a></li>
                <li><a href="../pages/produtos.php">Produtos</a></li>
                <li><a href="../pages/tabela.php">Tabela de Produtos</a></li>
                <li><a href="../pages/pedidos.html">Pedidos</a></li>
                <li><a href="../pages/onde-tem.html">Onde Tem</a></li>
                <li><a href="../pages/localizacao.html">Localização</a></li>
            </ul>
        </nav>

    </div>
  </div>

  <script>
    function searchProduct() {
      var searchValue = document.getElementById('search').value.toLowerCase();
      var table = document.getElementById('productTable');
      var rows = table.getElementsByTagName('tr');

      for (var i = 1; i < rows.length; i++) {
        var productName = rows[i].getElementsByTagName('td')[2].innerText.toLowerCase();
        
        if (productName.includes(searchValue)) {
          rows[i].style.display = '';
        } else {
          rows[i].style.display = 'none';
        }
      }
    }
  </script>
</body>
</html>
