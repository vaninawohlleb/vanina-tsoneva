// from MDN

var cn,
  c,
  u = 10;

const m = {
  x: innerWidth / 2,
  y: innerHeight / 2
}

window.onmousemove = function(e) {
  m.x = e.clientX; 
  m.y = e.clientY; 
}

var a = [];
window.onload = function particles() {
  cn = document.getElementById('cw');
  c = cn.getContext("2d");

  for(var i = 0; i < 6; i++) {
    var t = new obj(this.innerWidth / 2, this.innerHeight / 2, 2, "white", Math.random() * 200 + 20, 2);
    a.push(t)
  }

  resize();
  anim();
}

window.onresize = function () {
  resize();
}

function resize() {
  cn.height = innerHeight;
  cn.width = innerWidth;

  for (var i = 0; i < 101; i++) {
    a[i] = new obj(innerWidth / 2, innerHeight / 2, 1.5, "white", Math.random() * 200 + 20, 2);
  }
}

function obj(x, y, r, cc, o, s) {
  this.x = x;
  this.y = y;
  this.r = r;
  this.cc = cc;
  this.theta = Math.random() * Math.PI * 2;
  this.s = s;
  this.o = o,
  this.t = Math.random() * 35;
  this.dr = function() {
    const ls = {
      x: this.x,
      y: this.y
    };
    this.theta += this.s;
    this.x = m.x + Math.cos(this.theta) * this.t;
    this.y = m.y + Math.sin(this.theta) * this.t;
    c.beginPath();
    c.lineWidth = this.r;
    c.strokeStyle = "#fff";
    c.moveTo(ls.x, ls.y);
    c.lineTo(this.x, this.y);
    c.stroke();
    c.closePath();
  }
}

function anim() {
  requestAnimationFrame(anim);
  // console.log(c)
  c.fillStyle = "rgba(0,0,0,0.06)";
  c.fillRect(0, 0, cn.width, cn.height);
  a.forEach(function (e, i) {
    e.dr();
  });
}
