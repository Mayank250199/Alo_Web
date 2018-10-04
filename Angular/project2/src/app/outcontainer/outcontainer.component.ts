import { Component, OnInit } from '@angular/core';
import { $ } from 'protractor';

@Component({
  selector: 'app-outcontainer',
  templateUrl: './outcontainer.component.html',
  styleUrls: ['./outcontainer.component.css']
})
export class OutcontainerComponent implements OnInit {

  constructor() { }

  ngOnInit() {
  }
  myFullPage
  ngAfterViewInit(){
    this.myFullPage = window['fullpage']('#mfullpage', {
      licenseKey: 'OPEN-SOURCE-GPLV3-LICENSE',
      scrollOverflow:true,
      sectionsColor : ['#ccc', '#fff']
    });
    var self=this;
    window['full_page']=this.myFullPage;
    document.getElementById('cubeframe').style.height = window.innerHeight+'px';
    document.getElementById('cubeframe').onload=()=>{
      document.getElementById('cubeframe')['contentWindow']['update_parent']=(up,dn,swp)=>{
      if(up){
        self.myFullPage.moveSectionUp();
        if(swp!=undefined && swp.slideNext!=undefined)
          setTimeout(()=>swp.slideNext(), 1100);
      }
      else if(dn){
        self.myFullPage.moveSectionDown();
        if(swp!=undefined && swp.slideNext!=undefined)
          setTimeout(()=>swp.slidePrev(), 1100);
      } 
    };
   }
  }
}
