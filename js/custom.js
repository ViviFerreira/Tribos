$(document).ready(_ => {
    $nav = $('.nav');
    $toggleCollapse = $('.toggle-collapse');

    // Fazer menu para telas < 750px; evento clique
    $toggleCollapse.click(_ => {
        $nav.toggleClass('collapse');
    });

    // clicar para ir ao topo
    $('.move-up span').click(_ => {
        $('html,body').animate({
            scrollTop: 0
        }, 2000);
    });

    // animações
    AOS.init();
});

