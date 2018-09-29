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

    import('../assets/full_pageJs/scrolloverflow.js')
      .then(()=>{
        import('../assets/full_pageJs/fullpage.js')
          .then(()=>{
            window['myFullpage'] = new fullpage('#mfullpage', {
              licenseKey:'OPEN-SOURCE-GPLV3-LICENSE',
              anchors: ['firstPage', 'secondPage', '3rdPage', '4thPage'],
              sectionsColor: ['#212C3E', '#939FAA', '#323539'],
              scrollOverflow: true
            });
            console.log('full page is now ready')
          })
      })
    
  }
}
