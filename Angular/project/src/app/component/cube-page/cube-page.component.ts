import { Component, OnInit,AfterViewInit } from '@angular/core';

@Component({
  selector: 'app-cube-page',
  templateUrl: './cube-page.component.html',
  styleUrls: ['./cube-page.component.css']
})
export class CubePageComponent implements AfterViewInit {

  constructor() { }
  data=[
    {
      head:'A Real World Experience',
      body:'Each Alo experience revolves around a real-world scenario/project, frequently encountered in 21st-century profession, or personal life.',
      image_name:'RW_1.gif'
    },
    {
      head:'Immersive  Pedagogy',
      body:'The various skills required to tackle that scenario are learned through hands-on activities, live demonstrations & classroom games to engage school students. Along with online tools and games at home to master the skills.',
      image_name:'H_2.gif'
    },
    {
      head:'Designed by Experts',
      body:'Alo experiences have been designed for authentic exposure by field experts from esteemed institutions like IIT Delhi, AIIMS, NIFT, Delhi University, National Law University etc.',
      image_name:'M_3.gif'
    },
    {
      head:'Rigorous Assessment and Mapping',
      body:"Throughout the in-class experience and online tools & games, we rigorously track the student's growth in holistic skills and compatibility with various professions."+      
      "We map this assessment to our scientifically researched educational framework to suggest students the next set of learning experiences - for holistic development and in-depth career mapping.",
      image_name:'As_4.gif'
    }
  ]
  
  ngAfterViewInit() {
    console.log(this.data);
    
   }
}
