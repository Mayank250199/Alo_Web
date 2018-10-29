import { Component, ChangeDetectorRef } from '@angular/core';
declare const $: any;
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})

export class AppComponent {
  title = 'app';
  percentage = 0;
  constructor(private cdr: ChangeDetectorRef) { }
  ngOnInit() {
    var self = this;
    window['progress'] = () => {
      self.loaded_inc();
    }
    this.loaded_inc();
  }
  ngAfterViewInit() {
    //console.log('after view init app');
    $('#toggle').click(function () {
      $(this).toggleClass('active');
      $('#overlay').toggleClass('open');
    });

    var el = document.getElementById("mouse_icon");
    document.scrollingElement.onwheel = (e) => {
      //console.log('scrolling');
      /*
      if (window['full_page'] == undefined) {
        //on team page, hide mouse
        el.style.display = 'none';
      } else if (el.style.display == 'none') {
        el.style.display = 'block';
      } else {
        var ind = window['full_page'].getActiveSection().index;
        if (ind == 0) {
          //hide bottom icon
          el[1].style.display = 'none';
          el[2].style.display = 'block';
        } else if (ind == 4) {
          el[2].style.display = 'none';
          el[1].style.display = 'block';
        }
      }*/
    }


  }

  loaded_inc() {
    /*this.percentage = window['loaded'];
    if (this.percentage == 3) {
      console.log('loaded');
    } else {
      this.cdr.detectChanges();
      console.log('loading');
    }*/

  }
  scroll_click() {
    if (window['full_page'].getActiveSection().index == 4) {
      window['full_page'].moveTo(1);
      //document.getElementById('scroller_imgdn').style.display = 'block';
      //document.getElementById('scroller_imgup').style.display = 'none';
      //document.getElementById('scroller_imgboth').style.display = 'none';

    } else window['full_page'].moveSectionDown();
  }
}
//document.scrollingElement.on
//$(window).on('resize',function(){location.reload();});