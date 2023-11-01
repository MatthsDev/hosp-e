$(document).ready(function() {
    $('.menu-link').click(function(event) {
        event.preventDefault(); // Impede o comportamento padrão do link
        var menu = $(this).attr('href'); // Pega o link do item do menu clicado
        $('#conteudo-dinamico').load(menu); // Carrega o conteúdo correspondente na div "conteudo-dinamico"
    });

    if (!$('.menu-link').hasClass('active')) {
        // Se nenhum link de menu estiver ativo, carregue a "home.php" por padrão
        $('#conteudo-dinamico').load('home.php');
    }
});
