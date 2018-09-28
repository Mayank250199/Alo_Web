import { Component, OnInit } from '@angular/core';
declare const require:any;
declare var fullpage:any;
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'app';
  ngAfterViewInit() {
    //We loading the script on after view is loaded

    import('../assets/full_pageJs/scrolloverflow.js');
    import('../assets/full_pageJs/fullpage.js');
    
    
  }
}
