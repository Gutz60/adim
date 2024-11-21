<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja</title>
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
     <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
          .ie-panel {
      display: none;
      background: #212121;
      padding: 10px 0;
      box-shadow: 3px 3px 5px 0 rgba(0, 0, 0, .3);
      clear: both;
      text-align: center;
      position: relative;
      z-index: 1;
    }

    html.ie-10 .ie-panel,
    html.lt-ie-10 .ie-panel {
      display: block;
    }


.navbar {
    background-color: #0a2140; /* Fundo azul escuro */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}


.navbar-nav .nav-link {
    color: #ffffff; /* Cor branca para os links */
    font-size: 1.2rem; /* Aumenta o tamanho da fonte */
    font-weight: 500;
    margin-left: 15px;
    transition: color 0.3s, transform 0.2s;
}

.navbar-nav .nav-link.active {
    color: #7cc1de;
}

.navbar-nav .nav-link:hover {
    color: #7cc1de;
    transform: scale(1.1); /* Efeito de zoom leve no hover */
}

.navbar-toggler {
    border-color: #ffffff;
}

.navbar-toggler-icon {
    background-color: #ffffff;
}

.dropdown-menu {
    background-color: #0a2140; /* Fundo azul escuro para o dropdown */
    border: none;
}

.dropdown-menu .dropdown-item {
    color: #ffffff; /* Cor branca para os itens do dropdown */
    font-size: 1rem;
}

.dropdown-menu .dropdown-item:hover {
    background-color: #780088; /* Fundo roxo ao passar o mouse */
    color: #ffffff;
}

/* Responsividade */
@media (max-width: 768px) {
    .navbar-nav {
        flex-direction: column;
        align-items: center;
    }

    .navbar-nav .nav-link {
        margin-left: 0;
        margin-bottom: 10px;
        font-size: 1.1rem;
    }
}
      @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");
        header{
          margin-bottom: 150px;
        }
        #search-bar{
          margin-bottom: 20px;
          margin-left: 20px;
          width: 50%;
        }
        #img-card{
          width: 10px;
          height: 10pc;
          object-fit: cover; /* Corta a imagem para caber no contêiner sem distorcer */
          object-position: center; /* Centraliza o corte da imagem */
          border-top-left-radius: 0.5rem; /* Ajusta bordas arredondadas */
          border-top-right-radius: 0.5rem; /* Ajusta bordas arredondadas */
        }
    </style>
</head>
<body>
  <div class="ie-panel"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img
        src="../images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820" alt="
Você esta usando um navegador desatualizado. Para uma experiência de navegação mais rápida e segura, atualize."></a>
  </div>
  <div class="page-loader page-loader-variant-1">
    <div><img width='250' height='250' src='../images/logo.png' alt='' />
      <div class="offset-top-41 text-center">
        <div class="spinner"></div>
      </div>
    </div>
  </div>
  <!-- Page-->
  <div class="page text-center">
    <!-- Head da pagina (deixar mais bonito)-->
    <header>
      <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark fixed-top" data-bs-theme="dark">
        <div class="container-fluid d-flex justify-content-between">
          <a class="navbar-brand" href="#"><img src="../images/navlogo.png" alt="" width="20%"></a>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto"> <!-- ms-auto para alinhar as opções à direita -->
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="../index.html">inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../ficha/ficha.html">Ficha</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="loja.php">Produtos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../paginas/planos.html">Planos</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  FeedBack
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="paginas/contacts.html">Ajuda</a></li>
                  <li><a class="dropdown-item" href="">Feedback</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-cart3"></i></a>
              </li>
            </ul>
          </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </nav>
    </header>
<main class="container mt-5">
    <div class="search-bar-container">
        <input type="text" id="search-bar" class="form-control" placeholder="Pesquisar produto...">
        <h4>Carrinho ADM</h4>
    </div>
    <div id="product-container" class="row">
        <!-- Os produtos serão carregados dinamicamente aqui -->
    </div>
</main>

<script>
$(document).ready(function () {
    function fetchProducts(query = '') {
        $.ajax({
            url: 'buscar_produtos.php',
            method: 'GET',
            data: { busca: query },
            success: function (response) {
                $('#product-container').html(response);
            }
        });
    }

    // Buscar produtos ao carregar a página
    fetchProducts();

    // Atualizar a lista enquanto digita
    $('#search-bar').on('keyup', function () {
        const query = $(this).val();
        fetchProducts(query);
    });
});
</script>
 <footer
    class="section-relative section-top-66 section-bottom-34 page-footer bg-gray-base context-dark novi-background"
    data-preset='{"title":"Footer","category":"footer","reload":true,"id":"footer"}'>
    <div class="container">
      <div class="row text-xl-left">
        <div class="col-md-12">
          <div class="row">
            <div
              class="col-sm-10 col-md-3 text-left order-md-4 col-md-10 col-xl-3 offset-md-top-50 offset-xl-top-0 order-xl-2">
              <div class="offset-top-50 text-sm-center text-xl-left">
                <ul class="list-inline">
                  <li class="list-inline-item"><a
                      class="novi-icon icon fa fa-facebook icon-xxs icon-circle icon-darkest-filled" href="#"></a></li>
                  <li class="list-inline-item"><a
                      class="novi-icon icon fa fa-twitter icon-xxs icon-circle icon-darkest-filled" href="#"></a></li>
                  <li class="list-inline-item"><a
                      class="novi-icon icon fa fa-instagram icon-xxs icon-circle icon-darkest-filled" href="#"></a></li>
                  <li class="list-inline-item"><a
                      class="novi-icon icon fa fa-linkedin icon-xxs icon-circle icon-darkest-filled" href="#"></a></li>
                </ul>
              </div>
              <p class="offset-top-20">A.D.M &copy; <span id="copyright-year"></span> .
                <a class="nav-link" href="../paginas/pp.html">Política de Privacidade</a>
                <!-- NÃO pode tirar isso --> Design&nbsp;by&nbsp;<a
                  href="https://www.templatemonster.com">TemplateMonster</a>
            </div>
            <div class="col-sm-10 col-md-3 offset-top-66 order-md-1 offset-md-top-0 col-md-6 col-xl-3 order-xl-1">
              <!-- Footer brand-->
              <div class="footer-brand"><a href="index.html"><img width='200' height='200' src='../images/logo.png'
                    alt='' /></a></div>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  </div>
  <!-- Global Mailform Output-->
  <div class="snackbars" id="form-output-global"></div>
  <!-- Java script-->
  <script src="../js/core.min.js"></script>
  <script src="../js/script.js"></script>
</body>

</html>