window.onload = event => {
  const accordionToggle = document.querySelector('.accordion-toggle');
  const accordion = document.querySelector('.accordion');

  accordionToggle.addEventListener('click', () => {
    accordion.classList.toggle('open');
    accordion.classList.contains('open')
      ? (accordionToggle.innerHTML = '- SITEMAP')
      : (accordionToggle.innerHTML = '+ SITEMAP');
    accordion.classList.contains('open')
      ? window.scroll(0, 5000)
      : window.scroll(0);
  });
};
