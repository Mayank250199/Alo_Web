import { Component, AfterViewInit} from '@angular/core';

import '../../../../assets/card_page/js/jquery.flip.min.js';
declare var $:any, jquery:any;
@Component({
  selector: 'app-cards',
  templateUrl: './cards.component.html',
  styleUrls: ['./cards.component.css']
})
export class CardsComponent implements AfterViewInit{

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
    flipinit();

  }


  slides = [
    {image_front:'../../../../assets/card_page/Electricalfront.png',image_back:'../../../../assets/card_page/electrical.png'},
    {image_front:'../../../../assets/card_page/emotionalfront.png', image_back:'../../../../assets/card_page/emotional.png'},
    {image_front:'../../../../assets/card_page/lawfront.png',image_back:'../../../../assets/card_page/law.png'},
    {image_front:'../../../../assets/card_page/productdesign.png',image_back:'../../../../assets/card_page/product.png'},
    {image_front:'../../../../assets/card_page/socialfront.png',image_back:'../../../../assets/card_page/social.png'},
  ];
  slide(dir){
      slide(dir);
  }
  flip(no){
      divflip(no+1);
      console.log(no);
  }
  unflip(no){
      divunflip(no+1);
      console.log(no);
  }
}
var prevslx=0, direction=0, curr=3;
function slide(dir){
    curr += dir;
    if(curr==6) curr=1;
    else if(curr == 0) curr = 5;

    $('#s'+curr).prop('checked', true);
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

 function flipinit(){
    for(var i=1;i<=5;i++){
        $('#slide_flip'+i).flip();
    }
}
 function divflip(no){
    if($('#s'+no).prop('checked')==true){
        // this is the current element
        $('#slide_flip'+no).flip(true);
    }
 }
 function divunflip(no){
    $('#slide_flip'+no).flip(false);
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
