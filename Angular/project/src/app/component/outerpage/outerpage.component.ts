import { Component, OnInit } from '@angular/core';
declare var $:any;
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
    $('#mfullpage').fullpage({
      licenseKey:'OPEN-SOURCE-GPLV3-LICENSE',
      sectionsColor: ['#4A6FB1', '#939FAA', '#323539'],
      scrollOverflow:true
    })
  }

}
