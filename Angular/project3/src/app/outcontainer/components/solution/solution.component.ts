import { Component, OnInit, AfterViewInit } from '@angular/core';
//import { setInterval } from 'timers';

@Component({
  selector: 'app-solution',
  templateUrl: './solution.component.html',
  styleUrls: ['./solution.component.css']
})
export class SolutionComponent implements AfterViewInit {

  constructor() { }

  ngAfterViewInit() {
    var vid:any=document.getElementById('responsive').children[0];
    //var t=setInterval(()=>{
      vid.autoplay=true;
          vid.loop=true;
          vid.controls=false;
          vid.autoplay = true;
          vid.load();
          vid.height=window.innerHeight;
      //console.log('playing');
       //vid.play(); b++; if(b>10) clearInterval(t);}, 1000);
       //var prev_scroll:any=document.scrollingElement.onwheel;
       document.scrollingElement.onwheel=(e)=>{
         //prev_scroll(e);
         if(window['full_page'].getActiveSection().index==2){
           document.getElementById('responsive').children[0]['play']();
         } else document.getElementById('responsive').children[0]['pause']();
       
       
       }
  } 
  play(){
    document.getElementById('responsive').children[0]['play']();
  } 
  pause(){
    document.getElementById('responsive').children[0]['pause']();
  }
  

}

