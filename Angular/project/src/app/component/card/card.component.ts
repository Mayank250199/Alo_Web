import { Component, AfterViewInit} from '@angular/core';
import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel';
import * as $ from 'jquery';

declare var $:any;
@Component({
  selector: 'app-card',
  templateUrl: './card.component.html',
  styleUrls: ['./card.component.css']
})
export class CardComponent implements AfterViewInit{

  constructor() {}
  ngOnInit(){

  }
  ngAfterViewInit() {
    //this.owl();
    console.log('i was here');
    document.getElementById('slider').draggable = true;
    document.getElementById('slider').ondragstart = (e)=>{
        prevslx = e.screenX;
        //console.log('start');
    };
    document.getElementById('slider').ondrag = onSlide;

  }
  

  slides = [
    '../../../assets/Card_page/Electrical front.png',
    '../../../assets/Card_page/emotional front.png',
    '../../../assets/Card_page/law front.png',
    '../../../assets/Card_page/product design.png',
    '../../../assets/Card_page/social front.png'
  ];
  slide(dir){
      slide(dir);
  }
}
var prevslx=0, direction=0, curr=3;
function slide(dir){
    curr += dir;
    if(curr==6) curr=1;
    else if(curr == 0) curr = 5;
    
    document.getElementById('s'+curr).checked = true;
}
function onSlide(e){
    //console.log(prevslx);
    if(e.screenX == 0) {
        //prevslx=0;
       slide(direction);
        
        return;
    }
    if(prevslx-e.screenX > 0){
        //console.log('left');
        direction=1;
    }
    else if(prevslx-e.screenX < 0){
        //console.log('right');
        direction=-1;
    }
    //prevslx = e.screenX;
  }

/*
  owl(){


          $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
              // stagePadding: 200,
              loop:true,
              margin:0,
              items:1,
              nav:false,
            responsive:{
                  0:{
                      items:1,
                      // stagePadding: 60
                  },
                  600:{
                      items:1,
                      // stagePadding: 100
                  },
                  1000:{
                      items:2,
                      // stagePadding: 200
                  },
                  1200:{
                      items:3,
                      // stagePadding: 250
                  },
                  1400:{
                      items:5,
                      // stagePadding: 300
                  },
                  1600:{
                      items:5,
                      // stagePadding: 350
                  },
                  1800:{
                      items:5,
                      // stagePadding: 400
                  }
              }
          })
        })
        }


  }
*/