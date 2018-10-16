import { Component, AfterViewInit, ChangeDetectorRef} from '@angular/core';

import '../../../../assets/card_page/js/jquery.flip.min.js';
declare var $:any, jquery:any;
@Component({
  selector: 'app-cards',
  templateUrl: './cards.component.html',
  styleUrls: ['./cards.component.css']
})
export class CardsComponent implements AfterViewInit{

  constructor(private cde:ChangeDetectorRef) {}

  ngOnInit(){

  }
  ngAfterViewInit() {
    //this.owl();
    document.getElementById('slider').draggable = true;
    //document.getElementById('slider').ondragstart = (e)=>{
      //  prevslx = e.screenX;
        //console.log('start');
    ///};
    //document.getElementById('slider').ondrag = onSlide;
    flipinit();
    this.cde.detectChanges();
  }


  slides = [
    {image_front:'../../../assets/card_page/product.png',image_back:'../../../assets/card_page/productfront.png'},
    {image_front:'../../../assets/card_page/emotional.png', image_back:'../../../assets/card_page/emotionalfront.png'},
    {image_front:'../../../assets/card_page/Law.png',image_back:'../../../assets/card_page/Lawfront.png'},
    {image_front:'../../../assets/card_page/electrical.png',image_back:'../../../assets/card_page/electricalfront.png'},
    {image_front:'../../../assets/card_page/social.png',image_back:'../../../assets/card_page/socialfront.png'},
  ];
  slide(dir){
      slide(dir);
  }
  jump_to(no){
      jump_to(no+1);
      //console.log('clicked', no)
  }
  flip(no){
      divflip(no+1);
      //console.log(no);
  }
  unflip(no){
      divunflip(no+1);
      //console.log(no);
  }
  animating=false;
  animate(val=0){
    /*if(val==0) this.animating=false;
    if(this.animating) return;
    this.animating=true;
    */
    if(val!=0){
        if(val==-1) document.getElementById("cards_leftbar").style.backgroundColor='rgba(0,0,0,0.5)';
        else document.getElementById("cards_rightbar").style.backgroundColor="rgba(0,0,0,0.5)"
        if(this.animating) return;
        else{
            this.animating=true;
            slide(val);
            var self=this;
            var i=setInterval(()=>{
                    if(self.animating==false) clearInterval(i);
                    else slide(val);
                }, 1500);
        }
    } else {
        this.animating=false;
        document.getElementById("cards_leftbar").style.backgroundColor="rgba(0,0,0,0.1)"
        document.getElementById("cards_rightbar").style.backgroundColor="rgba(0,0,0,0.1)"
    }

  }
}
var prevslx=0, direction=0, curr=3;
function jump_to(no){
    curr=no;
    $('#s'+no).prop('checked', true);
}
function slide(dir){
    curr += dir;
    if(curr==6) curr=1;
    else if(curr == 0) curr = 5;

    $('#s'+curr).prop('checked', true);
}

function onSlide(e){
    //console.log(prevslx);
    if(e.screenX == 0) {
        //prevslx=0;
       slide(direction);

        return;
    }
    if(prevslx-e.screenX > 0){
        //console.log('left');
        direction=1;
    }
    else if(prevslx-e.screenX < 0){
        //console.log('right');
        direction=-1;
    }
    //prevslx = e.screenX;
  }

 function flipinit(){
    for(var i=1;i<=5;i++){
        $('#slide_flip'+i).flip();
    }
}
 function divflip(no){
    if($('#s'+no).prop('checked')==true){
        // this is the current element
        $('#slide_flip'+no).flip(true);
    }
 }
 function divunflip(no){
    $('#slide_flip'+no).flip(false);
 }
