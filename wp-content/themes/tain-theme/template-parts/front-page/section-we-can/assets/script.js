(function (e) {
  e.fn.circle = function (t) {
    var n = e.extend(
      {
        speed: "5000",
      },
      t
    );
    return this.each(function () {
      function updateActiveState() {
        var e = i.find("li.block.active").index();

        // Update active state for spans immediately
        var spans = $(".content-text-cirle .relative-span-cirle span");
        spans.removeClass("active");
        spans.eq(e).addClass("active");

        c.removeClass("active");
        c.eq(e).addClass("active");
      }

      function rotate() {
        var n;
        i.addClass("disable-hover");

        // Set active class before the animation starts
        p.active = i.find("li.active").removeClass("active");
        if (p.direction == "right" && p.step == d) {
          if (p.active.prev() && p.active.prev().length) {
            n = p.active.prev().index();
            p.active.prev().addClass("active");
          } else {
            p.active.siblings(":last-child").addClass("active");
            n = 9;
          }
        } else if (p.direction == "left" && p.step == u) {
          if (p.active.next() && p.active.next().length) {
            n = p.active.next().index();
            p.active.next().addClass("active");
          } else {
            p.active.siblings(":first-child").addClass("active");
            n = 0;
          }
        }

        // Update the spans and content states before starting animation
        updateActiveState();

        // Now start the animation
        i.stop(true, true).animate(
          {
            rotatedeg: (p.deg += p.step),
          },
          {
            duration: 400,
            step: function (t) {
              t >= 360 ? (t -= 360) : t <= -360 && (t += 360);
              e(this).css("transform", "rotate(" + t + "deg)");
              e(this).css("-webkit-transform", "rotate(" + t + "deg)");
            },
            complete: function () {
              i.is(":animated");
              i.removeClass("disable-hover");
            },
          },
          "ease"
        );
      }

      function rotateOnClick() {
        i.addClass("disable-hover");

        // Set active class before the animation starts
        updateActiveState();

        i.stop(true, true).animate(
          {
            rotatedeg: (p.deg += p.step),
          },
          {
            duration: 400,
            step: function (t) {
              t >= 360 ? (t -= 360) : t <= -360 && (t += 360);
              e(this).css("transform", "rotate(" + t + "deg)");
              e(this).css("-webkit-transform", "rotate(" + t + "deg)");
            },
            complete: function () {
              p.active = i.find("li.active");
              i.is(":animated");
              i.removeClass("disable-hover");
            },
          },
          "ease"
        );
      }

      var i = e(this),
        s = i.find("li").length,
        a = i.find(" > li .icon"),
        l = "count" + s,
        u = 0,
        c = i.next().find(".animate"),
        p = {
          duration: n.speed,
          deg: 0,
          step: u,
          active: i.find("li.active"),
          direction: "left",
        };
      switch (s) {
        case 10:
          u = -36;
          break;
        case 9:
          u = -40;
          break;
        case 8:
          u = -45;
          break;
        case 7:
          u = -51.5;
          break;
        case 6:
          u = -60;
          break;
        case 5:
          u = -72;
          break;
        case 4:
          u = -90;
          break;
        case 3:
          u = -120;
          break;
        case 2:
          u = -180;
          break;
        case 1:
          u = -360;
      }
      i.addClass(l);
      var d = u - 2 * u;
      i.find("> li").first().addClass("active");
      i.find("> li").first().find("a").attr("href");
      c.eq(0).addClass("active");
      e(a).on("click", function () {
        var n = e(this).parent().index() - i.find("li.active").index();
        i.children("li").removeClass("active");
        e(this).parent().addClass("active");
        p.step = -n * d;
        n * d >= 288 && (p.step = -n * d + 360);
        n * d <= -288 && (p.step = -n * d - 360);
        rotateOnClick();
        p.step = u;
        p.direction = "left";
        updateActiveState();
      });
      var f = i.parent().find("div.next"),
        h = i.parent().find("div.prev");
      f.on("click", function () {
        i.is(":animated") || ((p.direction = "left"), (p.step = u), rotate());
      });
      h.on("click", function () {
        i.is(":animated") || ((p.direction = "right"), (p.step = d), rotate());
      });

      // Autoplay feature: rotate from right to left every 5 seconds
      setInterval(function () {
        if (!i.is(":animated")) {
          p.direction = "left";
          p.step = u;
          rotate();
        }
      }, 5000); // 5000 milliseconds = 5 seconds
    });
  };
})(jQuery);

$(function () {
  // Background image
  $("div").each(function () {
    var url = $(this).attr("data-image");
    if (url) {
      $(this).css("background-image", "url(" + url + ")");
    }
  });
  $("section").each(function () {
    var url = $(this).attr("data-image");
    if (url) {
      $(this).css("background-image", "url(" + url + ")");
    }
  });

  function autoHeightCircle() {
    var circle = $(".circle--rotate"),
      circleInner = $(".animate-wrapper"),
      circleH = circle.width(),
      circleInnerH = circleInner.width();
    circle.height(circleH);
    circleInner.height(circleInnerH);
  }

  $("#circle--rotate").circle();
  autoHeightCircle();

  $(window).resize(function () {
    autoHeightCircle();
  });
});