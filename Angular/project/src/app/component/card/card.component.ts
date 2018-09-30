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
    {image: '../../../assets/Card_page/social front.png'}
  ];

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
