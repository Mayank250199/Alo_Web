import { Component, ChangeDetectorRef } from '@angular/core';

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
  loaded_inc(){
      this.percentage = window['loaded'];
      if(this.percentage==3){
        console.log('loaded');
      } else {
        this.cdr.detectChanges();
        console.log('loading');
      }

  }
}
