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
    {image: '../../../assets/Card_page/Electrical front.png'},
    {image: '../../../assets/Card_page/emotional front.png'},
    {image: '../../../assets/Card_page/law front.png'},
    {image: '../../../assets/Card_page/product design.png'},
    {image: '../../../assets/Card_page/social front.jpg'}
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
