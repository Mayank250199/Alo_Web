export class Scroller{
    sections_length=[];
    constructor(private out_element){
        // getting the height of screen, and setting it to outelement's property
        this.adjust();
        this.out_element.addEventListener('scroll', ()=>this.onScroll());
    }
    adjust(){
        this.out_element.style.height = window.innerHeight+'px';
        var sections=this.out_element.children;
        var tmplength=0;
        for(var i=0;i<sections.length;i++){
            sections[i].style.minHeight = (window.innerHeight+10)+'px';
            tmplength += sections[i].scrollHeight; 
            this.sections_length.push(tmplength)
        }
        console.log(this.sections_length);
    }
    last_top_position;
    get_position(val){
        var pos=0, minh=this.sections_length[0];
        for (let i = 0; i < this.sections_length.length; i++) {
            if(val<this.sections_length[i]) break;
            else pos+=1;
        }
        if(pos>=this.sections_length.length)pos=this.sections_length.length-1;
        return pos;
    }
    onScroll(){
        if(scrolling) return;
        var diff = (this.last_top_position - this.out_element.scrollTop);
        if(diff == 0) return;
        var scrolled_up = diff > 0;
        // -1 = down, +1 = moved up
        //console.log(scrolled_up);
        if(scrolled_up){
            var curr_sec_pos = this.get_position(this.out_element.scrollTop),
                prev_sec_pos = this.get_position(this.last_top_position);
                // transection occur if curr-prev<0
                if((curr_sec_pos-prev_sec_pos)<0){ 
                    this.scroll_to(this.sections_length[curr_sec_pos]-window.innerHeight);
                    //console.log(curr_sec_pos, prev_sec_pos);   
                }

                // else no transaction required
        } else {
            // scrolled down
            var curr_sec_pos = this.get_position(this.out_element.scrollTop+window.innerHeight),
                prev_sec_pos = this.get_position(this.last_top_position+window.innerHeight);
                // transection occur if curr-prev>0
                if((curr_sec_pos-prev_sec_pos)>0) 
                    this.scroll_to(this.sections_length[curr_sec_pos-1]);
                // else no transaction required
        }
        this.last_top_position = this.out_element.scrollTop;
    }
    scroll_to(to, duration=1000){
        scrollTo(this.out_element, to, duration);
    }
}
var scrolling = false;
function scrollTo(element, to, duration) {
    scrolling = true;
    var start = element.scrollTop,
        change = to - start,
        currentTime = 0,
        increment = 20;
        
    var animateScroll = function(){        
        currentTime += increment;
        var val = easeInOutQuad(currentTime, start, change, duration);
        element.scrollTop = val;
        if(currentTime < duration) {
            setTimeout(animateScroll, increment);
        }
        else scrolling = false;
    };
    animateScroll();
}

//t = current time
//b = start value
//c = change in value
//d = duration
function easeInOutQuad(t, b, c, d) {
  t /= d/2;
	if (t < 1) return c/2*t*t + b;
	t--;
	return -c/2 * (t*(t-2) - 1) + b;
};