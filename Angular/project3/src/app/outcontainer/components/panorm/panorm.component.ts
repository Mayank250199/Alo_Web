import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-panorm',
  templateUrl: './panorm.component.html',
  styleUrls: ['./panorm.component.css']
})
export class PanormComponent implements OnInit {

  constructor() { }

  ngOnInit() {
    document.getElementById('pan_img').onmousemove = this.lol;
  }
  lol(e) {
    //console.log(e);
    var img = document.getElementById('pan_img');
    var m_posx = 0, m_posy = 0, e_posx = 0, e_posy = 0;
      var obj:any = img;
    //get mouse position on document crossbrowser
    if (!e) { e = window.event; }
    if (e.pageX || e.pageY) {
      m_posx = e.pageX;
      m_posy = e.pageY;
    } else if (e.clientX || e.clientY) {
      m_posx = e.clientX + document.body.scrollLeft
        + document.documentElement.scrollLeft;
      m_posy = e.clientY + document.body.scrollTop
        + document.documentElement.scrollTop;
    }
    //get parent element position in document
    if (obj.offsetParent) {
      do {
        e_posx += obj.offsetLeft;
        e_posy += obj.offsetTop;
      } while (obj = obj.offsetParent);
    }
    // mouse position minus elm position is mouseposition relative to element:
    var x=m_posx - e_posx, y=m_posy - e_posy;
    
    var p_x = (x+img.parentElement.scrollLeft)/img.scrollWidth*100, p_y=y/img.scrollHeight*100;
    var coordinates=[
      []
    ]
    //console.log(m_posx);
    var x_over = m_posx<window.innerWidth/2?-50:-240, y_over = m_posy<window.innerHeight/2?10:-140;
    var box = document.getElementById('disp_box');
    box.style.left=x+x_over+'px';
    box.style.top=y+y_over+'px';
    

  }
  left_in(){
    document.getElementById('left_sc_div').style.backgroundColor='rgba(0,0,0,0.5)';
    this.scroll(-1);
  }
  left_out(){
    document.getElementById('left_sc_div').style.backgroundColor='rgba(0,0,0,0.1)';
    this.scrolling=false;
  }
  right_in(){
    document.getElementById('right_sc_div').style.backgroundColor='rgba(0,0,0,0.5)';
    this.scroll(1);
  }
  right_out(){
    document.getElementById('right_sc_div').style.backgroundColor='rgba(0,0,0,0.1)';
    this.scrolling=false;
  }
  scrolling=false;
  scroll(speed=1){
    this.scrolling=true;
    var a=setInterval(()=>{document.getElementById('pan_img').parentElement.scrollBy(speed,0);
      if(!this.scrolling) clearInterval(a);
    }, 10);
  }
}


