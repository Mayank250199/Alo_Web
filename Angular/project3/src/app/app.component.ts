import { Component, ChangeDetectorRef } from '@angular/core';
declare const $:any;
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})

export class AppComponent {
  title = 'app';
  percentage=0;
  constructor(private cdr:ChangeDetectorRef){}
  ngOnInit(){
    var self=this;
    window['progress']=()=>{
      self.loaded_inc();
    }
    this.loaded_inc();
  }
  ngAfterViewInit() {
    $('#toggle').click(function() {
      $(this).toggleClass('active');
      $('#overlay').toggleClass('open');
     });
  }
  
  loaded_inc(){
      this.percentage = window['loaded'];
      if(this.percentage==3){
        console.log('loaded');
      } else {
        this.cdr.detectChanges();
        console.log('loading');
      }

  }
  scroll_click(){
    if(window['full_page'].getActiveSection().index ==4){
      window['full_page'].moveTo(1);
    } else window['full_page'].moveSectionDown();
  }
}
