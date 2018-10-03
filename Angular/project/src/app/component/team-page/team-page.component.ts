import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-team-page',
  templateUrl: './team-page.component.html',
  styleUrls: ['./team-page.component.css']
})
export class TeamPageComponent implements OnInit {

  team_members_top=[
    {
      name:'Anoosh Kotak',
      pic_name: 'Anoosh_Kotak.png',
      position:'CEO & Co-Founder',
      details: 'A Computer Science Student at IIT Delhi, Anoosh took a year drop from college after first year to immerse in the Indian education ecosystem and conceptualised the idea of Alo. He leads the business & marketing operations side of Alo and is working on our in-house Intelligent Tracking System for holistic development & field compatibility mapping.'
    },
    {
      name:'Apurv kaushal',
      pic_name: 'Apurv_Kaushal.jpg',
      position:'CPO & Co-Founder',
      details: 'A graduate from IIT Delhi, Apurv leads the in class experience and online+ offline product design & development process for Alo. With an experience of leading multiple social enterprises in the past, he decided to opt out of placements and rather invest him time in creating an impact within the Indian education space.'
    },
    {
      name:'Anuj Chopra',
      pic_name: 'Anuj_Chopra.jpg',
      position:'COO',
      details: 'Anuj is our go to guy for handling the infinite problems associated with on ground operations & logistics of our Alo workshops. A Textile Engineering student at IIT Delhi as per society norms, he is also our unofficial Chief Entertainment Officer who can arrange parties of all kind to ensure the entertainment level/quotient and culture of team remains just perfect.'
    }];
    team_members_rest=[
    {
      name:'Ashutosh Gamad',
      pic_name: 'Ashutosh_Gamad.jpg',
      position:'Experience Designer'
    },
    {
      name:'Apoorva Mishra',
      pic_name: 'Apoorva_Mishra.jpg',
      position:'Psychology Expert'
    },
    {
      name:'Divyarth Saxena',
      pic_name: 'Divyarth_Saxena.png',
      position:'Experience Designer'
    },
    {
      name:'Vani Batra',
      pic_name: 'Vani_Batra.JPG',
      position:'Public Relations Executive'
    },
    {
      name:'Manjistha Datta',
      pic_name: 'Manjistha_Datta.jpg',
      position:'Psychology Expert'
    },
    {
      name:'Nidhi Jhala',
      pic_name: 'Nidhi_Jhala.JPG',
      position:'Product Design Expert'
    },
    {
      name:'Harshita Arora',
      pic_name: 'Harshita_Arora.jpg',
      position:'Graphic Designer'
    },
    {
      name:'Nishank Goyal',
      pic_name: 'Nishank_Goyal.jpg',
      position:'Experience Designer'
    },
    {
      name:'Ritvik Sharma',
      pic_name: 'Ritvik_Sharma.png',
      position:'Graphic Designer'
    },
    {
      name:'Siddhant Goel',
      pic_name: 'Siddhant_Goel.jpg',
      position:'Graphic Designer'
    },
    {
      name:'Siddharth Choubay',
      pic_name: 'Siddharth_Choubay.jpg',
      position:'Business Executive'
    },
    {
      name:'Rajeshwari Kamble',
      pic_name: 'Rajeshwari_Kamble.jpeg',
      position:'Experience Designer'
    },
    {
      name:'Sumir Kumar',
      pic_name: 'Sumir_Kumar.jpeg',
      position:'Business Executive'
    },
    {
      name:'Tarandeep Singh',
      pic_name: 'Tarandeep_Singh.jpg',
      position:'Experience Designer'
    },
    {
      name:'Tarun Rastogi',
      pic_name: 'Tarun_Rastogi.jpg',
      position:'Film Making Expert'
    },
    {
      name:'Yash Bhatnagar',
      pic_name: 'Yash_Bathnagar.png',
      position:'Experience Designer'
    },
    {
      name:'Mayank Jha',
      pic_name: 'mayankjha.jpg',
      position:'Web Developer'
    },


  ]
  constructor() { }

  ngOnInit() {
    //console.log(this.team_members)
  }


}
