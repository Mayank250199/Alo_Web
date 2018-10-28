import { Component, OnInit } from '@angular/core';
declare var $:any;

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
    
  }
}
$(window).on("load", ()=>{

  if(window.screen.availHeight>window.screen.availWidth)
    document['body']['webkitRequestFullScreen']();
  var mfp=window['fullpage']('#mfullpage', {
    licenseKey: 'OPEN-SOURCE-GPLV3-LICENSE',
    scrollOverflow:true,
    sectionsColor : ['#ccc', '#fff'],
    onLeave: function(origin, destination, direction){
      //console.log(origin, destination, direction);
      $('.mouse_animup').hide();
      $('.mouse_animdn').show();
      if(destination.isFirst) $('.mouse_animup').hide();
      else if(destination.isLast) {
        $('.mouse_animdn').hide();
        $('.mouse_animup').show();
      }
      if(destination.index==2){
        var vid:any=document.getElementById('responsive').children[0];
        vid.play();
        console.log('playing');
      }
    }
  });
  var self=this;
  window['full_page']=mfp;
  document.getElementById('cubeframe').style.height = window.innerHeight+'px';
  document.getElementById('cubeframe').onload=()=>{
    document.getElementById('cubeframe')['contentWindow']['update_parent']=(moveDown)=>{
    console.log(moveDown);
      if(!moveDown){
        window['full_page'].moveTo(3);
    }
    else {
      window['full_page'].moveTo(5);
    } 
  };
 }
  $('#cubeframe').attr({
    src:"../../assets/inside_sites/cube/nindex.html"});
})
