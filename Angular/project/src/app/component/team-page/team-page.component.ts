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
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    },
    {
      name:'Apurv kaushal',
      pic_name: 'Apurv_Kaushal.jpg',
      position:'CPO & Co-Founder',
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    },
    {
      name:'Anuj Chopra',
      pic_name: 'Anuj_Chopra.jpg',
      position:'COO',
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    }];
    team_members_rest=[
    {
      name:'Ashutosh Gamad',
      pic_name: 'Ashutosh_Gamad.jpg',
      position:'Experience Designer',
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    },
    {
      name:'Apoorva Mishra',
      pic_name: 'Apoorva_Mishra.jpg',
      position:'Psychology Expert',
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    },
    {
      name:'Divyarth Saxena',
      pic_name: 'Divyarth_Saxena.png',
      position:'Experience Designer',
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    },
    {
      name:'Vani Batra',
      pic_name: 'Vani_Batra.JPG',
      position:'Public Relations Executive',
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    },
    {
      name:'Manjistha Datta',
      pic_name: 'Manjistha_Datta.jpg',
      position:'Psychology Expert',
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    },
    {
      name:'Nidhi Jhala',
      pic_name: 'Nidhi_Jhala.JPG',
      position:'Product Design Expert',
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    },
    {
      name:'Harshita Arora',
      pic_name: 'Harshita_Arora.jpg',
      position:'Graphic Designer',
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    },
    {
      name:'Nishank Goyal',
      pic_name: 'Nishank_Goyal.jpg',
      position:'Experience Designer',
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    },
    {
      name:'Ritvik Sharma',
      pic_name: 'Ritvik_Sharma.png',
      position:'Graphic Designer',
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    },
    {
      name:'Siddhant Goel',
      pic_name: 'Siddhant_Goel.jpg',
      position:'Graphic Designer',
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    },
    {
      name:'Siddharth Choubay',
      pic_name: 'Siddharth_Choubay.jpg',
      position:'Business Executive',
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    },
    {
      name:'Rajeshwari Kamble',
      pic_name: 'Rajeshwari_Kamble.jpeg',
      position:'Experience Designer',
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    },
    {
      name:'Sumir Kumar',
      pic_name: 'Sumir_Kumar.jpeg',
      position:'Business Executive',
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    },
    {
      name:'Tarandeep Singh',
      pic_name: 'Tarandeep_Singh.jpg',
      position:'Experience Designer',
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    },
    {
      name:'Tarun Rastogi',
      pic_name: 'Tarun_Rastogi.jpg',
      position:'Film Making Expert',
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    },
    {
      name:'Yash Bhatnagar',
      pic_name: 'Yash_Bathnagar.png',
      position:'Experience Designer',
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    },
    {
      name:'Mayank Jha',
      pic_name: 'mayankjha.jpg',
      position:'Web Developer',
      details: 'This is the tribune to tailava, I love my PC, bla bla bla, thats it'
    },


  ]
  constructor() { }

  ngOnInit() {
    //console.log(this.team_members)
  }


}
