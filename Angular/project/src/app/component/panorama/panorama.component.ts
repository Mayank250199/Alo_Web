import { Component, OnInit } from '@angular/core';
import * as $ from 'jquery';
@Component({
  selector: 'app-panorama',
  templateUrl: './panorama.component.html',
  styleUrls: ['./panorama.component.css']
})
export class PanoramaComponent implements OnInit {

  constructor() { }

  ngOnInit() {
  }

}
$(function () {

  var $panorama = $('.panorama');

  var left = $panorama.offset().left;
  var width = $panorama.width();

  $('.panorama').mousemove(function (e) {
    var offset = e.pageX - left;
    var percentage = offset / width * 100;

    $panorama.css('background-position', percentage + '% 0');

  });

});
