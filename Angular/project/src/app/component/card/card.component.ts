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

  constructor() { }

  ngAfterViewInit() {
    this.owl();
  }

  slides = [
    {image: '../../../assets/Card_page/3.jpg'},
    {image: '../../../assets/Card_page/3bg.jpg'},
    {image: '../../../assets/Card_page/78.jpg'},
    {image: '../../../assets/Card_page/79.jpg'},
    {image: '../../../assets/Card_page/89.jpg'},
    {image: '../../../assets/Card_page/807.jpg'}
  ];
  
  owl(){ 
  
 
          $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                loop:true,
                margin:10,
                nav:false,
                dots:false,
                responsive:{
          0:{
              items:1
          },
          600:{
              items:3
          },
          1000:{
              items:3
          },
          1100:{
              items:3
          },
          1200:{
              items:3
          }
      }
            })
  
          })
        }
    
  
  }


