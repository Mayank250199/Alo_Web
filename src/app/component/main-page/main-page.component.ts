import { Component, AfterViewInit} from '@angular/core';
import * as $ from 'jquery';

declare var $:any;
@Component({
  selector: 'app-main-page',
  templateUrl: './main-page.component.html',
  styleUrls: ['./main-page.component.css']
})
export class MainPageComponent implements AfterViewInit {

  constructor() { }

  ngAfterViewInit() {
    this.counter();
  }
counter(){
  $('.count').each(function () {
      $(this).prop('Counter',0).animate({
          Counter: $(this).text()
      }, {
          duration: 4000,
          easing: 'swing',
          step: function (now) {
              $(this).text(Math.ceil(now)+'%');
          }
      });
  });

}
}
