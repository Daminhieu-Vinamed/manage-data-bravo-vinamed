$(document).ready(function () {
function animateHeart() {
    TweenMax.from($("#heart"), 1, {
      scaleX: 1.2, 
      scaleY: 1.2,
      transformOrigin: "50% 50%",
      ease: Elastic.easeOut.config(1, 0.3)
    });
    TweenMax.to($("#heart"), 1, {
      scaleX: 1, 
      scaleY: 1,
      ease: Elastic.easeOut.config(1, 0.3),
      onComplete: function() {
        setTimeout(animateHeart, 200);
      }
    });
  }
  
  new Vivus('message', {type: "oneByOne", duration: 1200}, function() {
    TweenMax.to($("path"), 5, {fillOpacity: 1, onComplete: function() {
      animateHeart();
    }});
  });
  
  $(function() {
    TweenMax.to("body", 20, {backgroundPositionY: -100, repeat: -1, ease: Power0.easeNone});
  })
})