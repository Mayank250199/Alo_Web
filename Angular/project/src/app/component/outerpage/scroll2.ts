export class FocusScroller{
    sections_length=[];
    constructor(private out_element,private focus_start=0,private focus_end=window.innerHeight){
        this.adjust();
        this.out_element.addEventListener('scroll', ()=>this.onScroll());

        window.onresize = ()=>this.adjust();
    }
    adjust(){
        // making outer element height equal to max available
        this.out_element.style.height = this.focus_end-this.focus_start;
        var sections=this.out_element.children;
        var tmplength=0;
        for(var i=0;i<sections.length;i++){
            // make sure every element have min-height = focus-diff
            sections[i].style.minHeight = window.innerHeight;
            tmplength += sections[i].scrollHeight; 
            this.sections_length.push(tmplength)
        }
        this.check_allowed();
        
    }
    
    allowed_scroll_up=false
    required_scroll_up=0
    allowed_scroll_down=false
    required_scroll_down=0
    focused_element_no

    check_allowed(){
        /** finding the current focused element */
        this.last_scroll_top = this.out_element.scrollTop;
        var mid_height = this.out_element.scrollTop + (this.focus_start + this.focus_end)/2;
        var i=0
        for(;i<this.sections_length.length;i++) if(mid_height<this.sections_length[i]) break;
        this.focused_element_no = i;
        /** Function to check if animated scrolling needed */
        if((this.out_element.scrollTop + this.focus_start) in this.sections_length.concat(0)){
            this.allowed_scroll_up = true;
        } else { 
            this.allowed_scroll_up=false;
            this.required_scroll_up=this.out_element.scrollTop-this.sections_length[this.focused_element_no-1];
        }

        if((this.out_element.scrollTop + this.focus_end) in this.sections_length) {
            this.allowed_scroll_down = true;
            this.required_scroll_down = 0;
        } else {
            this.allowed_scroll_down=false;
            this.required_scroll_down = this.sections_length[this.focused_element_no]-(this.out_element.scrollTop+this.focus_end);
        }
    }
    last_scroll_top;
    onScroll(){
        // getting scroll direction
        if(this.last_scroll_top != this.out_element.scrollTop){
            //scrolling is done
            var ammount = this.out_element.scrollTop-this.last_scroll_top;

            if(ammount>0){
                //scrolled down
                if(this.allowed_scroll_down){
                    // make the top of next element at our focus top  
                    
                } else {
                    // check if current scroll was enough to change this shit
                    if(ammount>this.required_scroll_down){
                        // yes, please scroll to next of current focused element

                    }
                    else {
                        // no extra scrolling required
                        this.check_allowed();
                    }
                }
            }else{
                //scrolled up
                if(this.allowed_scroll_up){
                    // make the bottom of next element at our focus bottom

                } else {
                    // check if scroll was enough to change this shit
                    if(-1*ammount>this.required_scroll_up){
                        // yes please scroll to prevous focused element
                    } else {
                        // no extra scrolling is required
                        this.check_allowed();
                    }
                }
            }


        }

    }


}