$(document).ready(function () {
    $(".faq-item").click(function () {
      var container = $(this);
      var answer = container.find(".textinside");
  
      if (container.hasClass("expanded")) {
        // Verifique se o clique ocorreu na div da pergunta
        if (!$(event.target).closest(".textinside").length) {
          // Fecha a resposta somente se o clique não ocorreu dentro da resposta
          answer.slideUp();
          container.removeClass("expanded");
          container.find(".icon i").removeClass("fa-rotate-180");
        }
      } else {
        // Abra a resposta atual
        answer.slideDown();
        container.addClass("expanded");
        container.find(".icon i").addClass("fa-rotate-180");
      }
    });
  });
  