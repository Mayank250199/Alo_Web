var swiper;
function update_parent(move_down=false){
    console.log(move_down);
}
function getDefs(){
    if(swiper==undefined){
        setTimeout(()=>{
            swiper = document.getElementsByClassName('swiper-container')[0].swiper;
            document.scrollingElement.onwheel = onScroll;
	        document.getElementsByClassName('arrow-left')[0].onclick=left_;
            document.getElementsByClassName('arrow-right')[0].onclick=right_;
            disable_default_scrolling()
            //console.log('did it');
        }, 500);
    }
}
function disable_default_scrolling(){
    if(undefined==swiper){
        getDefs();
        console.log('it was undefined');
    } else {
        swiper.container.off();
    }
}

function onScroll(e){
    //if(e.deltaY>1 || e.deltaY<-1) return;
    //console.log(e);
     // dont proceed if already animating

    //desktop mode
    if(document.scrollingElement.scrollHeight - window.innerHeight<10){
        getDefs();
        disable_default_scrolling();
        if(swiper.animating) return;
        //console.log(e.deltaX);
        if(e.deltaY>0){ // forward
            if(swiper.activeIndex==4){
                // heighest possible value so page down
                update_parent(true);
            }  else{
                swiper.slideNext();
            }
        } else if(e.deltaY<0){ //backward
            if(swiper.activeIndex==1) {
                // least possible value
                update_parent(false);
            }
             else{
                swiper.slidePrev();
            }          
        }
    } 
    // mobile mode 
    else {
        //console.log(document.scrollingElement.scrollTop);
        if (document.scrollingElement.scrollTop == 0 && e.deltaY<0) {
            update_parent(false);

            
        } else if (document.scrollingElement.scrollHeight == window.innerHeight + document.scrollingElement.scrollTop&& e.deltaY>0) {
            update_parent(true);
        }
        else{
        document.scrollingElement.scrollTop+=e.deltaY;
        }

    }
}
function right_(){
    onScroll(e={deltaX:1, deltaY:1});
}
function left_(){
    onScroll(e={deltaX:-1, deltaY:-1});
}
getDefs();