import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-team',
  templateUrl: './team.component.html',
  styleUrls: ['./team.component.css']
})
export class TeamComponent implements OnInit {
  team_members_top=[
    {
      name:'Anoosh Kotak',
      pic_name: 'Anoosh.png',
      position:'CEO & Co-Founder',
      details: 'A Computer Science Student at IIT Delhi, Anoosh took a year drop from college after first year to immerse in the Indian education ecosystem and conceptualised the idea of Alo. He leads the business & marketing operations side of Alo and is working on our in-house Intelligent Tracking System for holistic development & field compatibility mapping.'
    },
    {
      name:'Apurv kaushal',
      pic_name: 'Apurv.png',
      position:'CPO & Co-Founder',
      details: 'A graduate from IIT Delhi, Apurv leads the in class experience and online+ offline product design & development process for Alo. With an experience of leading multiple social enterprises in the past, he decided to opt out of placements and rather invest his time in creating an impact within the Indian education space.'
    },
    {
      name:'Anuj Chopra',
      pic_name: 'Anuj.png',
      position:'COO',
      details: 'Anuj is our go to guy for handling the infinite problems associated with on ground operations & logistics of our Alo workshops. A Textile Engineering student at IIT Delhi as per society norms, he is also our unofficial Chief Entertainment Officer who can arrange parties of all kind to ensure the entertainment level/quotient and culture of team remains just perfect.'
    }];
    team_members_rest=[
    {
      name:'Ashutosh Gamad',
      pic_name: 'Ashutosh.png',
      position:'Experience Designer'
    },
    {
      name:'Apoorva Mishra',
      pic_name: 'Apoorva.png',
      position:'Psychology Expert'
    },
    {
      name:'Divyarth Saxena',
      pic_name: 'Divyarth.png',
      position:'Experience Designer'
    },
    {
      name:'Harshita Arora',
      pic_name: 'Harshita.png',
      position:'Graphic Designer'
    },
    {
      name:'Tarandeep Singh',
      pic_name: 'Taran.png',
      position:'Operations Executive'
    },
    {
      name:'Nidhi Jhala',
      pic_name: 'Nidhi.png',
      position:'Business Executive'
    },
    {
      name:'Rajeshwari Kamble',
      pic_name: 'Rajeshwari.png',
      position:'Experience Designer'
    },
    {
      name:'Nishank Goyal',
      pic_name: 'Nishank.png',
      position:'Experience Designer'
    },
    {
      name:'Tarun Rastogi',
      pic_name: 'Tarun.png',
      position:'Film Making Expert'
    },
    {
      name:'Siddhant Goel',
      pic_name: 'Sidhant.png',
      position:'Experience Designer'
    },
    {
      name:'Siddharth Choubay',
      pic_name: 'Siddharth.png',
      position:'Business Executive'
    },
    {
      name:'Vani Batra',
      pic_name: 'Vani.png',
      position:'Public Relations Executive'
    },
    {
      name:'Sumir Kumar',
      pic_name: 'Sumir.png',
      position:'Business Executive'
    },
    {
      name:'Yash Bhatnagar',
      pic_name: 'Yash.png',
      position:'Experience Designer'
    },
    {
      name:'Ritvik Sharma',
      pic_name: 'Ritvik.png',
      position:'Electrical Engineering Expert'
    },
    {
      name:'Gouri jayasurya',
      pic_name: 'gouri.png',
      position:'Fashion Design Expert'
    },
    {
      name:'Mayank Jha',
      pic_name: 'mayankjha.jpg',
      position:'Web Developer'
    },
    {
      name:'Manjistha Datta',
      pic_name: 'Manjistha.png',
      position:'Psychology Expert'
    },


  ]
  constructor() { }

  ngOnInit() {
  }

}
