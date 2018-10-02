import { Component, OnInit } from '@angular/core';
import {Scroller} from './scroller';
@Component({
  selector: 'app-outerpage',
  templateUrl: './outerpage.component.html',
  styleUrls: ['./outerpage.component.css']
})
export class OuterpageComponent implements OnInit {

  constructor() { }

  ngOnInit() {
  }
  scroller;
  ngAfterViewInit(){
    this.scroller= new Scroller(document.getElementById('mfullpage'));
    //console.clear();
    //console.log(this.scroller);
  }

}
