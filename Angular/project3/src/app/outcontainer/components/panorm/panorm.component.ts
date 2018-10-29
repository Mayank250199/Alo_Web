import { Component, OnInit } from '@angular/core';
declare var $:any;

@Component({
  selector: 'app-panorm',
  templateUrl: './panorm.component.html',
  styleUrls: ['./panorm.component.css']
})
export class PanormComponent implements OnInit {

  constructor() { }

  ngOnInit() {
    document.getElementById('pan_img').onmousemove = this.lol;
    document.getElementById('disp_box').onmousemove = this.lol;
    this.this=this;
  }
  ngAfterViewInit(){

    $(window).on('load', ()=>{
    var p=[ 0.48629795714997506, 0.8253012048192771]
    var box = document.getElementById('disp_box');
    box.style.display='block';
    box.innerHTML = "<b>Human Psychology</b>  forms the core of our interactions and relationships with people.Learn the basis of <b>persuasion & stress coping strategies</b> by delivering elevator pitch of products & investigating stories of war."
    box.style.left = ((document.getElementById('pan_img').scrollWidth*p[0]+40-document.getElementById('pan_img').parentElement.scrollLeft))+'px';
    box.style.top = ((document.getElementById('pan_img').scrollHeight*p[1]-box.scrollHeight+40))+'px';
    //console.log(box.style.left, box.style.top);
    
    
    p=[0.7299451918285999, 0.4578313253012048]
    box = document.getElementById('disp_box2');
    box.style.display='block';
    box.innerHTML = "<b>Finance</b> governs the economic security & prosperity of individuals & dictates long term development of organisations all across the world.<br>Learn <b>personal financial management & investment strategies</b> by participating in stock market simulations."
    box.style.left = ((document.getElementById('pan_img').scrollWidth*p[0]-box.scrollWidth-document.getElementById('pan_img').parentElement.scrollLeft))+'px';
    box.style.top = ((document.getElementById('pan_img').scrollHeight*p[1]))+'px';
    //console.log(document.getElementById('pan_img').scrollWidth,p[0],box.scrollWidth);
    setTimeout(() => {
      document.getElementById('disp_box').style.display='none'
      box.style.display='none'
    }, 3000);
  });
  }
  scroll_init(){
  }
  p_x=0.0;
  this:any;
  p_y=0.0;
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
    var texts=[
      "<b>Social Skills</b> are the most widely used skills for effective conversations in both personal and professional life.<br> Practice & Learn <b>articulation & conversation</b> techniques by implementing health awareness campaigns for a Member of the Parliament.",
      "<b>Electrical Engineering</b> forms the backbone of all 21st-century technological advancement.<br>Learn concepts of <b>circuit design & binary arithmetic</b> by prototyping your own handheld gaming device.",
      "<b>Filmmaking</b> is the most effective medium of sharing your stories that often have the potential to change the world order.<br>Learn the art of <b>storytelling & visual communication</b> by scripting, directing and shooting your own short movie clip",
      "<b>Product Design</b> is all about developing easy to use & good looking products that exist everywhere, making our lives fairly comfortable.<br>Learn <b>user research techniques & prototyping concepts</b> by ideating & developing innovative products for the elderly & disabled.",
      "<b>Human Psychology</b>  forms the core of our interactions and relationships with people.Learn the basis of <b>persuasion & stress coping strategies</b> by delivering elevator pitch of products & investigating stories of war.",
      "<b>Mechanical Engineering</b> finds itself in every machine that humans have made to make their lives easier & advance the civilization.<br>Learn concepts of <b>machine design & mechanics</b> by conceptualizing & developing your own mini air engine.",
      "Explore and Learn for the real world like never before.",
      "<b>Finance</b> governs the economic security & prosperity of individuals & dictates long term development of organisations all across the world.<br>Learn <b>personal financial management & investment strategies</b> by participating in stock market simulations.",
      "<b>Civil Engineering</b> is central to the design & development of urban cities.<br>Develop strong <b>3d visualisation & problem solving skills<b> by building models of an urban smart city under real life constraints.",
      "<b>Negotiation</b> is a core skill to find a common ground despite difference in opinions at work & home.<br>Develop <b>synchrony techniques</b> & master <b>body language</b> processing by executing mock business deals for your company.",
      "<b>Fashion Designing</b> is in every piece of cloth wear we use, directly creating long-lasting impressions of ourselves & others in the society.<br>Learn the nuances of good <b>fashion sense</b> & <b>creative ideation</b> techniques by designing your own take home t-shirt.",
      "<b>Law</b> is an art of defining justice and interpreting it for various different situations.<br>Learn <b>argument formation</b> & <b>basics of law</b> by fighting a legal hit & run case of a famous Indian Celebrity.",
    ]
    var coordinates=[
      [12.855007473841553, 29.21686746987952, 14.349775784753364, 33.58433734939759, texts[0]],
      [19.33233682112606, 6.475903614457831, 21.026407573492776, 11.44578313253012, "Electrical Engineering"],
      [19.382162431489785, 45.63253012048193, 21.026407573492776, 50.30120481927711, "Filmmaking"],
      [43.846537120079724, 4.216867469879518, 45.54060787244644,9.036144578313253, "Product Design"],
      [48.629795714997506, 82.53012048192771, 50.2740408570005, 87.19879518072288, "Human Psychology"],
      [59.342301943198805, 56.92771084337349, 60.98654708520179, 61.897590361445786, "Mechanical Engineering"],
      [64.07573492775288, 26.20481927710843, 65.8196312904833, 31.475903614457827, "Explore and the learn for the real world like never before"],
      [72.99451918285999, 45.78313253012048, 74.6885899352267, 50.602409638554214, "Finance"],
      [77.13004484304933, 12.650602409638553, 78.82411559541605, 17.46987951807229, "Civil Engineering"],
      [80.51818634778276, 75, 82.16243148978575, 80.12048192771084, "Fashion Design"],
      [94.07075236671649, 23.795180722891565, 95.7648231190832, 28.614457831325304, "Law"],
      [90.98156452416542, 57.98192771084337, 92.57598405580468, 62.80120481927711, "asdx"]
    ]
    //console.log(p_x, p_y);
    window['p_x']=p_x;
    window['p_y']=p_y;
    var box = document.getElementById('disp_box');
    var disp='none', pos='';
    for(var i in coordinates){
      // x1<x1<x2 && y1<y<y2
      if(p_x>=coordinates[i][0] && p_x<=coordinates[i][2] && p_y>=coordinates[i][1] && p_y<=coordinates[i][3])
      {
        disp='block';
        pos=i;
        break;
      }

    }
    if(disp=='block') box.innerHTML=texts[pos];
    var x_over = m_posx<window.innerWidth/2?pos=='4'?-(box.scrollWidth):10:-(box.scrollWidth), y_over = m_posy<window.innerHeight/2?10:-(box.scrollHeight);
    box.style.display=disp;
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
  print(){
    //console.log(window['p_x']+", "+window['p_y']+", ");
  }
}
$(window).on('load', ()=>{
  //document.getElementById.
  var pan_img = document.getElementById('pan_img');
  var a = (58.29596412556054/100 - pan_img.parentElement.parentElement.scrollWidth/(2*pan_img.parentElement.scrollWidth))*pan_img.parentElement.scrollWidth
  pan_img.parentElement.scrollLeft=a
  //console.log(a);
  $('#pan_img').on('touchstart', (e)=>{
    init_touch=e.changedTouches[0].screenX
    init_pos =  document.getElementById('pan_img').parentElement.scrollLeft
  })
  $('#pan_img').on('touchmove', (e)=>{
    document.getElementById('pan_img').parentElement.scrollLeft = init_pos + init_touch-e.changedTouches[0].screenX;
    //console.log(e);
  })
})
var init_touch=0, init_pos
