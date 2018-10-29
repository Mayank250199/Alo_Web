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
  
  } 
  play(){
    
    var playPromise=document.getElementById('responsive').children[0]['play']();

  if (playPromise !== undefined) {
    playPromise.then(a => {
      // Automatic playback started!
      // Show playing UI.
      console.log(a);
    })
    .catch(error => {
      // Auto-play was prevented
      // Show paused UI.
      console.log(error);
    });
  }
  } 
  pause(){
    //document.getElementById('responsive').children[0]['pause']();
  }
  

}

