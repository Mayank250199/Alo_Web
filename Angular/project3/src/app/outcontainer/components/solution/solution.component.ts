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
    document.getElementById('responsive').children[0]['play']();
  } 
  pause(){
    document.getElementById('responsive').children[0]['pause']();
  }
  

}

