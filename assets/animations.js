const animations = document.querySelectorAll('.animate');
    
window.onload = (event) => {
  animations.forEach(animation => {
    observer = new IntersectionObserver((animation) => {
      if(animation[0].intersectionRatio > 0 && animation[0].target.dataset.completed !== 'true') {
        if(animation[0].target.dataset.animation === 'about') {
          var textWrapper = document.querySelector('.about h1');
          textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

          anime.timeline()
            .add({
              targets: '.about .item .letter',
              scale: [0.3, 1],
              opacity: [0, 1],
              translateZ: 0,
              easing: "easeOutExpo",
              duration: 1600,
              delay: (el, i) => 70 * (i + 1),
              complete: function (anim) {
                animation[0].target.dataset.completed = anim.completed;
              }
            }).add({
              targets: '.about h1',
              opacity: [0, 1],
              duration: 2,
              complete: function (anim) {
                animation[0].target.dataset.completed = anim.completed;
              }
            }, '-=4000').add({
              targets: '.about .about__text',
              opacity: [0, 1],
              duration: 2000,
              complete: function (anim) {
                animation[0].target.dataset.completed = anim.completed;
              }
            }, '-=1500');

        } else if(animation[0].target.dataset.animation === 'portfolio__one') {
          anime({
            targets: '.portfolio__one img',
            opacity: [0, 1],
            translateY: [-500, 0],
            easing: "easeInQuint",
            duration: 1400,
            delay: anime.stagger(300, { start: 200 }),
            complete: function (anim) {
              animation[0].target.dataset.completed = anim.completed;
            }
          })
        } else if (animation[0].target.dataset.animation === 'portfolio__two') {
          anime({
            targets: '.portfolio__two img',
            opacity: [0, 1],
            translateY: [-500, 0],
            easing: "easeInQuint",
            duration: 1400,
            delay: anime.stagger(300, { start: 200 }),
            complete: function (anim) {
              animation[0].target.dataset.completed = anim.completed;
            }
          })
        } else if (animation[0].target.dataset.animation === 'details') {
            anime({
              targets: '.details__text span',
              opacity: [0, 1],
              translateZ: 0,
              easing: "easeOutExpo",
              duration: 1600,
              delay: anime.stagger(300, { start: 100 }),
              complete: function(anim) {
                animation[0].target.dataset.completed = anim.completed;
            }
          });
        }
      }
    })
    observer.observe(animation);
  });
}